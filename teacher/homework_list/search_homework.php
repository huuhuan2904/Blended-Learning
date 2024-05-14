<?php
    // $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    // $output = '';
    // if(isset($_GET['key']) && $_GET['key']!=""){
    //     $key=trim($_GET['key']);
    //     $filter_data = "SELECT *, homework.id AS homework_id, homework.start_date AS start, homework.end_date AS deadline, lessons.name AS lesson_name, subjects.name AS subject_name, teachers.name AS teacher_name
    //                     FROM homework
    //                     JOIN lesson_day ON homework.lesson_day_id = lesson_day.id
    //                     JOIN lessons ON lesson_day.lesson_id = lessons.id
    //                     JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
    //                     JOIN days ON days_assignment.day = days.id
    //                     JOIN assignment ON days_assignment.assignment_id = assignment.id
    //                     JOIN subjects ON assignment.subject_id = subjects.id
    //                     JOIN teachers ON assignment.teacher_id = teachers.id
    //                     JOIN class ON assignment.class_id = class.id
    //                     WHERE assignment.class_id = ".$_GET['classId']." AND CONCAT(subjects.name, teachers.name, homework.type, homework.homework_day) LIKE '%$key%'";
    //     $query_run = mysqli_query($conn,$filter_data);
        
    //     $output .='<div class="card-group">';
    //     if(mysqli_num_rows($query_run) > 0){
    //         foreach($query_run as $row)
    //         {
    //             $output .= '<div class="card">
    //             <img class="card-img-top" src="http://www.bookthatbook.com/images/resource/favorite.jpg" alt="Card image cap" style="width: 230px; height: auto;">
    //             <b><h3 class="card-header">'.$row['type']. '</h3></b>
    //             <div class="card-body">
    //                 <h5 class="card-title">'.$row['teacher_name'].' ('.$row['subject_name'].')</h5>
    //                 <form action="./index.php?page=homework_details" method="post">
    //                     <input type="hidden" id="id" name="id" value='.$row['homework_id'].'>
    //                     <input type="hidden" id="subject" name="subject" value="'.$row['subject_name'].'">
    //                     <input type="hidden" id="teacher" name="teacher" value="'.$row['teacher_name'].' ">
    //                     <input type="hidden" id="type" name="type" value="'.$row['type'].' ">
    //                     <input type="hidden" id="filename" name="filename" value="'.$row['file_name'].' ">
    //                     <input type="hidden" id="filepath" name="filepath" value="'.$row['file_path'].' ">
    //                     <input type="hidden" id="title" name="title" value="'.$row['title']. '">
    //                     <input type="hidden" id="content" name="content" value="'.$row['content']. '">
    //                     <input type="hidden" id="lesson" name="lesson" value="'.$row['lesson_name'].' ">
    //                     <input type="hidden" id="start" name="start" value="'.$row['start']. '">
    //                     <input type="hidden" id="end" name="end" value="'.$row['deadline'].' ">
    //                     <input type="hidden" id="day" name="day" value="'.$row['homework_day'].' ">
    //                     <button type="submit" class="btn btn-primary">Chi tiết</button>
    //                 </form>';
    //                     if($row['deadline'] != '0000-00-00'){
    //                         $output .= '<p class="card-text"><small class="text-muted">Hạn nộp: '.$row['deadline'].' </small></p>';
    //                     }else{
    //                         $output .= '<p class="card-text"><small class="text-muted">Không có hạn</small></p>';
    //                 }
                    
    //         $output .= '</div>
    //             </div>';

    //         }
    //     }else{
    //         $output .= '<div style="text-align: center;">
    //         <img style="width:620px;height:480px;" src="https://cdn.dribbble.com/users/2382015/screenshots/6065978/no_result.gif" alt="Không có kết quả">
    //         </div>';
    //     }
    //       echo $output;
    // }else{
    //     $filter_data = "SELECT *, homework.id AS homework_id, homework.start_date AS start, homework.end_date AS deadline, lessons.name AS lesson_name, subjects.name AS subject_name, teachers.name AS teacher_name
    //                     FROM homework
    //                     JOIN lesson_day ON homework.lesson_day_id = lesson_day.id
    //                     JOIN lessons ON lesson_day.lesson_id = lessons.id
    //                     JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
    //                     JOIN days ON days_assignment.day = days.id
    //                     JOIN assignment ON days_assignment.assignment_id = assignment.id
    //                     JOIN subjects ON assignment.subject_id = subjects.id
    //                     JOIN teachers ON assignment.teacher_id = teachers.id
    //                     JOIN class ON assignment.class_id = class.id
    //                     WHERE assignment.class_id = ".$_GET['classId']."";
    //     $query_run = mysqli_query($conn,$filter_data);
        
    //     $output .='<div class="card-group">';
    //     if(mysqli_num_rows($query_run) > 0){
    //         foreach($query_run as $row)
    //         {
    //             $output .= '<div class="card">
    //             <img class="card-img-top" src="http://www.bookthatbook.com/images/resource/favorite.jpg" alt="Card image cap" style="width: 230px; height: auto;">
    //             <b><h3 class="card-header">'.$row['type']. '</h3></b>
    //             <div class="card-body">
    //                 <h5 class="card-title">'.$row['teacher_name'].' ('.$row['subject_name'].')</h5>
    //                 <form action="./index.php?page=homework_details" method="post">
    //                     <input type="hidden" id="id" name="id" value='.$row['homework_id'].'>
    //                     <input type="hidden" id="subject" name="subject" value="'.$row['subject_name'].'">
    //                     <input type="hidden" id="teacher" name="teacher" value="'.$row['teacher_name'].' ">
    //                     <input type="hidden" id="type" name="type" value="'.$row['type'].' ">
    //                     <input type="hidden" id="filename" name="filename" value="'.$row['file_name'].' ">
    //                     <input type="hidden" id="filepath" name="filepath" value="'.$row['file_path'].' ">
    //                     <input type="hidden" id="title" name="title" value="'.$row['title']. '">
    //                     <input type="hidden" id="content" name="content" value="'.$row['content']. '">
    //                     <input type="hidden" id="lesson" name="lesson" value="'.$row['lesson_name'].' ">
    //                     <input type="hidden" id="start" name="start" value="'.$row['start']. '">
    //                     <input type="hidden" id="end" name="end" value="'.$row['deadline'].' ">
    //                     <input type="hidden" id="day" name="day" value="'.$row['homework_day'].' ">
    //                     <button type="submit" class="btn btn-primary">Chi tiết</button>
    //                 </form>';
    //                     if($row['deadline'] != '0000-00-00'){
    //                         $output .= '<p class="card-text"><small class="text-muted">Hạn nộp: '.$row['deadline'].' </small></p>';
    //                     }else{
    //                         $output .= '<p class="card-text"><small class="text-muted">Không có hạn</small></p>';
    //                 }
                    
    //         $output .= '</div>
    //             </div>';

    //         }
    //     }else{
    //         $output .= '<img src="https://cdn.dribbble.com/userupload/2905340/file/original-10210d8c75d27373e95effe16950b396.png?resize=400x0" alt="Không có kết quả">';
    //     }
    //       echo $output;
    // }
 

