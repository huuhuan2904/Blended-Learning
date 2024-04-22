<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["assignment_id"]) && isset($_POST["day_id"])){
        $output = '';
        $Lesson_id_arr = array();
        $Assignment_arr = $_POST["assignment_arr"];//mảng chứa tất cả id từ bảng assignment được chọn từ lớp
        $Lessons_selected_arr = array();//mảng dùng để chứa tất cả id từ bảng days_assignment sau khi thỏa dk $Day_ass_result
        $Day_ass_result = mysqli_query($conn,'SELECT * from days_assignment where day = '.$_POST["day_id"].' AND assignment_id IN (' . implode(',', $Assignment_arr) . ')');
        $Lessons = mysqli_query($conn,'SELECT * from lessons');

        if ($Day_ass_result->num_rows > 0) {
            foreach ($Day_ass_result as $day_Ass_row) {// dùng vòng lặp lấy tất cả id của bảng days_assignment khi thỏa dk
                $Lessons_selected_arr[] = $day_Ass_row['id'];
            }
            $output .=' <form action="calendar/create_schedule.php" method="POST"> 
            <label>Tiết học</label>
            <select name="lessons[]" id="lessons" multiple required>';
            $Lesson_day_result = mysqli_query($conn,'SELECT lesson_id from lesson_day where days_ass_id IN (' . implode(',', $Lessons_selected_arr) . ')');
            //lấy all id trong mảng làm dk lấy các tiết học trong bảng lesson_day
                while ($lesson_result_row = mysqli_fetch_assoc($Lesson_day_result)) {
                    $Lesson_id_arr[] = $lesson_result_row['lesson_id'];
                }
                $lessons = mysqli_query($conn,"SELECT * from lessons WHERE id NOT IN (" . implode(',', $Lesson_id_arr) . ")");
                //so sánh nếu những id vào khong trùng id trong mảng thì hiển thị
                if ($lessons->num_rows > 0) {
                    while ($Lesson = mysqli_fetch_assoc($lessons)) {
                        $output .='<option value='.$Lesson['id'].'>'.$Lesson['name'].' ('.$Lesson['start_time'].' -> '.$Lesson['end_time'].')</option>';
                    }
                }    
            $output .=' </select>
                    </form>';
                
            $output .='
                    <label>Ngày bắt đầu</label>
                    <input name="startDate" id="startDate" type="date" placeholder="Ngày/tháng/năm" required>
                    <label>Ngày kết thúc</label>
                    <input name="endDate" id="endDate" type="date" placeholder="Ngày/tháng/năm" required>';
            
        }else{
            $output .='<form action="calendar/create_schedule.php" method="POST"> 
                <label>Tiết học</label>
                    <select name="lessons[]" id="lessons" multiple required>';
                            foreach($Lessons as $class_row) {
                                $output .='<option value='.$class_row['id'].'>'.$class_row['name'].' ( '.$class_row['start_time'].' -> '.$class_row['end_time'].' )</option>';
                            }
            $output .=' </select>
                            <label>Ngày bắt đầu</label>
                            <input name="startDate" id="startDate" type="date" placeholder="Ngày/tháng/năm" required>
                            <label>Ngày kết thúc</label>
                            <input name="endDate" id="endDate" type="date" placeholder="Ngày/tháng/năm" required>
                    </form>';
        }
        echo $output;
    }





    // $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    // if(isset($_POST["assignment_id"]) && isset($_POST["day_id"])){
    //     $output = '';
    //     $Lesson_id_arr = array();
    //     $Assignment_arr = $_POST["assignment_arr"];//mảng này chứa tất cả các tiết của lớp và thứ đã chọn
    //     $Day_ass_result = mysqli_query($conn,'SELECT * from days_assignment where assignment_id = '.$_POST["assignment_id"].' AND day = '.$_POST["day_id"].'');
    //     $Lessons = mysqli_query($conn,'SELECT * from lessons');

    //     if ($Day_ass_result->num_rows > 0) {
    //         while ($addAss = mysqli_fetch_assoc($Day_ass_result)) {
    //             $output .=' <form action="calendar/create_schedule.php" method="POST"> 
    //             <label>Tiết học</label>
    //             <select name="lessons[]" id="lessons" multiple required>';
    //                 $lesson_result = mysqli_query($conn,'SELECT * from lesson_day where days_ass_id  = '.$addAss['id'].'');
    //                 //lấy id của days_assignment làm điều kiện để lấy các hàng của bảng lesson_day
    //                 foreach ($lesson_result as $lesson_result_row) {// dùng vòng lặp để lấy value các hàng của cột lesson_id cho vào mảng
    //                     $Lesson_id_arr[] = $lesson_result_row['lesson_id'];
    //                 }
    //                 $lessons = mysqli_query($conn,"SELECT * from lessons WHERE id NOT IN (" . implode(',', $Lesson_id_arr) . ")");
    //                 //so sánh nếu những id vào khong trùng id trong mảng thì hiển thị
    //                 if ($lessons->num_rows > 0) {
    //                     while ($Lesson = mysqli_fetch_assoc($lessons)) {
    //                         $output .='<option value='.$Lesson['id'].'>'.$Lesson['name'].' ('.$Lesson['start_time'].' -> '.$Lesson['end_time'].')</option>';
    //                     }
    //                 }    
    //             $output .=' </select>
    //                     </form>';
                
    //             $output .='
    //                     <label>Ngày bắt đầu</label>
    //                     <input name="startDate" id="startDate" type="date" value="'.$addAss['start_date'].'" placeholder="Ngày/tháng/năm" required>
    //                     <label>Ngày kết thúc</label>
    //                     <input name="endDate" id="endDate" type="date" value="'.$addAss['end_date'].'" placeholder="Ngày/tháng/năm" required>';
    //         }
    //     }else{
    //         $output .='<form action="calendar/create_schedule.php" method="POST"> 
    //             <label>Tiết học</label>
    //                 <select name="lessons[]" id="lessons" multiple required>';
    //                         foreach($Lessons as $class_row) {
    //                             $output .='<option value='.$class_row['id'].'>'.$class_row['name'].' ( '.$class_row['start_time'].' -> '.$class_row['end_time'].' )</option>';
    //                         }
    //         $output .=' </select>
    //                         <label>Ngày bắt đầu</label>
    //                         <input name="startDate" id="startDate" type="date" placeholder="Ngày/tháng/năm" required>
    //                         <label>Ngày kết thúc</label>
    //                         <input name="endDate" id="endDate" type="date" placeholder="Ngày/tháng/năm" required>
    //                 </form>';
    //     }
    //     echo $output;
    // }
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('lessons')  // id
</script>