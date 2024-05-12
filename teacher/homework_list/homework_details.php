<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Homework_id = $_POST["homeworkId"];
    $Class_id = $_POST["classId"];

    $StudentList_result = mysqli_query($conn,'SELECT class_students.student_id, students.*
                                                from class_students 
                                                join students on class_students.student_id = students.id
                                                where class_students.class_id = '.$Class_id.'');
    $Class_result = mysqli_query($conn,'SELECT * from class where id = '.$Class_id.'');
    $Class_name_record = mysqli_fetch_assoc($Class_result);
    $Class_name = $Class_name_record['class_name'];
    $firstRow = true;
    $num_submitted = 0;
    $num_not_submitted = 0;
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
        <div class="card-deck">
            <div class="card border-success mb-3" style="max-width: 9rem; height: 3rem;">
                <div class="card-body d-flex align-items-center justify-content-center text-success">
                    <h6 class="card-title m-0">Đã nộp: <span id="submittedCount">0</span></h6>
                </div>
            </div>
            <div class="card border-danger mb-3" style="max-width: 9rem; height: 3rem;">
                <div class="card-body d-flex align-items-center justify-content-center text-danger">
                    <h6 class="card-title m-0">Chưa nộp: <span id="notSubmittedCount">0</span></h6>
                </div>
            </div>
        </div>
                <table style="text-align: center" class="table">
                    <thead>
                    <tr class="title_style">
                        <th> Lớp </th>
                        <th> Họ tên </th>
                        <th> Bài nộp </th>
                        <th> Ngày nộp </th>
                        <th> Trạng thái </th>
                    </tr>
                    </thead>
                    <?php
                        if ($StudentList_result->num_rows > 0) {
                            while($row = $StudentList_result->fetch_assoc()) {
                                $SubmissionList_result = mysqli_query($conn,'SELECT * from homework_submission 
                                                                            where homework_id = '.$Homework_id.' AND student_id = '.$row['id'].'');
                                if ($firstRow) { ?>
                                    <tr>
                                        <td rowspan="<?php echo mysqli_num_rows($StudentList_result) ?>"><?php echo $Class_name ?></td>
                        <?php $firstRow = false;
                                }
                                if ($SubmissionList_result->num_rows > 0) { 
                                    while($row2 = $SubmissionList_result->fetch_assoc()) { ?>
                                        <td><?php echo $row['last_name'] ?> <?php echo $row['first_name']?></td>
                                        <td>
                                            <a href="<?php echo $row2['file_name'] ?>" download><?php echo $row2['file_name'] ?> <i class="fa-solid fa-download"></i></a>
                                        </td>
                                        <td><?php echo $row2['submission_date'] ?></td>
                                        <td style="color: green">Đã nộp</td>
                                <?php $num_submitted++; 
                                    }
                                } else { ?>
                                        <td><?php echo $row['last_name'] ?> <?php echo $row['first_name']?></td>
                                        <td></td>
                                        <td></td>
                                        <td style="color: #FF6600">Chưa nộp bài</td>
                                <?php $num_not_submitted++; 
                                } ?>
                                    </tr>
                        <?php 
                            }
                        }
                    ?>
                </table>
        <div class="assignmentTable"></div>
        
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
      url: "homework_list/homework_data.php",
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
    document.getElementById("submittedCount").innerText = <?php echo $num_submitted ?>;
    document.getElementById("notSubmittedCount").innerText = <?php echo $num_not_submitted ?>;
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
