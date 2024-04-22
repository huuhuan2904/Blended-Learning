<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- <link rel="stylesheet"
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
    <link rel="stylesheet" href="../css/summernote-bs4.min.css"> -->
    <style>
    .logo span {
        color: white;
        font-size: 22px;
        margin: 45px;
    }
    </style>
    <script nonce="fba944bd-8852-4e44-b980-94d5d1c099ac">
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
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light"></nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="logo" href="index.php"><span>THPT Vĩnh Lộc</span></a>
            <div class="sidebar">
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fa-solid fa-laptop-file"></i>
                                <p>
                                    Quản lý
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?page=teacher_management" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý giáo viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=student_management" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý học sinh</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=class_management" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Quản lý lớp học</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?page=teaching_assignment" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Phân công giảng dạy</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Widgets
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item">
                            <a href="index.php?page=calendar_management" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Gallery
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/kanban.html" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Kanban Board
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">LABELS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Important</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-warning"></i>
                                <p>Warning</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-circle text-info"></i>
                                <p>Informational</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <script>
    </script>
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

</html>