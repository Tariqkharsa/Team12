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
  <link rel="stylesheet" href="tFormat.css?v=<?php echo time(); ?>">
  <body>
    <div class="main">
    <h1>TICKETS: PURCHASED TICKETS</h1>
    <h2>TICKETS RETRIEVED:</h2>

    <div class="TicketOutput">
      <?php
        $ticketID = $_GET['tickets-lookup'];

        $query = "SELECT * FROM TICKET WHERE TID='$ticketID' ";
        $result = mysqli_query($conn,$query);
        //if ticket id is found
        if(mysqli_num_rows($result) > 0){
          //create table
          echo "<table>";
            echo "<tr>";
              echo "<th>TID</th>";
              echo "<th>TTYPES</th>";
              echo "<th>PRICE</th>";
              echo "<th>SOLDDATE</th>";
              echo "<th>CUSID</th>";
            echo "</tr>";

            //loop to add ticket information from database into table
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
                echo "<td>"  . $row['TID']  .  "</td>";
                echo "<td>"  . $row['TTYPES']  .  "</td>";
                echo "<td>"  . $row['PRICE']  .  "</td>";
                echo "<td>"  . $row['SOLDDATE']  .  "</td>";
                echo "<td>"  . $row['CUSID']  .  "</td>";
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

    <a class="Return_button" href="ViewTicket-Search.php" id = "return-button">Return</a>

 
  </div>
  </body>
  </html>


  <?php
    mysqli_close($conn);
  ?>