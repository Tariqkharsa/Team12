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
$artName = $info = $arti = $dep = $outDate = "";
$artName_err = $info_err = $arti_err = $dep_err = $out_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate artname
    $input_artName = trim($_POST["artName"]);
    if(empty($input_artName)){
        $artName_err = "Please enter a name.";
    } elseif(!filter_var($input_artName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $artName_err = "Please enter a valid name.";
    } else{
        $artName = $input_artName;
    }
    // Validate info
    $input_info = trim($_POST["Information"]);
    
    // Validate artist
    $input_arti = trim($_POST["Artist"]);
    if(empty($input_arti)){
        $arti_err = "Please enter an artist.";     
    } elseif(!filter_var($input_arti, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $arti_err = "Please enter a valid name.";
    } else{
        $arti = $input_arti;
    }
    
    // Validate dep
    $input_dep = trim($_POST["Department"]);
    if(empty($input_dep)){
        $dep_err = "Please enter the department";     
    } elseif(!filter_var($input_dep, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $dep_err = "Please enter a valid department name.";
    } else{
        $dep = $input_dep;
    }
    $input_out = trim($_POST["outDate"]);
    if(empty($input_out)){
        $out_err = "Please enter a date";     
    }
    else{ 
        $outDate = $input_out;
    }
    // Check input errors before inserting in database
    if(empty($artName_err) && empty($arti_err) && empty($dep_err) && empty($out_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO ARTPIECES (ANAME, ARTIST, ARTINFO, DEPTNAME, INDATE, OUTDATE, dID) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_artName, $param_arti, $param_info, $param_dep, $param_in, $param_out, $param_did);
            
            // Set parameters
            $param_artName = $artName;
            $param_arti = $arti;
            $param_info = $info;
            $param_dep = $dep;
            $param_in = date("Y-m-d");
            $param_out = $outDate;
            if($dep == "Painting"){
                $param_did = 2;
            }
            elseif($dep == "Drawing"){
                $param_did = 3;
            }
            elseif($dep == "Photography"){
                $param_did = 4;
            }
            elseif($dep == "Sculpture"){
                $param_did = 5;
            }
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: Collection.php");
                exit();
            } else{
                if($outDate < date("Y-m-d")){
                    echo "Error: Removal Date cannot be before today's date";
                }
                else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connect);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add art pieces to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Art Piece</label>
                            <input type="text" name="artName" class="form-control <?php echo (!empty($artName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $artName; ?>">
                            <span class="invalid-feedback"><?php echo $artName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Info</label>
                            <textarea name="Information" class="form-control <?php echo (!empty($info_err)) ? 'is-invalid' : ''; ?>"><?php echo $info; ?></textarea>
                            <span class="invalid-feedback"><?php echo $info_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Artist</label>
                            <input type="text" name="Artist" class="form-control <?php echo (!empty($arti_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $arti; ?>">
                            <span class="invalid-feedback"><?php echo $arti_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select name="Department" class="form-control <?php echo (!empty($dep_err)) ? 'is-invalid' : ''; ?>">
                            <option value="">None</option>
                            <option value="Painting">Painting</option>
                            <option value="Drawing">Drawing</option>
                            <option value="Photography">Photography</option>
                            <option value="Sculpture">Sculpture</option>
                            </select><br>
                            <span class="invalid-feedback"><?php echo $dep_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Removal date</label>
                            <input type="date" name="outDate" class="form-control <?php echo (!empty($out_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $outDate; ?>">
                            <span class="invalid-feedback"><?php echo $out_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Collection.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>