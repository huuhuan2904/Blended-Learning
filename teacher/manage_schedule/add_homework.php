<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $LessonDay_id = $_POST['lesson_day_id'];
    $Type = $_POST['type'];
    $Title = $_POST['title'];
    $Start_date = $_POST['start_date'];
    $End_date = $_POST['end_date'];
    $Content = $_POST['content'];

    $targetDir = "uploads/";

    $fileName = basename($_FILES["file"]["name"]);
    $targetPath = $targetDir.$fileName;

    if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetPath)){
        $sql = "INSERT INTO homework (lesson_day_id, type, title, file_name, file_path, content, start_date, end_date) 
        VALUES ('$LessonDay_id', '$Type', '$Title', '$fileName', '$targetPath', '$Content', '$Start_date', '$End_date')";
        if($conn->query($sql) == true){
            echo "da upload va luu vao db";
        }else{
            echo "Error: ".$sql." Error details: ".$conn->error;
        }
    }else{
        echo "Error moving the file";
    }
}else{
    echo $_FILES['file']['error'];
}


?>