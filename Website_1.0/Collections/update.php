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
$artName = $info = $arti = $dep = $outDate = "";
$artName_err = $info_err = $arti_err = $dep_err = $out_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_artName = trim($_POST["artName"]);
    if(empty($input_artName)){
        $artName_err = "Please enter an art name.";
    } elseif(!filter_var($input_artName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $artName_err = "Please enter a valid art name.";
    } else{
        $artName = $input_artName;
    }
    
    // Validate address address
    $input_arti = trim($_POST["arti"]);
    if(empty($input_arti)){
        $arti_err = "Please enter an Artist.";     
    } elseif(!filter_var($input_arti, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $arti_err = "Please enter a valid Artist.";
    }  else{
        $arti = $input_arti;
    }
    
    // Validate salary
    $input_dep = trim($_POST["dep"]);
    if(empty($input_dep)){
        $dep_err = "Please enter the department.";     
    } elseif(!filter_var($input_dep, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $dep_err = "Please enter a valid department.";
    }  else{
        $dep = $input_dep;
    }
    
    // Validate salary
    $info = trim($_POST["info"]);

    $input_out = trim($_POST["outDate"]);
    if(empty($input_out)){
        $out_err = "Please enter a date";     
    }
    else{ 
        $outDate = $input_out;
    }
    // Check input errors before inserting in database
    if(empty($artName_err) && empty($arti_err) && empty($dep_err) && empty($out_err)){
        // Prepare an update statement
        $sql = "UPDATE ARTPIECES SET ANAME=?, ARTIST=?, ARTINFO=?, DEPTNAME=?, OUTDATE=?, dID=? WHERE AID=?";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssii", $param_artName, $param_arti, $param_info, $param_dep, $param_out, $param_did, $param_id);
            
            // Set parameters
            $param_artName = $artName;
            $param_arti = $arti;
            $param_info = $info;
            $param_dep = $dep;
            $param_out = $outDate;
            $param_id = $id;
            if($dep == "Painting"){
                $param_did = 1;
            }
            elseif($dep == "Drawing"){
                $param_did = 2;
            }
            elseif($dep == "Photography"){
                $param_did = 3;
            }
            elseif($dep == "Sculpture"){
                $param_did = 4;
            }
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: Collection.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($connect);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM ARTPIECES WHERE AID = ?";
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
                    $artName = $row["ANAME"];
                    $arti = $row["ARTIST"];
                    $dep = $row["DEPTNAME"];
                    $info = $row["ARTINFO"];
                    $outDate = $row["OUTDATE"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
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
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the Art Pieces.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Art Piece</label>
                            <input type="text" name="artName" class="form-control <?php echo (!empty($artName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $artName; ?>">
                            <span class="invalid-feedback"><?php echo $artName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Artist</label>
                            <input type="text" name="arti" class="form-control <?php echo (!empty($arti_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $arti; ?>">
                            <span class="invalid-feedback"><?php echo $arti_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Info</label>
                            <textarea name="info" class="form-control <?php echo (!empty($info_err)) ? 'is-invalid' : ''; ?>"><?php echo $info; ?></textarea>
                            <span class="invalid-feedback"><?php echo $info_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select name="dep" class="form-control <?php echo (!empty($dep_err)) ? 'is-invalid' : ''; ?>">
                            <option value="">None</option>
                            <option value="Painting">Painting</option>
                            <option value="Drawing">Drawing</option>
                            <option value="Photography">Photography</option>
                            <option value="Sculpture">Sculpture</option>
                            </select><br>
                            <span class="invalid-feedback"><?php echo $dep_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Removal Date</label>
                            <input type="date" name="outDate" class="form-control <?php echo (!empty($out_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $outDate; ?>">
                            <span class="invalid-feedback"><?php echo $out_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Collection.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
