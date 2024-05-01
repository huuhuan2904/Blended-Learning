<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["class_id"])){
        $output = '';
        $DaysAssignment_result = mysqli_query($conn,'SELECT id as dayAssId from days_assignment where assignment_id = '.$_POST["class_id"].'');
        $Days_id = array();
        $DaysAssignment_id = array();

        $output .= '
        <div class="table_data" style="padding-top: 30px;>
            <form action="calendar/create_schedule.php" method="POST">
                <table style="text-align: center" class="table table-bordered">
                    <tr class="title_style" style="background-color: black; color: white">
                        <th> Học liệu </th>
                        <th> Tiêu đề </th>
                        <th> Nội dung </th>
                        <th> Ngày bắt đầu </th>
                        <th> Ngày kết thúc </th>
                        <th> Ngày giao </th>
                        <th colspan="2"> Thao tác </th>
                    </tr>';
            foreach($DaysAssignment_result as $row){
                if($row['dayAssId']){
                    $LessonDay_result = mysqli_query($conn,'SELECT id as lessonDayId from lesson_day where days_ass_id = '.$row['dayAssId'].'');
                    foreach($LessonDay_result as $row2){
                        if($row2['lessonDayId']){
                            $Homework_result = mysqli_query($conn,'SELECT * from homework where lesson_day_id  = '.$row2['lessonDayId'].'');
                            foreach($Homework_result as $row3){
                                $output .='
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
                                        <td><button type="button" class="btn btn-secondary" onclick="editHomework('.$row3['id'].')"><i class="fa-solid fa-pen-to-square"></i></button></td>
                                        <td><button type="button" class="btn btn-danger" onclick="deleteHomework('.$row3['id'].')"><i class="fa-solid fa-trash"></i></button></td>
                                    </tr>';
                            }
                        }
                    }
                }
            }
        $output .=' </table>
                </form>
            <div/>';
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


