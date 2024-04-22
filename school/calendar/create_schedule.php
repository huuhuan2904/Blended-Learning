<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    foreach($_POST['arrayData'] as $key=>$value){
        if($key == 'assignmentId'){
            $AssignmentId = $value;
        }elseif($key == 'day'){
            $Day = $value;
        }elseif($key == 'lesson'){
            $Lesson_id = $value;
        }elseif($key == 'status'){
            $Status = $value;
        }elseif($key == 'startDate'){
            $Start_date = $value;
        }elseif($key == 'endDate'){
            $End_date = $value;
        }
    }
    $Day_ass_query= mysqli_query($conn,"SELECT * from days_assignment 
                                        where assignment_id = '$AssignmentId' AND day = '$Day' AND start_date = '$Start_date' AND end_date = '$End_date'");
        if($Day_ass_query->num_rows > 0){
            while ($Get_id = mysqli_fetch_assoc($Day_ass_query)) {
                $Day_ass_id = $Get_id['id'];
                foreach($Lesson_id as $lesson_id_row){
                    $query = mysqli_query($conn, "INSERT INTO lesson_day (days_ass_id, lesson_id, status) VALUES ('$Day_ass_id','$lesson_id_row','$Status')");
                }
            }
        }else{
            $query = mysqli_query($conn, "INSERT INTO days_assignment (assignment_id, day, start_date, end_date) 
                                        VALUES ('$AssignmentId','$Day', '$Start_date', '$End_date')");
            if ($query) {
                $Day_ass_id = mysqli_insert_id($conn);
                    foreach($Lesson_id as $lesson_id_row){
                        $query = mysqli_query($conn, "INSERT INTO lesson_day (days_ass_id, lesson_id, status) VALUES ('$Day_ass_id','$lesson_id_row','$Status')");
                    }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
?>