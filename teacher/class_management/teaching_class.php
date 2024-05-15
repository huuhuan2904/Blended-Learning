<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Class_query = "SELECT assignment.class_id, class.class_name
                    FROM assignment 
                    join class on assignment.class_id = class.id
                    where assignment.teacher_id  = ".$_SESSION['teacher_id']."
                    ORDER BY class.class_name";
    $Class_result = mysqli_query($conn, $Class_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- bootstrap core css -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
    <div class="container" style="max-width: 2140px;">
        <?php
            $class_results = array();
            if ($Class_result->num_rows > 0) {
                echo "<button class='btn btn-warning' style='margin-right: 10px;' onclick=\"location.href='index.php?page=teaching_class'\" type='button'>Tải lại  <i class=\"fa-solid fa-rotate-right\"></i></button>";
                while($row = $Class_result->fetch_assoc()) {
                    $class_results[] = $row;
                    echo "<button class='btn btn-primary' style='margin-right: 10px;' onclick='selectedClass(".$row['class_id'].");'>".$row['class_name']."  <i class=\"fa-solid fa-caret-down\"></i></button>";                
                }
            }
        ?>
        <div class="assignmentTable" style='margin-top: 10px;'>
            <table style="text-align: center" class="table">
                <thead>
                    <tr class="title_style">
                        <th> Lớp </th>
                        <th> Họ và tên đệm </th>
                        <th> Tên </th>
                        <th> Ngày sinh </th>
                        <th> Giới tính </th>
                        <th> Địa chỉ </th>
                        <th> Số điện thoại </th>
                        <th> Dân tộc </th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $class_all = array();
                $firstRow = true;
                foreach($class_results as $row){
                    $Assignment_result = mysqli_query($conn,'   SELECT class_students.student_id, students.*
                                                                from class_students 
                                                                join students on class_students.student_id = students.id
                                                                where class_students.class_id = '.$row['class_id'].'
                                                                ORDER BY students.first_name');
                        if ($Assignment_result->num_rows > 0) {
                            foreach($Assignment_result as $row2){ ?>
                                <tr>
                                    <th><?php echo $row['class_name'] ?></th>
                                    <td><?php echo $row2['last_name']?></td>
                                    <td><?php echo $row2['first_name']?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row2['dob'])); ?></td>
                                    <td><?php echo $row2['gender']?></td>
                                    <td><?php echo $row2['address']?></td>
                                    <td><?php echo $row2['phone']?></td>
                                    <td><?php echo $row2['nation']?></td>
                                </tr>
                        <?php } 
                        }
                }?>
            </tbody>
            </table>
        </div>
    </div>
<body>

</body>
</html>
<script>
  function selectedClass(classId) {
    $.ajax({
      url: "class_management/teaching_class_data.php",
      method: 'post',
      data: {
          class_id: classId,
      },
      success: function(result) {
        $(".assignmentTable").html(result);
      }
    })
}
</script>