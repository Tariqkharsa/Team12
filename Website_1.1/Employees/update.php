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
$firstName = $lastName = $age = $gender = $phoneNumber= $address= $birthdate= $jobTitle= $salary= $dNum = "";
$firstName_err = $lastName_err = $age_err = $gender_err = $phoneNumber_err = $address_err = $birthdate_err = $jobTitle_err = $salary_err = $dNum_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate artName
    $input_firstName = trim($_POST["firstName"]);
    if(empty($input_firstName)){
        $firstName_err = "Please enter a name.";
    } elseif(!filter_var($input_firstName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $firstName_err = "Please enter a valid name.";
    } else{
        $firstName = $input_firstName;
    }
    // Validate lastName
    $input_lastName = trim($_POST["lastName"]);
    if(empty($input_lastName)){
        $lastName_err = "Please enter a name.";
    } elseif(!filter_var($input_lastName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $lastName_err = "Please enter a valid name.";
    } else{
        $lastName = $input_lastName;
    }
    
    // Validate age
    $input_age = trim($_POST["age"]);
    if(empty($input_age)){
        $age_err = "Please enter an age.";     
    } elseif(!filter_var($input_age, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $age_err = "Please enter a valid age.";
    } else{
        $age = $input_age;
    }
    
    // Validate gender
    $input_gender = trim($_POST["gender"]);
    if(empty($input_gender)){
        $gender_err = "Please enter a gender";     
    } elseif(!filter_var($input_gender, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $gender_err = "Please enter a valid gender.";
    } else{
        $gender = $input_gender;
    }
    //phoneNumber
    $input_phoneNumber = trim($_POST["phoneNumber"]);
    if(empty($input_phoneNumber)){
        $phoneNumber_err = "Please enter a phoneNumber.";     
    } elseif(!filter_var($input_phoneNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/")))){
        $phoneNumber_err = "Please enter a valid phoneNumber in xxx-xxx-xxxx format.";
    } else{
        $phoneNumber = $input_phoneNumber;
    }
    //adress
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an adress";     
    }
    else{ 
        $address = $input_address;
    }
    //birthdate
    $input_birthdate = trim($_POST["birthdate"]);
    if(empty($input_birthdate)){
        $birthdate_err = "Please enter a date";     
    }
    else{ 
        $birthdate = $input_birthdate;
    }
    //jobTitle
    $input_jobTitle = trim($_POST["jobTitle"]);
    if(empty($input_jobTitle)){
        $jobTitle_err = "Please enter a job.";
    } elseif(!filter_var($input_jobTitle, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $jobTitle_err = "Please enter a valid job.";
    } else{
        $jobTitle = $input_jobTitle;
    }
    //salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter a salary.";
    } elseif(!filter_var($input_salary, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[+-]?([0-9]+\.?[0-9]*|\.[0-9]+)$/")))){
        $salary_err = "Please enter a valid salary in \$XXX,XXX,XXX.XX format.";
    } else{
        $salary = $input_salary;
    }
    //dNum
    $input_dNum = trim($_POST["dNum"]);
    if(empty($input_dNum)){
        $dNum_err = "Please enter an department number.";     
    } elseif(!filter_var($input_dNum, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
        $dNum_err = "Please enter a valid department number.";
    } else{
        $dNum = $input_dNum;
    }
    // Check input errors before inserting in database
    if(empty($firstName_err) && empty($lastName_err) && empty($age_err) && empty($gender_err) && empty($phoneNumber_err)&& empty($address_err)&& empty($birthdate_err)&& empty($jobTitle_err)&& empty($salary_err)&& empty($dNum_err)){
        // Prepare an update statement
        $sql = "UPDATE EMPLOYEES SET JOBTITLE=?, FIRST_NAME=?, LAST_NAME=?, AGE=?, SEX=?, PHONE_NUMBER=?, EMPLOYEE_ADDRESS=?, SALARY=?, BIRTHDATE=?, dNUM=? WHERE EMPLOYEE_ID=?";
         
        if($stmt = mysqli_prepare($connect, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssisssssii", $param_jobTitle, $param_firstName, $param_lastName, $param_age, $param_gender, $param_phoneNumber, $param_address, $param_salary, $param_birthdate,$param_dNum,$param_id);
            
            // Set parameters
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_age = $age;
            $param_gender = $gender;
            $param_phoneNumber = $phoneNumber;
            $param_birthdate = $birthdate;
            $param_address=$address;
            $param_jobTitle=$jobTitle;
            $param_salary=$salary;
            $param_dNum=$dNum;
            $param_id=$id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                
                header("location: employee.php");
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
        $sql = "SELECT * FROM EMPLOYEES WHERE EMPLOYEE_ID = ?";
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add art pieces to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                            <span class="invalid-feedback"><?php echo $firstName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>>Last Name</label>
                            <input type="text" name="lastName" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                            <span class="invalid-feedback"><?php echo $lastName_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                            <span class="invalid-feedback"><?php echo $age_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>">
                            <option value="">None</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="Other">Other</option>
                            </select><br>
                            <span class="invalid-feedback"><?php echo $gender_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>>Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control <?php echo (!empty($phoneNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneNumber; ?>">
                            <span class="invalid-feedback"><?php echo $phoneNumber_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>>Address</label>
                            <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Birthdate</label>
                            <input type="text" name="birthdate" class="form-control <?php echo (!empty($birthdate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $birthdate; ?>">
                            <span class="invalid-feedback"><?php echo $birthdate_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>>Job Title</label>
                            <input type="text" name="jobTitle" class="form-control <?php echo (!empty($jobTitle_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $jobTitle; ?>">
                            <span class="invalid-feedback"><?php echo $jobTitle_err;?></span>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>>Department Number</label>
                            <input type="text" name="dNum" class="form-control <?php echo (!empty($dNum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dNum; ?>">
                            <span class="invalid-feedback"><?php echo $dNumerr;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employee.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>