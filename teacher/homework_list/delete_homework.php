<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    $Homework_id = $_POST['homework_id'];

    $result = mysqli_query($conn,"DELETE FROM homework where id = $Homework_id");
    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "1";
        } else {
            echo "0";
        }
    } else {
        echo "0";
    }
?>