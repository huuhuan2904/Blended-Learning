<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Teacher_id = $_POST['teacher_id'];
$Day_id = $_POST['day_id'];
$Start_date = $_POST['start_date'];
$End_date = $_POST['end_date'];

switch ($Day_id) {
    case 1:
        $day_name = "Thứ 2";
        break;
    case 2:
        $day_name = "Thứ 3";
        break;
    case 3:
        $day_name = "Thứ 4";
        break;
    case 4:
        $day_name = "Thứ 5";
        break;
    case 5:
        $day_name = "Thứ 6";
        break;
    case 6:
        $day_name = "Thứ 7";
        break;
    default:
        $day_name = "Không học chủ nhật";
}

$Class_query = "SELECT assignment.class_id, class.class_name
                FROM assignment 
                join class on assignment.class_id = class.id
                where assignment.teacher_id  = ".$Teacher_id."";
$Class_result = mysqli_query($conn, $Class_query);
$output = '';
    $output .='
        <div style="padding: 20px">
            <form action="manage_schedule/add_online_class.php" method="POST">
                <input type="hidden" name=teacher_id class="form-control" id="exampleInputPassword1" value = '.$Teacher_id.'>
                <label for="exampleInputPassword1" class="form-label"><b>Lớp</b></label>
                <select class="form-select" name=class aria-label="Default select example" required>
                    <option disabled selected hidden>Chọn lớp học</option>';
                    if ($Class_result->num_rows > 0) {
                        while($row = $Class_result->fetch_assoc()) {
                            $output .="<option value='" . $row['class_id'] . "'>" . $row['class_name'] . "</option>";
                        }
                    }
        $output .='</select>
                <label for="exampleInputPassword1" class="form-label"><b>Thứ trong tuần</b></label>
                <select class="form-select" name=day aria-label="Default select example">
                    <option selected value=' . $Day_id . '>' . $day_name . '</option>
                </select>
                <input type="hidden" name=start_date class="form-control" id="exampleInputPassword1" value = '.$Start_date.'>
                <input type="hidden" name=end_date class="form-control" id="exampleInputPassword1" value = '.$End_date.'>
                <label for="exampleInputPassword1" class="form-label"><b>Tiết học</b></label>
                <select class="form-select" name=lesson aria-label="Default select example">
                    <option disabled selected hidden>Chọn tiết học</option>
                    <option value="12">Ngoài giờ 1 (18:00 - 18:45)</option>
                    <option value="13">Ngoài giờ 2 (18:50 - 19:35)</option>
                    <option value="14">Ngoài giờ 3 (19:40 - 20:25)</option>
                    <option value="15">Ngoài giờ 4 (20:30 - 21:15)</option>
                </select>
                <label for="exampleInputPassword1" class="form-label"><b>Hình thức</b></label>
                <select class="form-select" name=status aria-label="Default select example">
                    <option selected value="1">Trực tuyến</option>
                </select>
                <label for="exampleInputPassword1" class="form-label"><b>Link phòng học</b></label>
                <input type="text" name=link class="form-control" id="exampleInputPassword1" placeholder="http://meet.google.com/{...}">
                <div style="padding: 40px 0 40px 0">
                    <button style="float: right" type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>
        </div>';
    echo $output;
?>
