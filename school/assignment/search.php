<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    if(isset($_GET['key']) && $_GET['key']!=""){
        $output = '';
        $key=trim($_GET['key']);
        $filter_data = "SELECT t.id as teacher_id,
                            t.name as teacher_name,
                            s.name as subject_name,
                            GROUP_CONCAT(c.class_name) as class_name,
                            CASE 
                                WHEN a.teacher_id IS NOT NULL THEN a.subject_id
                                ELSE NULL
                            END AS subject_id,
                            CASE 
                                WHEN a.teacher_id IS NOT NULL THEN a.class_id
                                ELSE NULL
                            END AS class_id
                        FROM teachers t
                        LEFT JOIN assignment a ON t.id = a.teacher_id
                        LEFT JOIN subjects s ON a.subject_id = s.id
                        LEFT JOIN class c ON a.class_id = c.id 
                        where CONCAT(t.name, s.name, c.class_name) LIKE '%$key%'
                        group by t.id";
        $query_run = mysqli_query($conn,$filter_data);
        
        $output .='<table style="text-align: center" class="table table-bordered">
                <tr class="title_style" style="background-color: #007BFF; color: white">
                    <th> Giáo viên </th>
                    <th> Lớp được phân công </th>
                    <th> Môn học </th>
                    <th> Lớp học </th>
                </tr>';
        if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $row)
            {
                $output .= '<tr>
                    <td>'.$row['teacher_name'].'</td>
                    <td>'.$row['class_name'].'</td>
                    <td>'.$row['subject_name'].'</td>
                    <td>';
                        if ($row['subject_name'] > 0) {
                            $output .= '
                            <button class="editAssignment btn btn-secondary" id="'.$row['teacher_id'].'" data-toggle="modal" data-target="#editAssignmentModal">
                            <i class="fa-regular fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-danger" onclick="deleteAssignment('.$row['teacher_id'].')"><i class="fa-solid fa-trash"></i></button>';
                        }
                        else {
                            $output .= '
                            <button class="addAssignment btn btn-success" id="'.$row['teacher_id'].'" data-toggle="modal" data-target="#addAssignmentModal">
                            <i class="fa-solid fa-plus"></i></button>';
                        }
                    $output .= '</td>
                </tr>';
            }
          }else{
            $output .= '<tr>
                    <td colspan="4">Không tìm thấy</td>
                </tr>
                </table>';
          }
        $output .= '
                <div class="modal fade" id="editAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Sửa phân công</h5>
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
            </div>';

        $output .='
            <div class="modal fade" id="addAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Thêm phân công</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- modal body -->
                    <div class="modal-body">
                        <div style="padding: 60px">

                        </div>
                    </div>
                </div>
            </div>
        </div>';
          echo $output;
    }else{
        $output = '';
        if(isset($_GET['key']) && $_GET['key']==''){
            $filter_data = "SELECT t.id as teacher_id,
                                t.name as teacher_name,
                                s.name as subject_name,
                                GROUP_CONCAT(c.class_name) as class_name,
                                CASE 
                                    WHEN a.teacher_id IS NOT NULL THEN a.subject_id
                                    ELSE NULL
                                END AS subject_id,
                                CASE 
                                    WHEN a.teacher_id IS NOT NULL THEN a.class_id
                                    ELSE NULL
                                END AS class_id
                            FROM teachers t
                            LEFT JOIN assignment a ON t.id = a.teacher_id
                            LEFT JOIN subjects s ON a.subject_id = s.id
                            LEFT JOIN class c ON a.class_id = c.id 
                            group by t.id";
            $query_run = mysqli_query($conn,$filter_data);
            
            $output .='<table style="text-align: center" class="table table-bordered">
            <tr class="title_style" style="background-color: #007BFF; color: white">
                <th> Giáo viên </th>
                <th> Lớp được phân công </th>
                <th> Môn học </th>
                <th> Lớp học </th>
            </tr>';
            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $row)
                {
                    $output .= '<tr>
                        <td>'.$row['teacher_name'].'</td>
                        <td>'.$row['class_name'].'</td>
                        <td>'.$row['subject_name'].'</td>
                        <td>';
                            if ($row['subject_name'] > 0) {
                                $output .= '
                                <button class="editAssignment btn btn-secondary" id="'.$row['teacher_id'].'" data-toggle="modal" data-target="#editAssignmentModal">
                                <i class="fa-regular fa-pen-to-square"></i></button>
                                <button type="button" class="btn btn-danger" onclick="deleteAssignment('.$row['teacher_id'].')"><i class="fa-solid fa-trash"></i></button>';
                            }
                            else {
                                $output .= '
                                <button class="addAssignment btn btn-success" id="'.$row['teacher_id'].'" data-toggle="modal" data-target="#addAssignmentModal">
                                <i class="fa-solid fa-plus"></i></button>';
                            }
                        $output .= '</td>
                    </tr>';
                }
            }else{
                $output .= '<tr>
                        <td colspan="4">Không tìm thấy</td>
                    </tr>
                    </table>';
            }
        }
        $output .= '
                <div class="modal fade" id="editAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Sửa phân công</h5>
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
            </div>';

        $output .='
                <div class="modal fade" id="addAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Thêm phân công</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- modal body -->
                        <div class="modal-body">
                            <div style="padding: 60px">

                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }
 
?>
<script>
    $(document).ready(function(){
        $('.editAssignment').click(function(){
            select = $(this).attr('id'); 
            $.ajax({url:"assignment/edit_assignment_modal.php",
            method: 'POST',
            data:{teacher_id: select},
            success: function(result) {
               $(".modal-body2").html(result);  
            }
            })
        });
    });
</script>
<script>
$(document).ready(function() {
    $('.addAssignment').click(function() {
        select = $(this).attr('id');
        $.ajax({
            url: "assignment/add_assignment_modal.php",
            method: 'post',
            data: {
                teacher_id: select
            },
            success: function(result) {
                $(".modal-body").html(result);
            }
        })
    });
});
</script>
