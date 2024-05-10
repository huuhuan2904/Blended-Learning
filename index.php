<!DOCTYPE html>
<html>
<head>
<title>Cổng thông tin đào tạo trường THPT</title>
<link rel="icon" type="image/x-icon" href="./images/Education_Logo.png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./css/animate.css">
<link rel="stylesheet" type="text/css" href="./css/font.css">
<link rel="stylesheet" type="text/css" href="./css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="./css/slick.css">
<link rel="stylesheet" type="text/css" href="./css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="./css/theme.css">
<link rel="stylesheet" type="text/css" href="./css/stylee.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="index.php">Trang chủ</a></li>
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
          <div class="add_banner"><a href="#"><img src="./images/image10.jpg" alt=""></a></div>
        </div>
      </div>
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
          <li><a href="#">Giới thiệu</a></li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tuyển sinh</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Học bổng</a></li>
              <li><a href="#">Học phí</a></li>
              <li><a href="#">Tư vấn nhập học</a></li>
            </ul>
          </li>
          <li><a href="#">Tin tức</a></li>
          <li><a href="#">Câu lạc bộ</a></li>
          <li><a href="pages/contact.html">Liên hệ</a></li>
          <li><a href="./authenticate/login_page.php">Đăng nhập</a></li>
        </ul>
      </div>
    </nav>
  </section>
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Thông báo</span>
          <ul id="ticker01" class="news_sticker">
            <li><a href="#">CHÀO MỪNG BẠN ĐẾN VỚI TRANG THÔNG TIN ĐIỆN TỬ TRƯỜNG THPT</a></li>
            <li><a href="#">CHÀO MỪNG BẠN ĐẾN VỚI TRANG THÔNG TIN ĐIỆN TỬ TRƯỜNG THPT</a></li>
            <li><a href="#">CHÀO MỪNG BẠN ĐẾN VỚI TRANG THÔNG TIN ĐIỆN TỬ TRƯỜNG THPT</a></li>
            <li><a href="#">CHÀO MỪNG BẠN ĐẾN VỚI TRANG THÔNG TIN ĐIỆN TỬ TRƯỜNG THPT</a></li>
          </ul>
          <!-- <div class="social_area">
            <ul class="social_nav">
              <li class="facebook"><a href="#"></a></li>
              <li class="twitter"><a href="#"></a></li>
              <li class="flickr"><a href="#"></a></li>
              <li class="pinterest"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="vimeo"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>
              <li class="mail"><a href="#"></a></li>
            </ul>
          </div> -->
        </div>
      </div>
    </div>
  </section>
  <section id="sliderSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="slick_slider">
          <div class="single_iteam"> <a href="pages/single_page.html"> <img src="./images/image2.jpg" alt=""></a>
            <div class="slider_article">
              <h2><a class="slider_tittle" href="pages/single_page.html">Nhiệt liệt chào mừng</a></h2>
              <p>Ngày nhà giáo Việt Nam 30/04 và Quốc tế lao động 01/05</p>
            </div>
          </div>
          <div class="single_iteam"> <a href="pages/single_page.html"> <img src="./images/image2.jpg" alt=""></a>
            <div class="slider_article">
              <h2><a class="slider_tittle" href="pages/single_page.html">Nhiệt liệt chào mừng</a></h2>
              <p>Ngày nhà giáo Việt Nam 30/04 và Quốc tế lao động 01/05</p>
            </div>
          </div>
          <div class="single_iteam"> <a href="pages/single_page.html"> <img src="./images/image2.jpg" alt=""></a>
            <div class="slider_article">
              <h2><a class="slider_tittle" href="pages/single_page.html">Nhiệt liệt chào mừng</a></h2>
              <p>Ngày nhà giáo Việt Nam 30/04 và Quốc tế lao động 01/05</p>
            </div>
          </div>
          <div class="single_iteam"> <a href="pages/single_page.html"> <img src="./images/image2.jpg" alt=""></a>
            <div class="slider_article">
              <h2><a class="slider_tittle" href="pages/single_page.html">Nhiệt liệt chào mừng</a></h2>
              <p>Ngày nhà giáo Việt Nam 30/04 và Quốc tế lao động 01/05</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Thông báo</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
              <li>
                <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image.png"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Cuộc thi "Tuổi trẻ học tập và làm theo tư tưởng, đạo đức, phong cách Hồ Chí Minh" năm 2024</a> </div>
                </div>
              </li>
              <li>
                <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image2.jpg"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Các danh mục phụ vụ kỳ thi tốt nghiệp THPT năm 2024</a> </div>
                </div>
              </li>
              <li>
                <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image3.png"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Cuộc thi "Tuổi trẻ học tập và làm theo tư tưởng, đạo đức, phong cách Hồ Chí Minh" năm 2024</a> </div>
                </div>
              </li>
              <li>
                <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image4.jpg"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Các danh mục phụ vụ kỳ thi tốt nghiệp THPT năm 2024</a> </div>
                </div>
              </li>
              <li>
                <div class="media"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image.png"> </a>
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Cuộc thi "Tuổi trẻ học tập và làm theo tư tưởng, đạo đức, phong cách Hồ Chí Minh" năm 2024</a> </div>
                </div>
              </li>
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_post_content">
            <h2><span>Tin tức</span></h2>
            <div class="single_post_content_left">
              <ul class="business_catgnav  wow fadeInDown">
                <li>
                  <figure class="bsbig_fig"> <a href="pages/single_page.html" class="featured_img"> <img alt="" src="images/featured_img1.jpg"> <span class="overlay"></span> </a>
                    <figcaption>TIN TỨC NỔI BẬT</figcaption>
                    <p>DANH SÁCH GIÁO VIÊN, HỌC SINH, CHA MẸ HỌC SINH THAM DỰ LỄ KHAI MẠC HỘI KHOẺ PHÙ ĐỔNG TỈNH KON TUM LẦN THỨ IX NĂM 2024</p>
                  </figure>
                </li>
              </ul>
            </div>
            <div class="single_post_content_right">
              <ul class="spost_nav">
                <li>
                  <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image5.jpg"> </a>
                    <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Trường THPT thông báo danh sách giáo viên, học sinh, cha mẹ học sinh tham dự lễ khai mạc hội khoẻ phù đổng tỉnh Kon Tum lần thứ IX năm 2024 cụ thể như sau:</a> </div>
                  </div>
                </li>
                <li>
                  <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image6.jpg"> </a>
                    <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Trường THPT thông báo cuộc thi Dại sứ văn hóa năm 2024</a> </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="fashion_technology_area">
            <div class="fashion">
              <div class="single_post_content">
                <h2><span>Tuyển sinh</span></h2>
                <ul class="business_catgnav wow fadeInDown">
                  <li>
                    <figure class="bsbig_fig"> <a href="pages/single_page.html" class="featured_img"> <img alt="" src="images/featured_img2.jpg"> <span class="overlay"></span> </a>
                      <figcaption> <a href="pages/single_page.html">Thông báo ôn thi tuyển sinh 2024-2025</a> </figcaption>
                    </figure>
                  </li>
                </ul>
                <ul class="spost_nav">
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image7.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Thông báo TKB ôn thi tốt nghiệp 12 năm 2024-2025</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image8.png"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Thời khoá biểu ôn thi TN.THPT năm 2023-2024 (áp dụng từ ngày 22/4/2024)</a> </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="technology">
              <div class="single_post_content">
                <h2><span>Hoạt động</span></h2>
                <ul class="business_catgnav">
                  <li>
                    <figure class="bsbig_fig wow fadeInDown"> <a href="pages/single_page.html" class="featured_img"> <img alt="" src="images/featured_img3.jpg"> <span class="overlay"></span> </a>
                      <figcaption> <a href="pages/single_page.html">Các hoạt động chuyên môn</a> </figcaption>
                    </figure>
                  </li>
                </ul>
                <ul class="spost_nav">
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="./images/image9.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title">Cựu học sinh trường THPT niên khóa 1971-1974 kỷ niệm 50 năm ra trường</a> </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Thông báo từ sở</span></h2>
            <ul class="spost_nav">
              <li>
                <div class="media wow fadeInDown">
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> <h4>TĂNG CƯỜNG PHỔ BIẾN CHỈ THỊ SỐ 23</h4></a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown">
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"><h4>Thông báo tuyển dụng viên chức vào làm việc tại các đơn vị sự nghiệp công lập trực thuộc Sở giáo dục và Đào tạo theo quy định tại Nghị định 115/2020/NĐ-CP</h4></a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown">
                  <div class="media-body"> <a href="pages/single_page.html" class="catg_title"><h4>Công văn phổ biến, tuyên truyền các luật, nghị quyết mới được Quốc hội khóa XV thông qua tại Kỳ họp thứ 5</h4></a> </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="single_sidebar">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">Tổ môn</a></li>
              <li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">Video</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="category">
                <ul>
                  <li class="cat-item"><a href="#">Toán</a></li>
                  <li class="cat-item"><a href="#">Lý học</a></li>
                  <li class="cat-item"><a href="#">Hóa học</a></li>
                  <li class="cat-item"><a href="#">Sinh học</a></li>
                  <li class="cat-item"><a href="#">Ngữ Văn</a></li>
                  <li class="cat-item"><a href="#">Lịch Sử</a></li>
                  <li class="cat-item"><a href="#">Địa lý</a></li>
                  <li class="cat-item"><a href="#">Giáo dục công dân</a></li>
                </ul>
              </div>
              <div role="tabpanel" class="tab-pane" id="video">
                <div class="vide_area">
                  <iframe width="100%" height="250" src="http://www.youtube.com/embed/h5QWbURNEpA?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Hình ảnh tiêu biểu</span></h2>
            <a class="sideAdd" href="#"><img src="http://c3hongduc.daklak.edu.vn/wp-content/uploads/Thumbcache/hinh-anh-tieu-bieu-126-nqrkslssg9cx7au4yv7jnfdxcsdq4gmb9xgdzl55n6.jpg"></a> </div>
        </aside>
      </div>
    </div>
  </section>
  <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">
            <h2>CHỊU TRÁCH NHIỆM NỘI DUNG</h2>
            <p>Ban biên tập Trang thông tin điện tử Trường THPT</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">
            <h2>LIÊN HỆ</h2>
            <p>Email: huuhuan2942002@gmail.com</p>
            <address>
            Địa chỉ: 232 HL80, P.Bình Hưng Hòa B, Bình Tân, Tp Hồ Chí Minh
            </address>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
<script src="./js/jqueryy.min.js"></script> 
<script src="./js/wow.min.js"></script> 
<script src="./js/bootstrap.min.js"></script> 
<script src="./js/slick.min.js"></script> 
<script src="./js/jquery.li-scroller.1.0.js"></script> 
<script src="./js/jquery.newsTicker.min.js"></script> 
<script src="./js/jquery.fancybox.pack.js"></script> 
<script src="./js/customm.js"></script>
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