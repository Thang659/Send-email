<?php
//connect to the database using OO
$servername = "localhost:3306";
$username = "root";
$password = $row="";
$conn = new mysqli($servername, $username, $password, 'debt');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select * from debt";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$from = 'thang@mail.com';
        $to = $row['email']; // The column where your e-mail was stored.
		$amount = $row['amount'];
		$firstname = $row['firstname'];
		$now =date_create("2018-05-15");
		$due= $row['Due']; $time = strtotime( $due ); $newform = date('y-m-d', $time ); //convert string to date
		$diff= date_diff($newform,$now); 
        $subject = 'Pay your debt!';
		$msg = 'Hey '."$firstname".' ,The amount of your debt is '."$amount".' Your due date is '. "$due";
		ini_set( 'sendmail_from', "thang@mail.com" ); 
		ini_set( 'SMTP', "mail.bigpond.com" );  
		ini_set( 'smtp_port', 25 );
        mail($to, $subject, $msg, $from);
		
     }
} else {
    echo "0 results";
    }
$conn->close();
echo "<h3> $msg </h3>";

?>

