
<!--connecting to cloud database-->
<?php

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
// $customer_id = $_SESSION['customer']

//sql query
$query = mysqli_query($connect,"select exName, eDate, cover_url from Exhibition;");
$rows = mysqli_fetch_all($query);


/*
foreach ($rows as $thingy){
    echo $thingy->exName;
}
*/
/*
while ($rows = mysqli_fetch_array($query))
{
    echo $rows["exName"];
    echo $rows["eDate"];
}
*/

//mysqli_close($connect);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "utf-8">
        <title>Museum Exhibition</title>
        <link rel="stylesheet" href = "./stella_style.css">
        <meta name="viewpoint" conten="width=device-width, initial-scale=1">

    </head>

    <body>
    <!--following is nav bar-->
        <div class="header-container">
            <a href= "../index.php"><img class= "logo" src="../images/museum_icon3.png" alt="logo"></a>
            
                <ul class= "nav-links">
                <li class="nav-item name"><a href="../index.php">FabMuseum</a></li>
                    <li class="nav-item"><a href=#> About</a></li>
                    <li class="nav-item"><a href= "./Ticket.html"> Tickets</a></li>
                    <li class="nav-item"><a href= "./exhibition_page.php">Exhibition</a></li>
                    <li class="nav-item"><a href=#> Collection </a></li>
                    
                    <li class="nav-item login-button" ><a href="../Login/Login.php"><button >Login</button></a></li>
                </ul>
            
        </div>




<!-- following is body -->
        <div class = "body-page">
            <h2>Exhibitions</h2>
            <h3>Current Exhibitions</h4>

            

            <!--exhibition cards-->
       

        <div class="all-cards-container">

             <?php foreach ($query as $thingy): ?>

            <div class= "cards">
                <img src="<?=htmlspecialchars($thingy["cover_url"])?>" alt="<?=htmlspecialchars($thingy["exName"])?>"  >
                <div class = "container">
                    <h4><b><?=htmlspecialchars($thingy["exName"])?></b></h4>
                    <p>Through <?=htmlspecialchars($thingy["eDate"])?></p>
                    <button>Read More</button>
                </div>
            </div>
            <?php endforeach ?>
                            
            </div>   


        </div>
    </body>
</html>