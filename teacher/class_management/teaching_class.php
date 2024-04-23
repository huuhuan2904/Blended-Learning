<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Class_query = "SELECT assignment.class_id, class.class_name
                    FROM assignment 
                    join class on assignment.class_id = class.id
                    where assignment.teacher_id  = ".$_SESSION['teacher_id']."";
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
        <form action="profile/edit_profile" method="POST">
            <div class="form first">
                <div class="fields">
                    <div class="input-field">
                        <label>Lớp học</label>
                        <select name="class" id="class" onchange="selectedClass(value);" required>
                            <option disabled selected>Chọn Lớp học</option>
                            <?php
                                if ($Class_result->num_rows > 0) {
                                    while($row = $Class_result->fetch_assoc()) {
                                        echo "<option value='" . $row['class_id'] . "'>" . $row['class_name'] . "</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    
                </div>
            </div>
        </form>
        <div class="assignmentTable"></div>
    </div>
<body>

</body>
</html>
<script>
  function selectedClass(classId) {
    $.ajax({
      url: "class_management/teaching_class_modal.php",
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