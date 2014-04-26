<!DOCTYPE html>

<!--
  COLLABORATORS:
  I did not discuss the assignment with anyone
-->
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Survey</title>
<link rel="stylesheet" type="text/css" href="mainLayout.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">  
//This script extracts parameters from the URL
//from jquery-howto.blogspot.com
$.extend({
	getUrlVars : function() {
		var vars = [], hash;
		var hashes = window.location.href.slice(
				window.location.href.indexOf('?') + 1).split('&');
		for ( var i = 0; i < hashes.length; i++) {
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	},
	getUrlVar : function(name) {
		return $.getUrlVars()[name];
	}
}); 
if ($.getUrlVar('type')) {
    	var control = true;
	var message = "Thank you for completing control part of the study. Please, answer the following questions and hit Submit button to move to the ephemeral part of the study!\Ephemeral study will test andaptive menus, in which some of the menu items would appear sooner than others. The items that will appear sooner are the items that the system predicted would be most likely needed by you.";
} else {
	var control = false;
	var message = "Thank you for completing ephemeral part of the study. Please, answer the following questions about the study!";
}
if ($.getUrlVar('name')) {
    	var name = $.getUrlVar('name');
}
///////////////////////////////////////
/// Experiment variables

var trial_size = 4;

///////////////////////////////////////
$(document).ready(function() {
	$('#message').text(message);
	if (!control) {
		$(".survey").css("visibility", "visible");
	} else {
		$("#button").animate({top:'600px'});
	}
	$('#tasks').val(trial_size);
	$('#name').val(name);
	if (!control) {
		$('#ephemeral_survey').attr("action", "end.php");
	}
	
	/**$("#submit").click(function(evt) {
		if (control) {
			window.location = "ephemeral.html?trial=true&tasks=" + trial_size;
		} else {
			window.location = "end.html";
		}
		
    });**/
});
</script>

</head>

<body>
<div class="task"><span id="message"></span></div>
<form id="ephemeral_survey" action="ephemeral.php" method="get">
	<div class="survey">It was easy to find required values</div> 
	<div class="survey">
		<input type="radio" name="easy" value="strongly_agree" checked/>Strongly Agree<br/>
		<input type="radio" name="easy" value="agree"/>Agree<br/>
		<input type="radio" name="easy" value="agree_some"/>Agree Somewhat<br/>
		<input type="radio" name="easy" value="neutral"/>Neutral<br/>
		<input type="radio" name="easy" value="disagree_some"/>Disagree Somewhat<br/>
		<input type="radio" name="easy" value="disagree"/>Disagree<br/>
		<input type="radio" name="easy" value="strongly_disagree"/>Strongly Disagree<br/>
	</div> 
	<div class="survey">I didn't have difficulty using menus </div> 
	<div class="survey">
		<input type="radio" name="struggle" value="strongly_agree" checked/>Strongly Agree<br/>
		<input type="radio" name="struggle" value="agree"/>Agree<br/>
		<input type="radio" name="struggle" value="agree_some"/>Agree Somewhat<br/>
		<input type="radio" name="struggle" value="neutral"/>Neutral<br/>
		<input type="radio" name="struggle" value="disagree_some"/>Disagree Somewhat<br/>
		<input type="radio" name="struggle" value="disagree"/>Disagree<br/>
		<input type="radio" name="struggle" value="strongly_disagree"/>Strongly Disagree<br/>
	</div> 
	<div class="survey">I use pull-down menus often</div> 
	<div class="survey">
		<input type="radio" name="frequency" value="strongly_agree" checked/>Strongly Agree<br/>
		<input type="radio" name="frequency" value="agree"/>Agree<br/>
		<input type="radio" name="frequency" value="agree_some"/>Agree Somewhat<br/>
		<input type="radio" name="frequency" value="neutral"/>Neutral<br/>
		<input type="radio" name="frequency" value="disagree_some"/>Disagree Somewhat<br/>
		<input type="radio" name="frequency" value="disagree"/>Disagree<br/>
		<input type="radio" name="frequency" value="strongly_disagree"/>Strongly Disagree<br/>
	</div> 
	<div class="survey not_visible">The adaptive menus are distinctive from other menus I usually use </div> 
	<div class="survey not_visible">
		<input type="radio" name="distinctive" value="strongly_agree" checked/>Strongly Agree<br/>
		<input type="radio" name="distinctive" value="agree"/>Agree<br/>
		<input type="radio" name="distinctive" value="agree_some"/>Agree Somewhat<br/>
		<input type="radio" name="distinctive" value="neutral"/>Neutral<br/>
		<input type="radio" name="distinctive" value="disagree_some"/>Disagree Somewhat<br/>
		<input type="radio" name="distinctive" value="disagree"/>Disagree<br/>
		<input type="radio" name="distinctive" value="strongly_disagree"/>Strongly Disagree<br/>
	</div> 
	<div class="survey not_visible">The adaptive menus are more helpful than static menus (tested in control part)</div> 
	<div class="survey not_visible">
		<input type="radio" name="helpful" value="strongly_agree" checked/>Strongly Agree<br/>
		<input type="radio" name="helpful" value="agree"/>Agree<br/>
		<input type="radio" name="helpful" value="agree_some"/>Agree Somewhat<br/>
		<input type="radio" name="helpful" value="neutral"/>Neutral<br/>
		<input type="radio" name="helpful" value="disagree_some"/>Disagree Somewhat<br/>
		<input type="radio" name="helpful" value="disagree"/>Disagree<br/>
		<input type="radio" name="helpful" value="strongly_disagree"/>Strongly Disagree<br/>
	</div> 
	<div class="survey not_visible">It was distracting that some menu items appeared before others</div> 
	<div class="survey not_visible">
		<input type="radio" name="distract" value="strongly_agree" checked/>Strongly Agree<br/>
		<input type="radio" name="distract" value="agree"/>Agree<br/>
		<input type="radio" name="distract" value="agree_some"/>Agree Somewhat<br/>
		<input type="radio" name="distract" value="neutral"/>Neutral<br/>
		<input type="radio" name="distract" value="disagree_some"/>Disagree Somewhat<br/>
		<input type="radio" name="distract" value="disagree"/>Disagree<br/>
		<input type="radio" name="distract" value="strongly_disagree"/>Strongly Disagree<br/>
	</div> 
	<div class="survey not_visible">In general I would prefer to use:</div> 
	<div class="survey not_visible">
		<input type="radio" name="prefer" value="static"/>Static Menus<br/>
		<input type="radio" name="prefer" value="adaptive" checked/>Adaptive Menus<br/>
	</div>
	<input type="text" name="name" id="name" hidden />
	<input type="text" name="tasks" id="tasks"  hidden />
        <input type="text" name="trial" value="true" hidden /> 
	<div id="button" class="survey"><input type="submit" value="Submit"/></div>	
</form>

</body>

</html>
