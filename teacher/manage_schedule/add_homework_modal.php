<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$output = '';
$output .='<div style="padding: 10px 30px 60px 30px">
            <form action="manage_schedule/add_homework.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="lesson_day_id" id="lesson_day_id" value='.$_POST['lesson_day_id'].'>
                <div class="form-group">
                    <label for="type"><b>Loại học liệu</b></label>
                    <select name="type" class="form-control" id="type">
                        <option disabled selected>Học liệu</option>
                        <option>Bài giảng</option>
                        <option>Bài tập</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title"><b>Tiêu đề</b></label>
                    <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Tiêu đề">
                </div>
                <div class="form-group">
                    <label>Example file input</label>
                    <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Chọn file</label>
                </div>
              </div>
                <div class="form-row">
                    <div class="col">
                        <label><b>Ngày bắt đầu</b></label>
                        <input name="start_date" type="date" class="form-control" placeholder="Ngày bắt đầu">
                    </div>
                    <div class="col">
                        <label><b>Ngày kết thúc</b></label>
                        <input name="end_date" type="date" class="form-control" placeholder="Ngày kết thúc">
                    </div>
                </div>
                <label><b>Nội dung</b></label>
                <div id="editor">
                    <p id="pContent">This is some sample content.</p>
                </div>
                <input type="hidden" name="content" id="content">
                <button type="submit" class="btn btn-primary" style="float: right">Submit</button>
            </form>
        </div>';
    echo $output;
?>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    var pValue = document.getElementById("pContent").textContent;
    document.getElementById("content").value = pValue;
</script>