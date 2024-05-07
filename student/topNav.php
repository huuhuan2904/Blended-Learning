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

  <title>Cổng thông tin đào tạo trường THPT</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header id="header">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_top">
            <div class="header_top_left">
                <ul class="top_nav">
                <li><a href="../index.php">Trang chủ</a></li>
                </ul>
            </div>
            <div class="header_top_right">
                <p id="current-date-time"></p>
            </div>
            </div>
        </div>
        </div>
    </header>
    <section id="navArea" style="padding: 0">
        <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav main_nav">
            <li class="active"><a href="./index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="index.php?page=timetable_page">Thời khóa biểu</a></li>
            <li><a href="index.php?page=homework_page">Bài tập</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="background-color:#009ACD">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php if(isset($_SESSION['first_name'])){?>
                            <?=$_SESSION['last_name']?> <?=$_SESSION['first_name']?>
                        <?php } ?>    
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php?page=personal_inf">Thông tin cá nhân</a></li>
                        <li><a href="<?= ROOT_URL?>authenticate/logout.php">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </nav>
    </section>
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