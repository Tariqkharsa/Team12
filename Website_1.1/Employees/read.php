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
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Prepare a select statement
    $sql = "SELECT * FROM EMPLOYEES WHERE EMPLOYEE_ID = ?";
    
    if($stmt = mysqli_prepare($connect, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $employeeID=$firstName =$row["EMPLOYEE_ID"];
                $firstName =$row["FIRST_NAME"];
                $lastName=$row["LAST_NAME"];
                $age=$row["AGE"];
                $gender=$row["SEX"];
                $phoneNumber=$row["PHONE_NUMBER"];
                $birthdate=$row["BIRTHDATE"];
                $address=$row["EMPLOYEE_ADDRESS"];
                $jobTitle=$row["JOBTITLE"];
                $salary=$row["SALARY"];
                $dNum=$row["dNUM"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Employee ID</label>
                        <p><b><?php echo $row["EMPLOYEE_ID"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <p><b><?php echo $row["FIRST_NAME"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <p><b><?php echo $row["LAST_NAME"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <p><b><?php echo $row["AGE"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["SEX"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <p><b><?php echo $row["PHONE_NUMBER"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Home Address</label>
                        <p><b><?php echo $row["EMPLOYEE_ADDRESS"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Birthdate</label>
                        <p><b><?php echo $row["BIRTHDATE"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Job Title</label>
                        <p><b><?php echo $row["JOBTITLE"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p><b><?php echo $row["SALARY"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Department Number</label>
                        <p><b><?php echo $row["dNUM"]; ?></b></p>
                    </div>
                    <p><a href="employee.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>