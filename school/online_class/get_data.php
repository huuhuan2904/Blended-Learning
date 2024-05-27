<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    
    $Online_class_result = mysqli_query($conn,' SELECT assignment.* , days_assignment.*, lesson_day.*, class.*, lessons.*, online_class.*, 
                                                lessons.name as lesson_name, teachers.name as teacher_name, subjects.name as subject_name
                                        FROM online_class
                                        JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                        JOIN lessons ON lesson_day.lesson_id = lessons.id
                                        JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                        JOIN days ON days_assignment.day = days.id
                                        JOIN assignment ON days_assignment.assignment_id = assignment.id
                                        JOIN teachers ON assignment.teacher_id = teachers.id
                                        JOIN subjects ON assignment.subject_id = subjects.id
                                        JOIN class ON assignment.class_id = class.id');
    $data = array();
    while ($row = mysqli_fetch_assoc($Online_class_result)) {
        $data[] = $row;
    }
    echo json_encode($data);
?>