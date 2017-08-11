<?php
session_start();

$member_id=$_SESSION['member_id'];
  $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');
 
 $country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
  

  
 if(isset($_POST['email']) && $_POST['email']!='' && $_POST['pass']==$_POST['conf_pass']){ 
  

  
  $email=$_POST['email'];
  $pass =$_POST['pass'];
  $country =$_POST['country'];
  $state=$_POST['state'];
  
 
  $address1 =$_POST['address1'];
  $address2 =$_POST['address2'];
  $city =$_POST['city'];
  $zipcode = $_POST['zipcode'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cel1'].'-'.$_POST['cel2'].'-'.$_POST['cel3']; 
  $i_am = $_POST['i_am'];
 
 
$stmt=$con_pdo->prepare("update  member set `f_name`=:f_name, `l_name`=:l_name, `pwd`=:pwd, `address1`=:address1, `address2`=:address2, `city`=:city, `state`=:state, `country`=:country, `zipcode`=:zipcode, `i_am`=:i_am, `company_name`=:company_name, `tel`=:tel, `cel`=:cel where member_id=:member_id ");
 
 $stmt->bindParam(':f_name',$f_name);
 $stmt->bindParam(':l_name',$l_name);
 
 $stmt->bindParam(':pwd',$pass);
 $stmt->bindParam(':address1',$address1);
 $stmt->bindParam(':address2',$address2);
 $stmt->bindParam(':city',$city);
 if($_POST['state']!=''){
 
 $stmt->bindParam(':state',$state);
 }
 else{
$stmt->bindParam(':state',$state='');
	 
 }

 $stmt->bindParam(':country',$country);
 $stmt->bindParam(':zipcode',$zipcode);
 $stmt->bindParam(':i_am',$i_am);
 $stmt->bindParam(':company_name',$com_name);
 $stmt->bindParam(':tel',$tel);
 $stmt->bindParam(':cel',$cel);
 $stmt->bindParam(':member_id',$member_id);
 
 $stmt->execute();
 
 header("location:edit_register.php");
 }
  
else{
header("location:edit_register.php");	
}


?>