<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$id = $_POST['id'];
$subject = $_POST['subject'];
$teacher = $_POST['teacher'];
$type = $_POST['type'];
$filename = $_POST['filename'];
$filepath = $_POST['filepath'];
$title = $_POST['title'];
$content = $_POST['content'];
$lesson = $_POST['lesson'];
$start = $_POST['start'];
$end = $_POST['end'];
$day = $_POST['day'];
$student_id = $_SESSION['student_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>

<body>
<style>
    .modal-backdrop.show{
      display: none !important;
    }
</style>
    <div class="container2" style="padding-bottom: 180px">
        <table style="width:100%">
            <tr>
                <td style="width:60%">
                    <p style="font-size: 27px"><b><?php echo $type;?></b></p>
                    <table style="width:100%; background-color: #D6EEEE">
                        <tr>
                            <th style="width:30%; padding: 15px 0 0 15px;font-size: 20px">Giáo viên:</th>
                            <th style="width:27%; padding: 15px 0 0 15px;font-size: 20px">Môn học:</th>
                            <th style="width:27%; padding: 15px 0 0 15px;font-size: 20px">Ngày:</th>
                            <th style="width:25%; padding: 15px 0 0 15px;font-size: 20px">Tiết:</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0 15px 15px;font-size: 17px"><?php echo $teacher;?></td>
                            <td style="padding: 10px 0 15px 15px;font-size: 17px"><?php echo $subject;?></td>
                            <td style="padding: 10px 0 15px 15px;font-size: 17px"><?php echo $day;?></td>
                            <td style="padding: 10px 0 15px 15px;font-size: 17px"><?php echo $lesson;?></td>
                        </tr>
                    </table>
                    <div style="padding-bottom: 20px">
                        <table style="width:100%; background-color: #D6EEEE; padding-bottom: 20px">
                            <tr>
                                <th style="width:35%; padding: 15px 0 0 15px;font-size: 20px;">Học liệu:</th>
                            </tr>
                            <tr>
                                <td colspan="3" style="padding: 0 0 15px 15px;font-size: 17px">
                                    <a href="<?php echo $filename;?>" download><?php echo $filename;?> <i class="fa-solid fa-download"></i></a>
                                </td>
                            </tr>
                        </table>
                    </div>    
                    <?php 
                        $query = mysqli_query($conn, "SELECT * FROM homework_submission where homework_id = $id AND student_id = $student_id");
                        $Homework_row = mysqli_fetch_assoc($query);
                        if(mysqli_num_rows($query) > 0){ 
                            $Homework_submission = $Homework_row['id'];
                            $fileName = $Homework_row['file_name'];
                            $submitssionDate = $Homework_row['submission_date'];?>
                            <table style="width:100%; border-color: #96D4D4; border-style:solid;">
                                <tr>
                                    <td style="padding: 10px 0 15px 15px;font-size: 17px"><i class="fa-solid fa-file"></i> <?php echo $fileName;?></td>
                                    <td style="padding: 10px 0 15px 0;font-size: 17px"><i class="fa-solid fa-clock"></i> <?php echo $submitssionDate;?></td>
                                    <?php 
                                        if($Homework_row['status'] == 0){?>
                                            <td style="padding: 10px 0 15px 20px;font-size: 17px; color: green"><i class="fa-solid fa-circle-check"></i> Đã nộp</td>
                                        <?php }else{ ?>
                                            <td style="padding: 10px 0 15px 20px;font-size: 17px; color: #FF6600"><i class="fa-solid fa-circle-check"></i> Trễ hạn</td>
                                        <?php } ?>
                                    <td><button class="btn btn-primary" onclick="editHomework(<?php echo $Homework_submission?>)">Sửa</button></td>
                                </tr>
                            </table>
                        <?php }else{
                            if ($type != "Bài giảng") { ?>
                                <p style="font-size: 27px"><b>Nộp bài</b></p>
                                <form action="homework/homework_submission.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Chọn file: </label>
                                        <input type="file" class="form-control-file" id="file" name="file">
                                    </div>
                                    <div id="editor"></div>
                                    <input type="hidden" name="content" id="content" required>
                                    <input type="hidden" name="homework_id" id="homework_id" value="<?php echo $id;?>">
                                    <input type="hidden" id="currentDate" name="currentDate">
                                    <input type="hidden" id="deadline" name="deadline" value="<?php echo $end;?>">
                                    <button type="submit" class="btn btn-primary" style="float: right">Nộp bài</button>
                                </form>
                            <?php } ?>
                        <?php } ?>
                </td>
                <td style="width:10%"></td>
                <td style="border-color: #96D4D4; border-style:solid;">
                    <p style="padding: 0 0 0 15px;font-size: 27px;"><b>Thông tin học liệu</b></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b><i class="fa-solid fa-thumbtack"></i> Tiêu đề:</b> <?php echo $title;?></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b><i class="fa-solid fa-newspaper"></i> Nội dung:</b> <?php echo $content;?></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b><i class="fa-solid fa-clock"></i> Ngày bắt đầu:</b> <?php if ($type != "Bài giảng") { echo $start; } ?></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b><i class="fa-solid fa-clock"></i> Ngày kết thúc:</b> <?php if ($type != "Bài giảng") { echo $end; } ?></p>
                </td>
            </tr>
        </table>
        <!-- modal -->
        <div class="modal" id="editHomework" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div style="max-width: 800px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Sửa bài tập</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- modal body -->
                    <div class="modal-body">
                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            window.editor = editor;
            editor.model.document.on('change', () => {
                var content = window.editor.getData();
                document.getElementById("content").value = content;
            });
        })
        .catch(error => {
            console.error('There was an error initializing the editor:', error);
        });
</script>

<script>
function editHomework(id) {
    $.ajax({
        url: "homework/edit_homework_modal.php",
        type: 'POST',
        data: {
            homework_submission: id,
        },
        success: function(result) {
            $('#editHomework').modal('show');
            $(".modal-body").html(result);
        }
    })
}
</script>

<script>
    var today = new Date();

    var yyyy = today.getFullYear();
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var dd = String(today.getDate()).padStart(2, '0');
    var currentDate = yyyy + '-' + mm + '-' + dd;

    document.getElementById('currentDate').value = currentDate;
</script>