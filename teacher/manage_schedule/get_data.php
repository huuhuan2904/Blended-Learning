<?php
session_start();
define('ROOT_URL', 'http://localhost/final_project_admin/');
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Teacher_id = $_SESSION['teacher_id'];
if(!empty($_GET['type']) && $_GET['type'] == 'list'){
    $teacher_ass = "SELECT assignment.id, subjects.name as subject_name, class.class_name 
                    FROM assignment 
                    join subjects on assignment.subject_id  = subjects.id
                    join class  on assignment.class_id  = class.id
                    where teacher_id = '$Teacher_id'";
    $Ass_result = mysqli_query($conn, $teacher_ass);
    $Ass_array = array();
    while($row = $Ass_result->fetch_assoc()){//loop lấy các id phân công của teacher
        if($row['id']){ 
            $Day_ass = "SELECT days_assignment.id as dayAss_id, days_assignment.day, days_assignment.start_date, days_assignment.end_date, days.name as day_name
                        from days_assignment
                        join days on days_assignment.day = days.id where assignment_id = ".$row['id']."";
            $Day_ass_result = mysqli_query($conn, $Day_ass);
            if(mysqli_num_rows($Day_ass_result) > 0) {
                while($row2 = $Day_ass_result->fetch_assoc()){//loop lấy các ngày trong tuần dạy
                    if($row2['dayAss_id']){
                        $Lesson_day = "SELECT lesson_day.id as lessonDay_id, lesson_day.status, lessons.id as lesson_id, lessons.name as lesson_name, lessons.start_time, lessons.end_time
                                    from lesson_day
                                    join lessons on lesson_day.lesson_id  = lessons.id where days_ass_id = ".$row2['dayAss_id']."";
                        $Lesson_day_result = mysqli_query($conn, $Lesson_day);
                        while($row3 = $Lesson_day_result->fetch_assoc()){//loop lấy các tiết học củ mỗi buổi dạy
                            $Ass_array[] = $row2;//mảng giữ các key và value của loop row2 và thêm key, value của row3 tạo thành 1 mảng
                            foreach ($row3 as $key => $value) {
                                $Ass_array[count($Ass_array) - 1][$key] = $value;
                            }
                            foreach ($row as $key => $value) {
                                $Ass_array[count($Ass_array) - 1][$key] = $value;
                            }
                        }
                    }
                }
            }
        }
    }
    echo json_encode($Ass_array);
}else{//trường hợp lấy tất cả lớp online
    $teacher_ass = "SELECT assignment.id, subjects.name as subject_name, class.class_name 
                    FROM assignment 
                    join subjects on assignment.subject_id  = subjects.id
                    join class  on assignment.class_id  = class.id";
    $Ass_result = mysqli_query($conn, $teacher_ass);
    $Ass_array = array();
    while($row = $Ass_result->fetch_assoc()){//loop lấy các id phân công của teacher
        if($row['id']){ 
            $Day_ass = "SELECT days_assignment.id as dayAss_id, days_assignment.day, days_assignment.start_date, days_assignment.end_date, days.name as day_name
                        from days_assignment
                        join days on days_assignment.day = days.id where assignment_id = ".$row['id']."";
            $Day_ass_result = mysqli_query($conn, $Day_ass);
            if(mysqli_num_rows($Day_ass_result) > 0) {
                while($row2 = $Day_ass_result->fetch_assoc()){//loop lấy các ngày trong tuần dạy
                    if($row2['dayAss_id']){
                        $Lesson_day = "SELECT lesson_day.id as lessonDay_id, lesson_day.status, lessons.id as lesson_id, lessons.name as lesson_name, lessons.start_time, lessons.end_time
                                    from lesson_day
                                    join lessons on lesson_day.lesson_id  = lessons.id where days_ass_id = ".$row2['dayAss_id']." AND status = '1'";
                        $Lesson_day_result = mysqli_query($conn, $Lesson_day);
                        while($row3 = $Lesson_day_result->fetch_assoc()){//loop lấy các tiết học củ mỗi buổi dạy
                            $Ass_array[] = $row2;//mảng giữ các key và value của loop row2 và thêm key, value của row3 tạo thành 1 mảng
                            foreach ($row3 as $key => $value) {
                                $Ass_array[count($Ass_array) - 1][$key] = $value;
                            }
                            foreach ($row as $key => $value) {
                                $Ass_array[count($Ass_array) - 1][$key] = $value;
                            }
                        }
                    }
                }
            }
        }
    }
    echo json_encode($Ass_array);
}
?>