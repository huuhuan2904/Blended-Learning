<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
session_start();
define('ROOT_URL', 'http://localhost/final_project_admin/');

$Teacher_id = $_SESSION['teacher_id'];
$Login_id = $_SESSION['login_id'];
$Name = $_POST['name'];
$DOB = date('Y-m-d', strtotime($_POST['dob']));
$Gender = $_POST['gender'];
$Address = $_POST['address'];
$Phone = $_POST['phone'];
$Email = $_POST['email'];
$Password = $_POST['password'];

if($Password != '' || empty($Password)){
    $Password = md5($Password);
    $sql = "update logins SET email = '$Email', password = '$Password' where id = $Login_id";
}
$sql = "update logins SET email = '$Email'where id = $Login_id";
$result = mysqli_query($conn,$sql);

$query = mysqli_query($conn, "UPDATE teachers SET name = '$Name', dob = '$DOB', gender = '$Gender', address = '$Address', phone = '$Phone', login_id = $Login_id 
WHERE id = $Teacher_id");

header('location: ../index.php?page=personal_inf');
?>