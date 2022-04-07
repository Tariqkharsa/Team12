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


  //line of code for sharing variables between php files
  session_start();
}
?>

<?php
//initialize var that will hold ticket ID from form
$ticketID = "";
?>

<DOCTYPE html>
  <html>
  <link rel="stylesheet" href="tFormat.css?v=<?php echo time(); ?>">
  <body>
    <div class="main">
    <h1>TICKETS: PURCHASED TICKETS</h1>
    <h2>Enter Ticket ID:</h2>

    <!--Form to take in ticket id-->
    <div class="TicketSearch">
      <!--action="/ViewTicket-Retrieval.php"-->
      <form action="/ViewTicket-Retrieval.php" method="GET">
        <label for="TicketID">Ticket ID:</label>
        <input type="search" name="tickets-lookup" value="<?php if(isset($_GET['tickets-lookup'])){echo $_GET['tickets-lookup'];} ?>" id="Ticket_LookUp" required maxlength="10"> <input type="submit" name=submit value="Enter" /><br>  
    </form>
    </div>


    

    <a class="Return_button" href="Ticket Homepage.html" id = "return-button">Return</a>

 
  </div>
  </body>
  </html>


  <?php
    mysqli_close($conn);
  ?>