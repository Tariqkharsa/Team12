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
  <style>
    td,th {
      border: 1px solid black;
      padding: 10px;
      margin: 5px;
      text-align: center;
    }
  </style>
<!--<link rel="stylesheet" href="tFormat.css?v= //echo time(); ">-->
<body>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Starting Date</th>
        <th>Ending Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(!empty($row))
        foreach($row as $rows)
        {
      ?>
      <tr>

          <td><?php echo $rows['EXID']; ?></td>
          <td><?php echo $rows['exName']; ?></td>
          <td><?php echo $rows['COST']; ?></td>
          <td><?php echo $rows['sDate']; ?></td>
          <td><?php echo $rows['eDate']; ?></td>


      </tr>
      <?php } ?>
    </tbody>
  </table>

  <a class="Return_button" href="Ticket.html" id = "return-button">Return</a>

</body>
</html>


<?php
  mysqli_close($conn);
?>