<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Last_name = $_POST['last-name'];
$First_name = $_POST['first-name'];
$DOB = date('Y-m-d', strtotime($_POST['dob']));
$Gender = $_POST['gender'];
$Address = $_POST['address'];
$Phone = $_POST['phone'];
$Nation = $_POST['nation'];
$Email = $_POST['email'];
$Password = $_POST['password'];
$Password1 = md5($Password);
$Role = $_POST['role'];

$email_check = mysqli_query($conn, "select * from logins where email = '$Email'");
if(mysqli_num_rows($email_check) > 0){
  $msg = "Email đã được sử dụng";
  header('location: student_management.php?msg='.$msg);
}else{
  $query = mysqli_query($conn, "INSERT INTO logins (email, password, role) VALUES ('$Email','$Password1', '$Role')");

  $result = mysqli_query($conn, "select id from logins where email = '$Email'");
  $login_id = mysqli_fetch_array($result)['id'];

  $query = mysqli_query($conn, "INSERT INTO students (last_name, first_name, dob, gender, address, phone, nation, login_id)
  VALUES ('$Last_name','$First_name','$DOB', '$Gender', '$Address', '$Phone', '$Nation', '$login_id ')");
  header('location: ../index.php?page=student_management');
}


?>