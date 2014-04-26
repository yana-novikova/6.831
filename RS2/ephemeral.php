<!DOCTYPE html>

<!--
  COLLABORATORS:
  I did not discuss the assignment with anyone
-->
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Ephemeral Study</title>

<!-- Load style sheets -->
<link rel="stylesheet" type="text/css" href="mainLayout.css" />
<link rel="stylesheet" type="text/css" href="jquery-ui.css" />

<!-- Load any supplemental Javascript libraries here -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
<script type="text/javascript" src="user_task.js"></script>
<script type="text/javascript" src="array_shuffle.js"></script>
<script type="text/javascript" src="menu.json"></script>

<?
if (array_key_exists('trial', $_GET)){
        $trial = $_GET["trial"];
} else {
        $trial = "";
}
if (!empty($trial)){
	file_put_contents ("result/".$_GET['name'].".txt" , "easy,struggle,frequency,distinctive,helpful,distract,prefer\n", FILE_APPEND);
	file_put_contents ("result/".$_GET['name'].".txt" , $_GET['easy'].",".$_GET['struggle'].",".$_GET['frequency']."\n", FILE_APPEND);
}
?>
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
///////////////////////////////////////
/// Experiment variables

var ephemeral_tasks = 126;
var trial = false;

///////////////////////////////////////

var menus = groups;
var group_length = 4;
var total_groups = 72;
var selection = 8;
var menu_length = 16;
var ZipF_distribution = [15, 8, 5, 4, 3, 3, 2, 2];
var conditionTwo_tasks = [];
var index = 0;
var user = "Test";
var tasks = 0;
var trial = false;
var timeout = 500;
var to_appear = [];
var prediction_accuracy = 0.79;

