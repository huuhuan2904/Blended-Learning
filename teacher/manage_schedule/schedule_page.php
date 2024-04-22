<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<style>
    html,body{
    height: 100%;
    font-family: 'Ubuntu', sans-serif;
}

.mynav{
    color: #fff;
}

.mynav li a {
    color: #fff;
    text-decoration: none;
    width: 100%;
    display: block;
    border-radius: 5px;
    padding: 8px 5px;
}

.mynav li a.active{
    background: rgba(255,255,255,0.2);
}

.mynav li a:hover{
    background: rgba(255,255,255,0.2);
}

.mynav li a i{
    width: 25px;
    text-align: center;
}

.notification-badge{
    background-color: rgba(255,255,255,0.7);
    float: right;
    color: #222;
    font-size: 14px;
    padding: 0px 8px;
    border-radius: 2px;
}
</style>
<body>
  <div id='calendar'></div>
</body>
</html>

<script type="text/javascript">
  function getEvent(){
  $.ajax({
    url: "manage_schedule/get_data.php?type=list",
    type: 'POST',
    dataType: "json",
    success: function(data) {
      var result = data;
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '<?=date('Y-m-d')?>',
        height: 625,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        selectable: true,
        selectHelper: true,
        dayMaxEvents: true,
        // eventClick: function(calEvent, jsEvent, view) {  
        //   $.ajax({
        //     url: "calendar/calendar_details.php",
        //     method: 'post',
        //     data: {
        //       class_name: calEvent.event.extendedProps.class_name,
        //       day_name: calEvent.event.extendedProps.day_name,
        //       lesson_name: calEvent.event.extendedProps.lesson_name,
        //       subject_name: calEvent.event.extendedProps.subject_name,
        //       teacher_name: calEvent.event.extendedProps.teacher_name,
        //       status: calEvent.event.extendedProps.status,
        //       start_date: calEvent.event.extendedProps.start_date,
        //       end_date: calEvent.event.extendedProps.end_date,
        //       start_time: calEvent.event.extendedProps.start_time,
        //       end_time: calEvent.event.extendedProps.end_time,
        //     },
        //     success: function(result) {
        //       myModal = new bootstrap.Modal(document.getElementById('calendarDetails'));
        //       myModal.show();
        //       $(".calendar-modal-body").html(result);
        //     }
        //   })
        // },
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
            title: eventData.lesson_name,
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