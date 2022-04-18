<?php
require_once "database.php";
$price=$itemname=$quantity="";
$check_itemname = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // variable containing query to search database for given item name from textbox
    $check_itemname = "SELECT * FROM FinalTeam12.GiftShop WHERE item_name='$itemname'";


    // run and store query result into variable
    $result = mysqli_query($connect, check_itemname);
    // boolean (i think...not sure but it works) variable from result
    $item_exists = mysqli_fetch_assoc($result);
    // if true
    if ($item_exists) $exist_err = "E-mail address is already taken.";
    
    // if all error strings are empty meaning all info is valid
    if (empty($exist_err)) {
        // variable containing query to insert info into database
        $sql = "INSERT INTO FinalTeam12.GiftShop (item_name, price, quantity) VALUES (?, ?, ?)";
        // prepare query statement
        if ($stmt = mysqli_prepare($connect, $sql)) {
            // bind parameters into query statement
            mysqli_stmt_bind_param($stmt, "sdi", $param_name, $param_price, $param_q);
            $param_name = $itemname;
            $param_price = $price;
            $param_q = $quantity;
            // if query executed successfully
            if (mysqli_stmt_execute($stmt)) {
                $success = '<div class="alert alert-success" role="alert">Your item has been created.</div>';
                // wait 2 seconds then redirect to sign-in page
                header('refresh:1; url=giftshop.php');
            }
            else $error = '<div class="alert alert-danger" role="alert">Oops, something went wrong. Please try again later.</div>';
        }
        else $error = '<div class="alert alert-danger" role="alert">Please make sure your information is valid.</div>';
    }
    // close the connection
    mysqli_close($conn_WebLogins);
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Dashboard</title>
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
                        <h2 class="pull-left">Gift Shop</h2>
                        <a href="giftShopCreate.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Gift Shop Items</a>
                    </div>
                    <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM GiftShop";
                    if($result = mysqli_query($connect, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Item ID</th>";
                                        echo "<th>Item Name</th>";
                                        echo "<th>Item Price</th>";
                                        echo "<th>Item Quantity</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['GiftID'] . "</td>";
                                        echo "<td>" . $row['GiftName'] . "</td>";
                                        echo "<td>" . $row['Price'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>";

                                            //TODO: REDO THESE METHODS FOR GIFTSHOP
                                            
                                            echo '<a href="giftRead.php?id='. $row['GiftID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="giftUpdate.php?id='. $row['GiftID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="giftDelete.php?id='. $row['GiftID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
