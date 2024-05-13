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
    <title>Bootstrap Sidebar 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../../css/style.css"> -->
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
            if ($Class_result->num_rows > 0) {
                echo "<button class='btn btn-warning' style='margin-right: 10px;' onclick=\"location.href='index.php?page=homework_page'\" type='button'>Tải lại  <i class=\"fa-solid fa-rotate-right\"></i></button>";
                while($row = $Class_result->fetch_assoc()) {
                    $class_results[] = $row;
                    echo "<button class='btn btn-primary' style='margin-right: 10px;' onclick='selectedClass(".$row['id'].", ".$row['class_id'].");'>".$row['class_name']." <i class=\"fa-solid fa-caret-down\"></i></button>";
                }
            }
        ?>
        <div class="assignmentTable" style='margin-top: 10px;'>
            <table style="text-align: center" class="table">
                <thead>
                    <tr class="title_style">
                        <th> Học liệu </th>
                        <th> Tiêu đề </th>
                        <th> Nội dung </th>
                        <th> Ngày bắt đầu </th>
                        <th> Ngày kết thúc </th>
                        <th> Ngày giao </th>
                        <th> Tiết </th>
                        <th> Thao tác </th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($class_results as $row){
                    $Homework_result = mysqli_query($conn,' SELECT * , homework.id as homework_id, homework.start_date AS start, homework.end_date AS deadline, lessons.name as lesson_name
                                                            FROM homework
                                                            JOIN lesson_day ON homework.lesson_day_id = lesson_day.id
                                                            JOIN lessons ON lesson_day.lesson_id = lessons.id
                                                            JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                                            JOIN days ON days_assignment.day = days.id
                                                            JOIN assignment ON days_assignment.assignment_id = assignment.id
                                                            JOIN class ON assignment.class_id = class.id
                                                            WHERE days_assignment.assignment_id = '.$row['id'].'');
                        if ($Homework_result->num_rows > 0) {
                            foreach($Homework_result as $row2){ ?>
                            <!-- kiểm tra nếu ngày trong start_date là quá khứ và khác ngày hiện tại thì hiện màu đỏ -->
                            <tr <?php echo (strtotime($row2['deadline']) < time() && $row2['deadline'] != '0000-00-00' && date('Y-m-d', strtotime($row2['deadline'])) !== date('Y-m-d')) ? 'class="table-danger"' : ''; ?>>
                                <td><?php echo $row2['type']?></td>
                                <td><?php echo $row2['title']?></td>
                                <td><?php echo $row2['content']?></td>
                                <?php if($row2['start'] == '0000-00-00'){ ?>
                                    <td></td>
                                    <td></td>
                                <?php }else{ ?>
                                    <td><?php echo $row2['start']?></td>
                                    <td><?php echo $row2['deadline']?></td>
                                <?php } ?>
                                        <td><?php echo $row2['homework_day'] ?></td>
                                        <td><?php echo $row2['lesson_name'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle-split" type="button" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-gear"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if (strtotime($row2['deadline']) > time() || $row2['deadline'] == '0000-00-00' || date('Y-m-d', strtotime($row2['deadline'])) === date('Y-m-d')) : ?>
                                                        <a><button type="button" class="dropdown-item" onclick="editHomework(<?php echo $row2['homework_id']?>)"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
                                                        <a><button type="button" class="dropdown-item" onclick="deleteHomework(<?php echo $row2['homework_id']?>)"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                                                        <a>
                                                            <form action="index.php?page=homework_details" method="POST">
                                                                <input type="hidden" name="homeworkId" id="homeworkId" value="<?php echo $row2['homework_id']?>">
                                                                <input type="hidden" name="classId" id="classId" value="<?php echo $row['class_id'] ?>">
                                                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-magnifying-glass"></i> Chi tiết</button>
                                                            </form>
                                                        </a>
                                                    <?php else: ?>
                                                        <a><button type="button" class="dropdown-item" onclick="deleteHomework(<?php echo $row2['homework_id']?>)"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                                                        <a>
                                                            <form action="index.php?page=homework_details" method="POST">
                                                                <input type="hidden" name="homeworkId" id="homeworkId" value="<?php echo $row2['homework_id']?>">
                                                                <input type="hidden" name="classId" id="classId" value="<?php echo $row['class_id'] ?>">
                                                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-magnifying-glass"></i> Chi tiết</button>
                                                            </form>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                            </tr>
                        <?php } 
                        }
                }?>
            </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editHomeworkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
  function selectedClass(assId, classId) {
    $.ajax({
      url: "homework_list/homework_data.php",
      method: 'post',
      data: {
          assignmentId: assId,
          classId: classId
      },
      success: function(result) {
        $(".assignmentTable").html(result);
      }
    })
}
</script>
<script>
function editHomework(id) {
    console.log('asdasd');
    $.ajax({
        url: "homework_list/edit_homework_modal.php",
        method: 'post',
        data: {
            homework_id: id,
        },
        success: function(result) {
            $(".modal-body2").html(result);
            $('#editHomeworkModal').modal('show');
        }
    })
}
</script>
<script>
function deleteHomework(id) {
    $.ajax({
        url: "homework_list/delete_homework.php",
        method: 'post',
        data: {
            homework_id: id,
        },
        success: function(result) {
            if (result.trim() === "1") {
                var url = "./index.php?page=homework_page";
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
                    toastr.error("Lỗi");
                });
            }
        }
    });
}
</script>
<script>
function detailsHomework(id) {
    $.ajax({
        url: "homework_list/homework_details.php",
        method: 'post',
        data: {
            homework_id: id,
        },
        success: function(result) {
            $(".modal-body2").html(result);
            $('#editHomeworkModal').modal('show');
        }
    })
}
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
