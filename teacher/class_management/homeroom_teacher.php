<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Class_query = "SELECT class_students.*, students.*, logins.email, class.*
                    FROM class_students 
                    JOIN students ON class_students.student_id = students.id
                    JOIN class ON class_students.class_id = class.id
                    JOIN logins ON students.login_id = logins.id
                    where teacher_id  = ".$_SESSION['teacher_id']."";
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
<body>
    <div class="table_data">
        <table style="text-align: center" class="table table-bordered">
          <tr class="title_style" style="background-color: black; color: white">
            <th></th>
            <th> Họ và tên đệm </th>
            <th> Tên </th>
            <th> Ngày sinh </th>
            <th> Giới tính </th>
            <th> Địa chỉ </th>
            <th> Số điện thoại </th>
            <th> Dân tộc </th>
            <th> Email </th>
          </tr>
            <?php 
                $firstRow = true;
                if(mysqli_num_rows($Class_result) > 0){
                  foreach($Class_result as $row)
                  {
                    ?>
                      <tr>
                        <?php 
                            if ($firstRow) {
                                ?>
                                <th rowspan="<?php echo mysqli_num_rows($Class_result) ?>"><?php echo $row['class_name'] ?></th>
                                <?php 
                                $firstRow = false;
                            }
                            ?>
                        <td><?php echo $row['last_name'] ?></td>
                        <td><?php echo $row['first_name'] ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['dob'])) ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['address'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['nation'] ?></td>
                        <td><?php echo $row['email'] ?></td>
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
</body>
</html>
