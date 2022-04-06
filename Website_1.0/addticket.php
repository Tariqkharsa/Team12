<?php

$dbServername = "team12.copftkcel1k2.us-east-1.rds.amazonaws.com";
$dbUser = "admin";
$dbPass = "Group12,museum";
$dbName = "FinalTeam12";

//connect to database
$conn = new mysqli($dbServername, $dbUser, $dbPass, $dbName);

//if connection error occurs
if($conn -> connect_errno){
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

//tables that will be used to input data
$customer_table = "CUSTOMERS";
$ticket_table = "TICKET";


//variables that will hold their specified information
$firstname = $_GET['firstname_entered'];
$lastname = $_GET['lastname_entered'];
$age = $_GET['age_entered'];
$telnumber = $_GET['telephone number_entered'];
$email = $_GET['email_entered'];
$date = $_GET['sDate_entered'];


//inserting variables into the database tables
mysql_query("CREATE TABLE IF NOT EXISTS TICKET") 
mysql_query("INSERT INTO $customer_table(FirstName, LastName, Age, PhoneNumber, Email)
VALUES($firstname, $lastname, $age, $telnumber, $email)");


echo 'The information has been added!';

mysql_close($connection);

?>