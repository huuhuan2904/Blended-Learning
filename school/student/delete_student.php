<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Student_id = $_POST['student_id'];

$Students = mysqli_query($conn, "SELECT * from students where id = '$Student_id'");

$Login_id = mysqli_fetch_array($Students)['login_id'];
$Delete_student = mysqli_query($conn, "DELETE FROM students WHERE id = $Student_id");

try {
    $Delete_acc = mysqli_query($conn,"DELETE FROM logins where id = $Login_id");
    echo 1;
} catch (\Throwable $th) {
    echo $th;
    die();
}
?>