<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Teacher = $_POST['teacher_id'];

try {
    $result = mysqli_query($conn,"DELETE FROM assignment where teacher_id = $Teacher");
    echo 1;
} catch (\Throwable $th) {
    echo $th;
    die();
}
?>