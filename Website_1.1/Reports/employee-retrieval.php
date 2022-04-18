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
        <title>Found Employees</title>
        <link rel="stylesheet" href = #>
        <meta name="viewpoint" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <div class="container">
    <h1>Employees</h1>

    <div class="output">
      <?php
        $id = $_GET['emp_id'];
        $job = $_GET['emp_title'];
        $fName = $_GET['emp_fName'];
        $lName = $_GET['emp_lName'];
        $age = $_GET['emp_age'];
        $sex = $_GET['emp_sex'];
        $phone = $_GET['emp_phone'];
        $address = $_GET['emp_address'];
        $left_bound = $_GET['left_bound'];
        $right_bound = $_GET['right_bound'];
        $bDay = $_GET['emp_bDay'];
        $dNum = $_GET['dept_num'];

        $query0 = "SELECT * FROM EMPLOYEES WHERE ";
        $query1 ="EMPLOYEE_ID=EMPLOYEE_ID";
        $query2 ="JOBTITLE=JOBTITLE";
        $query3 ="FIRST_NAME=FIRST_NAME";
        $query4 ="LAST_NAME=LAST_NAME";
        $query5 ="AGE=AGE";
        $query6 ="SEX=SEX";
        $query7 ="PHONE_NUMBER=PHONE_NUMBER";
        $query8 ="EMPLOYEE_ADDRESS=EMPLOYEE_ADDRESS";
        $query9 ="SALARY=SALARY";
       
        $query10 ="BIRTHDATE=BIRTHDATE";
        $query11 ="dNUM=dNUM";

        if(empty($id) && empty($job) && empty($fName) && empty($lName) &&empty($age) && empty($sex) && empty($phone) && empty($address) && empty($left_bound) && empty($right_bound) &&empty($bDay) && empty($dNum))
        {
            $query = "SELECT * FROM EMPLOYEES;";
        }

        if(!empty($id)){
            $query1 = "EMPLOYEE_ID='$id'";
        }
        
        if(!empty($job)){
            $query2 = "JOBTITLE= '$job'";
        }
        if(!empty($fName)){
            $query3 = "FIRST_NAME LIKE '%{$fName}%'";
        }
        if(!empty($lName)){
            $query4 = "LAST_NAME LIKE '%{$lName}%'";
        }
        if($age != ''){
            $query5 = "AGE= '$age''";
        }

        if(!empty($sex)){
            if($sex !="Other")
            
                $query6 = "SEX = '$sex'";
            
        }

        if(!empty($phone)){
            $query7 = "PHONE_NUMBER LIKE '%{$phone}%'";
        }
        if(!empty($address)){
            $query8 = "EMPLOYEE_ADDRESS LIKE '%{$address}%'";
        }
        if(!empty($left_bound)){
            if(!empty($right_bound))
            {
                $query9="SALARY>='$left_bound' AND SALARY<='$right_bound'";
            }

            else
            {
                $query9="SALARY>='$left_bound";
            }
        }

        else if(empty($left_bound))
        {
            if(!empty($right_bound))
            {
                $query9="SALARY<='$right_bound'";
            }
        }

        if(!empty($bDay)){
            $query10 = "BIRTHDAY='$bDay'";
        }
        if(!empty($dNum)){
            $query11 = "dNUM = '$dNum'";

            
        }


        //$query = $query0 . $query1 . ' AND ' . $query2 . ' AND ' . $query3  . ' AND ' . $query4 . ' AND ' . $query5 . ' AND ' . $query6 . ' AND ' . $query7 . ' AND ' . $query8 . ' AND ' . $query9 . ' AND ' . $query10 . ' AND ' . $query11 ;
        $query =$query0 . $query1.' and ' .$query2.' and ' .$query3. ' and '.$query4. ' and '.$query5 .' and '.$query6. ' and '. $query7. ' and ' .$query8. ' and ' .$query9. ' and '. $query10 .' and '.$query11;
        $result = mysqli_query($conn,$query);

        //$row = mysqli_fetch_array($result);
       // echo $row['JOBTITLE'];


/*
$query ="SELECT * from EMPLOYEES;";
$result = mysqli_query($conn,$query);

//$row = mysqli_fetch_array($result);
     */
    
     //if ticket id is found
        
        if(mysqli_num_rows($result) > 0){
          //create table
          echo "<table border='1px'>";
          echo "<thread>";
            echo "<tr>";
              echo "<th>Employee ID</th>";
              echo "<th>Job Title</th>";
              echo "<th>First Name</th>";
              echo "<th>Last Name</th>";
              echo "<th>Age</th>";
              echo "<th>Sex</th>";
              echo "<th>Phone Number</th>";
              echo "<th>Address</th>";
              echo "<th>Salary</th>";
              echo "<th>Birthday</th>";
              echo "<th>Department</th>";
            echo "</tr>";
            echo "</thread>";

            //echo "<tbody>";
            //loop to add employee information from database into table
            
            while($row = mysqli_fetch_array($result)){
                echo "<thread>";
              echo "<tr>";
                echo "<td>"  . $row['EMPLOYEE_ID']  .  "</td>";
                echo "<td>"  . $row['JOBTITLE']  .  "</td>";
                echo "<td>"  . $row['FIRST_NAME']  .  "</td>";
                echo "<td>"  . $row['LAST_NAME']  .  "</td>";
                echo "<td>"  . $row['AGE']  .  "</td>";
                echo "<td>"  . $row['SEX']  .  "</td>";
                echo "<td>"  . $row['PHONE_NUMBER']  .  "</td>";
                echo "<td>"  . $row['EMPLOYEE_ADDRESS']  .  "</td>";
                echo "<td>"  . $row['SALARY']  .  "</td>";
                echo "<td>"  . $row['BIRTHDAY']  .  "</td>";
                echo "<td>"  . $row['dNUM']  .  "</td>";
              echo "</tr>";
              echo "</thread>";
            }
            //echo "</tbody>";
          echo "</table>";
        }

        //if ticket id is not found
        else{
          echo "No employee is found!";
        }
        
      ?>
    </div>
    <nav class="nav-item"><a href="employee-Search.php"><button class="button-56" role="button">Return</button></a></nav>
 
  </div>
  </body>
  </html>


  <?php
    mysqli_close($conn);
  ?>