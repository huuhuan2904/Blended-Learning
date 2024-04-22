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

  <title>Quản trị nhà trường</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
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

  <style>
    #wrapper{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #form-login{
        border-radius: 20px;
        max-width: 400px;
        background: rgba(0, 0, 0 , 0.8);
        flex-grow: 1;
        padding: 30px 30px 40px;
        box-shadow: 0px 0px 17px 2px rgba(255, 255, 255, 0.8);
    }
    .form-heading{
        font-size: 25px;
        color: #f5f5f5;
        text-align: center;
        margin-bottom: 30px;
    }
    .form-group{
        border-bottom: 1px solid #fff;
        margin-top: 15px;
        margin-bottom: 20px;
        display: flex;
    }
    .form-group i{
        color: #fff;
        font-size: 14px;
        padding-top: 5px;
        padding-right: 10px;
    }
    .form-input{
        background: transparent;
        border: 0;
        outline: 0;
        color: #f5f5f5;
        flex-grow: 1;
    }
    .form-input::placeholder{
        color: #f5f5f5;
    }
    #eye i{
        padding-right: 0;
        cursor: pointer;
    }
    
    .form-submit{
        background: transparent;
        border: 1px solid #f5f5f5;
        color: #fff;
        width: 100%;
        text-transform: uppercase;
        padding: 6px 10px;
        transition: 0.25s ease-in-out;
        margin-top: 30px;
    }
    .form-submit:hover{
        border: 1px solid #54a0ff;
    }
    .alert_message.error{
        color: red
    }
  </style>
</head>

<body style=" background-color: #e4eefd;">
  <div class="hero_area" style=" background-color: #CC3300;">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top" style="background-color: #e4eefd">
        <div class="container-fluid">
          <div style="text-align: center; padding-top: 25px; padding-bottom: 25px;">
          <a href="../home_page.php"><img src="../../images/logoschool.png" width="700" height="140" alt="" /></a>
          </div>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <div style="text-align: center;">
  <div id="wrapper">
        <form action="<?= ROOT_URL?>teacher/authenticate/login.php" id="form-login" method="POST">
            <h1 class="form-heading">Đăng nhập</h1>
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
                <i class="far fa-user"></i>
                <input value="<?= $email ?>" name="email" type="text" class="form-input" placeholder="Tên đăng nhập">
            </div>
            <div class="form-group">
                <i class="fas fa-key"></i>
                <input name="password" value="<?= $password ?>" type="password" class="form-input" placeholder="Mật khẩu">
                <div id="eye">
                    <i class="far fa-eye"></i>
                </div>
            </div>
            <button name="submit" value="Đăng nhập" class="form-submit">Đăng nhập</button>
        </form>
    </div>
  </div>
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