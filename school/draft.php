<div class="input-field">
                        <label>Học sinh</label>
                        <?php 
                            $sql = "SELECT id, last_name, first_name FROM students order by first_name";
                            $result = $conn->query($sql);
                            echo "<select id='studentSelect' name='studentSelect' required>
                            <option disabled selected>Chọn học sinh</option>";
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['last_name'] .' '. $row['first_name'] . "</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            echo "</select>";
                        ?>
                    </div>

                    <?php 

                            if(mysqli_num_rows($class_id) > 0){

                            }else{
                                $result = $conn->query($sql);
                                echo "<select id='teacherSelect' name='teacherSelect' required>
                                <option disabled selected>Chọn giáo viên</option>";
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                echo "</select>";
                            }

                            
                        ?>





<form action="add_assignment.php" method="POST">
                                <label for="classes">Lớp học</label>
                                <select name="classes[]" id="classes" multiple>
                                    <?php foreach($class_query as $class_row): ?>
                                    <option value="<?php echo $class_row['id']; ?>"><?php echo $class_row['class_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>     
                                <button id="submit" class="submit">Xác nhận</button>
                            </form>



                            <select name="" id="">
                                                        <option disabled selected>Môn học</option>
                                                        <?php foreach($subjects_query as $subject_row): ?>
                                                            <option value="<?php echo $subject_row['id']; ?>"><?php echo $subject_row['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>


                                                    

                                                    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      initialDate: '2024-04-08',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
      },
    });

    var startDate = '2024-04-08';
    var endDate = '2024-04-15';
    var startTime = '7:10:00';
    var endtTime = '7:55:00';

    var currentDate = moment(startDate).startOf('day');
    var endTime = moment(endDate).endOf('day');
    //tách time bắt đầu
    var timeParts = startTime.split(':');
    var startHour = parseInt(timeParts[0]);
    var startMinute = parseInt(timeParts[1]);
    var startSecond = parseInt(timeParts[2] || 0);
    //tách time kết thúc
    var timeParts = endtTime.split(':');
    var endHour = parseInt(timeParts[0]);
    var endMinute = parseInt(timeParts[1]);
    var endSecond = parseInt(timeParts[2] || 0);

    while (currentDate <= endTime) {
      if(currentDate.day() !== 0){
        var startDateTime = moment(currentDate).set({ 'hour': startHour, 'minute': startMinute, 'second': startSecond });
        var endDateTime = moment(currentDate).set({ 'hour': endHour, 'minute': endMinute, 'second': endSecond });

        calendar.addEvent({
          title: 'Sự kiện',
          start: startDateTime.format(),
          end: endDateTime.format(),
          url: 'https://google.com/'
        });
      }
      currentDate.add(1, 'days');
    }
      calendar.render(); 
  });
</script>


$output .=' </table>
                <label>Tiết học</label>
                <select name="lessons" id="lessons" required>
                    <option disabled selected>Chọn tiết học</option>';
                        foreach($Lessons as $class_row) {
                            $output .='<option value='.$class_row['id'].'>'.$class_row['name'].' ( '.$class_row['start_time'].' -> '.$class_row['end_time'].' )</option>';
                        }
        $output .=' </select>
                    <label>Buổi học</label>
                    <select name="day[]" id="day" required multiple>
                        <option value = 1>Thứ 2</option>
                        <option value = 2>Thứ 3</option>
                        <option value = 3>Thứ 4</option>
                        <option value = 4>Thứ 5</option>
                        <option value = 5>Thứ 6</option>
                        <option value = 6>Thứ 7</option>
                    </select>
                </form>';


                <div class="input-field">
                        <label>Tiết học</label>
                        <select name="lessons" id="lessons" required>
                            <option disabled selected>Chọn tiết học</option>
                            <?php
                              foreach($Lessons as $class_row) {?> 
                                <option value=<?php echo $class_row['id']?>>
                                  <?php echo $class_row['name']. ' (' .$class_row['start_time']. ' ->' .$class_row['end_time']. ')';?></option>
                              <?php
                              }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Ngày học</label>
                        <select name="day[]" id="day" required multiple>
                            <option value = '1'>Thứ 2</option>
                            <option value = '2'>Thứ 3</option>
                            <option value = '3'>Thứ 4</option>
                            <option value = '4'>Thứ 5</option>
                            <option value = '5'>Thứ 6</option>
                            <option value = '6'>Thứ 7</option>
                        </select>
                    </div>


                    // $DaysAssignment_result = mysqli_query($conn,'SELECT id as dayAssId from days_assignment where assignment_id = '.$_POST["assignmentId"].'');
        // $Days_id = array();
        // $DaysAssignment_id = array();

        // $output .= '
        //         <table style="text-align: center" class="table">
        //             <thead>
        //             <tr class="title_style">
        //                 <th> Học liệu </th>
        //                 <th> Tiêu đề </th>
        //                 <th> Nội dung </th>
        //                 <th> Ngày bắt đầu </th>
        //                 <th> Ngày kết thúc </th>
        //                 <th> Giao ngày </th>
        //                 <th> Thao tác </th>
        //             </tr>
        //             </thead>';
        //     foreach($DaysAssignment_result as $row){
        //         if($row['dayAssId']){
        //             $LessonDay_result = mysqli_query($conn,'SELECT id as lessonDayId from lesson_day where days_ass_id = '.$row['dayAssId'].'');
        //             foreach($LessonDay_result as $row2){
        //                 if($row2['lessonDayId']){
        //                     $Homework_result = mysqli_query($conn,'SELECT * from homework where lesson_day_id  = '.$row2['lessonDayId'].'');
        //                     foreach($Homework_result as $row3){
        //                         $output .='
        //                         <tbody>
        //                             <tr>
        //                                 <td>'.$row3['type'].'</td>
        //                                 <td>'.$row3['title'].'</td>
        //                                 <td>'.$row3['content'].'</td>';
        //                                 if($row3['start_date'] == '0000-00-00'){
        //                                     $output .='
        //                                         <td></td>
        //                                         <td></td>';
        //                                 }else{
        //                                     $output .='       
        //                                         <td>'.$row3['start_date'].'</td>
        //                                         <td>'.$row3['end_date'].'</td>';
        //                                 }
        //                                 $output .='
        //                                 <td>'.$row3['homework_day'].'</td>
                                        
        //                                 <td>
        //                                     <div class="btn-group">
        //                                         <button type="button" class="btn btn-secondary dropdown-toggle-split" type="button" data-bs-toggle="dropdown">
        //                                             <i class="fa-solid fa-gear"></i>
        //                                         </button>
        //                                         <div class="dropdown-menu">
        //                                             <a><button type="button" class="dropdown-item" onclick="editHomework('.$row3['id'].')"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
        //                                             <a><button type="button" class="dropdown-item" onclick="deleteHomework('.$row3['id'].')"><i class="fa-solid fa-trash"></i> Xóa</button></a>
        //                                             <a>
        //                                                 <form action="index.php?page=homework_details" method="POST">
        //                                                     <input type="hidden" name="homeworkId" id="homeworkId" value="'.$row3['id'].'">
        //                                                     <input type="hidden" name="classId" id="classId" value="'.$_POST["classId"].'">
        //                                                     <button type="submit" class="dropdown-item"><i class="fa-solid fa-magnifying-glass"></i> Chi tiết</button>
        //                                                 </form>
        //                                             </a>
        //                                         </div>
        //                                     </div>
        //                                 </td>
        //                             </tr>
        //                         </tbody>';
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // $output .=' </table>';