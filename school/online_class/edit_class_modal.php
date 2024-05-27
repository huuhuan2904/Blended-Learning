<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$Start_date = date('Y-m-d', strtotime($_POST['startDate']));
$output = '';

$output .='<div style="padding: 10px 30px 60px 30px">
            <form action="online_class/update_online_class.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="online_class_id" id="online_class_id" value='.$_POST['onlineClassId'].'>

                <div class="input-field">
                <label>Tiết học</label>
                    <select class="form-select" name="lesson" id="lesson" aria-label="Default select example">
                        <option value="12"' . (($_POST['lessonId'] == 12) ? ' selected' : '') . '>Ngoài giờ 1 (18:00 - 18:45)</option>
                        <option value="13"' . (($_POST['lessonId'] == 13) ? ' selected' : '') . '>Ngoài giờ 2 (18:50 - 19:35)</option>
                        <option value="14"' . (($_POST['lessonId'] == 14) ? ' selected' : '') . '>Ngoài giờ 3 (19:40 - 20:25)</option>
                        <option value="15"' . (($_POST['lessonId'] == 15) ? ' selected' : '') . '>Ngoài giờ 4 (20:30 - 21:15)</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Ngày học</label>
                    <input value="'.$Start_date.'" name="start_date" id="start_date" type="date" required>
                </div>
                <div class="input-field">
                    <label>Link phòng học</label>
                    <input value="'.$_POST['link'].'" style="width: 300px;" name="link" id="link" type="text" required>
                </div>
                <button type="submit" name="update_button" class="btn btn-primary" style="float: right">Xác nhận</button>
            </form>
        </div>';
    echo $output;
?>