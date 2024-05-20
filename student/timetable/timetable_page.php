<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
  <style>
    .modal-backdrop.show{
      display: none !important;
    }
  </style>
    <div id='calendar'></div>
      <!-- Modal -->
    <div class="modal" id="calendarDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div style="max-width: 800px; width: 90%;" class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Chi tiết lịch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <!-- modal body -->
                <div class="schedule-modal-body">
                            
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
  function getEvent(){
  $.ajax({
    url: "timetable/get_data.php?type=list",
    type: 'POST',
    dataType: "json",
    success: function(data) {
      var result = data;
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        customButtons: {
          timetableDetails: {
            text: 'Thời khóa biểu',
            click: function() {
              var jsonData = JSON.stringify(data);//chuyển data thành json
              $.ajax({
              url: "timetable/timetable_details.php",
              type: 'POST',
              dataType: "html",
              data: {jsonData: jsonData},
              success: function(result) {
                myModal = new bootstrap.Modal(document.getElementById('calendarDetails'));
                myModal.show();
                $(".schedule-modal-body").html(result);
              },
            });
            }
          },
        },
        initialView: 'dayGridMonth',
        locale: 'vi',
        initialDate: '<?=date('Y-m-d')?>',
        height: 600,
        headerToolbar: {
          left: 'prev,next timetableDetails today',
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
          var selectedDate = calEvent.event.start;
          var formattedDate = moment(selectedDate).format('YYYY-MM-DD');
          $.ajax({
            url: "timetable/lesson_details.php",
            method: 'post',
            data: {
              teacher_name: calEvent.event.extendedProps.teacher_name,
              day_name: calEvent.event.extendedProps.day_name,
              lesson_name: calEvent.event.extendedProps.lesson_name,
              subject_name: calEvent.event.extendedProps.subject_name,
              status: calEvent.event.extendedProps.status,
              start_time: calEvent.event.extendedProps.start_time,
              end_time: calEvent.event.extendedProps.end_time,
              lesson_day_id: calEvent.event.extendedProps.lessonDay_id,
              selected_date: formattedDate,
            },
            success: function(result) {
              $('#calendarDetails').modal('show');
              $(".schedule-modal-body").html(result);
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
            title: eventData.subject_name,
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

