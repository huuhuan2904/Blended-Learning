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
    <!-- Calendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome style -->
    <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />

    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <table style="text-align: center" class="table table-bordered" id="myTable">
        <thead>
            <tr class="title_style" style="background-color: #007BFF; color: white;">
                <th style="text-align: center">Lớp</th>
                <th style="text-align: center">Giáo viên</th>
                <th style="text-align: center">Tiết</th>
                <th style="text-align: center">Ngày</th>
                <th style="text-align: center">Phòng học</th>
                <th style="text-align: center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Sửa lịch học online</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- modal body -->
                <div class="modal-body2">
                    <div style="padding: 60px">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
<script>
    $(document).ready(function() {
        $.ajax({
            url: 'online_class/get_data.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    var table = $('#myTable').DataTable();
                    table.clear();// xóa trạng thái trống của DataTable vì được khởi tạo trước mà chưa có data
                    $.each(data, function(index, row) {
                        table.row.add([
                            row.class_name,
                            row.teacher_name + ' (' + row.subject_name + ')',
                            row.lesson_name + '<br>(' + row.start_time + '-' + row.end_time + ')',
                            row.start_date,
                            '<a href="' + row.link + '">Link</a>',
                            '<button class="btn btn-secondary" onclick="editModal('+row.days_ass_id+','+row.lesson_day_id+','+row.id+','+row.lesson_id+',\''+row.start_date+'\',\''+row.link+'\')" data-toggle="modal" data-target="#editModal"><i class="fa-regular fa-pen-to-square"></i></button>'
                        ]).draw(false); // vẽ lại DataTable mà không cần cập nhật ngôn ngữ
                    });
                } else {
                    $('#myTable').hide();
                }
            },
        });
    });
</script>
<script>
    function editModal(days_ass_id, lesson_day_id, online_class_id, lesson_id, start_date, link) {
        $.ajax({
            url: "online_class/edit_class_modal.php",
            method: 'POST',
            data: {
                daysAssId: days_ass_id,
                lessonDayId: lesson_day_id,
                onlineClassId: online_class_id,
                lessonId: lesson_id,
                startDate: start_date,
                link: link,
            },
            success: function(result) {
                $(".modal-body2").html(result);
            }
        });
    }
</script>

