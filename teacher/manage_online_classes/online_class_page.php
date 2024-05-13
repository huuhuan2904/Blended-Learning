<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Class_query = "SELECT assignment.id, assignment.class_id, class.class_name
                    FROM assignment 
                    join class on assignment.class_id = class.id
                    where assignment.teacher_id  = ".$_SESSION['teacher_id']."
                    ORDER BY class.class_name";
    $Class_result = mysqli_query($conn, $Class_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- bootstrap core css -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

</head>

<body>
    <div class="container" style="max-width: 2140px;">
        <?php
            $class_results = [];
            $class_ids = array();
            if ($Class_result->num_rows > 0) {
                echo "<button class='btn btn-warning' style='margin-right: 10px;' onclick=\"location.href='index.php?page=online_class_page'\" type='button'>Tải lại  <i class=\"fa-solid fa-rotate-right\"></i></button>";
                while($row = $Class_result->fetch_assoc()) {
                    $class_results[] = $row;
                    $class_ids[] = $row['id'];
                    echo "<button class='btn btn-primary' style='margin-right: 10px;' onclick='selectedClass(".$row['id'].");'>".$row['class_name']."  <i class=\"fa-solid fa-caret-down\"></i></button>";                
                }
            }
        ?>

        <div style='margin-top: 10px;'>
            <table style="text-align: center" class="table">
            <?php 
                $class_ids_str = implode(',', $class_ids);
                $Online_class_result = mysqli_query($conn,' SELECT *, online_class.id AS online_id, lessons.name AS lesson_name
                                                            FROM online_class
                                                            JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                                            JOIN lessons ON lesson_day.lesson_id = lessons.id
                                                            JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                                            JOIN days ON days_assignment.day = days.id
                                                            JOIN assignment ON days_assignment.assignment_id = assignment.id
                                                            JOIN class ON assignment.class_id = class.id
                                                            WHERE days_assignment.assignment_id IN ('.$class_ids_str.')
                                                            AND (DATE(days_assignment.start_date) = CURDATE() OR DATE(days_assignment.start_date) > CURDATE())
                                                            ORDER BY DATE(days_assignment.start_date) ASC
                                                            LIMIT 1;'); 
                if ($Online_class_result->num_rows > 0) {
                        foreach($Online_class_result as $row2){ 
                            $formattedStartTime = date("H:i", strtotime($row2['start_time']));
                            $formattedEndTime = date("H:i", strtotime($row2['end_time'])); ?>
                            <tbody>
                            <tr class="table-success">
                                <th>Lịch dạy tiếp theo:</th>
                                <td><?php echo $row2['class_name'] ?></td>
                                <td><?php echo $row2['lesson_name'] . "<br>(".$formattedStartTime." - ".$formattedEndTime.")"?></td>
                                <td><?php echo $row2['start_date'] . " (" . $row2['name'] . ")" ?></td>
                                <td><a href="<?php echo $row2['link'] ?>" target="blank"><?php echo $row2['link'] ?></a></td>
                            </tr>
                            </tbody>
                    <?php } 
                    }
                ?>
            </table>
        </div>
        
        <div class="assignmentTable" style='margin-top: 10px;'>
            <table style="text-align: center" class="table">
                <thead>
                    <tr class="title_style">
                        <th> Lớp </th>
                        <th> Tiết </th>
                        <th> Ngày </th>
                        <th> Link phòng </th>
                        <th> Thao tác </th>
                    </tr>
                </thead>
            <?php 
            foreach ($class_results as $row) {
                $Online_class_result = mysqli_query($conn,' SELECT * , online_class.id as online_id, lessons.name as lesson_name
                                                            FROM online_class
                                                            JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                                            JOIN lessons ON lesson_day.lesson_id = lessons.id
                                                            JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                                            JOIN days ON days_assignment.day = days.id
                                                            JOIN assignment ON days_assignment.assignment_id = assignment.id
                                                            JOIN class ON assignment.class_id = class.id
                                                            WHERE days_assignment.assignment_id = '.$row['id'].'
                                                            ORDER BY days_assignment.start_date ASC '); 
                if ($Online_class_result->num_rows > 0) {
                        foreach($Online_class_result as $row2){ 
                            $formattedStartTime = date("H:i", strtotime($row2['start_time']));
                            $formattedEndTime = date("H:i", strtotime($row2['end_time'])); ?>
                            <tbody>
                            <!-- kiểm tra nếu ngày trong start_date là quá khứ và khác ngày hiện tại thì hiện màu đỏ -->
                            <tr <?php echo (strtotime($row2['start_date']) < time() && date('Y-m-d', strtotime($row2['start_date'])) !== date('Y-m-d')) ? 'class="table-danger"' : ''; ?>>
                                <td><?php echo $row2['class_name'] ?></td>
                                <td><?php echo $row2['lesson_name'] . "<br>(".$formattedStartTime." - ".$formattedEndTime.")"?></td>
                                <td><?php echo $row2['start_date'] . " (" . $row2['name'] . ")" ?></td>
                                <td><a href="<?php echo $row2['link'] ?>" target="blank"><?php echo $row2['link'] ?></a></td>
                                <td>
                                    <?php if (strtotime($row2['start_date']) < time() && date('Y-m-d', strtotime($row2['start_date'])) !== date('Y-m-d')): ?>
                                        <div class="btn-group d-none">
                                    <?php else: ?>
                                        <div class="btn-group">
                                    <?php endif; ?>
                                        <button type="button" class="btn btn-secondary dropdown-toggle-split" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a><button type="button" class="dropdown-item" onclick="editOnlineClass(<?php echo $row2['online_id'] ?>,<?php echo $row2['lesson_day_id'] ?>)"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
                                            <a><button type="button" class="dropdown-item" onclick="deleteOnlineClass(<?php echo $row2['online_id'] ?>)"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                    <?php } 
                    }
                }?>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editHomeworkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Sửa học liệu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- modal body -->
                <div class="modal-body2">
                    <div style="padding: 60px">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
  function selectedClass(classId) {
    $.ajax({
      url: "manage_online_classes/online_class_data.php",
      method: 'post',
      data: {
          class_id: classId,
      },
      success: function(result) {
        $(".assignmentTable").html(result);
      }
    })
}
</script>
<script>
    function editOnlineClass(onlineId,lessonDayId) {
        $.ajax({
            url: "manage_online_classes/edit_class_modal.php",
            method: 'post',
            data: {
                online_id: onlineId,
                lessonDay_id: lessonDayId,
            },
            success: function(result) {
                $(".modal-body2").html(result);
                $('#editHomeworkModal').modal('show'); 
            }
        })
    }
</script>
<script>
function deleteOnlineClass(onlineId) {
    $.ajax({
        url: "manage_online_classes/delete_class.php",
        method: 'post',
        data: {
            online_id: onlineId
        },
        success: function(result) {
            if (result.trim() === "1") {
                var url = "./index.php?page=online_class_page";
                window.location.href = url;
            } else {
                toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                $(document).ready(function onDocumentReady() {  
                    toastr.error("Không có thông tin gì thay đổi");
                });
            }
        }
    });
}
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
