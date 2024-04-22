<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$query = "select class_students.*, class.*, students.*, class_students.id as class_student_id from class_students 
join class on class_students.class_id = class.id
join students on class_students.student_id = students.id";
$result = mysqli_query($conn,$query);

$resultClass = mysqli_query($conn,'select id, class_name from class');
$resultClassId = mysqli_query($conn,'select class_id, teacher_id, student_id from class_students');
$resultTeacher = mysqli_query($conn,'select * from teachers');
$array = [];
$teacherArray = [];
$studentArray = [];
foreach($resultClassId as $row){
  $array[$row['class_id']] = [
    'id' => $row['class_id'],
  ];
  $teacherArray[$row['teacher_id']] = [
    'id' => $row['teacher_id'],
  ];
  $studentArray[$row['student_id']] = [
    'id' => $row['student_id'],
  ];
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Quản trị nhà trường</title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome style -->
    <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />

    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />

</head>

<body>
        <div class="input-field" style="text-align: right;">
            <input class="search" style="width: 20em;" name="search" type="text" placeholder="Tìm kiếm...">
            <button style="margin-right: 40px" id="searchBtn" class="btn btn-outline-primary" type="submit">
                <i class="fa fa-search"></i>
            </button>
            <button type="button" id="addClass" class="btn btn-success" data-toggle="modal" data-target="#myModal">Thêm lớp học</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStudentModal">Thêm học sinh</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div style="max-width: 800px; 
                width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Thông tin lớp học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- modal body -->
                    <div class="modal-body">
                        <div class="container ">
                            <form action="class/create_class.php" method="POST">
                                <div class="form first">
                                    <div class="fields">
                                        <div class="input-field">
                                            <label>Tên lớp học</label>
                                            <input name="class_name" id="class_name" type="text" placeholder="VD: 12A3" required>
                                        </div>
                                        <div class="input-field" style="display:hidden">
                                            <div style="text-align: right" class="right-button">
                                                <button id="submit" class="submit">Xác nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div style="max-width: 1000px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Học sinh</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- modal body -->
                    <div class="modal-body">
                    <div class="container ">
                        <form action="class/add_student.php" method="POST">
                            <div class="form first">
                                <div class="fields">
                                    <div class="input-field">
                                        <label>Lớp học hiện có</label>
                                        <select name="class_id" id="class_id">
                                            <option disabled selected>Chọn lớp</option>
                                            <?php
                                            foreach($resultClass as $rowClass){?>
                                            <?php if($rowClass['id'] != $array[$rowClass['id']]['id']){
                                                echo "<option 
                                                value='".$rowClass['id']."'>".$rowClass['class_name']."
                                                </option>";
                                                }
                                            ?>
                                            <?php
                                            }  
                                        ?>
                                        </select>
                                    </div>
                                    <div class="input-field">
                                        <label>Giáo viên chủ nhiệm</label>
                                        <select name="teacher_id" id="teacher_id">
                                            <option disabled selected>Chọn giáo viên</option>
                                            <?php
                                            foreach($resultTeacher as $rowTeacher){?>
                                            <?php if($rowTeacher['id'] != $teacherArray[$rowTeacher['id']]['id']){
                                                echo "<option 
                                                value='".$rowTeacher['id']."'>".$rowTeacher['name']."
                                                </option>";
                                                }
                                            ?>
                                            <?php
                                            }  
                                        ?>
                                        </select>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col m-auto">
                                                <div class="card mt-5">
                                                    <table class="table table-bordered">
                                                        <tr class="title_style" style="background-color: #007BFF; color: white">
                                                            <th></th>
                                                            <th> Họ và tên đệm </th>
                                                            <th> Tên </th>
                                                            <th> Ngày sinh </th>
                                                            <th> Giới tính </th>
                                                            <th> Địa chỉ </th>
                                                            <th> Số điện thoại </th>
                                                            <th> Dân tộc </th>
                                                        </tr>
                                                        <?php 
                                            if(isset($_GET['search']) && $_GET['search'] != ''){
                                                $search = $_GET['search'];
                                            }
                                            if(!empty($search) && $search != '') {
                                                $filter_value = $search;
                                                $filter_data = "Select * from students 
                                                where CONCAT(last_name, first_name, dob, gender, address, phone, nation) LIKE '%$filter_value%'";
                                                }else{
                                                $filter_data = "Select * from students order by first_name";
                                                }
                                                $query_run = mysqli_query($conn,$filter_data);

                                                if(mysqli_num_rows($query_run) > 0){
                                                foreach($query_run as $row)
                                                {
                                                    if(empty($studentArray[$row['id']]['id'])){?>
                                                        <tr>
                                                            <td><input type="checkbox" name="checkbox<?php echo $row['id'] ?>" id="checkboxSelect"
                                                                    value="<?php echo $row['id'] ?>"></td>
                                                            <td><?php echo $row['last_name'] ?></td>
                                                            <td><?php echo $row['first_name'] ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row['dob'])) ?></td>
                                                            <td><?php echo $row['gender'] ?></td>
                                                            <td><?php echo $row['address'] ?></td>
                                                            <td><?php echo $row['phone'] ?></td>
                                                            <td><?php echo $row['nation'] ?></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                }
                                                }else{?>
                                                <tr><td colspan="4">Không tìm thấy</td></tr>
                                                <?php
                                            }
                                            ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-field" style="display:hidden">
                                        <div style="text-align: right" class="right-button">
                                            <button id="submit" class="submit">Xác nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- data table -->
                    <div  class="table_data">
                        <table style="text-align: center" class="table table-bordered">
                            <tr class="title_style" style="background-color: #007BFF; color: white">
                                <th> Tên lớp </th>
                                <th> Giáo viên chủ nhiệm </th>
                                <th> Học sinh </th>
                            </tr>
                            <?php 
                $filter_data = "SELECT DISTINCT class_students.class_id, class_students.teacher_id, class.class_name, teachers.name, teachers.id
                                  FROM class_students
                                  JOIN class ON class_students.class_id = class.id
                                  JOIN teachers ON class_students.teacher_id = teachers.id";
                $query_run = mysqli_query($conn,$filter_data);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row)
                  {
                    ?>
                        <tr>
                            <td><?php echo $row['class_name'] ?></td>
                            <td>
                                <?php echo $row['name'] ?>
                                <!-- truyền teacher id vào modal  -->
                                <button class="teacherDetail btn btn-outline-primary" id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#teacherModal">
                                    <i class="fa fa-search"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-outline-primary" 
                                onclick="location.href='index.php?page=students&ClassId=<?php echo $row['class_id']?>&TeacherId=<?php echo $row['teacher_id']?>'">
                                    <i class="fa fa-search"></i></a>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                  ?>    
                    <tr>
                        <td colspan="4">Không tìm thấy</td>
                    </tr>
                <?php
                }
            ?>
                        </table>

        <!-- Modal -->
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
        </div>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<script>
    $(document).ready(function(){
        $('#searchBtn').click(function(){
            $.ajax({url:"class/search.php",
            method: 'get',
            data:{key:$(".search").val()},
            success: function(result) {
               $(".table_data").html(result);  
            }
            })
        });
    });
</script>
</html>