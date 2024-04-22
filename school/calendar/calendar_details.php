<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if (isset($_POST['class_name'])) {
    $Start_time = substr($_POST['start_time'], 0, -3);
    $End_time = substr($_POST['end_time'], 0, -3);
    if($_POST['status'] == 0){
        $Status = 'Trực tiếp';
        $Color = '#0099FF';
    }else {
        $Status = 'Trực tuyến';
        $Color = '#33CC00';
    }
    $output = '';
    $output .='
        <div class="table_data">
            <table style="text-align: center" class="table table-bordered">
                <tr class="title_style" style="background-color: '.$Color.'; color: white">
                    <th></th>
                    <th> Tiết </th>
                    <th> Môn </th>
                    <th> Lớp </th>
                    <th> Giáo viên </th>
                    <th> Hình thức </th>
                </tr>
                <tr>
                    <td><b>'.$_POST['day_name'].'</b></td>
                    <td>'.$_POST['lesson_name'].'<br>'.$Start_time.'-'.$End_time.'</td>
                    <td>'.$_POST['subject_name'].'</td>
                    <td>'.$_POST['class_name'].'</td>
                    <td>'.$_POST['teacher_name'].'</td>
                    <td>'.$Status.'</td>
                </tr>
                <tr>
                    <td><b>Thời gian</b></td>
                    <td colspan="5">'.$_POST['start_date'].' - '.$_POST['end_date'].'</td>
                </tr>
            </table>
        </div>';
    echo $output;
}
?>