$(document).ready(function() {
	if ($.getUrlVar('name')) {
		user = $.getUrlVar('name');
	}
	if ($.getUrlVar('tasks')) {
		tasks = $.getUrlVar('tasks');
	}
	if ($.getUrlVar('trial')) {
		trial = true;
	}

	var perms = JSON.parse(sessionStorage.getItem('perms'));
	function createMenu(id) {
		//select 4 random groups and add them to the menu
		var menu_choices = [];
		var counter = 0;
		for (var i = 0; i<menu_length/group_length; i++) {
			var menu_group = Math.floor(Math.random()*total_groups);
			for (var j=0; j<menus[menu_group].length; j++) {
				$("#" + id).append("<li class='white' id='item" + counter + "'><a>" + menus[menu_group][j] + "</a></li>");
				menu_choices[counter] = menus[menu_group][j];
				counter++;
			}
			if (i<(menu_length/group_length-1)) {
				$("#" + id).append("<li></li>");
			}
		}
		return menu_choices;
	}
	/**function generateTaskSequence(id, menu) {
		var selected_items = {};
		var selected_tasks = [];
		for (var i=0; i<selection; i++) {
			var item_choice = Math.floor(Math.random()*menu_length);
			while (item_choice in selected_items) {
				item_choice = Math.floor(Math.random()*menu_length);
			}
				selected_items[item_choice] = "item" + item_choice;
		}
		var i = 0;
		for (var key in selected_items) {
			var task = new Task(id, selected_items[key], menu[key]);
			for (j=0; j<ZipF_distribution[i]; j++) {
				selected_tasks.push(task);
			}
			i++;
		}
		selected_tasks = shuffle(selected_tasks);
		return selected_tasks;
	} **/
	
	function permuteMenus(menu) {
		var options = [];
		if (menu == "menu1") {
			options[0] = "menu2";
			options[1] = "menu3";
		} else if (menu == "menu2") {
			options[0] = "menu1";
			options[1] = "menu3";
		} else if (menu == "menu3") {
			options[0] = "menu1";
			options[1] = "menu2";
		} 
		var item_choice = Math.round(Math.random());
		return options[item_choice];
	}
	
	function prepareConditionTwo() {
		var menu1 = createMenu("menu1");
		var menu2 = createMenu("menu2");
		var menu3 = createMenu("menu3");
		for (var i=0; i<perms.length; i++) {
			perms[i].menu = permuteMenus(perms[i].menu);
			perms[i].display = $('#' + perms[i].menu).children("#" + perms[i].item).find("a").text();
		}
		conditionTwo_tasks = perms;
		conditionTwo_tasks = shuffle(conditionTwo_tasks);
		$( "#menu1" ).menu(
			{select: function(event, ui){
				changeTask(this.id, ui);
			}
		});
		$( "#menu2" ).menu(
			{select: function(event, ui){
				changeTask(this.id, ui);
			}
		});
		$( "#menu3" ).menu(
			{select: function(event, ui){
				changeTask(this.id, ui);
			}
		}); 
		$(".menu_head").click(function(evt) {
			var menu_id = (evt.target.id).split("_head");
			var action = new Date().getTime() + "," + index + ",Menu Click," + menu_id[0] + ",ephemeral"; 
			if (!trial) {
				record_action(action);
			} 
			if ($("#" + menu_id[0]).css("visibility") == "visible") {
				$("#" + menu_id[0]).css("visibility", "hidden");
			} else if ($("#" + menu_id[0]).css("visibility") == "hidden") {
				$("#" + menu_id[0]).css("visibility", "visible");
			}
			for (var j=0; j<to_appear.length; j++) {
				$("#" + menu_id[0]).children("#" + to_appear[j]).removeClass("white");
			}
			setTimeout(function(){$("#" + menu_id[0]).children().removeClass("white")},timeout);
		});
	}
	
	function willHappen(probability) {
		var rando = Math.round(Math.random());
		if (rando < probability) {
			return true;
		} else {
			return false;
		}
	}

	
  	function record_action(action) {
                $.post( "process_responses.php", { file: user + "_study.txt", action: action })
                        .done(function( data ) {
                                console.log( "Data Loaded: " + data );
                        });
        }
	
	function runConditionTwo() {
		
		var message = "Please select " + conditionTwo_tasks[index].display + " from " + conditionTwo_tasks[index].menu + " (Adaptive Task " + (index+1) + "/" + tasks + ")";
		$("#input").text(message);
		var action = new Date().getTime() + "," + index + ",Prompt," + conditionTwo_tasks[index].menu + "," + 
			conditionTwo_tasks[index].item + ",ephemeral"; 
		if (!trial) {
			record_action(action);
		} 
		var random1 = Math.floor(Math.random()*menu_length);
		var random2 = Math.floor(Math.random()*menu_length);
		var random3 = Math.floor(Math.random()*menu_length);
		to_appear[0] = (willHappen? conditionTwo_tasks[index].item:"item"+random1);
		to_appear[1] = "item"+random2;
		to_appear[2] = "item"+random3;
		
	}
	
	var changeTask = function (menu, ui){
		var action = new Date().getTime() + "," + index + ",Item Click," + menu + "," + 
			ui.item.attr('id') + ",ephemeral"; 
		if (!trial) {
			record_action(action);
		} 
		$("#" + menu).css("visibility", "hidden");
		$("#" + menu).children().addClass("white");
		if (conditionTwo_tasks[index].display == ui.item.find("a").text()) {
			index++;
		}
		if (index < tasks) {
			runConditionTwo();
		}
		if (index == tasks) {
			if (trial) {
				alert("Thank you for completing the trial! Now let's move on to the actual test!");
				window.location = "ephemeral.php?name=" + user + "&tasks=" + ephemeral_tasks;
			} else {
				window.location = "survey.php?name=" + user;
			}
		}
	}

	prepareConditionTwo();
	runConditionTwo();
	
});

  
</script>

</head>

<body>	
<div class="task">
	<span id="input"></span>
</div>

<div id="menu1_head" class="menu_head">Menu 1 &#9660; </div>
<div id="menu2_head" class="menu_head">Menu 2 &#9660; </div>
<div id="menu3_head" class="menu_head">Menu 3 &#9660; </div>

<div class="container">
	<div class="menu">
		<ul id="menu1" >
		</ul>
	</div>
	<div class="menu">
		<ul id="menu2" >
		</ul>
	</div>
	<div class="menu">
		<ul id="menu3" >
		</ul>
	</div>
</div>		

</body>

</html>
