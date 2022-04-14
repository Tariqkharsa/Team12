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

<?php
//initialize var that will hold ticket ID from form
$ticketID = "";
?>

<DOCTYPE html>
  <html>
  <link rel="stylesheet" href="../tFormat2.css?v=<?php echo time(); ?>">
  <body>
    <div class="main">
    <h1>TICKETS: PURCHASED TICKETS</h1>
    <h2>Enter Ticket ID:</h2>

    <!--Form to take in ticket id-->
    <div class="TicketSearch">
      <!--action="/ViewTicket-Retrieval.php"-->
      <form action="ViewTicket-Retrieval.php" method="GET">
      <label for="Customer">Customer:</label>
        <input type="search" name="customer-lookup" value="<?php if(isset($_GET['customer-lookup'])){echo $_GET['customer-lookup'];} ?>"> 
        <label for="TicketID">Ticket ID:</label>
        <input type="search" name="tickets-lookup" value="<?php if(isset($_GET['tickets-lookup'])){echo $_GET['tickets-lookup'];} ?>"> 
        <label>Status:</label>
        <select for="status" name="status-lookup" value="<?php if(isset($_GET['status-lookup'])){echo $_GET['status-lookup'];} ?>">
        <option value="None">None</option>
        <option value="Regular">Regular</option>
        <option value="Student">Student</option>
        <option value="Veteran">Veteran</option>
        <option value="Senior">Senior</option>
        <option value="Child">Child</option>
        </select><br>
        <label for="inDate">From Date:</label>
        <input type="date" name="inDate-lookup" value="<?php if(isset($_GET['inDate-lookup'])){echo $_GET['inDate-lookup'];} ?>" min="2014-05-11"> 
        <label for="outDate">To Date:</label>
        <input type="date" name="outDate-lookup" value="<?php if(isset($_GET['outDate-lookup'])){echo $_GET['outDate-lookup'];} ?>" min="2014-05-11"> 
        <input type="submit" name=submit value="Enter" /><br>  
    </form>
    </div>
    
    <link rel="stylesheet" href="../Collections/Coll.css">
    <style>
         .button-56 {
            right:0px;
         }
    </style>
    <nav class="nav-item"><a href="Ticket.php"><button class="button-56" role="button">Return</button></a></nav>
    <p></p>
  <p></p>
 
  </div>
  </body>
  </html>


  <?php
    mysqli_close($conn);
  ?>