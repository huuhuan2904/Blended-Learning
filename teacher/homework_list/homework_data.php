<?php
    $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
    if(isset($_POST["class_id"])){
        echo $_POST["class_id"];
        // $output = '';
        // $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
        // $Assignment_result = mysqli_query($conn,'SELECT id
        //                                         from assignment 
        //                                         where class_id = '.$_POST["class_id"].' AND teacher_id = '.$_SESSION['teacher_id'].'');
        // $Ass_id = array();
        //     if(mysqli_num_rows($Assignment_result) > 0){
        //         foreach($Assignment_result as $row)
        //         {
        //             $Ass_id = $row['id'];
        //         }
        //     }
        // echo $Ass_id;
    }
?>



