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
            
            $subjects_query = mysqli_query($conn, "Select * from subjects");
            $class_query = mysqli_query($conn, "Select * from class");
                       
            $output .= '
            <form action="assignment/add_assignment.php" method="POST">
                <input value="' .$_POST['teacher_id']. '" name="teacher_id" type="hidden">
                <label for="subjects">Môn học</label>
                <select name="subject_id" id="subject_id">
                    <option disabled selected>Môn học</option>';
                    foreach($subjects_query as $subject_row) { 
                        $output .= '<option value="'.$subject_row['id'].'">'.$subject_row['name'].'</option>';
                    }
                $output .= '</select>
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



