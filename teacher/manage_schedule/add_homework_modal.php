<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$Selected_day = date('Y-m-d', strtotime($_POST['homework_day']));
$output = '';

$output .='<div style="padding: 10px 30px 60px 30px">
            <form action="manage_schedule/add_homework.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="lesson_day_id" id="lesson_day_id" value='.$_POST['lesson_day_id'].'>
                <input type="hidden" name="homework_day" id="homework_day" value='.$Selected_day.'>
                <p><b>Ngày chọn: </b>'.$Selected_day.'</p>
                <div class="form-group">
                    <label for="type"><b>Loại học liệu</b></label>
                    <select name="type" class="form-control" id="type" required>
                        <option disabled selected value="">Học liệu</option>
                        <option value="Bài giảng">Bài giảng</option>
                        <option value="Bài tập">Bài tập</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title"><b>Tiêu đề</b></label>
                    <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Tiêu đề" required>
                </div>
                <div class="form-group">
                    <label><b>Tải file học liệu</b></label>
                    <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" for="customFile">Chọn file</label>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label><b>Ngày bắt đầu</b></label>
                        <input id="date" name="start_date" type="date" class="form-control date-input" placeholder="Ngày bắt đầu" required>
                    </div>
                    <div class="col">
                        <label><b>Ngày kết thúc</b></label>
                        <input id="date" name="end_date" type="date" class="form-control date-input" placeholder="Ngày kết thúc" required>
                    </div>
                </div>
                <label><b>Nội dung</b></label>
                <div id="editor"></div>
                <input type="hidden" name="content" id="content" required>
                <button type="submit" class="btn btn-primary" style="float: right">Xác nhận</button>
            </form>
        </div>';
    echo $output;
?>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            window.editor = editor;
            editor.model.document.on('change', () => {
                var content = window.editor.getData();
                document.getElementById("content").value = content;
                console.log(content);
            });
        })
        .catch(error => {
            console.error('There was an error initializing the editor:', error);
        });
</script>
<script>
    document.getElementById("type").addEventListener("change", function() {
        var selectedValue = this.value;
        if (selectedValue !== "") {
            this.removeAttribute("required");
            if(selectedValue != 'Bài tập'){
                var dateInputs = document.querySelectorAll(".date-input");
                dateInputs.forEach(function(input) {
                    input.removeAttribute("required");
                });
            }
        } else {
            this.setAttribute("required", "required");
        }
    });
</script>