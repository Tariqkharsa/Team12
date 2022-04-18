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
// $customer_id = $_SESSION['customer']
 
// Define variables and initialize with empty values
$price=$itemname=$quantity="";
$Name_err=$price_err=$quantity_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemname = trim($_POST["ItemName"]);
    $price = trim($_POST["Price"]);
    $quantity = trim($_POST["Quantity"]);
    // variable containing query to search database for given item name from textbox
    $check_itemname = "SELECT * FROM FinalTeam12.GiftShop WHERE GiftName = '$itemname'";


    // run and store query result into variable
    $result = mysqli_query($connect, $check_itemname);
    // boolean (i think...not sure but it works) variable from result
    $item_exists = mysqli_fetch_assoc($result);
    // if true
    if ($item_exists){
        $exist_err = "Item already Exists";
    } 
    // if all error strings are empty meaning all info is valid
    if (empty($exist_err)) {
        // variable containing query to insert info into database
        $sql = "INSERT INTO FinalTeam12.GiftShop (GiftName, Price, quantity) VALUES (?, ?, ?)";
        // prepare query statement
        if ($stmt = mysqli_prepare($connect, $sql)) {
            // bind parameters into query statement
            // echo $stmt;
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
        //mysqli_stmt_close($stmt);
    }
    
    // close the connection
    mysqli_close($connect);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
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
                    <h2 class="mt-5">Create Gift Shop Item</h2>
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
                        <input type="submit" class="btn btn-primary" value="Create">
                        <a href="giftshop.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>