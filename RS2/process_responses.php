<?
$file = $_POST['file'];
$user_action = $_POST['action'];
file_put_contents ("result/".$file , $user_action."\n", FILE_APPEND);
?>
