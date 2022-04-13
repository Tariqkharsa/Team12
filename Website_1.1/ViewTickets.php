<?php
echo "this is php";
$dbServername = "team12.copftkcel1k2.us-east-1.rds.amazonaws.com";
$dbUser = "admin";
$dbPass = "Group12,museum";
$dbName = "FinalTeam12";

$connect = mysqli_connect($dbServername, $dbUser, $dbPass, $dbName) or die("Unable to Connect to '$dbServername'");
// mysqli_select_db($connect, $dbName) or die("Could not open the db '$dbName'");
if($connect->connect_error) {
    die('Bad connection'. $connect->connect_error);
}

session_start();
// $customer_id = $_SESSION['customer']
?>
<link href="tFormat.css" rel="stylesheet">
<body>
  <div id="main">
  <h1>TICKETS: PURCHASED TICKETS</h1>
  <h2>Choose one of the following:</h2>

  <a class="Return_button" href="Ticket.html" id = "return-button">Return</a>

  
  <!--
  <?php
  $result = $connect->query("select * from Museum");
  $res = $result->fetch_all();
  print_r($res);
  $connect->close();
  ?>
    -->


</div>
</body>