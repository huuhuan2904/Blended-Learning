<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
$id = $_GET['Id'];
$query = "select teachers.*, logins.* , teachers.id as teachers_id from teachers join logins on teachers.login_id = logins.id where teachers.id = '$id'";
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
  <!-- service section -->

        <div class="container ">
          <form action="teacher/update_teacher.php" method="POST">
            <?php 
                foreach($result as $row){
            ?>
            <input value="<?php echo $row['teachers_id'] ?>" name="teachers_id" id="id" type="hidden">
            <input value="<?php echo $row['login_id'] ?>" name="login_id" id="id" type="hidden">
            <div class="form first">
                <div class="fields">
                    <div class="input-field">
                        <label>Họ và tên</label>
                        <input value="<?php echo $row['name'] ?>" name="name" id="name" type="text" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="input-field">
                        <label>Sinh ngày</label>
                        <input value="<?php echo date("Y-m-d", strtotime($row['dob'])) ?>" name="dob" id="dob" type="date" required>
                    </div>
                    <div class="input-field">
                        <label>Giới tính</label>
                        <select name="gender" id="gender" required>
                            <option disabled>Chọn giới tính</option>
                            <option value='Nam' <?php if($row["gender"] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value='Nữ' <?php if($row["gender"] == 'Nữ') echo 'selected'; ?>>Nữ</option>
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
                    onclick="location.href='index.php?page=teaching_management'">
                        <i class="fa-solid fa-arrow-left"></i></button>
                    <button id="submit" class="submit"><i class="fa-solid fa-check"></i></button>
                </div>
            </div>
            <?php }?>
        </form>
      </div>



</body>

</html>