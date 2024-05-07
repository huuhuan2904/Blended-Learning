<?php 
    session_start();
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

<body>
  <div class="hero_area"  style="background-color: #f5f5f5">
        <!-- header section strats -->
    <div class="container">
        <?php
            include('topNav.php');
        ?>
        <section id="navArea">
        <!-- body -->
        <?php
            if (isset($_GET["page"]) && $_GET["page"] != '') {
                switch ($_GET["page"]) {
                    case 'timetable_page':
                        $path = "timetable/".$_GET["page"].".php";
                        if (file_exists($path)) {
                            include($path);
                        } else {
                            echo 'Error: File not found';
                        }
                        break;
                    case 'personal_inf':
                        $path = "profile/".$_GET["page"].".php";
                        if (file_exists($path)) {
                            include($path);
                        } else {
                            echo 'Error: File not found';
                        }
                        break;
                    case 'homework_page':
                        $path = "homework/".$_GET["page"].".php";
                        if (file_exists($path)) {
                            include($path);
                        } else {
                        echo 'Error: File not found';
                            }
                        break;
                    case 'homework_details':
                        $path = "homework/".$_GET["page"].".php";
                        if (file_exists($path)) {
                            include($path);
                        } else {
                        echo 'Error: File not found';
                            }
                        break;
                    default:
                        echo 'Error: Invalid page';
                        break;
                }
            }    
        ?>
        </section>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
</body>

</html>
<?php
    if(isset($_SESSION['success'])) {
        if(!empty($_SESSION['success']) || $_SESSION['success'] === 2){?>
            <script>      
                $(document).ready(function onDocumentReady() { 
                    toastr.success("<?php echo $_SESSION['notification']; ?>");
                });
            </script>
            <?php 
            unset($_SESSION['success']);
            unset($_SESSION['notification']);
        }
    }
    if(isset($_SESSION['error'])){
        if($_SESSION['error'] === 2){?>
            <script>      
                $(document).ready(function onDocumentReady() {  
                    toastr.error("<?php echo $_SESSION['notification']; ?>");
                });
            </script>
            <?php 
            unset($_SESSION['error']);
        }
    }

    
?>