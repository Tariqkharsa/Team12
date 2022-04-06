<?php
$dbServername = "team12.copftkcel1k2.us-east-1.rds.amazonaws.com";
$dbUser = "admin";
$dbPass = "Group12,museum";
$dbName = "FinalTeam12";

$connect = mysqli_connect($dbServername, $dbUser, $dbPass, $dbName) or die("Unable to Connect to '$dbServername'");
// mysqli_select_db($connect, $dbName) or die("Could not open the db '$dbName'");
if($connect->connect_error) {
    die('Bad connection'. $connect->connect_error);
}
$InputUName=(int) $_POST['userName'];
$InputPass=$_POST['password'];
if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$InputPass)) 
{

} 
else 
{
    header("Location: Login.php");
    exit();
}
//$result = $connect->query("select * FROM EMPLOYEES");
//$res = $result->fetch_all();
//print_r($InputUName);
$result = $connect->query("select JOBTITLE FROM EMPLOYEES WHERE EMPLOYEE_ID='{$InputUName}'AND BIRTHDATE='{$InputPass}'");
//$res = $result->fetch_all();
//print_r($res);

if($result->num_rows == 0)
{
    header("Location: Login.php");
    exit();
}
else
{
    header("Location: front.php");
    exit();
}
