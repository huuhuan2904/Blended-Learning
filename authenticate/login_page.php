<?php 
    session_start();
    // get back form data if there was a log in error
    $email = $_SESSION['signin-data']['email'] ?? null;
    $password = $_SESSION['signin-data']['password'] ?? null;

    unset($_SESSION['signin-data']);
    define('ROOT_URL', 'http://localhost/final_project_admin/');
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

  <title>Đăng nhập</title>

  <!-- font awesome style -->
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/font.css">
    <link rel="stylesheet" type="text/css" href="../css/li-scroller.css">
    <link rel="stylesheet" type="text/css" href="../css/slick.css">
    <link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="../css/theme.css">
    <link rel="stylesheet" type="text/css" href="../css/stylee.css">
  <style>
    #wrapper{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #form-login{
        border: 1px solid #00439d;
        border-radius: 20px;
        max-width: 400px;
        background: white;
        flex-grow: 1;
        padding: 30px 30px 40px;
        box-shadow: 0px 0px 17px 2px rgba(255, 255, 255, 0.8);
    }
    .form-heading{
        font-size: 25px;
        color: black;
        text-align: center;
        margin-bottom: 30px;
    }
    .form-group{
        border-bottom: 1px solid #00439d;
        margin-top: 15px;
        margin-bottom: 20px;
        display: flex;
    }
    .form-group i{
        /* color: #fff; */
        font-size: 14px;
        padding-top: 5px;
        padding-right: 10px;
    }
    .form-input{
        background: transparent;
        border: 0;
        outline: 0;
        /* color: #f5f5f5; */
        flex-grow: 1;
    }
    #eye i{
        padding-right: 0;
        cursor: pointer;
    }
    
    .form-submit{
        border: 1px solid #00439d;
        background-color: #00439d;
        color: white;
        width: 100%;
        text-transform: uppercase;
        padding: 6px 10px;
        transition: 0.25s ease-in-out;
        margin-top: 30px;
    }
    .form-submit:hover{
        color: black;
        border: 1px solid #00439d;
        background-color: white;
    }
    .alert_message.error{
        color: red
    }
  </style>
</head>

<body>
  <div class="hero_area"  style="background-color: #f5f5f5">
    <!-- header section strats -->
    <div class="container">
    <header id="header">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_top" style="background-color: #00439d;">
            <div class="header_top_left">
                <ul class="top_nav">
                <li><a href="../index.php" style="border-right: none">Trang chủ</a></li>
                </ul>
            </div>
            <div class="header_top_right">
                <p id="current-date-time"></p>
            </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_bottom">
            <div class="logo_area"><a href="index.html" class="logo"><img src="images/logo.jpg" alt=""></a></div>
            <div class="add_banner"><a href="#"><img src="../images/image10.jpg" alt=""></a></div>
            </div>
        </div>
        </div>
    </header>
    <section id="navArea">
        <nav class="navbar navbar-inverse" role="navigation" style="background-color: #00439d;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav main_nav">
            <li class="active"><a href="../index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
            <li><a style="border-left: none; text-shadow: none" href="#">Giới thiệu</a></li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="border-left: none; text-shadow: none">Tuyển sinh</a>
                <ul class="dropdown-menu" role="menu">
                <li><a href="#">Học bổng</a></li>
                <li><a href="#">Học phí</a></li>
                <li><a href="#">Tư vấn nhập học</a></li>
                </ul>
            </li>
            <li><a style="border-left: none; text-shadow: none" href="#">Tin tức</a></li>
            <li><a style="border-left: none; text-shadow: none" href="#">Câu lạc bộ</a></li>
            <li><a style="border-left: none; text-shadow: none" href="pages/contact.html">Liên hệ</a></li>
            <li><a style="border-left: none; text-shadow: none" href="./teacher/authenticate/login_page.php">Đăng nhập</a></li>
            </ul>
        </div>
        </nav>
    </section>
    </div>
    <!-- end header section -->
  </div>

  <div style="text-align: center;">
  <div id="wrapper">
        <form action="<?= ROOT_URL?>authenticate/login.php" id="form-login" method="POST">
            <img src="../images/eduLogoNoName.png" width="150px" alt="">
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message succes">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <div class="form-group">
                <!-- <i class="far fa-user"></i> -->
                <input value="<?= $email ?>" name="email" type="text" class="form-input" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
                <!-- <i class="fas fa-key"></i> -->
                <input name="password" value="<?= $password ?>" type="password" class="form-input" placeholder="Mật khẩu">
                <div id="eye">
                    <i class="far fa-eye"></i>
                </div>
            </div>
            <div style="padding-bottom: 20px;">
                <select class="form-control" name="role" id="exampleFormControlSelect1">
                    <option disabled selected hidden>Chọn vai trò</option>
                    <option value="1">Học sinh</option>
                    <option value="2">Giáo viên</option>
                </select>
            </div>
            <button name="submit" value="Đăng nhập" class="form-submit">Đăng nhập</button>
        </form>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
</body>

</html>
<script>
    $(document).ready(function(){
    $('#eye').click(function(){
        $(this).toggleClass('open');
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        if($(this).hasClass('open')){
            $(this).prev().attr('type', 'text');
        }else{
            $(this).prev().attr('type', 'password');
        }
    });
});
</script>

<script src="../js/jqueryy.min.js"></script> 
<script src="../js/wow.min.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/slick.min.js"></script> 
<script src="../js/jquery.li-scroller.1.0.js"></script> 
<script src="../js/jquery.newsTicker.min.js"></script> 
<script src="../js/jquery.fancybox.pack.js"></script> 
<script src="../js/customm.js"></script>
</body>
</html>
<script>
function updateDateTime() {
    // Lấy thẻ <p> có id="current-date-time"
    var currentDateTimeElement = document.getElementById("current-date-time");

    // Tạo một đối tượng Date
    var currentDateTime = new Date();

    // Lấy giờ, phút và giây từ đối tượng Date
    var hours = currentDateTime.getHours();
    var minutes = currentDateTime.getMinutes();
    var seconds = currentDateTime.getSeconds();

    // Lấy ngày, tháng và năm từ đối tượng Date
    var day = currentDateTime.getDate();
    var month = currentDateTime.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần cộng thêm 1
    var year = currentDateTime.getFullYear();

    // Định dạng lại thời gian và ngày tháng năm để hiển thị
    var formattedHours = hours < 10 ? "0" + hours : hours;
    var formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
    var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;
    var formattedDay = day < 10 ? "0" + day : day;
    var formattedMonth = month < 10 ? "0" + month : month;

    // Hiển thị thời gian và ngày tháng năm hiện tại lên trang web
    currentDateTimeElement.textContent = formattedDay + "/" + formattedMonth + "/" + year + " " + formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;
}

// Gọi hàm updateDateTime mỗi giây
setInterval(updateDateTime, 1000);
</script>