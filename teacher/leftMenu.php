<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giáo viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
<div id="bdSidebar" class="d-flex flex-column flex-shrink-0 p-3 text-white offcanvas-md offcanvas-start" style="width: 280px;background-color: rgba(var(--bs-success-rgb)) !important">
            <a href="#" class="navbar-brand">
                <h5><i class="fa-solid fa-bomb me-2" style="font-size: 28px;"></i>Giáo viên</h5>
            </a>
            <hr>
            <ul class="mynav nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="index.php?page=schedule_page" class="active">
                        <i class="fa-solid fa-calendar"></i>
                        Lịch dạy của tôi
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="fa-solid fa-people-group"></i>
                        <span>Lớp học</span>
                        <div style="float: right"><i class="fa-solid fa-caret-down"></i></div>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="padding-left: 7px">
                        <li class="sidebar-item">
                            <a href="index.php?page=teaching_class" class="sidebar-link" style="font-size:14px"><i class="fa-solid fa-plus"></i>Lớp học giảng dạy</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="index.php?page=homeroom_teacher" class="sidebar-link" style="font-size:14px"><i class="fa-solid fa-plus"></i>Lớp học chủ nhiệm</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mb-1">
                    <a href="index.php?page=online_class_page" class="">
                        <i class="fa-solid fa-chalkboard"></i>
                        Buổi học trực tuyến
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="index.php?page=homework_page" class="">
                        <i class="fa-solid fa-book"></i>
                        Danh sách bài tập
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="index.php?page=personal_inf" class="">
                        <i class="fa-solid fa-user"></i>
                        Thông tin cá nhân
                    </a>
                </li>
            </ul>
            <hr>
            <div class="d-flex">
                <img src="../images/Education_Logo.png" class="img-fluid rounded me-2" width="50px" alt="">
                <span>
                    <?php if(isset($_SESSION['teacher_name'])){?>
                        <h6><?=$_SESSION['teacher_name'] ?></h6>
                    <?php
                        }
                    ?>
                    <?php if(isset($_SESSION['login_email'])){?>
                        <small><?=$_SESSION['login_email'] ?></small>
                    <?php
                        }
                    ?>
                </span>
            </div>
        </div>
</body>
</html>
