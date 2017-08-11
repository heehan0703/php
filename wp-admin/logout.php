<?
session_start();
session_destroy();
session_start();
session_regenerate_id();
		echo "You will be logged out in a momoent...";
		

?>
<script language="javascript">
	window.parent.location= "login.php";
</script>