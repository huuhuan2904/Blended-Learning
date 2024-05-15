<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$query = "  SELECT teachers.*, logins.* , teachers.id as teachers_id 
            from teachers join logins on teachers.login_id = logins.id";
$result = mysqli_query($conn,$query);

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
    <!-- service section -->

        <?php
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                echo '<p style="color: red; text-align: center; font-size: 30px">'.$msg.'</p>';
            }
        ?>
        <div class="input-field" style="text-align: right;">
            <input class="search" style="width: 20em;" name="search" type="text" placeholder="Tìm kiếm...">
            <button style="margin-right: 40px" id="searchBtn" class="btn btn-outline-primary" type="submit">
                <i class="fa fa-search"></i>
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Thêm giáo viên</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div style="max-width: 800px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Thông tin giáo viên</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- modal body -->
                    <div class="modal-body">
                        <div class="container ">
                            <form action="teacher/register_teacher.php" method="POST">
                                <div class="form first">
                                    <div class="fields">
                                        <div class="input-field">
                                            <label>Họ và tên</label>
                                            <input name="name" id="name" type="text" placeholder="Nhập họ tên" required>
                                        </div>
                                        <div class="input-field">
                                            <label>Sinh ngày</label>
                                            <input name="dob" id="dob" type="date" placeholder="Ngày/tháng/năm"
                                                required>
                                        </div>
                                        <div class="input-field">
                                            <label>Giới tính</label>
                                            <select name="gender" id="gender" required>
                                                <option disabled selected>Chọn giới tính</option>
                                                <option>Nam</option>
                                                <option>Nữ</option>
                                            </select>
                                        </div>
                                        <div class="input-field">
                                            <label>Địa chỉ</label>
                                            <input name="address" id="adddres" type="text" placeholder="Nhập địa chỉ"
                                                required>
                                        </div>
                                        <div class="input-field">
                                            <label>Số điện thoại</label>
                                            <input name="phone" id="phone" type="number"
                                                placeholder="Nhập số điện thoại" required>
                                        </div>
                                        <div class="input-field">
                                            <label>Tài khoản</label>
                                            <input name="email" id="email" type="text" placeholder="Nhập email"
                                                required>
                                        </div>
                                        <div class="input-field">
                                            <label>Mật khẩu</label>
                                            <input name="password" id="password" type="text" placeholder="Nhập mật khẩu"
                                                required>
                                        </div>
                                        <div class="input-field">
                                            <label>Vai trò</label>
                                            <select name="role" id="role" required>
                                                <option disabled selected>Chọn vai trò</option>
                                                <option value="1">Học sinh</option>
                                                <option value="2">Giáo viên</option>
                                            </select>
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
      <div class="table_data">
        <table style="text-align: center" class="table table-bordered">
            <tr class="title_style" style="background-color: #007BFF; color: white">
                <th> Họ tên </th>
                <th> Ngày sinh </th>
                <th> Giới tính </th>
                <th> Địa chỉ </th>
                <th> Số điện thoại </th>
                <th> Email </th>
                <th> Sửa </th>
                <th> Xóa </th>
            </tr>
            <?php 
                $filter_data = "Select teachers.*, logins.* , teachers.id as teachers_id from teachers join logins on teachers.login_id = logins.id";
                $query_run = mysqli_query($conn,$filter_data);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row)
                  {
                    ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo date('d-m-Y', strtotime($row['dob'])) ?></td>
                            <td><?php echo $row['gender'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <input class="teacher_id" value="<?php echo $row['teachers_id'] ?>" name="teachers_id" id="id"
                                type="hidden">
                            <td>
                                <button type="button" class="btn btn-secondary" onclick="location.href='index.php?page=edit&Id=<?php echo $row['teachers_id'] ?>'">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" onclick="deleteTeacher(<?php echo $row['teachers_id'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php
                  }
                }
            ?>
        </table>
      </div>

</body>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteTeacher(teacherId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "teacher/delete_teacher.php",
                type: 'POST',
                data: {
                    teacher_id: teacherId,
                },
                success: function(data) {
                    console.log(data);
                    //sau khi success thì tự trả từ url trên về biến data
                    if (data == 1) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        }).then((result) => {
                            url = "./index.php?page=teacher_management";
                            window.location.href = url;
                        });

                    }
                }
            })
        }
    });
}
</script>

<script>
    $(document).ready(function(){
        $('#searchBtn').click(function(){
            $.ajax({url:"teacher/search.php",
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