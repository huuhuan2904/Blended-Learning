<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["assignment_id"])){
        $Selected_ass_id = $_POST["assignment_id"];
        $Assignment_arr = $_POST["assignment_arr"];//mảng chứa tất cả id từ bảng assignment được chọn từ lớp
        $output = '';
                $output .=' <form action="calendar/create_schedule.php" method="POST"> 
                              <label>Buổi học</label>
                                <select name="day" id="day" onchange="selectedDay('.$Selected_ass_id.', value, '.htmlspecialchars(json_encode($Assignment_arr)).');" required>
                                    <option disabled selected>Chọn buổi học</option>         
                                    <option value = 1>Thứ 2</option>
                                    <option value = 2>Thứ 3</option>
                                    <option value = 3>Thứ 4</option>
                                    <option value = 4>Thứ 5</option>
                                    <option value = 5>Thứ 6</option>
                                    <option value = 6>Thứ 7</option> 
                                </select>
                            </form>';    
        }
        echo $output;
?>
