<?php
$array = array();
$Class_id = $_POST['class_id'];
$Teacher_id = $_POST['teacher_id'];

$array['class_id'] =  $Class_id;
$array['teacher_id'] =  $Teacher_id;
$array['data'] =  1;

$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Student_id = $_POST['student_id'];

try {
    $query = mysqli_query($conn, "DELETE FROM class_students WHERE student_id = $Student_id");
    echo json_encode($array);
} catch (\Throwable $th) {
    echo $th;
    die();
}

?>