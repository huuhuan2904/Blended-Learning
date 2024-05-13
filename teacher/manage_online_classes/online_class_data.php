<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["class_id"])){
        $output = '';
        $Online_class_result = mysqli_query($conn,' SELECT * , online_class.id as online_id, lessons.name as lesson_name
                                        FROM online_class
                                        JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                        JOIN lessons ON lesson_day.lesson_id = lessons.id
                                        JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                        JOIN days ON days_assignment.day = days.id
                                        JOIN assignment ON days_assignment.assignment_id = assignment.id
                                        JOIN class ON assignment.class_id = class.id
                                        WHERE days_assignment.assignment_id = '.$_POST["class_id"].'');

        $output .= '
                <table style="text-align: center" class="table">
                    <thead>
                    <tr class="title_style">
                        <th> Lớp </th>
                        <th> Tiết </th>
                        <th> Ngày </th>
                        <th> Link phòng </th>
                        <th> Thao tác </th>
                    </tr>
                    </thead>';
            foreach($Online_class_result as $row){
                $formattedStartTime = date("H:i", strtotime($row['start_time']));
                $formattedEndTime = date("H:i", strtotime($row['end_time'])); 
                $output .= '<tbody>';
                if (strtotime($row['start_date']) < time() && date('Y-m-d', strtotime($row['start_date'])) !== date('Y-m-d')) {
                    $output .= '<tr class="table-danger">';
                } else {
                    $output .= '<tr>';
                }
                $output .= '
                    <td>'.$row['class_name'].'</td>
                    <td>'.$row['lesson_name'].' <br>('.$formattedStartTime.' - '.$formattedEndTime.')</td>
                    <td>'.$row['start_date'].' ('.$row['name'].')</td>
                    <td><a href="'.$row['link'].'" target="blank">'.$row['link'].'</a></td>
                    <td>';
                if (strtotime($row['start_date']) > time() || date('Y-m-d', strtotime($row['start_date'])) === date('Y-m-d')) {
                    $output .= '
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle-split" type="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-gear"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a><button type="button" class="dropdown-item" onclick="editOnlineClass('.$row['online_id'].','.$row['lesson_day_id'].')"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
                                <a><button type="button" class="dropdown-item" onclick="deleteOnlineClass('.$row['online_id'].')"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                            </div>
                        </div>';
                }
                $output .= '</td>
                </tr>';
                $output .= '</tbody>';                
            }
        $output .=' </table>';
        echo $output;
    }
?>


