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

$sql = "select * from Exhibition";
$result = ($conn->query($sql));

$row = [];


if($result->num_rows > 0){
  $row = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" href="../dFormat.css?v=<?php echo time(); ?>">
<body>
  <div class="main">
      <h1>TICKETS</h1>
      <h2>Exhibition LookUp:</h2>
    
      <div class="ExhibitionSearch">
      <!--action="/Exhibition-Retrieval.php"-->
      <form action="Exhibition-Retrieval.php" method="GET">

            <!-- For looking up exhibition name-->
            <label for="EXHIBITION-COST">Exhibition Name:</label>
            <input type="text" name="exhibition-name-lookup" value="<?php if(isset($_GET['exhibition-name-lookup'])){echo $_GET['exhibition-name-lookup'];} ?>" id="exhibition-name-lookup" ><br>  
            <br>
            

            <!-- For looking up exhibition cost-->
            <label for="EXHIBITION-COST">Exhibition Cost:</label>
            <input type="search" name="exhibition-cost-lookup" value="<?php if(isset($_GET['exhibition-cost-lookup'])){echo $_GET['exhibition-cost-lookup'];} ?>" id="Exhibition_Cost_LookUp" ><br>  
            <br>
            

            <!-- For looking up exhibition starting date-->
            <label for="EXHIBITION-COST">Exhibition's Starting Date:</label>
            <input type="date" name="exhibition-sDate-lookup" value="<?php if(isset($_GET['exhibition-sDate-lookup'])){echo $_GET['exhibition-sDate-lookup'];} ?>" id="Exhibition_sDate_LookUp" ><br> 
            <br>

            <!-- For looking up exhibition ending date-->
            <label for="EXHIBITION-COST">Exhibition's Ending Date:</label>
            <input type="date" name="exhibition-eDate-lookup" value="<?php if(isset($_GET['exhibition-eDate-lookup'])){echo $_GET['exhibition-eDate-lookup'];} ?>" id="Exhibition_eDate_LookUp" ><br>
            <br>
            <input type="submit" name=submit value="Enter" /> 
            

        </form>
      </div>
      <p></p>
      <link rel="stylesheet" href="../Collections/Coll.css">
    <style>
         .button-56 {
            right:0px;
         }
    </style>
    <nav class="nav-item"><a href="Ticket.php"><button class="button-56" role="button">Return</button></a></nav>
    <p></p>
  </body>
</html>


<?php
  mysqli_close($conn);
?>