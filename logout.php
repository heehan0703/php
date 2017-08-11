<?php
session_start();


require_once('wp-admin/include/connectdb.php');

if(empty($_SESSION['GOOD_SHOP_USERID'])){
	  
	   echo '<script type="text/javascript">
	   alert("You are logging out successfully");
	   window.location="index.php";
	   </script>';
	  
	   exit;
   }
  else
  {
	
	mysql_query("delete from cart where userid='$GOOD_SHOP_USERID'");
	//<--
	/*@session_unregister("GOOD_SHOP_USERID") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_NAME") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_LEVEL") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_PART") or die("session_unregister err");
	@session_unregister("GOOD_SHOP_CART") or die("session_unregister err");
	@session_unregister("company_name") or die("session_unregister err");
	@session_unregister("status") or die("session_unregister err");
 */
 
session_destroy();
   echo '<script type="text/javascript">
	   alert("You are logging out successfully");
	   window.location="index.php";
	   </script>';
	   
	exit;
}

  
?>
