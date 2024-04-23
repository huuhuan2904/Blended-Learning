<?php
    if(isset($_POST["class_id"])){
        $output = '';
        $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
        $Assignment_result = mysqli_query($conn,'SELECT class_students.student_id, students.*
                                                from class_students 
                                                join students on class_students.student_id = students.id
                                                where class_students.class_id = '.$_POST["class_id"].'');
        
        $output .= '
            <div class="table_data">
                <form action="calendar/create_schedule.php" method="POST">
                    <table style="text-align: center" class="table table-bordered">
                        <tr class="title_style" style="background-color: black; color: white">
                            <th> Họ và tên đệm </th>
                            <th> Tên </th>
                            <th> Ngày sinh </th>
                            <th> Giới tính </th>
                            <th> Địa chỉ </th>
                            <th> Số điện thoại </th>
                            <th> Dân tộc </th>
                            <th> Email </th>
                        </tr>';
                            if(mysqli_num_rows($Assignment_result) > 0){
                                foreach($Assignment_result as $row)
                                {
                                    $output .='
                                        <tr>
                                            <td>'.$row['last_name'].'</td>
                                            <td>'.$row['first_name'].'</td>
                                            <td>'.date('d-m-Y', strtotime($row['dob'])).'</td>
                                            <td>'.$row['gender'].'</td>
                                            <td>'.$row['address'].'</td>
                                            <td>'.$row['phone'].'</td>
                                            <td>'.$row['nation'].'</td>
                                        </tr>';
                                }
                            }else{
                                $output .='
                                        <tr>
                                            Lớp này chưa được phân công
                                        </tr>';
                            }
        $output .=' </table>
                </form>
            <div/>';
        echo $output;
    }
?>



