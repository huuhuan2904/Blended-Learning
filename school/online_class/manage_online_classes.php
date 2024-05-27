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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
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
                <th style="text-align: center">Link</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
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
                        '<a href="' + row.link + '">Link</a>'
                    ]).draw(false); // vẽ lại DataTable mà không cần cập nhật ngôn ngữ
                });
            } else {
                $('#myTable').hide();
            }
        },
    });
});

</script>


