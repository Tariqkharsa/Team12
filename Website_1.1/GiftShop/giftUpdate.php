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
?>
<?php
// Define variables and initialize with empty values
$price=$itemname=$quantity="";
$Name_err=$price_err=$quantity_err=$exist_err= "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    $itemname = trim($_POST["ItemName"]);
    $price = trim($_POST["Price"]);
    $quantity = trim($_POST["Quantity"]);
    // Check input errors before inserting in database
    if (empty($exist_err)) {
        // variable containing query to insert info into database
        $sql = "UPDATE GiftShop SET GiftName = ?, Price = ?, quantity = ? WHERE GiftID=?";
        // prepare query statement
        if ($stmt = mysqli_prepare($connect, $sql)) {
            // bind parameters into query statement
            // echo $stmt;
            mysqli_stmt_bind_param($stmt, "sdii", $param_name, $param_price, $param_q, $param_id);
            $param_name = $itemname;
            $param_price = $price;
            $param_q = $quantity;
            $param_id = $id;
            // if query executed successfully
            if (mysqli_stmt_execute($stmt)) {
                $success = '<div class="alert alert-success" role="alert">Your item has been created.</div>';
                // wait 2 seconds then redirect to sign-in page
                header('refresh:1; url=giftshop.php');
            }
            else $error = '<div class="alert alert-danger" role="alert">Oops, something went wrong. Please try again later.</div>';
        }
        else $error = '<div class="alert alert-danger" role="alert">Please make sure your information is valid.</div>';
        //mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connect);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM GiftShop WHERE GiftID = ?";
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $GiftName = $row["GiftName"];
                    $GiftID = $row["GiftID"];
                    $gP = $row["Price"];
                    $gQ = $row["quantity"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($connect);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <h2 class="mt-5">Update Gift Shop Item</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="ItemName" class="form-control <?php echo (!empty($Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $itemname; ?>">
                            <span class="invalid-feedback"><?php echo $artName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="decimal" step = "0.01" name="Price" class="form-control <?php echo (!empty($arti_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" min = "0" name="Quantity" class="form-control <?php echo (!empty($out_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantity; ?>">
                            <span class="invalid-feedback"><?php echo $quantity_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a href="giftshop.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
