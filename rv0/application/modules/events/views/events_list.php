<link rel='stylesheet' href='<?php echo ASSETS;?>assets/css/jquery-ui.min.css' />
<link href='<?php echo ASSETS;?>assets/css/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo ASSETS;?>assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo ASSETS;?>assets/js/moment.min.js'></script>
<script src='<?php echo ASSETS;?>assets/js/fullcalendar.min.js'></script>
<div class="main-content events-page">
  <div class="col-lg-12">
    <div class="page-header">
      <h1>Events</h1>
    </div>
  </div>
  <div class="members-directory">
    <div class="members-count col-lg-12">
      <div class="grid-container"><a class="disabled btn cal-icon" href="<?php echo base_url();?>events"><i class="fa fa-calendar" aria-hidden="true"></i></a> <a class="list-icon" href="<?php echo base_url();?>events/gridView"><i class="fa fa-list" aria-hidden="true"></i> </a> </div>
    </div>
  </div>
  <div id='calendar'></div>
</div>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: new Date(),
			editable: true,
			eventLimit: true, 
			timeFormat: 'H(:mm)',// allow "more" link when too many events
			events: /*[
				{
					title: 'All Day Event',
					start: '2016-01-01'
				},
				{
					title: 'Long Event',
					start: '2016-01-07',
					end: '2016-01-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2016-01-11',
					end: '2016-01-13'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T10:30:00',
					end: '2016-01-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2016-01-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2016-01-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2016-01-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2016-01-13T07:00:00'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-01-28'
				}
			]*/
			<?php echo $events;?>
		});
		
	});

</script> 
