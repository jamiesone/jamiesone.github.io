<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['numberSelection']) 		||
   empty($_POST['attendance'])	||
   empty($_POST['evening'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }

$name = $_POST['name'];
$email_address = $_POST['email'];
$attendance = $_POST['attendance'];
$message = $_POST['message'];
$evening = $_POST['evening'];
$numberSelection = $_POST['numberSelection'];


$conn = new mysqli('re0k9a.myd.infomaniak.com', 're0k9a_admin', 'emilyetsonDef2024!','re0k9a_wedding');

//$conn = new mysqli('emilyandpascal.cnc28ymq8qzp.eu-west-1.rds.amazonaws.com', 'admin', 'emilyetsonDef2024!','rsvp');
// Check connection
if ($conn->connect_error) {
   die("Connection failed");
}

$evening_int = 0;

if ($attendance == "true") {  
  $attendance_int = 1;
} else {
  $attendance_int = 0;
};


$sql = $conn->prepare("INSERT INTO guests (name, email, attendance, numberSelection, message, evening) VALUES (?, ?, ?, ?, ?, ?);");
$sql->bind_param("ssssss", $name, $email_address, $attendance_int, $numberSelection, $message, $evening_int);
//$sql = "INSERT INTO guests (name, email, attendance, numberSelection, message, evening) VALUES ('$name_updated', '$email_address', '$attendance', '$numberSelection', '$message_updated', '$evening');";

  
// if(mysqli_query($conn, $sql)){
if($sql->execute()){
   echo "Success";
   return true;
} else {
   echo "ERROR: Was not able to execute $sql. " . mysqli_error($conn);
   return false;
}

?>