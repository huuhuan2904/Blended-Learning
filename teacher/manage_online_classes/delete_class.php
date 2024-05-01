<?php
session_start();
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    $Online_id = $_POST['online_id'];

    $Online_class_query = mysqli_query($conn,"SELECT lesson_day_id  from online_class where id = $Online_id");

    if ($Online_class_query) {
        $LessonDay_id_row = mysqli_fetch_assoc($Online_class_query);
        $LessonDay_id = $LessonDay_id_row['lesson_day_id'];
        $Delete_online_class = mysqli_query($conn,"DELETE FROM online_class where id = $Online_id");

        if ($Delete_online_class) {
            $Lesson_day_query = mysqli_query($conn,"SELECT days_ass_id from lesson_day where id = $LessonDay_id");
            if($Lesson_day_query){
                $DayAss_id_row = mysqli_fetch_assoc($Lesson_day_query);
                $DayAss_id = $DayAss_id_row['days_ass_id'];
                $Delete_lesson_day = mysqli_query($conn,"DELETE FROM lesson_day where id = $LessonDay_id");
                
                if($Delete_lesson_day) {
                    $Delete_days_ass = mysqli_query($conn,"DELETE FROM days_assignment where id = $DayAss_id");
                    
                    if($Delete_days_ass){
                        $_SESSION['success'] = 2;
                        echo "1";
                    }else {
                        $_SESSION['errorr'] = 2;
                        echo "0";
                    }
                }else {
                    $_SESSION['errorr'] = 2;
                    echo "0";
                }
            }else {
                $_SESSION['errorr'] = 2;
                echo "0";
            }
        }else {
            $_SESSION['errorr'] = 2;
            echo "0";
        }
    } else {
        $_SESSION['errorr'] = 2;
        echo "0";
    }
?>