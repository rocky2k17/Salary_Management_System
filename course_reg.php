<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){

   $cname = mysqli_real_escape_string($conn, $_POST['cname']);
   $ccode = mysqli_real_escape_string($conn, $_POST['ccode']);
   $cexam =$_POST['cexam'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $labstatus = mysqli_real_escape_string($conn, $_POST['labstatus']);
   $status = "false";

   $select= mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');
   $result = mysqli_fetch_assoc($select);

   $select1 = mysqli_query($conn, "SELECT * FROM `courses` WHERE ccode = '$ccode'");
   $result1 = mysqli_fetch_assoc($select1);

   $teacher_id = $result['id'];

   if(mysqli_num_rows($result1)>0){
      $message[] = "Course Already Taken";
   }
   else{
      $insert = mysqli_query($conn, "INSERT INTO `courses`(name,course_code,course_exam_number, labstatus,course_teacher_id, course_status) VALUES('$cname', '$ccode','$cexam','$labstatus','$status','$teacher_id')") or die('query failed');
      $insert1= mysqli_fetch_assoc($insert);
      if(mysqli_num_rows($insert1)>0){
         header('location:home.php');
      }else{
         header('location:course_reg.php');
      }
   }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Course Registration</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="home.php" method="post" enctype="multipart/form-data">
      <div>
         <div>
            <img src="images/du.png" alt="DU Logo" height="100px" width="80px">
         </div>
         <div>
            <h3>Register For New Course</h3>
         </div>
      </div>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <div class="message">
    </div>
      <input type="text" name="cname" placeholder="enter course name" class="box" required>
      <input type="text" name="ccode" placeholder="enter course code" class="box" required>
      <input type="number" name="cexam" placeholder="enter number of exams" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
       <p>Lab Included? <input type="checkbox" name="labstatus" value="true"></p>
      <input type="submit" name="submit" value="Submit Form" class="btn">
   </form>

</div>

</body>
</html>