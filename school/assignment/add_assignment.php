<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Teacher = $_POST['teacher_id'];
$Class = $_POST['class_id'];
$Subject = $_POST['subject_id'];

if (!isset($_POST['class_id'])) {
    echo "<script>alert('Vui lòng chọn lớp học'); window.history.back();</script>";
    exit;
}

foreach($Class as $class_row){
    $query = mysqli_query($conn, "INSERT INTO assignment (teacher_id, subject_id, class_id) VALUES ('$Teacher','$Subject', '$class_row')");
}
header('location: ../index.php?page=teaching_assignment');
?>