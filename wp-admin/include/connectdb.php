<?php
$localhost="db661395778.db.1and1.com";
$user="dbo661395778";
$pass="ebhahair555";
$db="db661395778";

$con=mysql_connect($localhost,$user,$pass);
$sql=mysql_select_db($db,$con);
if(!$con)
{
	echo "eror to connect database";
}



//$con_pdo = new PDO('mysql:host=db661395778.db.1and1.com',$user,$pass);
$con_pdo = new PDO('mysql:host=db661395778.db.1and1.com;dbname=db661395778',$user,$pass);
//mysql_query("SET CHARACTER SET utf8");
mysql_query ("set character_set_client='utf8'"); 
 mysql_query ("set character_set_results='utf8'"); 
mysql_query ("set collation_connection='utf8_general_ci'");

mysql_query('set character_set_connection=utf8');
mysql_query('SET NAMES utf8');

// mysql_set_charset('UTF8', $sql);

$SubDomain = str_replace('.ebhahair.com','',$_SERVER['HTTP_HOST']);
if($SubDomain=="ebhahair.com"){
$SubDomain="";
}
//echo "$SubDomain";
  
  ?>