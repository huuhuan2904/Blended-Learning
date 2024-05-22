<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if (isset($_POST['lessonDayId']) && $_POST['daysAssId']) {
    $LessonDay_id =  $_POST['lessonDayId'];
    $DaysAss_id = $_POST['daysAssId'];

    $Delete_lesson = mysqli_query($conn,"DELETE FROM lesson_day where id = $LessonDay_id");
                    
    if($Delete_lesson){
        $Delete_dayAss = mysqli_query($conn,"DELETE FROM days_assignment where id = $DaysAss_id");
        if($Delete_dayAss){
            header('location: ../index.php?page=calendar_management');
        }
    }
}