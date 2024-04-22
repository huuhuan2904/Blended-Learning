<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

//join 2 bảng với 2 khóa ngoại trong 1 bảng chính
// $query = "SELECT class_students.*, class.name, teachers.name, students.last_name, students.first_name
// FROM class_students
// JOIN class ON class_students.class_id = class.id
// JOIN teachers ON class_students.teacher_id = teachers.id
// JOIN students ON class_students.student_id = students.id;";

$query = "select class_students.*, class.*, students.*, class_students.id as class_student_id from class_students 
join class on class_students.class_id = class.id
join students on class_students.student_id = students.id";
$result = mysqli_query($conn,$query);
$search = '';

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
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="contact_nav">
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                                Email : admin@gmail.com
                            </span>
                        </a>
                        <!-- <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +01 123455678990
              </span>
            </a> -->
                    </div>
                </div>
            </div>
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container ">
                        <a class="navbar-brand" href="../home_page.php">
                            <span>
                                THPT Vĩnh Lộc
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>
                        <form style="padding-left: 100px;" method="GET">
                            <div class="input-field">
                                <input style="width: 40em;" name="search" type="text" placeholder="Tìm kiếm..."
                                    value="<?php if(isset($search)){echo $search;}?>">
                                <button style="margin-right: 40px" class="btn btn-outline-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ">
                                <li class="nav-item">
                                    <a class="nav-link" href="../teacher/teacher_management.php">Giáo viên</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../student/student_management.php">Học sinh</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="class_management.php">Lớp học <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../assignment/teaching_assignment.php">Phân công giảng dạy</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
    </div>

    <!-- service section -->
    <section class="service_section layout_padding">
        <div class="container ">
            <form action="add_student.php" method="POST">
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

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    </section>

    <!-- end service section -->

    <!-- info section -->
    <section class="info_section ">
        <div class="container">
            <h4>
                Get In Touch
            </h4>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="info_items">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="">
                                    <div class="item ">
                                        <div class="img-box ">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </div>
                                        <p>
                                            Lorem Ipsum is simply dummy text
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="">
                                    <div class="item ">
                                        <div class="img-box ">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <p>
                                            +02 1234567890
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="">
                                    <div class="item ">
                                        <div class="img-box">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <p>
                                            demo@gmail.com
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-box">
            <h4>
                Follow Us
            </h4>
            <div class="box">
                <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>



    <!-- end info_section -->

    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayDateYear"></span> All Rights Reserved By
                <a href="https://html.design/">Free Html Templates</a>
            </p>
        </div>
    </footer>
    <!-- footer section -->

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->


</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>