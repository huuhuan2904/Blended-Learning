<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if (!isset($_POST['class']) || !isset($_POST['lesson']) || !isset($_POST['link'])) {
    echo "<script>alert('Vui lòng chọn đầy đủ các thông tin'); window.history.back();</script>";
    exit;
}

$Teacher_id = $_POST['teacher_id'];
$Class_id = $_POST['class'];
$Day_id = $_POST['day'];
$Start_date = $_POST['start_date'];
$End_date = $_POST['end_date'];
$Lesson_id = $_POST['lesson'];
$Status = $_POST['status'];
$Link = $_POST['link'];

$Ass_result = mysqli_query($conn, "SELECT id FROM assignment WHERE teacher_id ='$Teacher_id' AND class_id  ='$Class_id'");
$Ass_record = mysqli_fetch_assoc($Ass_result);
$Ass_id = $Ass_record['id'];

$DaysAss_result = mysqli_query($conn, " INSERT INTO days_assignment (assignment_id, day, start_date, end_date) 
                                        VALUES ('$Ass_id','$Day_id', '$Start_date', '$End_date')");
if ($DaysAss_result) {
    $DaysAss_id = mysqli_insert_id($conn);
    $LessonDay_result = mysqli_query($conn, "INSERT INTO lesson_day (days_ass_id, lesson_id, status) VALUES ('$DaysAss_id','$Lesson_id','$Status')");

    if ($LessonDay_result) {
        $LessonDay_id = mysqli_insert_id($conn);
        $OnlineClass_result = mysqli_query($conn, "INSERT INTO online_class (lesson_day_id, link) VALUES ('$LessonDay_id','$Link')");
        header('location: ../index.php?page=schedule_page');
    }else{
        echo "Error: " . mysqli_error($conn);
    }
}else{
    echo "Error: " . mysqli_error($conn);
}
?>