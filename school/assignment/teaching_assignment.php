<?php 
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$subjects_query = mysqli_query($conn, "Select * from subjects");
$class_query = mysqli_query($conn, "Select * from class");

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
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome style -->
    <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />

</head>

<body>
    <div style="text-align: right" class="input-field">
        <input class="search" style="width: 20em;" name="search" type="text" placeholder="Tìm kiếm...">
        <button id="searchBtn" class="btn btn-outline-primary" type="submit">
            <i class="fa fa-search"></i>
        </button>
    </div>
    <!-- data table -->
    <div class="table_data">
        <table style="text-align: center" class="table table-bordered">
            <tr class="title_style" style="background-color: #007BFF; color: white">
                <th> Giáo viên </th>
                <th> Lớp được phân công </th>
                <th> Môn học </th>
                <th> Lớp học </th>
            </tr>
            <?php 
                                    $filter_data = "SELECT t.id as teacher_id,
                                                            t.name as teacher_name,
                                                            s.name as subject_name,
                                                            GROUP_CONCAT(c.class_name) as class_name,
                                                            CASE 
                                                                WHEN a.teacher_id IS NOT NULL THEN a.subject_id
                                                                ELSE NULL
                                                            END AS subject_id,
                                                            CASE 
                                                                WHEN a.teacher_id IS NOT NULL THEN a.class_id
                                                                ELSE NULL
                                                            END AS class_id
                                                        FROM teachers t
                                                        LEFT JOIN assignment a ON t.id = a.teacher_id
                                                        LEFT JOIN subjects s ON a.subject_id = s.id
                                                        LEFT JOIN class c ON a.class_id = c.id 
                                                        group by t.id";
                                    $query_run = mysqli_query($conn,$filter_data);
                                    if(mysqli_num_rows($query_run) > 0){
                                    foreach($query_run as $row)
                                    {
                                        ?>
            <tr>
                <td><?php echo $row['teacher_name'] ?></td>
                <td><?php echo $row['class_name'] ?></td>
                <td><?php echo $row['subject_name'] ?></td>
                <td>
                    <?php if ($row['subject_name'] > 0) { ?>
                    <button class="editAssignment btn btn-secondary" id="<?php echo $row['teacher_id'];?>"
                        data-toggle="modal" data-target="#editAssignmentModal"><i
                            class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn btn-danger"
                        onclick="deleteAssignment(<?php echo $row['teacher_id']?>)"><i class="fa-solid fa-trash"></i></button>
                    <?php } else { ?>
                    <button class="addAssignment btn btn-success" id="<?php echo $row['teacher_id'];?>"
                        data-toggle="modal" data-target="#addAssignmentModal"><i class="fa-solid fa-plus"></i></button>
                    <?php } ?>
                </td>
            </tr>
            <?php
                                        }
                                    }else{
                                    ?>
            <tr>
                <td colspan="4">Không tìm thấy</td>
            </tr>
            <?php
                                    }
                                    ?>
        </table>
    </div>

    <div class="modal fade" id="addAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Thêm phân công</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <div style="padding: 60px">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div style="max-width: 1300px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Sửa phân công</h5>
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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
    new MultiSelectTag('classes') // id
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('.addAssignment').click(function() {
        select = $(this).attr('id');
        $.ajax({
            url: "assignment/add_assignment_modal.php",
            method: 'post',
            data: {
                teacher_id: select
            },
            success: function(result) {
                $(".modal-body").html(result);
            }
        })
    });
});
</script>
<script>
$(document).ready(function() {
    $('.editAssignment').click(function() {
        select = $(this).attr('id');
        $.ajax({
            url: "assignment/edit_assignment_modal.php",
            method: 'POST',
            data: {
                teacher_id: select
            },
            success: function(result) {
                $(".modal-body2").html(result);
            }
        })
    });
});
</script>
<script>
function deleteAssignment(teacherId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "assignment/delete_assignment.php",
                type: 'POST',
                data: {
                    teacher_id: teacherId,
                },
                success: function(data) {
                    console.log(data);
                    //sau khi success thì tự trả từ url trên về biến data
                    if (data == 1) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        }).then((result) => {
                            url = "./index.php?page=teaching_assignment";
                            window.location.href = url;
                        });

                    }
                }
            })
        }
    });
}
</script>
<script>
$(document).ready(function() {
    $('#searchBtn').click(function() {
        $.ajax({
            url: "assignment/search.php",
            method: 'get',
            data: {
                key: $(".search").val()
            },
            success: function(result) {
                $(".table_data").html(result);
            }
        })
    });
});
</script>

</html>