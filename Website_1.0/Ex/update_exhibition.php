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
$exhiName = $cost = $stDate = $edDate = $cover_url = "";
$exhiName_err = $cost_err = $start_err = $end_err = $url_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["exhiName"]) && !empty($_POST["exhiName"])){
    // Get hidden input value
    $exhiName = $_POST["exhiName"];
    
    // Validate name
    $input_exhiName = trim($_POST["exhiName"]);
    
    if(empty($input_exhiName)){
        $exhiName_err = "Please enter an exhibition name.";
    } 
    else{
        $exhiName = $input_exhiName;
    }
    
  // Validate cost
  $input_cost = trim($_POST["cost"]);
  if(empty($input_cost))
  {
      $cost_err = "Please enter the price for this exhibition.";
  }
  else{
      $cost = $input_cost;
  }

    // Validate start date
    $input_start = trim($_POST["stDate"]);
    if(empty($input_start)){
        $start_err = "Please enter start date";     
    }
    else{ 
        $stDate = $input_start;
    }

    //validate end date
    $input_end = trim($_POST["edDate"]);
    if(empty($input_end)){
        $end_err = "Please enter end date";     
    }
    else{ 
        $edDate = $input_end;
    }

    //validate cover_url date
    $input_url = trim($_POST["cover_url"]);
    if(empty($input_url)){
        $url_err = "Please enter url for exhibition cover picture";     
    }
    else{ 
        $cover_url = $input_url;
    }


    // Check input errors before inserting in database
 if(empty($exhiName_err) && empty($cost_err) && empty($start_err) && empty($end_err) && empty($url_err)){        // Prepare an update statement
        $sql = "UPDATE Exhibition SET exName=?, COST=?, sDate=?, eDate=?, cover_url=? WHERE exName=?";

       // $sql = "INSERT INTO Exhibition ( exName, COST,sDate, eDate,cover_url) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sdssss", $param_exhiName, $param_cost, $param_start, $param_end, $param_url, $param_exhiName);
            //mysqli_stmt_bind_param($stmt, "d", $param_cost);

         

            // Set parameters
            $param_exhiName = $exhiName;
            $param_cost = $cost;
            $param_start = $stDate;
            $param_end = $edDate;
            $param_url = $cover_url;

             // Attempt to execute the prepared statement

             if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: cur_exhibition.php");
                exit();
            } else{
                if($edDate < "2001-01-01"){
                    echo "Error: End date cannot be before museum's established date";
                }
                else if($stDate < "2001-01-01"){
                    echo "Error: Start date cannot be before museum's established dat";
                }
                else if($edDate < $stDate){
                    echo "Error: End Date cannot be before exhibitoiin start date";
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
} else{
    
    // Check existence of exhiName parameter before processing further
    if(isset($_GET["exhiName"]) && !empty(trim($_GET["exhiName"]))){
        // Get URL parameter
        $exhiName =  trim($_GET["exhiName"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM Exhibition WHERE exName = ?";
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_exhiName);
            
            // Set parameters
            $param_exhiName = $exhiName;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $exhiName = $row["exName"];
                    $cost = $row["COST"];
                    $stDate = $row["sDate"];
                    $edDate = $row["eDate"];
                    $cover_url = $row["cover_url"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: exhi_error.php");
                    exit();
                }
                
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($connect);
    }  else{
        // URL doesn't contain exhiName parameter. Redirect to error page
        header("location: exhi_error.php");
        exit();
    }
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Exhibition</title>
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
                    <h2 class="mt-5">Update Exhibition</h2>
                    <p>Please edit the input values and submit to update the Exhibition.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Exhibition Name</label>
                            <input type="text" name="exhiName" class="form-control <?php echo (!empty($exhiName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $exhiName; ?>">
                            <span class="invalid-feedback"><?php echo $exhiName_err;?></span>
                        </div>
                    
                        <div class="form-group">
                            <label>Cost</label>
                            <input type="number" step="any" min=0 name="cost" class="form-control <?php echo (!empty($cost_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cost; ?>">
                            <span class="invalid-feedback"><?php echo $cost_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="stDate" class="form-control <?php echo (!empty($start_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $stDate; ?>">
                            <span class="invalid-feedback"><?php echo $start_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="edDate" class="form-control <?php echo (!empty($end_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $edDate; ?>">
                            <span class="invalid-feedback"><?php echo $end_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Cover Picture Url</label>
                            <input type="text" name="cover_url" class="form-control <?php echo (!empty($url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cover_url; ?>">
                            <span class="invalid-feedback"><?php echo $url_err;?></span>
                        </div>

                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="cur_exhibition.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
