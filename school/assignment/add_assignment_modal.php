<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>
<body> -->
    <?php
        if(isset($_POST["teacher_id"])){
            $output = '';
            $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
            $Class_arr = array();
            
            $subjects_query = mysqli_query($conn, "Select * from subjects");
                       
            $filterClass_query = mysqli_query($conn, "SELECT DISTINCT class_id FROM class_students");
            while($row = $filterClass_query->fetch_assoc()) {
                $Class_arr[] = $row['class_id'];
            }
            $class_query = mysqli_query($conn, "Select * from class WHERE id IN (" . implode(',', $Class_arr) . ")");
            
            $output .= '
                <input value="' .$_POST['teacher_id']. '" name="teacher_id" id="teacher_id" type="hidden">
                <label for="subjects">Môn học</label>
                <select name="subject_id" id="subject_id" onchange="selectedSubject(value);">
                    <option disabled selected>Môn học</option>';
                    foreach($subjects_query as $subject_row) { 
                        $output .= '<option value="'.$subject_row['id'].'">'.$subject_row['name'].'</option>';
                    }
                $output .= '</select>';
            echo $output;
        }
    ?>
<!-- 
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
        <script>
            new MultiSelectTag('class_id')  // id
        </script>
</body>
</html> -->

<script>
  function selectedSubject(id){
    var teacher_id=document.getElementById("teacher_id").value;  
    $.ajax({
      url: "assignment/selected_subject.php",
      method: 'post',
      data: {
        subject_id: id,
        teacher_id: teacher_id,
      },
    success: function(result) {
        $(".modal-body").html(result);
    }
    })
}
</script>

