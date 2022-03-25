<p>hello</p>
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
<link href="site.css" rel="stylesheet">
<body>
  <div id="main">
  <h1>Welcome to Fabulous Museum</h1>
  <h2>Our services</h2>
  <img src="images/Museum.jpeg" alt="Museum Photo" width = "240" height = "160" id = "image">
  <p>Login</p>
  <p>Buy Tickets</p>
  <p>Exhibition</p>
  <p>Gift Shop</p>
  <p>Collections</p>
  <nav>
  <a href="About.php" id = "button">About</a>
  </nav>
  
  <?php
  $result = $connect->query("select * from Museum");
  $res = $result->fetch_all();
  print_r($res);
  $connect->close();
?>



</div>
</body>
