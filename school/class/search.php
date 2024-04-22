<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    if(isset($_GET['key']) && $_GET['key']!=""){
        $output = '';
        $key=trim($_GET['key']);
        $filter_data = "SELECT DISTINCT class_students.class_id, class_students.teacher_id, class.class_name, teachers.name, teachers.id
                        FROM class_students
                        JOIN class ON class_students.class_id = class.id
                        JOIN teachers ON class_students.teacher_id = teachers.id 
                        where CONCAT(class_name, name) LIKE '%$key%'";
        $query_run = mysqli_query($conn,$filter_data);
        
        $output .='<table style="text-align: center" class="table table-bordered">
                    <tr class="title_style" style="background-color: #007BFF; color: white">
                        <th> Tên lớp </th>
                        <th> Giáo viên chủ nhiệm </th>
                        <th> Học sinh </th>
                    </tr>';
        if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $row)
            {
                $output .= '<tr>
                        <td>'.$row['class_name'].'</td>
                        <td>
                            '.$row['name'].'
                            <button class="teacherDetail btn btn-outline-primary" id="'.$row['id'].'" data-toggle="modal" data-target="#teacherModal">
                                <i class="fa fa-search"></i>
                            </button>
                        </td>
                        <td>
                            <a href="index.php?page=students&ClassId='.$row['class_id'].'&TeacherId='.$row['teacher_id'].'">
                                <button class="btn btn-outline-primary"> 
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </td>
                    </tr>';

            }
          }else{
            $output .= '<tr>
                    <td colspan="4">Không tìm thấy</td>
                </tr>
                </table>';
          }
          $output .= '
                    <div class="modal fade" id="teacherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Thông tin giáo viên chủ nhiệm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- modal body -->
                            <div class="modal-body2">
            
                            </div>
                        </div>
                    </div>
                </div>';
          echo $output;
    }else{
        $output = '';
        if(isset($_GET['key']) && $_GET['key']==''){
            $filter_data = "SELECT DISTINCT class_students.class_id, class_students.teacher_id, class.class_name, teachers.name, teachers.id
                            FROM class_students
                            JOIN class ON class_students.class_id = class.id
                            JOIN teachers ON class_students.teacher_id = teachers.id";
        $query_run = mysqli_query($conn,$filter_data);
        
        $output .='<table style="text-align: center" class="table table-bordered">
                    <tr class="title_style" style="background-color: #007BFF; color: white">
                        <th> Tên lớp </th>
                        <th> Giáo viên chủ nhiệm </th>
                        <th> Học sinh </th>
                    </tr>';
        if(mysqli_num_rows($query_run) > 0){
            foreach($query_run as $row)
            {
                $output .= '<tr>
                        <td>'.$row['class_name'].'</td>
                        <td>
                            '.$row['name'].'
                            <button class="teacherDetail btn btn-outline-primary" id="'.$row['id'].'" data-toggle="modal" data-target="#teacherModal">
                                <i class="fa fa-search"></i>
                            </button>
                        </td>
                        <td>
                            <a href="index.php?page=students&ClassId='.$row['class_id'].'&TeacherId='.$row['teacher_id'].'">
                                <button class="btn btn-outline-primary"> 
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </td>
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
                <div class="modal fade" id="teacherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Thông tin giáo viên chủ nhiệm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- modal body -->
                        <div class="modal-body2">

                        </div>
                    </div>
                </div>
            </div>';
        echo $output;
    }
 
?>
<script>
    $(document).ready(function(){
        $('.teacherDetail').click(function(){
            select = $(this).attr('id'); 
            $.ajax({url:"class/teacher_selection.php",
            method: 'post',
            data:{teacher_id: select},
            success: function(result) {
               $(".modal-body2").html(result);  
            }
            })
        });
    });
</script>
