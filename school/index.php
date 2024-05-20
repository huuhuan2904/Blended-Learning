<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);

    $students_result = $conn->query("SELECT COUNT(*) AS studentNum FROM students");
        $student_row = $students_result->fetch_assoc();
        $student_num = $student_row['studentNum'];

    $teachers_result = $conn->query("SELECT COUNT(*) AS teacherNum FROM teachers");
        $teacher_row = $teachers_result->fetch_assoc();
        $teacher_num = $teacher_row['teacherNum'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị nhà trường</title>
    <link rel="icon" type="image/x-icon" href="../images/Education_Logo.png">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../css/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../css/jqvmap.min.css">
    <link rel="stylesheet" href="../css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="../css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../css/daterangepicker.css">
    <link rel="stylesheet" href="../css/summernote-bs4.min.css">
    <link href="../css/style.css" rel="stylesheet" />
    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <style>
    .logo span {
        color: white;
        font-size: 25px;
        margin: 45px;
    }
    </style>
    <!-- <script nonce="fba944bd-8852-4e44-b980-94d5d1c099ac">
    try {
        (function(w, d) {
            ! function(du, dv, dw, dx) {
                du[dw] = du[dw] || {};
                du[dw].executed = [];
                du.zaraz = {
                    deferred: [],
                    listeners: []
                };
                du.zaraz.q = [];
                du.zaraz._f = function(dy) {
                    return async function() {
                        var dz = Array.prototype.slice.call(arguments);
                        du.zaraz.q.push({
                            m: dy,
                            a: dz
                        })
                    }
                };
                for (const dA of ["track", "set", "debug"]) du.zaraz[dA] = du.zaraz._f(dA);
                du.zaraz.init = () => {
                    var dB = dv.getElementsByTagName(dx)[0],
                        dC = dv.createElement(dx),
                        dD = dv.getElementsByTagName("title")[0];
                    dD && (du[dw].t = dv.getElementsByTagName("title")[0].text);
                    du[dw].x = Math.random();
                    du[dw].w = du.screen.width;
                    du[dw].h = du.screen.height;
                    du[dw].j = du.innerHeight;
                    du[dw].e = du.innerWidth;
                    du[dw].l = du.location.href;
                    du[dw].r = dv.referrer;
                    du[dw].k = du.screen.colorDepth;
                    du[dw].n = dv.characterSet;
                    du[dw].o = (new Date).getTimezoneOffset();
                    if (du.dataLayer)
                        for (const dH of Object.entries(Object.entries(dataLayer).reduce(((dI, dJ) => ({
                                ...dI[1],
                                ...dJ[1]
                            })), {}))) zaraz.set(dH[0], dH[1], {
                            scope: "page"
                        });
                    du[dw].q = [];
                    for (; du.zaraz.q.length;) {
                        const dK = du.zaraz.q.shift();
                        du[dw].q.push(dK)
                    }
                    dC.defer = !0;
                    for (const dL of [localStorage, sessionStorage]) Object.keys(dL || {}).filter((dN => dN
                        .startsWith("_zaraz_"))).forEach((dM => {
                        try {
                            du[dw]["z_" + dM.slice(7)] = JSON.parse(dL.getItem(dM))
                        } catch {
                            du[dw]["z_" + dM.slice(7)] = dL.getItem(dM)
                        }
                    }));
                    dC.referrerPolicy = "origin";
                    dC.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(du[dw])));
                    dB.parentNode.insertBefore(dC, dB)
                };
                ["complete", "interactive"].includes(dv.readyState) ? zaraz.init() : du.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document)
    } catch (e) {
        throw fetch("/cdn-cgi/zaraz/t"), e;
    };
    </script> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        </nav>
        <!-- left menu -->
        <?php
            include('leftMenu.php');
        ?>

        <div class="content-wrapper" style="min-height: 301.4px;">
            <div class="content-header">
                <!-- <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Quản trị</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div>
                    </div>
                </div> -->
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info" style="height: 100px; padding: 10px; font-size: 12px;">
                                <div class="inner" style="padding: 0px;text-align: center">
                                    <h3><?php echo $student_num; ?></h3>
                                    <p>Học sinh</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success" style="height: 100px; padding: 10px; font-size: 12px;">
                                <div class="inner" style="padding: 0px;text-align: center">
                                    <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                                    <h3><?php echo $teacher_num; ?></h3>
                                    <p>Giáo viên</p>
                                </div>
                                <!-- <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">Chi tiết <i
                                        class="fas fa-arrow-circle-right"></i></a> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning" style="height: 100px; padding: 10px; font-size: 12px;">
                                <div class="inner" style="padding: 0px;text-align: center">
                                    <h3><?php echo $student_num; ?></h3>
                                    <p>Tài khoản học sinh</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger" style="height: 100px; padding: 10px; font-size: 12px;">
                                <div class="inner" style="padding: 0px;text-align: center">
                                    <h3><?php echo $teacher_num; ?></h3>
                                    <p>Tài khoản giáo viên</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- body content -->
                    <?php
                        if (isset($_GET["page"]) && $_GET["page"] != '') {
                            switch ($_GET["page"]) {
                                case 'teacher_management':
                                    $path = "teacher/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'edit':
                                    $path = "teacher/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'student_management':
                                    $path = "student/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'edit_student':
                                    $path = "student/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'class_management':
                                    $path = "class/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'students':
                                    $path = "class/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'teaching_assignment':
                                    $path = "assignment/".$_GET["page"].".php";
                                    if (file_exists($path)) {
                                        include($path);
                                    } else {
                                        echo 'Error: File not found';
                                    }
                                    break;
                                case 'calendar_management':
                                    $path = "calendar/".$_GET["page"].".php";
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
            </section>
        </div>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/Chart.min.js"></script>
    <script src="../js/sparkline.js"></script>
    <script src="../js/jquery.vmap.min.js"></script>
    <script src="../js/jquery.vmap.usa.js"></script>
    <script src="../js/jquery.knob.min.js"></script>
    <script src="../js/moment.min.js"></script>
    <script src="../js/daterangepicker.js"></script>
    <script src="../js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../js/summernote-bs4.min.js"></script>
    <script src="../js/jquery.overlayScrollbars.min.js"></script>
    <script src="../js/adminlte.js?v=3.2.0"></script>
    <script src="../js/demo.js"></script>
    <script src="../js/dashboard.js"></script>
</body>
<!-- data table -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</html>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "language": {
                "sProcessing":   "Đang xử lý...",
                "sLengthMenu":   "Xem _MENU_ mục",
                "sZeroRecords":  "Không tìm thấy dữ liệu phù hợp",
                "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix":  "",
                "sSearch":       "Tìm kiếm:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Đầu",
                    "sPrevious": "Trước",
                    "sNext":     "Tiếp",
                    "sLast":     "Cuối"
                }
            },
            "lengthMenu": [5, 10, 25, 50, 75, 100],
            // "order": [[0, "asc"]]sap xep cot thu may
        });
    });
</script>