<?php
ini_set('display_errors', '1');
session_start();
require_once('wp-admin/include/connectdb.php');
 $country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
  if($_POST['captcha1']==$_SESSION['captcha']){ 
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
  
  $numrows=mysql_num_rows(mysql_query("select * from member where f_name='$f_name' and l_name='$l_name'"));
  if($numrows){
  $subdomain="$f_name"."$l_name".$numrows;
  }else{
  
      $subdomain="$f_name"."$l_name";
	  }
  
  if($_POST['bhha']){
  $pieces = explode("@", $email);
  $code   =  rand(10, 99);
  $refcode="$pieces[0]".$code;
  $refcode=strtoupper($refcode);
  }else{
  $refcode="";
  }
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cel1'].'-'.$_POST['cel2'].'-'.$_POST['cel3']; 
  $time=time();

 $stmt=$con_pdo->prepare("insert into member set `f_name`=:f_name, `l_name`=:l_name, `email`=:email, `pwd`=:pwd, `address1`=:address1, `address2`=:address2, `city`=:city, `state`=:state, `country`=:country, `zipcode`=:zipcode,`tel`=:tel, `cel`=:cel, `registered_date`=:time, `refcode`=:refcode,`subdomainurl`=:subdomain");

 $stmt->bindParam(':f_name',$f_name);
 $stmt->bindParam(':l_name',$l_name);
 $stmt->bindParam(':email',$email);
 $stmt->bindParam(':pwd',$pass);
 $stmt->bindParam(':address1',$address1);
 $stmt->bindParam(':address2',$address2);
 $stmt->bindParam(':refcode',$refcode);
 $stmt->bindParam(':city',$city);
 $stmt->bindParam(':subdomain',$subdomain);
 if($_POST['state']!=''){
 
 $stmt->bindParam(':state',$state);
 }
 else{
$stmt->bindParam(':state',$state='');	 
 }
 
 $stmt->bindParam(':country',$country);
 $stmt->bindParam(':zipcode',$zipcode);
 
// $stmt->bindParam(':company_name',$com_name);
 $stmt->bindParam(':tel',$tel);
 $stmt->bindParam(':cel',$cel);
 $stmt->bindParam(':time',$time);
 
// $stmt->execute();
  
 if($stmt->execute()){
 //echo "register sucesss";
 header("location:register-welcome.php?refcode=$refcode");
 exit();
 }else{
 //echo "dhirendra";
 header("location:register.html");
 }
 

  $fname = strtoupper($f_name);
  $lname= strtoupper($l_name);
 
 
 
		 $email_login=$email;
		 $pwd_login=$pass;
$stmtautologin=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login ");
 $stmtautologin->bindParam(':email_login',$email_login);
 $stmtautologin->bindParam(':pwd_login',$pwd_login);
 $stmtautologin->execute();
  $count=$stmtautologin->rowCount();
  if($count>0){
	 $user_info_row = $stmtautologin->fetch(PDO::FETCH_ASSOC);
	 if($user_info_row['supplier']==1){
	$_SESSION['user_type']='Supplier';
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 $_SESSION['GOOD_SHOP_PART']='member';
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 $_SESSION['level'] = $user_info_row['level'];
	 
	 
	 $GOOD_SHOP_USERID= $_SESSION['GOOD_SHOP_USERID'];
//echo $GOOD_SHOP_USERID;
	if(empty($GOOD_SHOP_USERID)){	//registering non-member session id
		$GOOD_SHOP_USERID	= time();
		$GOOD_SHOP_NAME		= "non-member";
		$GOOD_SHOP_PART		= "guest";
		$GOOD_SHOP_LEVEL		= 0;
		$GOOD_SHOP_CART		= $GOOD_SHOP_USERID;
		/*
		@session_register("GOOD_SHOP_USERID") or die("session_register err");
		@session_register("GOOD_SHOP_NAME") or die("session_register err");
		@session_register("GOOD_SHOP_LEVEL") or die("session_register err");
		@session_register("GOOD_SHOP_PART") or die("session_register err");
		@session_register("GOOD_SHOP_CART") or die("session_register err");
		*/
		
		$_SESSION['GOOD_SHOP_USERID'] = $GOOD_SHOP_USERID;
		//echo $GOOD_SHOP_USERID;
		$_SESSION['GOOD_SHOP_NAME'] = $GOOD_SHOP_NAME;
		$_SESSION['GOOD_SHOP_LEVEL'] = $GOOD_SHOP_LEVEL;
		$_SESSION['GOOD_SHOP_PART'] = $GOOD_SHOP_PART;
		$_SESSION['GOOD_SHOP_CART'] = $GOOD_SHOP_CART;
		//echo "mmm";
	}
	
	//echo "$GOOD_SHOP_CART--dhirendra $GOOD_SHOP_USERID";
	
	if($_SESSION['GOOD_SHOP_CART']!=$GOOD_SHOP_USERID)
	{
		//echo "update cart set userid=$GOOD_SHOP_USERID where userid='$_SESSION[GOOD_SHOP_CART]'";
	mysql_query("update cart set userid='$GOOD_SHOP_USERID' where userid='$_SESSION[GOOD_SHOP_CART]'");
	}	  		 
 header("location:cart.php");
 }
 }
  }
else{
echo "error";
//header("location:register.php");	
}
?>