<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$id = $_GET['Id'];
$query = "select students.*, logins.* , students.id as students_id from students join logins on students.login_id = logins.id where students.id = '$id'";
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

<body>
        <div class="container ">
          <form action="student/update_student.php" method="POST">
            <?php 
                foreach($result as $row){
            ?>
            <input value="<?php echo $row['students_id'] ?>" name="students_id" id="id" type="hidden">
            <input value="<?php echo $row['login_id'] ?>" name="login_id" id="id" type="hidden">
            <div class="form first">
                <div class="fields">
                    <div class="input-field">
                        <label>Họ và tên đệm</label>
                        <input value="<?php echo $row['last_name'] ?>" name="last-name" id="last-name" type="text" placeholder="Nhập họ và tên dệm" required>
                    </div>
                    <div class="input-field">
                        <label>Tên</label>
                        <input value="<?php echo $row['first_name'] ?>" name="first-name" id="first-name" type="text" placeholder="Nhập tên" required>
                    </div>
                    <div class="input-field">
                        <label>Sinh ngày</label>
                        <input value="<?php echo date("Y-m-d", strtotime($row['dob'])) ?>" name="dob" id="dob" type="date" required>
                    </div>
                    <div class="input-field">
                        <label>Giới tính</label>
                        <select name="gender" id="gender" required>
                            <option disabled>Chọn giới tính</option>
                            <option value='Nam' <?php if($row ["gender"] == 'Nam')?> selected >Nam</option>
                            <option value='Nữ'>Nữ</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Địa chỉ</label>
                        <input value="<?php echo $row['address'] ?>" name="address" id="gender" type="text" placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="input-field">
                        <label>Số điện thoại</label>
                        <input value="<?php echo $row['phone'] ?>" name="phone" id="phone" type="number" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="input-field">
                        <label>Dân tộc</label>
                        <input value="<?php echo $row['nation'] ?>" name="nation" id="nation" type="text" placeholder="Nhập dân tộc" required>
                    </div>
                    <div class="input-field">
                        <label>Tài khoản</label>
                        <input value="<?php echo $row['email'] ?>" name="email" id="email" type="text" placeholder="Nhập email" required>
                    </div>
                    <div class="input-field">
                        <label>Mật khẩu</label>
                        <input value="<?php echo $row['password'] ?>" name="password" id="password" type="text" placeholder="Nhập mật khẩu" required>
                    </div>
                </div>
                <div style="text-align: right" class="right-button">
                  <button  id="submit" class="submit" style="color: #265df2;background-color: white;border-style: solid;border-color: #265df2;" 
                      onclick="location.href='index.php?page=student_management'"><i class="fa-solid fa-arrow-left"></i></button>
                  <button id="submit" class="submit"><i class="fa-solid fa-check"></i></button>
                </div>
            </div>
            <?php }?>
        </form>
      </div>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</body>

</html>