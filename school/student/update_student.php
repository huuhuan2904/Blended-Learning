<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Student_id = $_POST['students_id'];
$Login_id = $_POST['login_id'];
$Last_name = $_POST['last-name'];
$First_name = $_POST['first-name'];
$DOB = date('Y-m-d', strtotime($_POST['dob']));
$Gender = $_POST['gender'];
$Address = $_POST['address'];
$Phone = $_POST['phone'];
$Nation = $_POST['nation'];
$Email = $_POST['email'];
$Password = $_POST['password'];

if($Password != '' || empty($Password)){
    $Password = md5($Password);
    $sql = "update logins SET email = '$Email', password = '$Password' where id = $Login_id";
}
$sql = "update logins SET email = '$Email'where id = $Login_id";
$result = mysqli_query($conn,$sql);

$query = mysqli_query($conn, "UPDATE students SET last_name = '$Last_name', first_name = '$First_name', dob = '$DOB', gender = '$Gender', 
address = '$Address', phone = '$Phone', nation = '$Nation', login_id = $Login_id WHERE id = $Student_id");

header('location: ../index.php?page=student_management');
?>
