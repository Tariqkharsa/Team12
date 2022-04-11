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

session_start();
// $customer_id = $_SESSION['customer']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Exhibitions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 1200px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">All Exhibitions</h2>
                        <a href="./add_exhibition.php" style="background-color:#d9ba5b; color:black;border-color:black;" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Exhibition</a>
                        <a href="./exhibition_page.php" style="background-color:#d9ba5b; color:black;border-color:black; margin-right:30px;" class="btn btn-success pull-right"> Go Back</a>
                    </div>
                    <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM Exhibition";
                    if($result = mysqli_query($connect, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Exhibition Name</th>";
                                        echo "<th>Cost</th>";
                                        echo "<th>Start Date</th>";
                                        echo "<th>End Date</th>";
                                        echo "<th>Cover Photo</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['exName'] . "</td>";
                                        echo "<td>" . $row['COST'] . "</td>";
                                        echo "<td>" . $row['sDate'] . "</td>";
                                        echo "<td>" . $row['eDate'] . "</td>";
                                        echo "<td>" . $row['cover_url'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="update_exhibition.php?id='. $row['exName'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete_exhibition.php?id='. $row['exName'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($connect);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
