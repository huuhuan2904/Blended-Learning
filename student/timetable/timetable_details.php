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
                    <th style="text-align: center"> Tiết </th>
                    <th style="text-align: center"> Môn </th>
                    <th style="text-align: center"> Lớp </th>
                    <th style="text-align: center"> Hình thức </th>
                </tr>
                <tr>
                    <td><b>'.$_POST['day_name'].'</b></td>
                    <td>'.$_POST['lesson_name'].'<br>'.$Start_time.'-'.$End_time.'</td>
                    <td>'.$_POST['subject_name'].'</td>
                    <td>'.$_POST['class_name'].'</td>
                    <td>'.$Status.'</td>
                </tr>';
                if($_POST['status'] == 1){
                    $output .='<tr>
                        <td><b>Link phòng học</b></td>
                        <td colspan="5"><a href="'.$Link.'" target="blank">'.$Link.'</a></td>
                    </tr>';
                }
            $output .='</table>';
    echo $output;
}
?>
