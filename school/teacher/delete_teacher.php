<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Teacher_id = $_POST['teacher_id'];

$Teachers = mysqli_query($conn, "select * from teachers where id = '$Teacher_id'");

$Login_id = mysqli_fetch_array($Teachers)['login_id'];
$Delete_teacher = mysqli_query($conn, "DELETE FROM teachers WHERE id = $Teacher_id");

try {
    $Delete_acc = mysqli_query($conn,"DELETE FROM logins where id = $Login_id");
    echo 1;
} catch (\Throwable $th) {
    echo $th;
    die();
}

?>