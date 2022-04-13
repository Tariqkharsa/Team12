<?php session_start();?>
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

//session_start();
//$user=$_session["user"];
// $customer_id = $_SESSION['customer']
?>
<link href="site.css" rel="stylesheet">
<body>
  <div id="main">
  <h1> <?php
  $result = $connect->query("select * from Museum");
  $res = $result->fetch_all();
  print_r($res[0][0]);
?>
</h1>
<h2><?php
  $result = $connect->query("select * from Museum");
  $res = $result->fetch_all();
  print("Address: ");
  print_r($res[0][1]);
  print(" ");
  print_r($res[0][2]);
  print(" ");
  print_r($res[0][3]);
  $connect->close();
 ?> 
</h2>
  <h2>Our services</h2>
  <img src="images/Museum.jpeg" alt="Museum Photo" width = "240" height = "160" id = "image">
  <nav>
  <a href="Ticket.html" id = "button">Buy Tickets</a>
  </nav>
  <nav>
  <a href="Ex/exhibition_page.php" id = "button">Exhibitions</a>
  </nav>
  <nav>
  <a href="front.php" id = "button">Gift Shop</a>
  </nav>
  <nav>
  <a href="Collections/Collection.php" id = "button">Collections</a>
  </nav>
  <nav>
  <a href="About.php" id = "button">About</a>
  </nav>
  <?php
  if($_SESSION["user"] != "guest") 
  { 
    echo '<nav>
      <a href="Employees/employee.php" id = "button">Employee Management</a>
      </nav>';
  }
  ?>  

  <nav>
  <a href="index.php" id = "button">Logout</a>
  </nav>
</div>
</body>

