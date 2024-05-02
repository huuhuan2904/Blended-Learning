<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["class_id"])){
        $output = '';
        $Online_class_result = mysqli_query($conn,' SELECT * , online_class.id as online_id, lessons.name as lesson_name
                                        FROM online_class
                                        JOIN lesson_day ON online_class.lesson_day_id = lesson_day.id
                                        JOIN lessons ON lesson_day.lesson_id = lessons.id
                                        JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                        JOIN days ON days_assignment.day = days.id
                                        JOIN assignment ON days_assignment.assignment_id = assignment.id
                                        JOIN class ON assignment.class_id = class.id
                                        WHERE days_assignment.assignment_id = '.$_POST["class_id"].'');
        $Days_id = array();
        $DaysAssignment_id = array();

        $output .= '
        <div class="table_data" style="padding-top: 30px;>
            <form action="calendar/create_schedule.php" method="POST">
                <table style="text-align: center" class="table table-bordered">
                    <tr class="title_style" style="background-color: black; color: white">
                        <th> Lớp </th>
                        <th> Thứ </th>
                        <th> Tiết </th>
                        <th> Link phòng </th>
                        <th colspan="2"> Thao tác </th>
                    </tr>';
            foreach($Online_class_result as $row){
                $output .='
                <tr>
                    <td>'.$row['class_name'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['lesson_name'].'</td>
                    <td><a href="'.$row['link'].'" target="blank">'.$row['link'].'</a></td>
                    <td><button type="button" class="btn btn-secondary" onclick="editOnlineClass('.$row['online_id'].','.$row['lesson_day_id'].')"><i class="fa-solid fa-pen-to-square"></i></button></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteOnlineClass('.$row['online_id'].')"><i class="fa-solid fa-trash"></i></button></td>
                </tr>';
            }
        $output .=' </table>
                </form>
            <div/>';
        echo $output;
    }
?>
<script>
    function editOnlineClass(onlineId,lessonDayId) {
        $.ajax({
            url: "manage_online_classes/edit_class_modal.php",
            method: 'post',
            data: {
                online_id: onlineId,
                lessonDay_id: lessonDayId,
            },
            success: function(result) {
                $(".modal-body2").html(result);
                $('#editHomeworkModal').modal('show'); 
            }
        })
    }
</script>
<script>
function deleteOnlineClass(onlineId) {
    $.ajax({
        url: "manage_online_classes/delete_class.php",
        method: 'post',
        data: {
            online_id: onlineId
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
    });
}
</script>


