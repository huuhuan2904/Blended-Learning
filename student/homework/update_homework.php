<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
session_start();
define('ROOT_URL', 'http://localhost/final_project_admin/');

$File = $_POST['file'];
$Homework_submission_id = $_POST['id'];

$query = mysqli_query($conn, "UPDATE homework_submission SET file_name = '$File' WHERE id = '$Homework_submission_id'");

if ($query) {
    $_SESSION['success'] = 2;
    $_SESSION['notification'] = 'Sửa bài thành công';
    header('location: ../index.php?page=homework_page');
} else {
    $_SESSION['error'] = 2;
    $_SESSION['notification'] = 'Lỗi';
    header('location: ../index.php?page=personal_inf');
}
?>