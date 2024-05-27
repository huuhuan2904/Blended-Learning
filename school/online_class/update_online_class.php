<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if(isset($_POST['update_button'])) {
    $Start_date = $_POST['start_date'];
    $End_date = date('Y-m-d', strtotime($Start_date . ' +1 day'));
    $dayOfWeek = date('l', strtotime($Start_date));
    $days = [
        'Monday' => '1',
        'Tuesday' => '2',
        'Wednesday' => '3',
        'Thursday' => '4',
        'Friday' => '5',
        'Saturday' => '6'
    ];

    if (array_key_exists($dayOfWeek, $days)) {
        $Update_sql = "UPDATE online_class
                JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                SET online_class.link = '".$_POST['link']."', 
                    lesson_day.lesson_id = '".$_POST['lesson']."',
                    days_assignment.day = '".$days[$dayOfWeek]."',
                    days_assignment.start_date = '".$Start_date."',
                    days_assignment.end_date = '".$End_date."'
                WHERE online_class.id = '".$_POST['online_class_id']."'";
        $result = mysqli_query($conn, $Update_sql);
        if($result){
            header('location: ../index.php?page=manage_online_classes');
        }
    } else {
        echo "Ngày không hợp lệ";
    }
}
?>