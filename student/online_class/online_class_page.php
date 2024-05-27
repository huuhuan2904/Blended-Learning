<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Class_query = "SELECT class_students.*, class.class_name
                    FROM class_students 
                    join class on class_students.class_id = class.id
                    where class_students.student_id  = ".$_SESSION['student_id']."";
    $Class_result = mysqli_query($conn, $Class_query);
    $Class_row = mysqli_fetch_assoc($Class_result);
    $Class_of_student = $Class_row['class_id'];

    $Ass_query = "  SELECT assignment.id, assignment.class_id, class.class_name
                    FROM assignment 
                    join class on assignment.class_id = class.id
                    where assignment.class_id  = ".$Class_of_student."";
    $Ass_result = mysqli_query($conn, $Ass_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
        $class_results = [];
        $ass_ids = array();
        if ($Ass_result->num_rows > 0) {
            while($row = $Ass_result->fetch_assoc()) {
                $class_results[] = $row;
                $ass_ids[] = $row['id'];
            }
        }
    ?>
    <div style='margin-top: 10px;'>
        <table style="text-align: center" class="table">
            <?php 
                $ass_ids_str = implode(',', $ass_ids);
                //nếu DATE đầu tiên là start_date trùng current date(case 1) hoặc k trùng và có ngày gần nhất với cur date thì sẽ lấy(case 2)
                $Online_class_result = mysqli_query($conn,' SELECT *, online_class.id AS online_id, lessons.name AS lesson_name
                                                            FROM online_class
                                                            JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                                            JOIN lessons ON lesson_day.lesson_id = lessons.id
                                                            JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                                            JOIN days ON days_assignment.day = days.id
                                                            JOIN assignment ON days_assignment.assignment_id = assignment.id
                                                            JOIN class ON assignment.class_id = class.id
                                                            WHERE days_assignment.assignment_id IN ('.$ass_ids_str.')
                                                            AND (
                                                                DATE(days_assignment.start_date) = CURDATE()
                                                                OR (
                                                                    NOT EXISTS (
                                                                        SELECT 1
                                                                        FROM days_assignment
                                                                        WHERE DATE(start_date) = CURDATE()
                                                                        AND assignment_id IN ('.$ass_ids_str.')
                                                                    )
                                                                    AND DATE(days_assignment.start_date) = (
                                                                        SELECT MIN(DATE(start_date))
                                                                        FROM days_assignment
                                                                        WHERE DATE(start_date) > CURDATE()
                                                                        AND assignment_id IN ('.$ass_ids_str.')
                                                                    )
                                                                )
                                                            )
                                                            ORDER BY DATE(days_assignment.start_date) ASC;'); 
                if ($Online_class_result->num_rows > 0) {
                        foreach($Online_class_result as $row2){ 
                            $formattedStartTime = date("H:i", strtotime($row2['start_time']));
                            $formattedEndTime = date("H:i", strtotime($row2['end_time'])); ?>
                            <tr>
                                <th style="background-color: #d4edda;">Lịch học tiếp theo:</th>
                                <td style="background-color: #d4edda;"><?php echo $row2['class_name'] ?></td>
                                <td style="background-color: #d4edda;"><?php echo $row2['lesson_name'] . "<br>(".$formattedStartTime." - ".$formattedEndTime.")"?></td>
                                <td style="background-color: #d4edda;"><?php echo $row2['start_date'] . " (" . $row2['name'] . ")" ?></td>
                                <td style="background-color: #d4edda;"><a href="<?php echo $row2['link'] ?>" target="blank"><?php echo $row2['link'] ?></a></td>
                            </tr>
                    <?php } 
                    }else{ ?>
                        <tr>
                            <th>Chưa có lịch học nào mới ở đây</th>
                        </tr>
                    <?php }
                ?>
        </table>
    </div>

    <div class="assignmentTable" style='margin-top: 10px;'>
            <table style="text-align: center" class="table">
                <thead>
                    <tr class="title_style">
                        <th style="text-align: center"> Lớp </th>
                        <th style="text-align: center"> Ngày </th>
                        <th style="text-align: center"> Tiết </th>
                        <th style="text-align: center"> Link phòng </th>
                    </tr>
                </thead>
            <?php 
            foreach ($class_results as $row) {
                $Online_class_result = mysqli_query($conn,' SELECT * , online_class.id as online_id, lessons.name as lesson_name, subjects.name as subject_name
                                                            FROM online_class
                                                            JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                                            JOIN lessons ON lesson_day.lesson_id = lessons.id
                                                            JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                                            JOIN days ON days_assignment.day = days.id
                                                            JOIN assignment ON days_assignment.assignment_id = assignment.id
                                                            JOIN subjects ON assignment.subject_id = subjects.id
                                                            JOIN class ON assignment.class_id = class.id
                                                            WHERE days_assignment.assignment_id = '.$row['id'].'
                                                            ORDER BY days_assignment.start_date ASC '); 
                if ($Online_class_result->num_rows > 0) {
                        foreach($Online_class_result as $row2){ 
                            $formattedStartTime = date("H:i", strtotime($row2['start_time']));
                            $formattedEndTime = date("H:i", strtotime($row2['end_time'])); ?>
                            <tbody>
                            <!-- kiểm tra nếu ngày trong start_date là quá khứ và khác ngày hiện tại thì hiện màu đỏ -->
                            <tr <?php echo (strtotime($row2['start_date']) < time() && date('Y-m-d', strtotime($row2['start_date'])) !== date('Y-m-d')) ? 'style="background-color: #f8d7da;"' : ''; ?>>
                                <td><?php echo $row2['subject_name'] ?></td>
                                <td><?php echo $row2['start_date'] . " (" . $row2['name'] . ")" ?></td>
                                <td><?php echo $row2['lesson_name'] . "<br>(".$formattedStartTime." - ".$formattedEndTime.")"?></td>
                                <td><a href="<?php echo $row2['link'] ?>" target="blank"><?php echo $row2['link'] ?></a></td>
                            </tr>
                            </tbody>
                    <?php } 
                    }
                }?>
            </table>
        </div>
</body>
</html>