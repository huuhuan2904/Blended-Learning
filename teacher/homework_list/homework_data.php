<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["assignmentId"])){
        $output = '';
        $Homework_result = mysqli_query($conn,'SELECT * , homework.id as homework_id, homework.start_date AS start, homework.end_date AS deadline, lessons.name as lesson_name
                                        FROM homework
                                        JOIN lesson_day ON homework.lesson_day_id = lesson_day.id
                                        JOIN lessons ON lesson_day.lesson_id = lessons.id
                                        JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                        JOIN days ON days_assignment.day = days.id
                                        JOIN assignment ON days_assignment.assignment_id = assignment.id
                                        JOIN class ON assignment.class_id = class.id
                                        WHERE days_assignment.assignment_id = '.$_POST["assignmentId"].'');
            $output .= '
                <table style="text-align: center" class="table">
                    <thead>
                    <tr class="title_style">
                        <th> Học liệu </th>
                        <th> Tiêu đề </th>
                        <th> Nội dung </th>
                        <th> Ngày bắt đầu </th>
                        <th> Ngày kết thúc </th>
                        <th> Ngày giao </th>
                        <th> Thao tác </th>
                    </tr>
                    </thead>';
                    foreach($Homework_result as $row3){
                        $output .= '<tbody>';
                        if (strtotime($row3['deadline']) < time() && date('Y-m-d', strtotime($row3['deadline'])) !== date('Y-m-d')) {
                            $output .= '<tr class="table-danger">';
                        } else {
                            $output .= '<tr>';
                        }
                        $output .= '
                                <td>'.$row3['type'].'</td>
                                <td>'.$row3['title'].'</td>
                                <td>'.$row3['content'].'</td>';
                                if($row3['start'] == '0000-00-00'){
                                    $output .='
                                        <td></td>
                                        <td></td>';
                                }else{
                                    $output .='       
                                        <td>'.$row3['start_date'].'</td>
                                        <td>'.$row3['deadline'].'</td>';
                                }
                                    $output .='
                                        <td>'.$row3['homework_day'].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle-split" type="button" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-gear"></i>
                                                </button>
                                                <div class="dropdown-menu">';
                                                if (strtotime($row3['deadline']) > time() || date('Y-m-d', strtotime($row3['deadline'])) === date('Y-m-d')) {
                                                    $output .='
                                                            <a><button type="button" class="dropdown-item" onclick="editHomework('.$row3['homework_id'].')"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
                                                            <a><button type="button" class="dropdown-item" onclick="deleteHomework('.$row3['homework_id'].')"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                                                            <a>
                                                                <form action="index.php?page=homework_details" method="POST">
                                                                    <input type="hidden" name="homeworkId" id="homeworkId" value="'.$row3['homework_id'].'">
                                                                    <input type="hidden" name="classId" id="classId" value="'.$_POST["classId"].'">
                                                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-magnifying-glass"></i> Chi tiết</button>
                                                                </form>
                                                            </a>
                                                        </div>
                                                    </div>';
                                                }else{
                                                    $output .='
                                                            <a>
                                                                <form action="index.php?page=homework_details" method="POST">
                                                                    <input type="hidden" name="homeworkId" id="homeworkId" value="'.$row3['homework_id'].'">
                                                                    <input type="hidden" name="classId" id="classId" value="'.$_POST["classId"].'">
                                                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-magnifying-glass"></i> Chi tiết</button>
                                                                </form>
                                                            </a>
                                                        </div>
                                                    </div>';
                                                }
                                                    
                                                
                            $output .='</td>
                                    </tr>
                            </tbody>';
                    }
            $output .=' </table>';
        echo $output;
    }
?>
