<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Class_id = $_GET['ClassId'];
$Teacher_id = $_GET['TeacherId'];

$class_name = '';
$teacher_name = '';

$class_query = mysqli_query($conn, "SELECT class_name from class where id = $Class_id");
while($rowData = mysqli_fetch_array($class_query)){
    $class_name = $rowData["class_name"];
}
$teacher_query = mysqli_query($conn, "SELECT name from teachers where id = $Teacher_id");
while($rowData = mysqli_fetch_array($teacher_query)){
    $teacher_name = $rowData["name"];
}

$search = '';
//lọc học sinh chưa có lớp
$resultClassId = mysqli_query($conn,'select class_id, teacher_id, student_id from class_students');
$studentArray = [];
foreach($resultClassId as $row){
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
        <form style="text-align: right; padding-bottom: 10px" method="POST" action="students.php?ClassId=<?php echo $Class_id ?>&TeacherId=<?php echo $Teacher_id ?>">
            <div class="input-field">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStudentModal"><i class="fa-solid fa-user-plus"></i></button>
            </div>
        </form>

        <!-- Modal -->
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
                                            <label>Tên lớp học</label>
                                            <input type="text" placeholder="<?php echo $class_name?>" readonly>
                                            <input type="hidden" name="class_id" id="class_id" value="<?php echo $Class_id; ?>">
                                        </div>
                                        <div class="input-field">
                                            <label>Tên giáo viên</label>
                                            <input  type="text" placeholder="<?php echo $teacher_name?>" readonly>
                                            <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $Teacher_id; ?>">
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
                    <table class="table table-bordered" id="myTable">
                    <thead>
                    <tr class="title_style" style="background-color: #007BFF; color: white">
                        <th> Họ và tên đệm </th>
                        <th> Tên </th>
                        <th> Ngày sinh </th>
                        <th> Giới tính </th>
                        <th> Địa chỉ </th>
                        <th> Số điện thoại </th>
                        <th> Dân tộc </th>
                        <th> Email </th>
                        <th> Xóa </th>
                    </tr>
                    </thead>
                        <tbody>
                        <?php 
                        if(isset($_POST['search']) && $_POST['search'] != ''){
                            $search = $_POST['search'];
                            // echo $search;
                            // die();
                        }
                        if(!empty($search) && $search != '') {
                            $filter_value = $search;
                            $filter_data = "SELECT students.*, class_students.*, logins.* from class_students 
                                join students on class_students.student_id = students.id 
                                join logins on students.login_id = logins.id
                                where class_students.class_id = $Class_id AND CONCAT(last_name, first_name, dob, gender, address, phone, nation, email) LIKE '%$filter_value%'";
                            }else{
                            $filter_data = "SELECT students.*, class_students.*, logins.*, students.id as students_id from class_students 
                                join students on class_students.student_id = students.id
                                join logins on students.login_id = logins.id
                                where class_students.class_id = $Class_id";
                            }
                            $query_run = mysqli_query($conn, $filter_data);

                            if(mysqli_num_rows($query_run) > 0){
                            foreach($query_run as $row)
                            {
                                ?>
                                <tr>
                                    <td><?php echo $row['last_name'] ?></td>
                                    <td><?php echo $row['first_name'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['dob'])) ?></td>
                                    <td><?php echo $row['gender'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['nation'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><button type="button" class="btn btn-danger" onclick="deleteStudent(<?php echo $row['students_id'] ?>)"><i class="fa-solid fa-user-minus"></i></button></td>
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
                        </tbody>                                                              
                    </table>
                    <div style="text-align: right">
                        <button  id="submit" class="submit" style="color: #265df2;background-color: white;border-style: solid;border-color: #265df2;" 
                            onclick="location.href='index.php?page=class_management'">
                                <i class="fa-solid fa-arrow-left"></i></button>
                    </div>
                    

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function deleteStudent(studentId){
    Swal.fire(
      {
        title: "Bạn có chắc chắn muốn xóa?",
        text: "Dữ liệu sẽ không được khôi phục",
        icon: "warning",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa"
      }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
            type: "POST", 
            url: "class/delete_student.php", 
            data: {
                student_id: studentId,
                class_id: $('#class_id').val(),
                teacher_id: $('#teacher_id').val(),
            },
            success: function(data){
                console.log(123,JSON.parse(data).class_id);
                //sau khi success thì tự trả từ url trên về biến data
                if (JSON.parse(data).data == 1) {
                Swal.fire({
                    title: "Xóa thành công",
                    text: "Dữ liệu đã được xóa",
                    icon: "success"
                    });
                    url = "index.php?page=students&ClassId="+JSON.parse(data).class_id+"&TeacherId="+JSON.parse(data).teacher_id;
                    window.location.href = url;
                }
            }
            }) 
        }
    });}
 </script>
</html>