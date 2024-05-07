<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    $Class = array();
    $Class_query = "    SELECT class_students.class_id, class.class_name
                        FROM class_students 
                        join class on class_students.class_id = class.id
                        where class_students.student_id = ".$_SESSION['student_id'].""; 
    $Class_result = mysqli_query($conn, $Class_query);
    $Class_row = mysqli_fetch_assoc($Class_result);
    $Class_id = $Class_row['class_id'];

    $Homework_result = mysqli_query($conn, "SELECT *, homework.id AS homework_id, homework.start_date AS start, homework.end_date AS deadline, lessons.name AS lesson_name, subjects.name AS subject_name, teachers.name AS teacher_name
                                            FROM homework
                                            JOIN lesson_day ON homework.lesson_day_id = lesson_day.id
                                            JOIN lessons ON lesson_day.lesson_id = lessons.id
                                            JOIN days_assignment ON lesson_day.days_ass_id = days_assignment.id
                                            JOIN days ON days_assignment.day = days.id
                                            JOIN assignment ON days_assignment.assignment_id = assignment.id
                                            JOIN subjects ON assignment.subject_id = subjects.id
                                            JOIN teachers ON assignment.teacher_id = teachers.id
                                            JOIN class ON assignment.class_id = class.id
                                            WHERE assignment.class_id = ".$Class_id."");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <style>
        .container2 .card-group{
            display: flex;
            height: 80vh;
        }
        .container2 .card-group .card{
            margin-right: 30px;
        }

    </style>
    <div class="container2" >
        <div class="card-group">
            <?php foreach($Homework_result as $row): ?>
            <div class="card">
                    <img class="card-img-top" src="http://www.bookthatbook.com/images/resource/favorite.jpg" alt="Card image cap" style="width: 230px; height: auto;">
                    <b><h3 class="card-header"><?php echo $row['type']; ?></h3></b>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['teacher_name']. ' ('.$row['subject_name']. ')'?></h5>
                        <form action="./index.php?page=homework_details" method="post">
                            <input type="hidden" id="id" name="id" value=<?php echo $row['homework_id']; ?>>
                            <input type="hidden" id="subject" name="subject" value="<?php echo $row['subject_name']; ?>">
                            <input type="hidden" id="teacher" name="teacher" value="<?php echo $row['teacher_name']; ?>">
                            <input type="hidden" id="type" name="type" value="<?php echo $row['type']; ?>">
                            <input type="hidden" id="filename" name="filename" value="<?php echo $row['file_name']; ?>">
                            <input type="hidden" id="filepath" name="filepath" value="<?php echo $row['file_path']; ?>">
                            <input type="hidden" id="title" name="title" value="<?php echo $row['title']; ?>">
                            <input type="hidden" id="content" name="content" value="<?php echo $row['content']; ?>">
                            <input type="hidden" id="lesson" name="lesson" value="<?php echo $row['lesson_name']; ?>">
                            <input type="hidden" id="start" name="start" value="<?php echo $row['start']; ?>">
                            <input type="hidden" id="end" name="end" value="<?php echo $row['deadline']; ?>">
                            <input type="hidden" id="day" name="day" value="<?php echo $row['homework_day']; ?>">
                            <button type="submit" class="btn btn-primary">Chi tiết</button>
                        </form>
                        <?php
                            if($row['deadline'] != '0000-00-00'){?>
                                <p class="card-text"><small class="text-muted">Hạn nộp: <?php echo $row['deadline']; ?></small></p>
                            <?php 
                            }else{?>
                                <p class="card-text"><small class="text-muted">Không có hạn</small></p>
                            <?php
                        }?>
                        
                    </div>
                </div>
            <?php endforeach; ?>    
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
function homeworkDetails(id, subject, teacher, type, filename, filepath, title, content, lesson, start, end) {
    var subject_name = subject;
    console.log(subject_name);
    $.ajax({
        url: "homework/homework_details.php",
        type: 'POST',
        data: {
            id: id,
            subject: subject,
            teacher: teacher,
            type: type,
            filename: filename,
            filepath: filepath,
            title: title,
            content: content,
            lesson: lesson,
            start: start,
            end: end
        },
        success: function(response) {
            window.location.href = './index.php?page=homework_details';
        },
    })
}
</script>
