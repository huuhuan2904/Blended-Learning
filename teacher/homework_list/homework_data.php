<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["assignmentId"])){
        $output = '';
        $DaysAssignment_result = mysqli_query($conn,'SELECT id as dayAssId from days_assignment where assignment_id = '.$_POST["assignmentId"].'');
        $Days_id = array();
        $DaysAssignment_id = array();

        $output .= '
                <table style="text-align: center" class="table">
                    <thead>
                    <tr class="title_style">
                        <th> Học liệu </th>
                        <th> Tiêu đề </th>
                        <th> Nội dung </th>
                        <th> Ngày bắt đầu </th>
                        <th> Ngày kết thúc </th>
                        <th> Giao ngày </th>
                        <th> Thao tác </th>
                    </tr>
                    </thead>';
            foreach($DaysAssignment_result as $row){
                if($row['dayAssId']){
                    $LessonDay_result = mysqli_query($conn,'SELECT id as lessonDayId from lesson_day where days_ass_id = '.$row['dayAssId'].'');
                    foreach($LessonDay_result as $row2){
                        if($row2['lessonDayId']){
                            $Homework_result = mysqli_query($conn,'SELECT * from homework where lesson_day_id  = '.$row2['lessonDayId'].'');
                            foreach($Homework_result as $row3){
                                $output .='
                                <tbody>
                                    <tr>
                                        <td>'.$row3['type'].'</td>
                                        <td>'.$row3['title'].'</td>
                                        <td>'.$row3['content'].'</td>';
                                        if($row3['start_date'] == '0000-00-00'){
                                            $output .='
                                                <td></td>
                                                <td></td>';
                                        }else{
                                            $output .='       
                                                <td>'.$row3['start_date'].'</td>
                                                <td>'.$row3['end_date'].'</td>';
                                        }
                                        $output .='
                                        <td>'.$row3['homework_day'].'</td>
                                        
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle-split" type="button" data-bs-toggle="dropdown">
                                                    <i class="fa-solid fa-gear"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a><button type="button" class="dropdown-item" onclick="editHomework('.$row3['id'].')"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
                                                    <a><button type="button" class="dropdown-item" onclick="deleteHomework('.$row3['id'].')"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                                                    <a>
                                                        <form action="index.php?page=homework_details" method="POST">
                                                            <input type="hidden" name="homeworkId" id="homeworkId" value="'.$row3['id'].'">
                                                            <input type="hidden" name="classId" id="classId" value="'.$_POST["classId"].'">
                                                            <button type="submit" class="dropdown-item"><i class="fa-solid fa-magnifying-glass"></i> Chi tiết</button>
                                                        </form>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>';
                            }
                        }
                    }
                }
            }
        $output .=' </table>';
        echo $output;
    }
?>
<script>
    function editHomework(id) {
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


