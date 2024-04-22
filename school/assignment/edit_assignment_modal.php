<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>
<body>
    <?php
        if(isset($_POST["teacher_id"])){
            $output = '';

            $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
            
            $Subjects = mysqli_query($conn, "Select * from subjects");
            $Selected_Subject = mysqli_query($conn, "SELECT assignment.subject_id, subjects.name 
                                                        FROM assignment 
                                                        JOIN subjects ON assignment.subject_id = subjects.id
                                                        WHERE teacher_id = '" . $_POST['teacher_id'] . "'");
            
            $Selected_Class = mysqli_query($conn, "SELECT assignment.class_id, class.class_name
                                                        FROM assignment 
                                                        JOIN class ON assignment.class_id = class.id
                                                        WHERE teacher_id = '" . $_POST["teacher_id"] . "'");
                       
            $output .= '
            <form action="assignment/edit_assignment.php" method="POST">
                <input value="' .$_POST['teacher_id']. '" name="teacher_id" type="hidden">
                <label for="subjects">Môn học</label>
                <select name="subject_id" id="subject_id">';
                    $selected_subject_ids = array();
                    foreach ($Selected_Subject as $selected_subject) {
                        $selected_subject_ids[] = $selected_subject['subject_id'];
                    }
                    foreach ($Selected_Subject as $selected_subject) {
                        $output .= '<option selected value="' . $selected_subject['subject_id'] . '">' . $selected_subject['name'] . '</option>';
                        break;
                    }    
                    // Xây dựng câu truy vấn để lấy các lớp khác chưa được chọn
                    $Subjects = mysqli_query($conn, "SELECT * FROM subjects WHERE id NOT IN (" . implode(',', $selected_subject_ids) . ")");
                    if ($Subjects->num_rows > 0) {
                        while ($subject = mysqli_fetch_assoc($Subjects)) {
                            $output .= '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
                        }
                    }       
                $output .= '</select>

                <label for="class_id">Lớp học</label>
                <select name="class_id[]" id="classes" multiple>'; 
                    $selected_class_ids = array();
                    foreach ($Selected_Class as $selected_class) {
                        $selected_class_ids[] = $selected_class['class_id'];
                    }
                    foreach ($Selected_Class as $selected_class) {
                        $output .= '<option selected value="' . $selected_class['class_id'] . '">' . $selected_class['class_name'] . '</option>';
                    }   
                    // Xây dựng câu truy vấn để lấy các lớp khác chưa được chọn
                    $Classes = mysqli_query($conn, "SELECT * FROM class WHERE id NOT IN (" . implode(',', $selected_class_ids) . ")"); 
                    if ($Classes->num_rows > 0) {
                        while ($class = mysqli_fetch_assoc($Classes)) {
                            $output .= '<option value="' . $class['id'] . '">' . $class['class_name'] . '</option>';
                        }
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
            new MultiSelectTag('classes')  // id
        </script>
</body>
</html>



