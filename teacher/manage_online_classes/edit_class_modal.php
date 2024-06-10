<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Online_class_id = $_POST['online_id'];
    $Lesson_day_id = $_POST['lessonDay_id'];

    $output = '';
    $Online_class_result = mysqli_query($conn,"SELECT * FROM online_class WHERE id = $Online_class_id");
    $Online_class_record = mysqli_fetch_assoc($Online_class_result);
    $Link = $Online_class_record['link'];

    $Lesson_day_result = mysqli_query($conn,"SELECT lesson_day.*, lessons.name as lesson_name FROM lesson_day join lessons on lesson_day.lesson_id = lessons.id WHERE lesson_day.id = $Lesson_day_id");
    $Lesson_day_record = mysqli_fetch_assoc($Lesson_day_result);
    $Lesson = $Lesson_day_record['lesson_id'];

    $output .='
            <div class="container" style="max-width: 2140px;">
            <form>
                <div class="form first">
                    <div class="fields">
                    <input value="'.$Online_class_id.'" name="online_class_id" id="online_class_id" type="hidden">
                    <input value="'.$Lesson_day_id.'" name="lesson_day_id" id="lesson_day_id" type="hidden">
                    <div class="input-field">
                        <label>Tiết học</label>
                        <select class="form-select" name="lesson" id="lesson" aria-label="Default select example">
                            <option value="12"' . (($Lesson == 12) ? ' selected' : '') . '>Ngoài giờ 1 (18:00 - 18:45)</option>
                            <option value="13"' . (($Lesson == 13) ? ' selected' : '') . '>Ngoài giờ 2 (18:50 - 19:35)</option>
                            <option value="14"' . (($Lesson == 14) ? ' selected' : '') . '>Ngoài giờ 3 (19:40 - 20:25)</option>
                            <option value="15"' . (($Lesson == 15) ? ' selected' : '') . '>Ngoài giờ 4 (20:30 - 21:15)</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Link phòng học</label>
                        <input value="'.$Link.'" name="link" id="link" type="text" required>
                    </div>
                </div>
                    <div style="text-align: right" class="right-button">
                        <button id="update" class="submit" type="button" style="float: right">Xác nhận</button>
                    </div>    
                </div>
            </form>
        </div>';
    echo $output;
?>
<script>
  $('#update').on('click', function(){
    var array = {
      'online_class_id': $('#online_class_id').val(),
      'lesson_day_id': $('#lesson_day_id').val(),
      'day': $('#day').val(),
      'lesson': $('#lesson').val(),
      'link': $('#link').val(),
    };
    $.ajax({
      url: "manage_online_classes/edit_class.php",
      method: 'post',
      data: {
        arrayData: array
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
                toastr.error("Lỗi");
            });
        }
      }
    })
});
</script>