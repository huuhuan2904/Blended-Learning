[33mcommit 531fdbb421f3bb47acf4ae98242a6c05db0fd26d[m[33m ([m[1;36mHEAD -> [m[1;32mmaster[m[33m, [m[1;31morigin/master[m[33m)[m
Author: huuhuan2904 <huuhuan2942002@gmail.com>
Date:   Thu Apr 25 23:01:24 2024 +0700

    add

[1mdiff --git a/teacher/manage_schedule/add_homework.php b/teacher/manage_schedule/add_homework.php[m
[1mindex 7c81149..e69de29 100644[m
[1m--- a/teacher/manage_schedule/add_homework.php[m
[1m+++ b/teacher/manage_schedule/add_homework.php[m
[36m@@ -1,33 +0,0 @@[m
[31m-<?php[m
[31m-$conn = mysqli_connect("localhost","root","","final_project") or die($conn);[m
[31m-[m
[31m-if(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {[m
[31m-    $LessonDay_id = $_POST['lesson_day_id'];[m
[31m-    $Type = $_POST['type'];[m
[31m-    $Title = $_POST['title'];[m
[31m-    $Start_date = $_POST['start_date'];[m
[31m-    $End_date = $_POST['end_date'];[m
[31m-    $Content = $_POST['content'];[m
[31m-[m
[31m-    $targetDir = "uploads/";[m
[31m-[m
[31m-    $fileName = basename($_FILES["file"]["name"]);[m
[31m-    $targetPath = $targetDir.$fileName;[m
[31m-[m
[31m-    if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetPath)){[m
[31m-        $sql = "INSERT INTO homework (lesson_day_id, type, title, file_name, file_path, content, start_date, end_date) [m
[31m-        VALUES ('$LessonDay_id', '$Type', '$Title', '$fileName', '$targetPath', '$Content', '$Start_date', '$End_date')";[m
[31m-        if($conn->query($sql) == true){[m
[31m-            echo "da upload va luu vao db";[m
[31m-        }else{[m
[31m-            echo "Error: ".$sql." Error details: ".$conn->error;[m
[31m-        }[m
[31m-    }else{[m
[31m-        echo "Error moving the file";[m
[31m-    }[m
[31m-}else{[m
[31m-    echo $_FILES['file']['error'];[m
[31m-}[m
[31m-[m
[31m-[m
[31m-?>[m
\ No newline at end of file[m
[1mdiff --git a/teacher/manage_schedule/add_homework_modal.php b/teacher/manage_schedule/add_homework_modal.php[m
[1mindex 1cb32dd..90a4889 100644[m
[1m--- a/teacher/manage_schedule/add_homework_modal.php[m
[1m+++ b/teacher/manage_schedule/add_homework_modal.php[m
[36m@@ -1,44 +1,48 @@[m
 <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>[m
 <?php[m
 $conn = mysqli_connect("localhost","root","","final_project") or die($conn);[m
[32m+[m[32m$Selected_day = date('Y-m-d', strtotime($_POST['homework_day']));[m
 $output = '';[m
[32m+[m
 $output .='<div style="padding: 10px 30px 60px 30px">[m
             <form action="manage_schedule/add_homework.php" method="POST" enctype="multipart/form-data">[m
                 <input type="hidden" name="lesson_day_id" id="lesson_day_id" value='.$_POST['lesson_day_id'].'>[m
[32m+[m[32m                <input type="hidden" name="homework_day" id="homework_day" value='.$Selected_day.'>[m
[32m+[m[32m                <p><b>Ngày chọn: </b>'.$Selected_day.'</p>[m
                 <div class="form-group">[m
                     <label for="type"><b>Loại học liệu</b></label>[m
[31m-                    <select name="type" class="form-control" id="type">[m
[31m-                        <option disabled selected>Học liệu</option>[m
[31m-                        <option>Bài giảng</option>[m
[31m-                        <option>Bài tập</option>[m
[32m+[m[32m                    <select name="type" class="form-control" id="type" required>[m
[32m+[m[32m                        <option disabled selected value="">Học liệu</option>[m
[32m+[m[32m                        <option value="Bài giảng">Bài giảng</option>[m
[32m+[m[32m                        <option value="Bài tập">Bài tập</option>[m
                     </select>[m
                 </div>[m
                 <div class="form-group">[m
                     <label for="title"><b>Tiêu đề</b></label>[m
[31m-                    <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Tiêu đề">[m
[32m+[m[32m                    <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Tiêu đề" required>[m
                 </div>[m
                 <div class="form-group">[m
[31m-                    <label>Example file input</label>[m
[32m+[m[32m                    <label><b>Tải file học liệu</b></label>[m
                     <div class="custom-file">[m
[31m-                    <input type="file" name="file" class="custom-file-input" id="customFile">[m
[32m+[m[32m                    <input type="file" name="file" class="custom-file-input" id="customFile" required>[m
                     <label class="custom-file-label" for="customFile">Chọn file</label>[m
                 </div>[m
               </div>[m
                 <div class="form-row">[m
                     <div class="col">[m
                         <label><b>Ngày bắt đầu</b></label>[m
[31m-                        <input name="start_date" type="date" class="form-control" placeholder="Ngày bắt đầu">[m
[32m+[m[32m                        <input id="date" name="start_date" type="date" class="form-control date-input" placeholder="Ngày bắt đầu" required>[m
                     </div>[m
                     <div class="col">[m
                         <label><b>Ngày kết thúc</b></label>[m
[31m-                        <input name="end_date" type="date" class="form-control" placeholder="Ngày kết thúc">[m
[32m+[m[32m                        <input id="date" name="end_date" type="date" class="form-control date-input" placeholder="Ngày kết thúc" required>[m
                     </div>[m
                 </div>[m
                 <label><b>Nội dung</b></label>[m
                 <div id="editor">[m
[31m-                    <p id="pContent">This is some sample content.</p>[m
[32m+[m[32m                    <p id="pContent"></p>[m
                 </div>[m
[31m-                <input type="hidden" name="content" id="content">[m
[32m+[m[32m                <input type="hidden" name="content" id="content" required>[m
                 <button type="submit" class="btn btn-primary" style="float: right">Submit</button>[m
             </form>[m
         </div>';[m
[36m@@ -54,4 +58,24 @@[m [m$output .='<div style="padding: 10px 30px 60px 30px">[m
 <script>[m
     var pValue = document.getElementById("pContent").textContent;[m
     document.getElementById("content").value = pValue;[m
[32m+[m[32m</script>[m
[32m+[m[32m<script>[m
[32m+[m[32m    // Sự kiện lắng nghe cho phần tử select[m
[32m+[m[32m    document.getElementById("type").addEventListener("change", function() {[m
[32m+[m[32m        var selectedValue = this.value;[m
[32m+[m[32m        // Nếu đã chọn một giá trị khác rỗng từ select, loại bỏ thuộc tính required[m
[32m+[m[32m        if (selectedValue !== "") {[m
[32m+[m[32m            this.removeAttribute("required");[m
[32m+[m[32m            // Nếu giá trị đã chọn không phải là 2, loại bỏ thuộc tính required của phần tử input date[m
[32m+[m[32m            if(selectedValue != 'Bài tập'){[m
[32m+[m[32m                var dateInputs = document.querySelectorAll(".date-input");[m
[32m+[m[32m                dateInputs.forEach(function(input) {[m
[32m+[m[32m                    input.removeAttribute("required");[m
[32m+[m[32m                });[m
[32m+[m[32m            }[m
[32m+[m[32m        } else {[m
[32m+[m[32m            // Nếu chưa chọn giá trị từ select, thêm thuộc tính required[m
[32m+[m[32m            this.setAttribute("required", "required");[m
[32m+[m[32m        }[m
[32m+[m[32m    });[m
 </script>[m
\ No newline at end of file[m
[1mdiff --git a/teacher/manage_schedule/schedule_details.php b/teacher/manage_schedule/schedule_details.php[m
[1mindex e46518e..9ca7146 100644[m
[1m--- a/teacher/manage_schedule/schedule_details.php[m
[1m+++ b/teacher/manage_schedule/schedule_details.php[m
[36m@@ -4,6 +4,7 @@[m [m$conn = mysqli_connect("localhost","root","","final_project") or die($conn);[m
 if (isset($_POST['class_name'])) {[m
     $Start_time = substr($_POST['start_time'], 0, -3);[m
     $End_time = substr($_POST['end_time'], 0, -3);[m
[32m+[m[32m    $Selected_date = $_POST['selected_date'];[m
     if($_POST['status'] == 0){[m
         $Status = 'Trực tiếp';[m
         $Color = '#0099FF';[m
[36m@@ -36,15 +37,43 @@[m [mif (isset($_POST['class_name'])) {[m
                 </tr>[m
             </table>';[m
 [m
[31m-    $Lesson_day_id = "SELECT lesson_day_id FROM homework where lesson_day_id = ".$_POST['lesson_day_id']."";[m
[32m+[m[32m    $Lesson_day_id = "SELECT * FROM homework where lesson_day_id = ".$_POST['lesson_day_id']."";[m
     $LessonDayId_result = mysqli_query($conn, $Lesson_day_id);[m
     if(mysqli_num_rows($LessonDayId_result) > 0) {[m
[31m-        echo 'co bai tap';[m
[32m+[m[32m        $output .='[m
[32m+[m[32m        <table style="text-align: center" class="table table-bordered">[m
[32m+[m[32m            <tr class="title_style">[m
[32m+[m[32m                <th> Học liệu </th>[m
[32m+[m[32m                <th> Tiêu đề </th>[m
[32m+[m[32m                <th></th>[m
[32m+[m[32m            </tr>';[m
[32m+[m[32m        foreach($LessonDayId_result as $row){[m
[32m+[m[32m            if($row['homework_day'] == $_POST['selected_date']){//nếu ngày của bt giao cùng ngày đã chọn trên lịch[m
[32m+[m[32m                $output .=' <tr style="background-color: #E8E8E8;">[m
[32m+[m[32m                            <td>'.$row['type'].'</td>[m
[32m+[m[32m                            <td>'.$row['title'].'</td>[m
[32m+[m[32m                            <td><a>Chi tiết</a></td>[m
[32m+[m[32m                        </tr>';[m
[32m+[m[32m            }[m
[32m+[m[32m        }[m
[32m+[m[32m        $output .='[m
[32m+[m[32m                </table>[m
[32m+[m[32m                <div style="text-align: center">[m
[32m+[m[32m                    <button onclick="addHomeworkModal('.$_POST['lesson_day_id'].', \''.$Selected_date.'\')" type="button" class="btn btn-primary"><i class="fa-solid fa-book"></i> Thêm học liệu</button>[m
[32m+[m[32m                </div>[m
[32m+[m[32m            </div>';[m
     }else{[m
[31m-        $output .=' <div style="text-align: center">[m
[31m-                        <button onclick="addHomeworkModal('.$_POST['lesson_day_id'].')" type="button" class="btn btn-primary"><i class="fa-solid fa-book"></i> Thêm học liệu</button>[m
[32m+[m[32m        $output .=' <table style="text-align: center" class="table table-bordered">[m
[32m+[m[32m                        <tr class="title_style">[m
[32m+[m[32m                            <th> Học liệu </th>[m
[32m+[m[32m                            <th> Tiêu đề </th>[m
[32m+[m[32m                            <th></th>[m
[32m+[m[32m                        </tr>[m
[32m+[m[32m                    </table>[m
[32m+[m[32m                    <div style="text-align: center">[m
[32m+[m[32m                        <button onclick="addHomeworkModal('.$_POST['lesson_day_id'].', \''.$Selected_date.'\')" type="button" class="btn btn-primary"><i class="fa-solid fa-book"></i> Thêm học liệu</button>[m
                     </div>[m
[31m-                </div>';[m
[32m+[m[32m            </div>';[m
     }[m
     echo $output;[m
 }[m
[1mdiff --git a/teacher/manage_schedule/schedule_page.php b/teacher/manage_schedule/schedule_page.php[m
[1mindex 642dad4..6d3a501 100644[m
[1m--- a/teacher/manage_schedule/schedule_page.php[m
[1m+++ b/teacher/manage_schedule/schedule_page.php[m
[36m@@ -76,6 +76,8 @@[m
         selectHelper: true,[m
         dayMaxEvents: true,[m
         eventClick: function(calEvent, jsEvent, view) {  [m
[32m+[m[32m          var selectedDate = calEvent.event.start;[m
[32m+[m[32m          var formattedDate = moment(selectedDate).format('YYYY-MM-DD');[m
           $.ajax({[m
             url: "manage_schedule/schedule_details.php",[m
             method: 'post',[m
[36m@@ -90,6 +92,7 @@[m
               start_time: calEvent.event.extendedProps.start_time,[m
               end_time: calEvent.event.extendedProps.end_time,[m
               lesson_day_id: calEvent.event.extendedProps.lessonDay_id,[m
[32m+[m[32m              selected_date: formattedDate,[m
             },[m
             success: function(result) {[m
               myModal = new bootstrap.Modal(document.getElementById('calendarDetails'));[m
[36m@@ -144,12 +147,13 @@[m
 getEvent();[m
 </script>[m
 <script>[m
[31m-  function addHomeworkModal(id) {[m
[32m+[m[32m  function addHomeworkModal(id, day) {[m
     $.ajax({[m
       url: "manage_schedule/add_homework_modal.php",[m
       method: 'post',[m
       data: {[m
[31m-        lesson_day_id: id[m
[32m+[m[32m        lesson_day_id: id,[m
[32m+[m[32m        homework_day: day,[m
       },[m
       success: function(result) {[m
         $(".add-homework-body").html(result);[m

[33mcommit dd1aa4c95fa1a123111588cc37592298a30c4a3d[m
Author: huuhuan2904 <huuhuan2942002@gmail.com>
Date:   Thu Apr 25 18:15:47 2024 +0700

    add

[1mdiff --git a/teacher/class_management/teaching_class_modal.php b/teacher/class_management/teaching_class_modal.php[m
[1mindex d4fee1b..ca52d0c 100644[m
[1m--- a/teacher/class_management/teaching_class_modal.php[m
[1m+++ b/teacher/class_management/teaching_class_modal.php[m
[36m@@ -19,7 +19,6 @@[m
                             <th> Địa chỉ </th>[m
                             <th> Số điện thoại </th>[m
                             <th> Dân tộc </th>[m
[31m-                            <th> Email </th>[m
                         </tr>';[m
                             if(mysqli_num_rows($Assignment_result) > 0){[m
                                 foreach($Assignment_result as $row)[m
[1mdiff --git a/teacher/manage_schedule/add_homework.php b/teacher/manage_schedule/add_homework.php[m
[1mnew file mode 100644[m
[1mindex 0000000..7c81149[m
[1m--- /dev/null[m
[1m+++ b/teacher/manage_schedule/add_homework.php[m
[36m@@ -0,0 +1,33 @@[m
[32m+[m[32m<?php[m
[32m+[m[32m$conn = mysqli_connect("localhost","root","","final_project") or die($conn);[m
[32m+[m
[32m+[m[32mif(isset($_FILES['file']) && $_FILES['file']['error'] == 0) {[m
[32m+[m[32m    $LessonDay_id = $_POST['lesson_day_id'];[m
[32m+[m[32m    $Type = $_POST['type'];[m
[32m+[m[32m    $Title = $_POST['title'];[m
[32m+[m[32m    $Start_date = $_POST['start_date'];[m
[32m+[m[32m    $End_date = $_POST['end_date'];[m
[32m+[m[32m    $Content = $_POST['content'];[m
[32m+[m
[32m+[m[32m    $targetDir = "uploads/";[m
[32m+[m
[32m+[m[32m    $fileName = basename($_FILES["file"]["name"]);[m
[32m+[m[32m    $targetPath = $targetDir.$fileName;[m
[32m+[m
[32m+[m[32m    if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetPath)){[m
[32m+[m[32m        $sql = "INSERT INTO homework (lesson_day_id, type, title, file_name, file_path, content, start_date, end_date)[m[41m [m
[32m+[m[32m        VALUES ('$LessonDay_id', '$Type', '$Title', '$fileName', '$targetPath', '$Content', '$Start_date', '$End_date')";[m
[32m+[m[32m        if($conn->query($sql) == true){[m
[32m+[m[32m            echo "da upload va luu vao db";[m
[32m+[m[32m        }else{[m
[32m+[m[32m            echo "Error: ".$sql." Error details: ".$conn->error;[m
[32m+[m[32m        }[m
[32m+[m[32m    }else{[m
[32m+[m[32m        echo "Error moving the file";[m
[32m+[m[32m    }[m
[32m+[m[32m}else{[m
[32m+[m[32m    echo $_FILES['file']['error'];[m
[32m+[m[32m}[m
[32m+[m
[32m+[m
[32m+[m[32m?>[m
\ No newline at end of file[m
[1mdiff --git a/teacher/manage_schedule/add_homework_modal.php b/teacher/manage_schedule/add_homework_modal.php[m
[1mnew file mode 100644[m
[1mindex 0000000..1cb32dd[m
[1m--- /dev/null[m
[1m+++ b/teacher/manage_schedule/add_homework_modal.php[m
[36m@@ -0,0 +1,57 @@[m
[32m+[m[32m<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>[m
[32m+[m[32m<?php[m
[32m+[m[32m$conn = mysqli_connect("localhost","root","","final_project") or die($conn);[m
[32m+[m[32m$output = '';[m
[32m+[m[32m$output .='<div style="padding: 10px 30px 60px 30px">[m
[32m+[m[32m            <form action="manage_schedule/add_homework.php" method="POST" enctype="multipart/form-data">[m
[32m+[m[32m                <input type="hidden" name="lesson_day_id" id="lesson_day_id" value='.$_POST['lesson_day_id'].'>[m
[32m+[m[32m                <div class="form-group">[m
[32m+[m[32m                    <label for="type"><b>Loại học liệu</b></label>[m
[32m+[m[32m                    <select name="type" class="form-control" id="type">[m
[32m+[m[32m                        <option disabled selected>Học liệu</option>[m
[32m+[m[32m                        <option>Bài giảng</option>[m
[32m+[m[32m                        <option>Bài tập</option>[m
[32m+[m[32m 