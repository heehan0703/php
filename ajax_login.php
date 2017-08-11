<?php
require_once('wp-admin/include/connectdb.php');
if(isset($_POST['email'])){

	 $email_login=$_POST['email'];
	  $pwd_login=$_POST['pass'];		 
$stmt=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login and supplier=0");
 $stmt->bindParam(':email_login',$email_login);
 $stmt->bindParam(':pwd_login',$pwd_login);
 $stmt->execute();
  $count=$stmt->rowCount();
// echo $count;
 if($count>0){
    session_start();
	 $user_info_row = $stmt->fetch(PDO::FETCH_ASSOC);
	 if($user_info_row['supplier']==1){
	$_SESSION['user_type']='Supplier';
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 $_SESSION['GOOD_SHOP_PART']='member';
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 $_SESSION['my_shop']=$user_info_row['my_shop'];
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 $_SESSION['level'] = $user_info_row['level'];
	 
	 $_SESSION['i_am'] = $user_info_row['i_am'];
	echo "sucess";	
	
	if($_SESSION['GOOD_SHOP_CART']!= $_SESSION['GOOD_SHOP_USERID'])
	{
		//echo "update cart set userid=$GOOD_SHOP_USERID where userid='$_SESSION[GOOD_SHOP_CART]'";
	mysql_query("update cart set userid='$_SESSION[GOOD_SHOP_USERID]' where userid='$_SESSION[GOOD_SHOP_CART]'");
	}
	
   }else{
   
   echo"fail";
    }
	 	 
 }
  
?>
