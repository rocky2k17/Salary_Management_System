<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
};
if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Course Management</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" >
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/custom.css">

</head>
<body>
<style>
   .label {
      color: white;
      padding: 8px;
   }
   .success {background-color: #04AA6D;} /* Green */
   .danger {background-color: #f44336;} /* Red */
</style>
<div class="main_body">
   <div class="heading">
      <header>
         <div class="left_area"><a href="home.php" style="text-decoration:none;font-family: Time New Roman; "><h3 style="color: #1DC4E7;"><span>University </span>of Dhaka</h3></a> </div>
         <div class="right_area"><a href="home.php?logout=<?php echo $user_id; ?>" class="logout_btn">Logout</a></div> 

      </header>
   </div>

   <div class="sidebar">
      <a href="home.php"><i class="fas fa-user"></i><span>Personal Information</span></a>
      <a href="course_management.php" style="background-color:#3399ff;"><i class="fas fa-table"></i><span>Course Management</span></a>
      <a href="salary_management.php" ><i class="fas fa-file"></i><span>Bill Management</span></a>
      
   </div>
   <div class="newContent">
      <button class="button" onclick="redirectToUpdatePage()">Registration for New Course</button>
      <script>
          function redirectToUpdatePage() {
               window.location.href = "course_reg.php";
         }
      </script>
      <div style="overflow: auto" class="tableContainer">
         <table class="table" cellpadding="5">
         <caption style="border: 3px solid black;">Course Management Table</caption>
         <thead>
            <tr>
               <td>
                  Course Name
               </td>
               <td>
                  Course Title
               </td>
               <td> 
                  Total Exam Number
               </td>
               <td>
                  Lab Incuded
               </td>
            </tr>
         </thead>
         <tbody>
            <?php
               $query1 = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$user_id'") or die('query failed');
               $result = mysqli_fetch_assoc($query1);
               $teacher_id = $result['id'];            
               $select = mysqli_query($conn, "SELECT * FROM `courses` WHERE tid = '$teacher_id' ") or die('query failed');
               if(mysqli_num_rows($select) > 0){
                  while($fetch = mysqli_fetch_assoc($select)){
                     echo '<tr>';
                     echo '<td>'.$fetch['cname'].'</td>';
                     echo '<td>'.$fetch['ccode'].'</td>';
                     echo '<td>'.$fetch['cenumber'].'</td>';
                     if($fetch['labstatus'] == 'true')
                     {
                        echo '<td><span class="label success">YES</span></td>';
                     }else{
                        echo '<td><span class="label danger">NO</span></td>';
                     }
             
                     // echo '<td>'.$fetch['number_of_students_viva'].'</td>';
                     // echo '<td>'.$fetch['amount_viva'].'</td>';
                     // echo '<td>'.$fetch['other_bills'].'</td>';
                     // 
                  }
               }
            ?>
         </tbody>
      </table>
      </div>
   </div>
   

</div>



</body>
</html>


