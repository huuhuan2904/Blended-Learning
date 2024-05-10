
<?php 
    session_start();
    define('ROOT_URL', 'http://localhost/final_project_admin/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giáo viên | Quản trị</title>
    <link rel="icon" type="image/x-icon" href="../images/Education_Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    
</head>
<style>
    html,body{
    height: 100%;
    font-family: 'Ubuntu', sans-serif;
}

.mynav{
    color: #fff;
}

.mynav li a {
    color: #fff;
    text-decoration: none;
    width: 100%;
    display: block;
    border-radius: 5px;
    padding: 8px 5px;
}

.mynav li a.active{
    background: rgba(255,255,255,0.2);
}

.mynav li a:hover{
    background: rgba(255,255,255,0.2);
}

.mynav li a i{
    width: 25px;
    text-align: center;
}

.notification-badge{
    background-color: rgba(255,255,255,0.7);
    float: right;
    color: #222;
    font-size: 14px;
    padding: 0px 8px;
    border-radius: 2px;
}
</style>
<body>
    <div class="container-fluid p-0 d-flex h-100">
        <?php
            include('leftMenu.php');
        ?>

        <div class="bg-light flex-fill">
            <div class="p-4">
                <nav style="--bs-breadcrumb-divider:'>';font-size:14px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h5 id="current-date-time"></h5>
                    <?php if(isset($_SESSION['teacher_name'])){?>
                        <a class="btn btn-sm btn-light" href="<?= ROOT_URL?>authenticate/logout.php">
                        <i class="fa fa-sign-out"></i>Đăng xuất</a>
                    <?php
                        }
                    ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <?php
                            if (isset($_GET["page"]) && $_GET["page"] != '') {
                                switch ($_GET["page"]) {
                                    case 'schedule_page':
                                        $path = "manage_schedule/".$_GET["page"].".php";
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
                                    case 'teaching_class':
                                        $path = "class_management/".$_GET["page"].".php";
                                        if (file_exists($path)) {
                                            include($path);
                                        } else {
                                            echo 'Error: File not found';
                                        }
                                        break;
                                    case 'homeroom_teacher':
                                        $path = "class_management/".$_GET["page"].".php";
                                        if (file_exists($path)) {
                                            include($path);
                                        } else {
                                            echo 'Error: File not found';
                                        }
                                        break;
                                    case 'homework_page':
                                        $path = "homework_list/".$_GET["page"].".php";
                                        if (file_exists($path)) {
                                            include($path);
                                        } else {
                                            echo 'Error: File not found';
                                        }
                                        break;
                                    case 'online_class_page':
                                        $path = "manage_online_classes/".$_GET["page"].".php";
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
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<!-- Toastr -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }</script>
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
          