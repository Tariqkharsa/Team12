<?php

$dbServername = "team12.copftkcel1k2.us-east-1.rds.amazonaws.com";
$dbUser = "admin";
$dbPass = "Group12,museum";
$dbName = "FinalTeam12";

//connect to database
$conn = new mysqli($dbServername, $dbUser, $dbPass, $dbName);

//if connection error occurs
if($conn -> connect_errno){
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset = "utf-8">
        <title>Search Employee</title>
        <link rel="stylesheet" href = "emp_report.css">
        <meta name="viewpoint" content="width=device-width, initial-scale=1">
        </head>

        <body>
            
                <h1>Search Employee</h1>
                <h4>Filter Information From below</h5>
                <div class="flex-container">
                <form action="employee-retrieval.php" method="GET">
                    <label for="id">Employee ID</label> <!--for is only used to give extra info about what the label is about-->
                        <input class="top-margin" type= "search" name= "emp_id" size=35 value="<?php if(isset($_GET['emp_id'])){echo $_GET['emp_id'];} ?>"><br>  <!--type is used to defined the input type-->  <!--name is being used to reference form data-->
                    <label for="job_title">Job Title</label>
                        <input type="text" name="emp_title" size=35 maxlength="100" value="<?php if(isset($_GET['emp_title'])){echo $_GET['emp_title'];} ?>"><br>
                    <label for="fName">First Name</label>
                        <input type="text" name="emp_fName" size=35 maxlength="50" value ="<?php if(isset($_GET['emp_fName'])){echo $_GET['emp_fName'];} ?>"> <br>
                    <label for="LName">Last Name</label>
                        <input type="text" name="emp_lName" size=35 maxlength="50" value ="<?php if(isset($_GET['emp_lName'])){echo $_GET['emp_lName'];} ?>"><br>
                    <label for="age">Age</label>
                        <input type= "number" name="emp_age" size=35 min="16" max="120" value="<?php if(isset($_GET['emp_age'])){echo $_GET['emp_age'];} ?>"><br>
                    <label>Sex</label>
                        <select for="sex" name = "emp_sex"  value="<?php if(isset($_GET['emp_sex'])){echo $_GET['emp_sex'];} ?>"><br>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="Other">Other</option>
                        </select><br>
                    <label for="phone#">Phone Number</label> 
                        <input type="text" name="emp_phone" placeholder="eg. 123-456-7890" maxlength="12" size=35 value="<?php if(isset($_GET['emp_phone'])){echo $_GET['emp_phone'];} ?>"><br>
                    <label for="address">Address</label>
                        <input type="text" name="emp_address" size=35 maxlength="200" value="<?php if(isset($_GET['emp_address'])){echo $_GET['emp_address'];} ?>"><br>
                    <label for="salary">Salary Range</label><br>
                    <label for="left_bound"></label>
                        <input type="number" name="left_bound" step="any" placeholder="left bound" min=0 value ="<?php if(isset($_GET['left_bound'])){echo $_GET['left_bound'];} ?>">
                    <label for="right_bound"></label>
                        <input type="number" name="right_bound" step="any" placeholder="right bound" min=0 value ="<?php if(isset($_GET['right_bound'])){echo $_GET['right_bound'];} ?>"><br>  
                    <label for="birthday">Birthday</label>
                        <input type="date" name="emp_bDay" size=35 value= "<?php if(isset($_GET['emp_bDay'])){echo $_GET['emp_bDay'];} ?>"><br>
                    <label for="d_num">Department</label>
                        <input type="number" name="dept_num" min="0" value="<?php if(isset($_GET['emp_dNum'])){echo $_GET['emp_dNum'];} ?>"><br>

                    <input class="a" type= "submit" name="submit" value="Search"> 
                    <a style="padding:10px"class="bottom-margin" href=#>Go Back</a>
                </form>
            </div>
        </body>
    </html>

<?php
    mysqli_close($conn);
  ?>

<!--Table: EMPLOYEES

Columns:
EMPLOYEE_ID
int AI PK
JOBTITLE
varchar(100)
FIRST_NAME
varchar(50)
LAST_NAME
varchar(50)
AGE
int
SEX
enum('M','F','Other')
PHONE_NUMBER
char(12)
EMPLOYEE_ADDRESS
varchar(200)
SALARY
decimal(9,2)
BIRTHDATE
date
dNUM
int-->