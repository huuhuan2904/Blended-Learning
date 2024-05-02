<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Homework_id = $_POST['homework_id'];
    $output = '';
    $result = mysqli_query($conn,"SELECT * FROM homework WHERE id = $Homework_id");

    $output .='
            <div class="container" style="max-width: 2140px;">
            <form>
                <div class="form first">
                    <div class="fields">
                    <input value="'.$Homework_id.'" name="homework_id" id="homework_id" type="hidden">';
                    foreach($result as $row){
                    $output .='
                        <div class="input-field">
                            <label>Học liệu</label>
                            <select name="type" id="type" required>
                                <option value="Bài giảng" ' . ($row['type'] == 'Bài giảng"' ? 'selected' : '') . '>Bài giảng</option>
                                <option value="Bài tập" ' . ($row['type'] == 'Bài tập' ? 'selected' : '') . '>Bài tập</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label>Tiêu đề</label>
                            <input value="'.$row['title'].'" name="title" id="title" type="text" required>
                        </div>
                        <div class="input-field">
                            <label>Nội dung</label>
                            <input value="'.$row['content'].'" name="content" id="content" type="text" required>
                        </div>
                        <div class="input-field">
                            <label>Ngày bắt đầu</label>
                            <input value="' . $row['start_date'] . '" name="start_date" id="start_date" type="date" required>
                        </div>
                        <div class="input-field">
                            <label>Ngày kết thúc</label>
                            <input value="' . $row['end_date'] . '" name="end_date" id="end_date" type="date" required>
                        </div>';
                        }
                $output .='</div>
                    <div style="text-align: right" class="right-button">
                        <button id="update" class="submit" type="button" style="float: right"><i class="fa-solid fa-check"></i></button>
                    </div>    
                </div>
            </form>
        </div>';
    echo $output;
?>
<script>
  $('#update').on('click', function(){
    var array = {
      'homeworkId': $('#homework_id').val(),
      'type': $('#type').val(),
      'title': $('#title').val(),
      'content': $('#content').val(),
      'startDate': $('#start_date').val(),
      'endDate': $('#end_date').val(),
    };
    $.ajax({
      url: "homework_list/edit_homework.php",
      method: 'post',
      data: {
        arrayData: array
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
                toastr.error("Không có thông tin gì thay đổi");
            });
        }
      }
    })
});
</script>