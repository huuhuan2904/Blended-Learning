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
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
  <!-- font awesome style -->
  <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="./css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="./css/responsive.css" rel="stylesheet" />
  
</head>

<body>
  <div class="hero_area" style="  background-color: #CC3300;">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top" style="background-color: #e4eefd">
        <div class="container-fluid">
          <div style="text-align: center; padding-top: 25px; padding-bottom: 25px;">
          <a href="./home_page.php"><img src="./images/logoschool.png" width="700" height="140" alt="" /></a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div id="navbarSupportedContent" style="margin:0 auto;">
              <ul class="navbar-nav ">
                <li class="nav-item">
                  <a class="nav-link" style="color: white;" href="./teacher/teacher_management.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="color: white;"href="./student/student_management.php">Giới thiệu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="color: white;"href="./class/class_management.php">Đào tạo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="color: white;"href="./assignment/teaching_assignment.php">Liên hệ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" style="color: white;"href="./assignment/teaching_assignment.php">Tuyển sinh</a>
                </li>
              </ul>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                  <input type="radio" name="options" id="option1" autocomplete="off" checked> Active
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="options" id="option2" autocomplete="off"> Radio
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="options" id="option3" autocomplete="off"> Radio
                </label>
              </div>
              <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Sony</button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Tablet</a></li>
                    <li><a href="#">Smartphone</a></li>
                  </ul>
              </div>
              <a href="./teacher/authenticate/login_page.php"><button type="button" class="btn btn-success">Đăng nhập</button></a>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <div style="text-align: center;">
      <img src="./images/imageschoolfinal.png" alt="School" >
  </div>

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container ">
      <!-- <div class="heading_container heading_center">
        <h2> Quản trị nhà trường </h2>
      </div> -->
      <div class="row">
        <div class="col-sm-6 col-md-3 mx-auto">
          <a href="./teacher/teacher_management.php" style="color: black;">
            <div class="box ">
              <div class="img-box">
                <img src="./images/s1.png" alt="" />
              </div>
              <div class="detail-box">
                <h5>
                  Quản lý giáo viên
                </h5>
                <p>
                  Chỉnh sửa các thông tin liên quan đến các giáo viên trong trường
                </p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-3 mx-auto">
          <a href="./student/student_management.php" style="color: black;">
            <div class="box ">
              <div class="img-box">
                <img src="./images/s1.png" alt="" />
              </div>
              <div class="detail-box">
                <h5>
                  Quản lý học sinh
                </h5>
                <p>
                  Chỉnh sửa các thông tin liên quan đến các học sinh trong trường
                </p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-3 mx-auto">
          <a href="./class/class_management.php" style="color: black;">
            <div class="box ">
              <div class="img-box">
                <img src="./images/s2.png" alt="" />
              </div>
              <div class="detail-box">
                <h5>
                  Quản lý lớp học
                </h5>
                <p>
                  Chỉnh sửa các thông tin liên quan đến các lớp học trong trường
                </p>
              </div>
            </div>
           </a> 
        </div>
        <div class="col-sm-6 col-md-3 mx-auto">
          <a href="./assignment/teaching_assignment.php" style="color: black;">
            <div class="box ">
              <div class="img-box">
                <img src="./images/s3.png" alt="" />
              </div>
              <div class="detail-box">
                <h5>
                  Phân công giảng dạy
                </h5>
                <p>
                  Phân công lịch dạy cho giáo viên, phân công lớp học cho học sinh 
                </p>
              </div>
            </div>
           </a> 
        </div>
      </div>
      <!-- <div class="btn-box">
        <a href="">
          View More
        </a>
      </div> -->
    </div>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->


</body>

</html>