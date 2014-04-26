<!DOCTYPE html>

<!--
  COLLABORATORS:
  I did not discuss the assignment with anyone
-->
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Thank you!</title>
<link rel="stylesheet" type="text/css" href="mainLayout.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">  

$(document).ready(function() {
});
</script>

</head>
<?
file_put_contents ("result/".$_GET['name'].".txt" , $_GET['easy'].",".$_GET['struggle'].",".$_GET['frequency'].",".
					$_GET['distinctive'].",".$_GET['helpful'].",".$_GET['distract'].",".$_GET['prefer']."\n", FILE_APPEND);
?>
<body>	
<p>Thank you for your time!!!</p>
</body>

</html>
