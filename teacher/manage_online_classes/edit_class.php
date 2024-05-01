<?php
session_start();
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

foreach($_POST['arrayData'] as $key=>$value){
    if($key == 'online_class_id'){
        $Online_class_id = $value;
    }elseif($key == 'lesson_day_id'){
        $Lesson_day_id = $value;
    }elseif($key == 'day'){
        $Day = $value;
    }elseif($key == 'lesson'){
        $Lesson = $value;
    }elseif($key == 'link'){
        $Link = $value;
    }
}

$Lesson_day_result = mysqli_query($conn,"UPDATE lesson_day SET lesson_id = '$Lesson' WHERE id = '$Lesson_day_id';");
$Online_class_result = mysqli_query($conn,"UPDATE online_class SET link = '$Link' WHERE id = '$Online_class_id';");

if ($Online_class_result || $Lesson_day_result) {
    $_SESSION['success'] = 2;
    echo '1';
} else {
    $_SESSION['errorr'] = 2;
    echo '0';
}
?>