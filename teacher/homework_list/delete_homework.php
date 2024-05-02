<?php
session_start();
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    $Homework_id = $_POST['homework_id'];

    $result = mysqli_query($conn,"DELETE FROM homework where id = $Homework_id");
    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['success'] = 2;
            $_SESSION['notification'] = 'Xóa thành công';
            echo "1";
        } else {
            $_SESSION['error'] = 2;
            echo "0";
        }
    } else {
        $_SESSION['error'] = 2;
        echo "0";
    }
?>