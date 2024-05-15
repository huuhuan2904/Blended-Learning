<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$query = "SELECT students.*, logins.* , students.id as students_id 
          from students join logins on students.login_id = logins.id";
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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
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
<style>
        .table_data {
            width: 100%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 8px;
            text-align: center;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #333;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
    </style>
<body>
    <?php
      if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        echo '<p style="color: red; text-align: center; font-size: 30px">'.$msg.'</p>';
      }
    ?>
        <div class="input-field" style="text-align: right;">
          <input class="search" style="width: 20em;" name="search" type="text" placeholder="Tìm kiếm..." >
          <button id="searchBtn" style="margin-right: 40px" class="btn btn-outline-primary" type="submit">
            <i class="fa fa-search"></i>
          </button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Thêm học sinh</button>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div style="max-width: 800px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Thông tin học sinh</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- modal body -->
      <div class="modal-body">
        <div class="container ">
          <form action="student/register_student.php" method="POST">
            <div class="form first">
                <div class="fields">
                    <div class="input-field">
                        <label>Họ và tên đệm</label>
                        <input name="last-name" id="last-name" type="text" placeholder="Nhập họ tên đệm" required>
                    </div>
                    <div class="input-field">
                        <label>Tên</label>
                        <input name="first-name" id="first-name" type="text" placeholder="Nhập tên" required>
                    </div>
                    <div class="input-field">
                        <label>Sinh ngày</label>
                        <input name="dob" id="dob" type="date" placeholder="Ngày/tháng/năm" required>
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
                        <input name="address" id="gender" type="text" placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="input-field">
                        <label>Số điện thoại</label>
                        <input name="phone" id="phone" type="number" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="input-field">
                        <label>Dân tộc</label>
                        <input name="nation" id="nation" type="text" placeholder="Nhập dân tộc" required>
                    </div>
                    <div class="input-field">
                        <label>Tài khoản</label>
                        <input name="email" id="email" type="text" placeholder="Nhập email" required>
                    </div>
                    <div class="input-field">
                        <label>Mật khẩu</label>
                        <input name="password" id="password" type="text" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="input-field">
                        <label>Vai trò</label>
                        <select name="role" id="role" required>
                            <option disabled selected>Chọn vai trò</option>
                            <option value ="1">Học sinh</option>
                            <option value ="2">Giáo viên</option>
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
            <th> Họ và tên đệm </th>
            <th> Tên </th>
            <th> Ngày sinh </th>
            <th> Giới tính </th>
            <th> Địa chỉ </th>
            <th> Số điện thoại </th>
            <th> Dân tộc </th>
            <th> Email </th>
            <th> Sửa  </th>
            <th> Xóa </th>
          </tr>
            <?php 
                $limit = 10; // Số bản ghi trên mỗi trang
                $page = isset($_GET['pagination']) && is_numeric($_GET['pagination']) ? (int)$_GET['pagination'] : 1;
                $page = max($page, 1); // Đảm bảo $page >= 1
                $start = ($page - 1) * $limit;
                
                $result = $conn->query("SELECT COUNT(*) AS total FROM students");
                $total_records = $result->fetch_assoc()['total'];
                $total_pages = ceil($total_records / $limit);

                $filter_data = "SELECT students.*, logins.* , students.id as students_id from students 
                                join logins on students.login_id = logins.id
                                ORDER BY students.first_name COLLATE utf8mb4_unicode_ci
                                LIMIT $start, $limit";
                $query_run = mysqli_query($conn,$filter_data);

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
                        <input class="student_id" value="<?php echo $row['students_id'] ?>" name="students_id" id="id" type="hidden">
                        <td>
                          <button type="button" class="btn btn-secondary" onclick="location.href='index.php?page=edit_student&Id=<?php echo $row['students_id'] ?>'">
                              <i class="fa-regular fa-pen-to-square"></i>
                          </button>
                          </td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteStudent(<?php echo $row['students_id'] ?>)"><i class="fa-solid fa-trash"></i></button></td>
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
        <div class="pagination">
          <?php if($page > 1): ?>
              <a href="index.php?page=student_management&pagination=<?php echo $page-1; ?>">&laquo; Trước</a>
          <?php endif; ?>

          <?php for($i = 1; $i <= $total_pages; $i++): ?>
              <a class="<?php if($page == $i) echo 'active'; ?>" href="index.php?page=student_management&pagination=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php endfor; ?>

          <?php if($page < $total_pages): ?>
              <a href="index.php?page=student_management&pagination=<?php echo $page+1; ?>">Sau &raquo;</a>
          <?php endif; ?>
        </div>
      </div>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function deleteStudent(studentId) {
        Swal.fire(
          {
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: "student/delete_student.php",
                    type: 'POST',
                    data:{
                        student_id: studentId,
                    },
                success: function(data){
                    console.log(data);
                    //sau khi success thì tự trả từ url trên về biến data
                    if (data == 1) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                        }).then((result) => {
                            url = "./index.php?page=student_management";
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
            $.ajax({url:"student/search.php",
            method: 'get',
            data:{key:$(".search").val()},
            success: function(result) {
              if(result == 1){
                window.location.href = "./index.php?page=student_management";
              }else{
                $(".table_data").html(result);  
              }
            }
            })
        });
    });
</script>
</html>
