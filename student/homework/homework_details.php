<?php
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
    <div class="container2">
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
                    <table style="width:100%; background-color: #D6EEEE">
                        <tr>
                            <th style="width:35%; padding: 15px 0 0 15px;font-size: 20px;">Học liệu:</th>
                        </tr>
                        <tr>
                            <td colspan="3" style="padding: 0 0 15px 15px;font-size: 17px">
                                <a href="<?php echo $filename;?>" download><?php echo $filename;?> <i class="fa-solid fa-download"></i></a>
                            </td>
                        </tr>
                    </table>
                    <p style="font-size: 27px"><b>Nộp bài</b></p>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Chọn file: </label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div id="editor"></div>
                        <input type="hidden" name="content" id="content" required>
                        <input type="hidden" name="homework_id" id="homework_id" value="<?php echo $id;?>">
                        <button type="submit" class="btn btn-primary" style="float: right">Nộp bài</button>
                    </form>
                </td>
                <td style="width:10%"></td>
                <td style="border-color: #96D4D4; border-style:solid;">
                    <p style="padding: 0 0 0 15px;font-size: 27px;"><b>Thông tin học liệu</b></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b>Tiêu đề:</b> <?php echo $title;?></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b>Nội dung:</b> <?php echo $content;?></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b>Ngày bắt đầu:</b> <?php if ($type != "Bài giảng") { echo $start; } ?></p>
                    <p style="padding-left: 15px;font-size: 17px;"><b>Ngày kết thúc:</b> <?php if ($type != "Bài giảng") { echo $end; } ?></p>
                </td>
            </tr>
        </table>
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