<!DOCTYPE html>
<html>

<?php
  $conn = mysqli_connect("localhost","root","","final_project") or die($conn);
  $Classes = mysqli_query($conn,"SELECT * from class");
  
?>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Quản trị nhà trường</title>
    <!-- Calendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome style -->
    <link rel="stylesheet" type="text/css" href="../../css/font-awesome.min.css" />

    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="input-field" style="text-align: right;">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSchedule">Thêm lịch học</button>
    </div>
    <div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div style="max-width: 800px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Lịch học</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- modal body -->
      <div class="modal-body">
        <div class="container ">
          <form id="createSchedule">
            <div class="form first">
                <div class="fields">
                    <div class="input-field">
                        <label>Lớp học</label>
                        <select name="classes" id="classes" onchange="selectedClass(value);" required>
                            <option disabled selected>Chọn lớp học</option>
                            <?php
                              foreach($Classes as $class_row) {?> 
                                <option value=<?php echo $class_row['id']?>>
                                  <?php echo $class_row['class_name']?></option>
                              <?php
                              }
                            ?>
                        </select>
                    </div>
                    <div class="input-field"><div class="assignmentTable"></div></div>
                    <div class="input-field"><div class="day"></div></div>
                    <div class="input-field"><div class="lesson"></div></div>
                    <div class="input-field">
                        <label>Hình thức</label>
                        <select name="status" id="status" required>
                            <option value = '0' selected>Trực tiếp</option>
                            <option value = '1'>Trực tuyến</option>
                        </select>
                    </div>
                </div>
                <div style="text-align: right" class="right-button">
                    <button type="button" id="submit" class="submit">Xác nhận</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="calendarDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div style="max-width: 800px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Chi tiết lịch</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- modal body -->
                    <div class="calendar-modal-body">
                        
                    </div>
                </div>
            </div>
        </div>

<div id='calendar'></div>
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
  <script>
      new MultiSelectTag('day')  // id
  </script>
</body>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
<!-- <script>
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
  var startDateTime = '7:10:00';
  var endDateTime = '7:55:00';

  var currentDate = moment(startDate).startOf('day');
  var endTime = moment(endDate).endOf('day');

  function createEvent(startHour, startMinute, endHour, endMinute) {
    var startDateTime = moment(currentDate).set({ 'hour': startHour, 'minute': startMinute });
    var endDateTime = moment(currentDate).set({ 'hour': endHour, 'minute': endMinute });
    calendar.addEvent({
      title: 'Sự kiện',
      start: startDateTime.format(),
      end: endDateTime.format(),
      url: 'https://google.com/'
    });
  }

  while (currentDate <= endTime) {
    if (currentDate.day() !== 0) {
      createEvent(7, 10, 7, 55);
    }
    currentDate.add(1, 'days');
  }

  calendar.render(); 
});
</script> -->
<script>
  function selectedClass(classId){
    $.ajax({
      url: "calendar/selected_class.php",
      method: 'post',
      data: {
          class_id: classId
      },
      success: function(result) {
        $(".assignmentTable").html(result);
      }
    })
}
</script>
<script>
  function selectedTeacher(assignmentId, assignmentArr){
    $.ajax({
      url: "calendar/selected_teacher.php",
      method: 'post',
      data: {
        assignment_id: assignmentId,
        assignment_arr: assignmentArr
      },
      success: function(result) {
        $(".day").html(result);
      }
    })
}
</script>
<script>
  function selectedDay(assignmentId, dayId, assignmentArr){
    $.ajax({
      url: "calendar/selected_day.php",
      method: 'post',
      data: {
        assignment_id: assignmentId,
        day_id: dayId,
        assignment_arr: assignmentArr
      },
      success: function(result) {
        $(".lesson").html(result);
      }
    })
}
</script>
<script>
  $('#submit').on('click', function(){
    var array = {
      'assignmentId': $('input[name="checkbox"]:checked').val(),
      'day': $('#day').val(),
      'lesson': $('#lessons').val(),
      'status': $('#status').val(),
      'startDate': $('#startDate').val(),
      'endDate': $('#endDate').val(),
    };
    console.log(array);
    $.ajax({
      url: "calendar/create_schedule.php",
      method: 'post',
      data: {
        arrayData: array
      },
      success: function(result) {
        window.location.href = "./index.php?page=calendar_management";
      }
    })
});
</script>

