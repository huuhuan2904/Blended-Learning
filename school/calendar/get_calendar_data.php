<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if(!empty($_GET['type']) && $_GET['type'] == 'list'){
    $sql = "SELECT lesson_day.id as lessonDay_id, lesson_day.status, lessons.name as lesson_name, lessons.start_time, lessons.end_time, 
    days_assignment.id as daysAss_id, days_assignment.assignment_id, days_assignment.day, days_assignment.start_date, days_assignment.end_date
            FROM lesson_day
            join lessons on lesson_day.lesson_id = lessons.id
            join days_assignment on lesson_day.days_ass_id  = days_assignment.id";
    $result = mysqli_query($conn, $sql);
    $Array = array();

    while($row = $result->fetch_assoc()){
        $Array[] = $row;
        if($row['assignment_id']){
            $assignment_sql = "SELECT assignment.teacher_id, assignment.subject_id, assignment.class_id, teachers.name as teacher_name, 
                            subjects.name as subject_name, class.class_name
                                FROM assignment
                                join teachers on assignment.teacher_id = teachers.id
                                join subjects on assignment.subject_id = subjects.id
                                join class on assignment.class_id = class.id
                                where assignment.id = ".$row['assignment_id']."";
            $assignment_result = mysqli_query($conn, $assignment_sql);
            while ($sub_row = $assignment_result->fetch_assoc()) {
                foreach ($sub_row as $key => $value) {
                    $Array[count($Array) - 1][$key] = $value;//lấy phần tử cuối cùng trong mảng và thêm key với value
                }
            }
        }
        if($row['day']){
            $days_sql = "SELECT name as day_name
                                FROM days
                                where id = ".$row['day']."";
            $days_result = mysqli_query($conn, $days_sql);
            while ($sub_row = $days_result->fetch_assoc()) {
                foreach ($sub_row as $key => $value) {
                    $Array[count($Array) - 1][$key] = $value;
                }
            }
        }

    }
    echo json_encode($Array);
}
?>