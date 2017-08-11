<?

session_start();

require_once('include/connectdb.php');

include("pager.php");


if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
*/

if($_GET['type'] && $_GET['type']!=''){
  
  $type= $_GET['type'];
  echo "<option value=''>select option</option>";
  if($type=='buyer'){
 $query= mysql_query("select * from member where supplier=0 order by email asc");	  
	  }else{
  $query =  mysql_query("select * from member where supplier=1 order by email asc");
	  }
	  while($member_row=mysql_fetch_assoc($query)){
		echo "<option value='$member_row[member_id]'>$member_row[email]</option>";  
	  }
	  
}

?>

