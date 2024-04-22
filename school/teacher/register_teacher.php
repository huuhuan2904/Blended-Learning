<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Name = $_POST['name'];
$DOB = date('Y-m-d', strtotime($_POST['dob']));
$Gender = $_POST['gender'];
$Address = $_POST['address'];
$Phone = $_POST['phone'];
$Email = $_POST['email'];
$Password = $_POST['password'];
$Password1 = md5($Password);
$Role = $_POST['role'];

$email_check = mysqli_query($conn, "select * from logins where email = '$Email'");
if(mysqli_num_rows($email_check) > 0){
  $msg = "Email đã được sử dụng";
  header('location: teacher_management.php?msg='.$msg);
}else{
  $query = mysqli_query($conn, "INSERT INTO logins (email, password, role) VALUES ('$Email','$Password1', '$Role')");

  $result = mysqli_query($conn, "select id from logins where email = '$Email'");
  $login_id = mysqli_fetch_array($result)['id'];

  $query = mysqli_query($conn, "INSERT INTO teachers (name, dob, gender, address,  phone, login_id)
  VALUES ('$Name','$DOB', '$Gender', '$Address', '$Phone', '$login_id ')");
  header('location: ../index.php?page=teacher_management');
}

?>