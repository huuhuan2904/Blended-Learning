<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if (!isset($_POST['type']) || !isset($_POST['title']) || !isset($_POST['content'])) {
    echo "<script>alert('Vui lòng nhập đầy đủ các thông tin'); window.history.back();</script>";
    exit;
}

if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $LessonDay_id = $_POST['lesson_day_id'];
    $Type = $_POST['type'];
    $Title = $_POST['title'];
    $Start_date = $_POST['start_date'];
    $End_date = $_POST['end_date'];
    $Content = $_POST['content'];
    $Homework_day = $_POST['homework_day'];

    $targetDir = "uploads/";

    $fileName = basename($_FILES["file"]["name"]);
    $targetPath = $targetDir.$fileName;

    if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetPath)){
        $sql = "INSERT INTO homework (lesson_day_id, type, title, file_name, file_path, content, start_date, end_date, homework_day)
        VALUES ('$LessonDay_id', '$Type', '$Title', '$fileName', '$targetPath', '$Content', '$Start_date', '$End_date', '$Homework_day')";
        if($conn->query($sql) == true){
            header('location: ../index.php?page=schedule_page');
        }else{
            echo "Error: ".$sql." Error details: ".$conn->error;
        }
    }else{
        echo "Error moving the file";
    }
}else{
    echo "<script>alert('Vui lòng chọn file học liệu'); window.history.back();</script>";
    exit;
}


?>
