<?php
$conn = mysqli_connect("localhost", "root", "", "final_project") or die(mysqli_error($conn));

if (!isset($_POST['class_id']) || !isset($_POST['teacher_id'])) {
    echo "<script>alert('Vui lòng chọn lớp học hoặc giáo viên chủ nhiệm'); window.history.back();</script>";
    exit;
}

$Class = $_POST['class_id'];
$Teacher = $_POST['teacher_id'];

// kiểm tra nếu không có checkbox
$checkboxFound = false;
foreach ($_POST as $key => $value) {
    if (substr($key, 0, 8) === "checkbox") {
        $checkboxFound = true;
        break;
    }
}

if (!$checkboxFound) {
    echo "<script>alert('Vui lòng chọn ít nhất 1 học sinh vào lớp học'); window.history.back();</script>";
    exit;
}

foreach ($_POST as $key => $value) {
    if (substr($key, 0, 8) === "checkbox") {
        $Student = $value; // lấy giá trị của checkbox
        $query = mysqli_query($conn, "INSERT INTO class_students (class_id, teacher_id, student_id) VALUES ('$Class', '$Teacher', '$Student')");
        if (!$query) {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
            exit;
        }
    }
}

header('Location: ../index.php?page=students&ClassId=' . $Class . '&TeacherId=' . $Teacher);
exit;
?>
