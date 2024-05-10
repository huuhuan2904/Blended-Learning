<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);
session_start();
define('ROOT_URL', 'http://localhost/final_project_admin/');

$Homework_submission = $_POST['homework_submission'];

$output = '';

$output .='
    <div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
        <form action="homework/update_homework.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlFile1">Chọn file: </label>
                <input type="file" class="form-control-file" id="file" name="file"">
                <input type="hidden" name="id" id="id" value="'.$Homework_submission.'">
            </div>
            <button type="submit" style="float: right;" class="btn btn-primary"><i class="fa-solid fa-upload"></i> Nộp</button>
        </form>
    </div>';
    echo $output;
?>