</script>
<script type="text/javascript">
  function getEvent(){
  $.ajax({
    url: "calendar/get_calendar_data.php?type=list",
    type: 'POST',
    dataType: "json",
    success: function(data) {
      var result = data;
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        locale: 'vi',
        initialDate: '<?=date('Y-m-d')?>',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        buttonText: {
            today: 'Hôm nay',
            month: 'Tháng',
            week: 'Tuần',
            day: 'Ngày'
        },
        locale: {
          code: 'vi',
          allDayText: 'Cả ngày'
        },
        moreLinkText: function(num) {
          return "xem thêm ";
        },
        selectable: true,
        selectHelper: true,
        dayMaxEvents: true,
        eventClick: function(calEvent, jsEvent, view) {  
          $.ajax({
            url: "calendar/calendar_details.php",
            method: 'post',
            data: {
              class_name: calEvent.event.extendedProps.class_name,
              day_name: calEvent.event.extendedProps.day_name,
              lesson_name: calEvent.event.extendedProps.lesson_name,
              subject_name: calEvent.event.extendedProps.subject_name,
              teacher_name: calEvent.event.extendedProps.teacher_name,
              status: calEvent.event.extendedProps.status,
              start_date: calEvent.event.extendedProps.start_date,
              end_date: calEvent.event.extendedProps.end_date,
              start_time: calEvent.event.extendedProps.start_time,
              end_time: calEvent.event.extendedProps.end_time,
            },
            success: function(result) {
              myModal = new bootstrap.Modal(document.getElementById('calendarDetails'));
              myModal.show();
              $(".calendar-modal-body").html(result);
            }
          })
        },
      });

      result.forEach(function(eventData) {
        var startDate = eventData.start_date;
        var endDate = eventData.end_date;
        var startDateTime = eventData.start_time;
        var endDateTime = eventData.end_time;
        var day = eventData.day;

        var currentDate = moment(startDate).startOf('day');
        var endTime = moment(endDate).endOf('day');

        function createEvent(startHour, startMinute, endHour, endMinute) {
          var startDateTime = moment(currentDate).set({ 'hour': startHour, 'minute': startMinute });
          var endDateTime = moment(currentDate).set({ 'hour': endHour, 'minute': endMinute });
          calendar.addEvent({
            title: eventData.class_name,
            start: startDateTime.format(),
            end: endDateTime.format(),
            color: eventData.status == '0' ? '#0099FF' : '#33CC00',
            extendedProps: eventData
          });
        }

        while (currentDate <= endTime) {
          if (day.includes((currentDate.day()).toString())) {
            var startTimeParts = startDateTime.split(':');
            var startHour = parseInt(startTimeParts[0]);
            var startMinute = parseInt(startTimeParts[1]);

            var endTimeParts = endDateTime.split(':');
            var endHour = parseInt(endTimeParts[0]);
            var endMinute = parseInt(endTimeParts[1]);
            createEvent(startHour, startMinute, endHour, endMinute);
          }
          currentDate.add(1, 'days');
        }
      });

      calendar.render(); 
    }
  });
}

getEvent();
</script>

<!-- <script type="text/javascript">
  function getEvent(){
    var events = new Array();
    $.ajax({
      url: "calendar/get_calendar_data.php?type=list",
      type: 'POST',
      dataType: "json",
      success: function(data) {
        var result = data;
        $.each(result, function(i, item){
          events.push({
            event_id: result[i].id,
            title: result[i].class_name,
            start: new Date(result[i].start_date + 'T' + result[i].start_time).toISOString(),
            end: new Date(result[i].end_date + 'T' + result[i].end_time).toISOString()
          });
        });
        
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'timeGridWeek',
          initialDate: '<?=date('Y-m-d')?>',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay',
          },
          events: events
        });
        calendar.render(); 
      }
    });

  }
  getEvent()
</script> -->
