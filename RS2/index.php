<!DOCTYPE html>

<!--
  COLLABORATORS:
  I did not discuss the assignment with anyone
-->
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Overview</title>
<link rel="stylesheet" type="text/css" href="mainLayout.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">  
///////////////////////////////////////
/// Experiment variables

var trial_size = 4;

///////////////////////////////////////

$(document).ready(function() {
	$('#tasks').val(trial_size);
	$('#name').focus();
	//$("#submit").click(function(evt) {
		//var name = $("#fname").val();
		//window.location = "control.html?name=" + name + "&tasks=" + trial_size + "&trial=true";
    //});
});
</script>

</head>

<body>	
<p>Welcome to EPHEMERAL ADAPTATION Study! Please, answer some questions about yourself:</p>
<form action="control.php" method="get">
	<div class="label">Name:</div> 
	<div class="input"><input type="text" name="name" id="name"/></div>
	<div class="label">Gender:</div>
	<div class="input">
		<input type="radio" name="sex" value="male" checked />Male<br>
		<input type="radio" name="sex" value="female"/>Female
	</div>
	<p>Next you will be asked to select items within different menus. In the first part of the study, you will work with static menus and in the second part of the study, you will work with adaptive menus. Before each session, you will be asked to complete a short 8 practice block of selections to familiarize yourself with the menus behavior before completing a longer 126-trial task blocks for each menu type</p>
	<input type="text" name="tasks" id="tasks"  hidden />
	<input type="text" name="trial" value="true" hidden />
	<div class="label"><input id="submit" type="submit" value="Submit"/></div>	
</form>

</body>

</html>
