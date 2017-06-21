<style type="text/css">
#boone-current-date {
	margin: 24px 0;
}
div.boone-system-date {
	width: 100%;
	overflow: hidden;
	text-align:center;
	color: #7F7F7F;
}
div.boone-system-date li {
	display:inline;
	font-size: 2.4em;
	font-weight: 700;
}

#point {
	position:relative;
	-moz-animation:mymove 1s ease infinite;
	-webkit-animation:mymove 1s ease infinite;
	padding-left:8px;
	padding-right:8px;
}

@-webkit-keyframes mymove 
{
	0% {opacity:1.0;}
	50% {opacity:0; text-shadow:none; }
	100% {opacity:1.0; }
}

@-moz-keyframes mymove 
{
	0% {opacity:1.0;}
	50% {opacity:0; text-shadow:none; }
	100% {opacity:1.0; }	
	}
</style>
<div class="card-bolck">
	<div class="row">
		<div class="col-xs-6">
			<span class="btn btn-secondary-outline btn-block" data-toggle="tooltip" data-placement="top" title="使用设备">
				<?php echo $this->agent->platform() ?>
			</span>
		</div>
		<div class="col-xs-6">
			<span class="btn btn-secondary-outline btn-block" data-toggle="tooltip" data-placement="top" title="浏览器">
				<?php echo $this->agent->browser() ?>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div id="boone-current-date" class="btn btn-secondary-outline btn-lg btn-block">
			</div>
			<div class='boone-system-date'>
				<li id='hours'></li>
				<li id='point'>:</li>
				<li id='min'></li>
				<li id='point'>:</li>
				<li id='sec'></li>
			</div>
		</div>
	</div>
	<span class="card-corner card-corner-success"></span>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	// Create two variable with the names of the months and days in an array
	var monthNames = [ '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ]; 
	var dayNames= ['星期一','星期二','星期三','星期四','星期五','星期六','星期日']

	// Create a newDate() object
	var newDate = new Date();
	// Extract the current date from Date object
	newDate.setDate(newDate.getDate());
	// Output the day, date, month and year    
	$('#boone-current-date').html(
		newDate.getFullYear() + ' - ' +
		monthNames[newDate.getMonth()] + ' - ' +
		newDate.getDate() + ' &nbsp; ' + 
		dayNames[newDate.getDay()]
	);

	setInterval( function()
	{
		// Create a newDate() object and extract the seconds of the current time on the visitor's
		var seconds = new Date().getSeconds();
		// Add a leading zero to seconds value
		$('#sec').html(( seconds < 10 ? '0' : '') + seconds);
	},100);
		
	setInterval( function()
	{
		// Create a newDate() object and extract the minutes of the current time on the visitor's
		var minutes = new Date().getMinutes();
		// Add a leading zero to the minutes value
		$('#min').html(( minutes < 10 ? '0' : '') + minutes);
	},100);
		
	setInterval( function()
	{
		// Create a newDate() object and extract the hours of the current time on the visitor's
		var hours = new Date().getHours();
		// Add a leading zero to the hours value
		$('#hours').html(( hours < 10 ? '0' : '') + hours);
	}, 100);
	
}); 
</script>