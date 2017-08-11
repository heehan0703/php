<?php
session_start();
require_once('include/connectdb.php');
require_once('pager2.php');
if($_SESSION["ADMIN_ID"]==""){	
header("location:login.php");		
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));

 $query=mysql_query("SELECT * FROM `product` order by id asc ");
 
*/   
$commi_id=$_GET['commi_id'];
$user_id=$_GET['user_id'];
  if($commi_id){
 //echo"delete * from commission_detail where id=$commi_id";
$result=mysql_query("delete from commission_detail where id=$commi_id");
  header("location:commission.php?user_id=$user_id");
   }