<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$Teacher = $_POST['teacher_id'];
$Subject = $_POST['subject_id'];
$Class = $_POST['class_id'];

    $valid_class = array();//array chứa các class sẽ k bị xóa trong db

    //kiểm tra $Subject có tồn tại trong db
    $check_subject_query = mysqli_query($conn, "SELECT * from assignment where teacher_id = $Teacher AND subject_id = $Subject");
    echo 'Giá trị môn học nhập: ' .$Subject. "<br />";
        if($check_subject_query->num_rows > 0){
            echo 'Môn học tồn tại ' .$Subject. "<br />";
        }
        else{
            $update_subject_query = mysqli_query($conn, "UPDATE assignment SET subject_id = '$Subject' WHERE teacher_id = $Teacher");
        }

    //kiểm tra $Class có tồn tại trong db
    foreach($Class as $class_row){
        $check_class_query = mysqli_query($conn, "SELECT * from assignment where teacher_id = $Teacher AND class_id = $class_row");
        echo 'Giá trị lớp nhập: ' .$class_row. "<br />";
            if($check_class_query->num_rows > 0){
                echo 'Lớp tồn tại ' .$class_row. "<br />";
                $valid_class[] = $class_row;
            }
            else{
                $add_class_query = mysqli_query($conn, "INSERT INTO assignment (teacher_id, subject_id, class_id) VALUES ('$Teacher', '$Subject', '$class_row')");
                $valid_class[] = $class_row;
            }
    }

    //kiểm tra các class trong db có tồn tại trong array hay k
    $class_filter_query = mysqli_query($conn, "SELECT class_id FROM assignment 
                                                WHERE teacher_id = $Teacher 
                                                AND subject_id = $Subject
                                                AND class_id NOT IN (" . implode(',', $valid_class) . ")");
    if ($class_filter_query->num_rows > 0) {
        while ($classes = mysqli_fetch_assoc($class_filter_query)) {
            echo '<br /> Giá trị bị xóa ' .$classes['class_id'];
            $delete_old_class = mysqli_query($conn,"DELETE FROM assignment WHERE teacher_id = $Teacher AND subject_id = $Subject AND class_id = ".$classes['class_id']."");
        }
    } 

header('location: ../index.php?page=teaching_assignment');
?>