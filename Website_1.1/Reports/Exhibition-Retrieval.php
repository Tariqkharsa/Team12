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

//line of code for sharing variables between php files
session_start();
?>

<DOCTYPE html>
  <html>
  <link rel="stylesheet" href="../dFormat.css?v=<?php echo time(); ?>">
  <body>
    <div class="main">
    <h1>TICKETS: EXHIBITIONS</h1>
    <h2>EXHIBITIONS RETRIEVED:</h2>

    <div class="TicketOutput">
      <?php
        //initial query
        $final_query = "SELECT * FROM Exhibition WHERE ";

        //query based on exhibition name
        $exhibition_Name = $_GET['exhibition-name-lookup'];

        //if $exhibition_Name has " 's " in its string
        if(strpos($exhibition_Name, "'s") != false){
          //echo "String has ' 's ' " ;

          $temp = substr($exhibition_Name, 0, strpos($exhibition_Name, "'s"));
          $temp2 = substr($exhibition_Name, strpos($exhibition_Name, "'s"), strlen($exhibition_Name) - strpos($exhibition_Name, "'s"));

          //echo $temp;
          //echo "  + ";
          //echo $temp2;

          $exhibition_Name = $temp . "\\" . $temp2;

          //echo "        ";
          //echo $exhibition_Name;
          //echo "          ";
        }
        

        //if $exhibition_Name is not empty
        if(!empty($exhibition_Name)){
          $name_query = "exName LIKE '%{$exhibition_Name}%' ";
        }
        else{
          $name_query = "exName=exName";
        }


        //query based on exhibition cost
        $exhibitionCost = $_GET['exhibition-cost-lookup'];
        
        //if $exhibitionCost is not empty
        if(!empty($exhibitionCost)){
          $cost_query = "COST='$exhibitionCost' ";        }
        else{
          $cost_query = "COST=COST";
        }


        //query based on exhibition starting date
        $exhibition_sDate = $_GET['exhibition-sDate-lookup'];

        //if $exhibition_sDate is not empty
        if(!empty($exhibition_sDate)){
          $sDate_query = "sDate ='$exhibition_sDate' ";        }
        else{
          $sDate_query = "sDate=sDate";
        }

        //query based on exhibition ending date
        $exhibition_eDate = $_GET['exhibition-eDate-lookup'];
        
        //if $exhibition_sDate is not empty
        if(!empty($exhibition_eDate)){
          $eDate_query = "eDate ='$exhibition_eDate' ";        }
        else{
          $eDate_query = "eDate=eDate";
        }
    

        //final query with other queries added with it
        $final_query .=  $name_query  . ' AND ' . $cost_query  .  ' AND '  .  $sDate_query .  ' AND '  .  $eDate_query;



        //$result = mysqli_query($conn,$query);
        $result = $conn->query($final_query);

        //if query result fails
        if($result == false){
          echo "DATABASE ERROR: "  . mysqli_error($conn);
        }

        else{
          //if exhibition is found
          if(mysqli_num_rows($result) > 0){
            //create table
            echo "<table>";
              echo "<tr>";
                echo "<th>Exhibition Name</th>";
                echo "<th>Cost</th>";
                echo "<th>Starting Date</th>";
                echo "<th>Ending Date</th>";
              echo "</tr>";

              //loop to add exhibition information from database into table
              while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                  echo "<td>"  . $row['exName']  .  "</td>";
                  echo "<td>"  . $row['COST']  .  "</td>";
                  echo "<td>"  . $row['sDate']  .  "</td>";
                  echo "<td>"  . $row['eDate']  .  "</td>";
                echo "</tr>";
              }

            echo "</table>";
          }

          //if exhibition is not found
          else{
            echo "No exhibition is found!";
          }
      }
      ?>
    </div>

    <a class="Return_button" href="Exhibition-Search.php" id = "return-button">Return</a>

 
  </div>
  </body>
  </html>


  <?php
    mysqli_close($conn);
  ?>