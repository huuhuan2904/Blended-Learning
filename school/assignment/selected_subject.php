<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>
<body>
    <?php
        if(isset($_POST["subject_id"])){
            $output = '';
            $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
            $Class_arr = array();
            $Class_subject = array();
                       
            $filterClass_query = mysqli_query($conn, "SELECT DISTINCT class_id FROM class_students");
            while($row = $filterClass_query->fetch_assoc()) {
                $Class_arr[] = $row['class_id'];//lưu ds lớp đã phân công
            }

            $classSubject_query = mysqli_query($conn, "SELECT class_id FROM assignment where subject_id = ".$_POST["subject_id"]."");
            while($row = $classSubject_query->fetch_assoc()) {
                $Class_subject[] = $row['class_id'];//lưu ds lớp đã có môn học được chọn
            }

            $class_query = mysqli_query($conn, "SELECT * FROM class WHERE id IN (" . implode(',', $Class_arr) . ") AND id NOT IN (" . implode(',', $Class_subject) . ")");
            
            $output .= '
            <form action="assignment/add_assignment.php" method="POST">
                <input value="' .$_POST['teacher_id']. '" name="teacher_id" id="teacher_id" type="hidden">
                <input value="' .$_POST["subject_id"]. '" name="subject_id" id="subject_id" type="hidden">
                <label for="classes">Lớp học</label>
                <select name="class_id[]" id="class_id" multiple>'; 
                foreach($class_query as $class_row) { 
                    $output .= '<option value="'.$class_row['id'].'">'.$class_row['class_name'].'</option>';
                }                                            
            $output .= '
                    </select>     
                    <button id="submit" class="submit">Xác nhận</button>
                </form>';
            echo $output;
        }
    ?>

<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
        <script>
            new MultiSelectTag('class_id')  // id
        </script>
</body>
</html>



