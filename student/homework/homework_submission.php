<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
session_start();
define('ROOT_URL', 'http://localhost/final_project_admin/');

$Student_id = $_SESSION['student_id'];
$File = $_POST['file'];
$Homework_id = $_POST['homework_id'];
$CurrentDate = date('Y-m-d', strtotime($_POST['currentDate']));
$Deadline = date('Y-m-d', strtotime($_POST['deadline']));

if ($CurrentDate <= $Deadline) {
    $query = mysqli_query($conn, "INSERT INTO homework_submission (student_id, homework_id, file_name, submission_date, status) 
                                        VALUES ('$Student_id','$Homework_id', '$File', '$CurrentDate', '0')");
}else{
    $query = mysqli_query($conn, "INSERT INTO homework_submission (student_id, homework_id, file_name, submission_date, status) 
                                        VALUES ('$Student_id','$Homework_id', '$File', '$CurrentDate', '1')");
}

if ($query) {
    $_SESSION['success'] = 2;
    $_SESSION['notification'] = 'Nộp bài thành công';
    header('location: ../index.php?page=homework_page');
} else {
    $_SESSION['error'] = 2;
    $_SESSION['notification'] = 'Lỗi';
    header('location: ../index.php?page=personal_inf');
}
?>