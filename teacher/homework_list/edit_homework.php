<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

foreach($_POST['arrayData'] as $key=>$value){
    if($key == 'homeworkId'){
        $Homework_id = $value;
    }elseif($key == 'type'){
        $Type = $value;
    }elseif($key == 'title'){
        $Title = $value;
    }elseif($key == 'content'){
        $Content = $value;
    }elseif($key == 'startDate'){
        $Start_date = $value;
    }elseif($key == 'endDate'){
        $End_date = $value;
    }
}
$result = mysqli_query($conn,"UPDATE homework SET type = '$Type', title = '$Title', content = '$Content', start_date = '$Start_date', end_date = '$End_date' WHERE id = '$Homework_id';");

if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
        echo "1";
    } else {
        echo "0";
    }
} else {
    echo "0";
}
?>