<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

if(isset($_POST['json_data'])){
    $jsonData = $_POST['json_data'];
    $decodedData = json_decode($jsonData, true); // chuyển đổi chuỗi JSON thành mảng PHP

    $output = '';
    $output .= '<div class="table_data" style="padding: 0 20px 20px 20px">
            <table style="text-align: center" class="table table-bordered">
                <tr class="title_style">';
    $output .= '<th style="text-align: center">Tiết / Thứ</th>';
    //cột ngang từ Thứ 2 đến Thứ 7
    for ($day = 2; $day <= 7; $day++) {
        $output .= "<th style='text-align: center'>Thứ ".$day."</th>";
    }
    $output .= "</tr>";
    for ($lesson = 1; $lesson <= 10; $lesson++) {
        $output .= "<tr>";
        $output .= "<td><b>Tiết ".$lesson."</b></td>"; // cột các tiết học
        for ($day = 1; $day <= 6; $day++) {
            $found = false;
            foreach ($decodedData as $item) {
                if ($item['day'] == $day && $item['lesson_id'] == $lesson + 1) {//+1 vì db của lesson là từ 2-11
                    $output .= "<td>".$item['subject_name']."</td>";
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $output .= '<td></td>';
            }
        }
        $output .= '</tr>';
    }
    $output .= '</table></div>';
    echo $output;
}
?>