<?php
    if(isset($_POST["class_id"])){
        $output = '';
        $AssignmentArray  = array();//mảng chứa tất cả id từ bảng assignment được chọn từ lớp
        $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
        $Lessons = mysqli_query($conn,"SELECT * from lessons");
        $Assignment_result = mysqli_query($conn,'SELECT assignment.*, teachers.name as t_name, subjects.name as s_name, assignment.id as a_id
                                                from assignment 
                                                join teachers on assignment.teacher_id = teachers.id
                                                join subjects on assignment.subject_id = subjects.id
                                                where class_id = '.$_POST["class_id"].'');
        
        $output .= '
                <form action="calendar/create_schedule.php" method="POST">
                    <table style="text-align: center" class="table table-bordered">
                        <tr class="title_style" style="background-color: #007BFF; color: white">
                            <th>  </th>
                            <th> Giáo viên </th>
                            <th> Môn học </th>
                        </tr>';
                            if(mysqli_num_rows($Assignment_result) > 0){
                                foreach($Assignment_result as $rowId){
                                    $AssignmentArray[] = $rowId['id'];
                                }
                                foreach($Assignment_result as $row)
                                {
                                    $output .='
                                        <tr>
                                            <td><input type="radio" name="checkbox" id="checkboxSelect_'.$row['a_id'].'" onclick="selectedTeacher('.$row['a_id'].', '.htmlspecialchars(json_encode($AssignmentArray)).');" value="'.$row['a_id'].'"></td>
                                            <td>'.$row['t_name'].'</td>
                                            <td>'.$row['s_name'].'</td>
                                        </tr>';
                                }
                            }else{
                                $output .='
                                        <tr>
                                            Lớp này chưa được phân công
                                        </tr>';
                            }
        $output .=' </table>
                </form>';
        echo $output;
    }
?>



