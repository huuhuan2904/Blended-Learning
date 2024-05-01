<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if (isset($_POST['class_name'])) {
    $output = '';
    $Start_time = substr($_POST['start_time'], 0, -3);
    $End_time = substr($_POST['end_time'], 0, -3);
    $Selected_date = $_POST['selected_date'];
    
    $LessonDayId_result = mysqli_query($conn, "SELECT * FROM homework where lesson_day_id = ".$_POST['lesson_day_id']."");

    if($_POST['status'] == 0){
        $Status = 'Trực tiếp';
        $Color = '#0099FF';
    }else {
        $OnlineClass_result = mysqli_query($conn, "SELECT * FROM online_class where lesson_day_id = ".$_POST['lesson_day_id']."");
        $OnlineClass_record = mysqli_fetch_assoc($OnlineClass_result);
        $Link = $OnlineClass_record['link'];
        $Status = 'Trực tuyến';
        $Color = '#33CC00';
    }
    $output .='
        <div class="table_data" style="padding: 20px">
            <input type="hidden" id="lesson_day_id" name="lesson_day_id" value='.$_POST['lesson_day_id'].'>
            <table style="text-align: center" class="table table-bordered">
                <tr class="title_style" style="background-color: '.$Color.'; color: white">
                    <th></th>
                    <th> Tiết </th>
                    <th> Môn </th>
                    <th> Lớp </th>
                    <th> Hình thức </th>
                </tr>
                <tr>
                    <td><b>'.$_POST['day_name'].'</b></td>
                    <td>'.$_POST['lesson_name'].'<br>'.$Start_time.'-'.$End_time.'</td>
                    <td>'.$_POST['subject_name'].'</td>
                    <td>'.$_POST['class_name'].'</td>
                    <td>'.$Status.'</td>
                </tr>';
                if($_POST['status'] == 0){
                    $output .='<tr>
                        <td><b>Thời gian</b></td>
                        <td colspan="5">'.$_POST['start_date'].' - '.$_POST['end_date'].'</td>
                    </tr>';
                }else {
                    $output .='<tr>
                        <td><b>Link phòng học</b></td>
                        <td colspan="5"><a href="'.$Link.'" target="blank">'.$Link.'</a></td>
                    </tr>';
                }
            $output .='</table>';
            if(mysqli_num_rows($LessonDayId_result) > 0) {
                $output .='
                <table style="text-align: center" class="table table-bordered">
                    <tr class="title_style">
                        <th> Học liệu </th>
                        <th> Tiêu đề </th>
                        <th> Chi tiết </th>
                    </tr>';
                foreach($LessonDayId_result as $row){
                    if($row['homework_day'] == $_POST['selected_date']){//nếu ngày của bt giao cùng ngày đã chọn trên lịch
                        $output .=' <tr style="background-color: #E8E8E8;">
                                    <td>'.$row['type'].'</td>
                                    <td>'.$row['title'].'</td>
                                    <td><a href="#"><button id="searchBtn" class="btn btn-outline-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button></a></td>
                                </tr>';
                    }
                }
                $output .='
                        </table>
                        <div style="text-align: center">
                            <button onclick="addHomeworkModal('.$_POST['lesson_day_id'].', \''.$Selected_date.'\')" type="button" class="btn btn-primary"><i class="fa-solid fa-book"></i> Thêm học liệu</button>
                        </div>
                    </div>';
            }else{
                $output .=' <table style="text-align: center" class="table table-bordered">
                                <tr class="title_style">
                                    <th> Học liệu </th>
                                    <th> Tiêu đề </th>
                                    <th></th>
                                </tr>
                            </table>
                            <div style="text-align: center">
                                <button onclick="addHomeworkModal('.$_POST['lesson_day_id'].', \''.$Selected_date.'\')" type="button" class="btn btn-primary"><i class="fa-solid fa-book"></i> Thêm học liệu</button>
                            </div>
                    </div>';
            }
    echo $output;
}
?>
