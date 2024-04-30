<?php
$conn = mysqli_connect("localhost","root","","final_project") or die($conn);

$output = '';
$output .="  <div id='OnlClassCalendar'></div>";
echo $output;
?>

<script type="text/javascript">
  function getEvent(){
  $.ajax({
    url: "manage_schedule/get_data.php",
    type: 'POST',
    dataType: "json",
    success: function(data) {
      var result = data;
      var calendarEl = document.getElementById('OnlClassCalendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '<?=date('Y-m-d')?>',
        height: 600,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        selectable: true,
        selectHelper: true,
        dayMaxEvents: true,
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
      setTimeout(() => {
        calendar.render(); 
      }, 145);
    }
  });
}
getEvent();
</script>

