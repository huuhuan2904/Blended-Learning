<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Class = $_POST['class_id'];
$Teacher = $_POST['teacher_id'];

// Lặp qua các checkbox và chèn chúng vào cơ sở dữ liệu cùng với các giá trị khác
foreach ($_POST as $key => $value) {
    // Kiểm tra xem key có phải là một checkbox không
    if (substr($key, 0, 8) === "checkbox") {
        // Lấy giá trị của checkbox
        $Student = $value;
        $query = mysqli_query($conn, "INSERT INTO class_students (class_id, teacher_id, student_id) VALUES ('$Class','$Teacher', '$Student')");
    }
}
header('location: ../index.php?page=students&ClassId='.$Class.'&TeacherId='.$Teacher.'');


?>