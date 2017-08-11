<?php 
session_start();
require_once('wp-admin/include/connectdb.php');
$email=$_POST['email'];
$result=mysql_query("insert into newsletter_new set email='$email'");
?>