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
?>

<DOCTYPE html>
  <html>
  <link rel="stylesheet" href="../tFormat2.css?v=<?php echo time(); ?>">
  <body>
  <link rel="stylesheet" href="../Table.css">
    <div class="main">
    <h1>TICKETS: PURCHASED TICKETS</h1>
    <h2>TICKETS RETRIEVED:</h2>

    <div class="TicketOutput">
      <?php
        $Customer = $_GET['customer-lookup'];
        $ticketID = $_GET['tickets-lookup'];
        $status = $_GET['status-lookup'];
        $inDate = $_GET['inDate-lookup'];
        $outDate = $_GET['outDate-lookup'];
        $query0 = "SELECT * FROM VT WHERE ";
        $query1 = $query2 = $query3 = $query4 = $query5 = "ID > 0";
        if($ticketID != ''){
            $query1 = "ID='$ticketID'";
        }
        if(!empty($inDate)){
            $query2 = "DateSold >= '$inDate'";
        }
        if(!empty($outDate)){
            $query3 = "DateSold <= '$outDate'";
        }
        if(!empty($status)){
            if($status != "None"){
                $query4 = "Label= '$status'";
            }
        }
        if($Customer != ''){
            $query5 = "Customer LIKE '%{$Customer}%'";
        }
        if(empty($Customer) && empty($ticketID) && empty($inDate) && empty($outDate) && $status == "None"){
            $query = "SELECT * FROM VT";
        }
        else{
            $query = $query0 . $query1 . ' AND ' . $query2 . ' AND ' . $query3  . ' AND ' . $query4 . ' AND ' . $query5;
        }
        $result = mysqli_query($conn,$query);
        //if ticket id is found
        if(mysqli_num_rows($result) > 0){
          //create table
          echo "<table>";
            echo "<tr>";
              echo "<th>ID</th>";
              echo "<th>Customer Name</th>";
              echo "<th>Status</th>";
              echo "<th>Quantity</th>";
              echo "<th>Price</th>";
              echo "<th>Date</th>";
            echo "</tr>";

            //loop to add ticket information from database into table
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
                echo "<td>"  . $row['ID']  .  "</td>";
                echo "<td>"  . $row['Customer']  .  "</td>";
                echo "<td>"  . $row['Label']  .  "</td>";
                echo "<td>"  . $row['Quantity']  .  "</td>";
                echo "<td>"  . $row['Price']  .  "</td>";
                echo "<td>"  . $row['DateSold']  .  "</td>";
              echo "</tr>";
            }

          echo "</table>";
        }

        //if ticket id is not found
        else{
          echo "No ticket is found!";
        }
      ?>
    </div>
    <p></p>
    <p></p>
    <link rel="stylesheet" href="../Collections/Coll.css">
    <style>
         .button-56 {
            right:0px;
         }
    </style>
    <nav class="nav-item"><a href="ViewTicket-Search.php"><button class="button-56" role="button">Return</button></a></nav>
 
  </div>
  </body>
  </html>


  <?php
    mysqli_close($conn);
  ?>