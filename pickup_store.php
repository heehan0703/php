<?php
session_start();
require_once('wp-admin/include/connectdb.php');
 $tradecode = $_GET['tradecode'];
 $store_id=$_GET['store_id'];
 $name1= $_POST['name1'];
 $name2 = $_POST['name2'];
 $address1 = $_POST['address1'];
 $address2 = $_POST['address2'];
 $city = $_POST['city'];
 $zipcode = $_POST['zipcode'];
 $country= $_POST['country'];
 $state = $_POST['state'];
 $storerow=mysql_fetch_array(mysql_query("select * from store where id=$store_id"));
//echo $store_id;
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];
 //echo $GOOD_SHOP_USERID ;
 $cart =$_SESSION["cart_id"];
  //echo $cart;
if(isset($_POST['submit'])){
$tradecode = $_GET['tradecode'];
 $store_id=$_GET['store_id'];
 $name1= $_POST['name1'];
 $name2 = $_POST['name2'];
 $address1 = $_POST['address1'];
 $address2 = $_POST['address2'];
 $city = $_POST['city'];
 $zipcode = $_POST['zipcode'];
 $country= $_POST['country'];
 $state = $_POST['state'];

if(isset($_GET['tradecode'])){
$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
$GOOD_SHOP_PART = $_SESSION['GOOD_SHOP_PART'];
 $cart_result = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'");
 //echo  "select * from cart where userid='$GOOD_SHOP_USERID'";
	while($cart_row = mysql_fetch_array($cart_result))
	{	
	
	mysql_query("INSERT INTO `trade_goods`( `userid`, `tradecode`, `goodsId`, `supplier_id`,`cnt`, `option1`, `option2`, `option3`, `writeday`, `price`,`message`,`dropship`,`shipping_label`,`storeid`,`option_index`,`pickup_personid`) VALUES ('$GOOD_SHOP_USERID','$tradecode','$cart_row[goodsId]','$cart_row[supplier_id]','$cart_row[cnt]','$cart_row[option1]','$cart_row[option2]','$cart_row[option3]',
now(),'$cart_row[price]','$cart_row[message]','$cart_row[dropship]','$cart_row[shipping_label]','$store_id','$cart_row[option_index]','$val')");
	
		
		$goods_row = mysql_fetch_array(mysql_query("select * from product where id=$cart_row[goodsId] limit 1"));
		if($goods_row['quantity']){
			$new_limitCnt = $goods_row['quantity']-$cart_row['cnt'];
			$sale_amount=$goods_row['sale_amount'];
			$sale_amount=$sale_amount+1;
			if($new_limitCnt <0) $new_limitCnt=0;
			
			
				mysql_query("update product set quantity=$new_limitCnt ,sale_amount='$sale_amount' where id=$goods_row[id]");
			
		}
	}
	

 
 
 }
$totalM=$_GET['totalP'];

$query11=mysql_query("INSERT INTO `trade`( `tradecode`, `userid`, `userid_part`, `totalM`, `shipM`, `payM`,`writeday`, `name1`, `name2`, `adr1`, `adr2`, `city`, `state`, `country`, `zip`, `rname1`, `rname2`, `radr1`, `radr2`, `rcity`, `rstate`, `rcountry`, `rzip`, `totalweight`,`shipotherM`,`servicechoose`,`storeid`,`order_type`) VALUES 
('$tradecode','$GOOD_SHOP_USERID','$GOOD_SHOP_PART','$totalM','0','$totalM','$time','$name1','$name2','$address1',
'$address2','$city','$state','$country','$zipcode','$ship_name1','$ship_name2','$ship_address1','$ship_address2',
'$ship_city','$ship_state','$ship_country','$ship_zipcode','$total_weight','0','$service_choose','$store_id','Pickup')");


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email =  $_POST['email'];
 $phone = $_POST['phone'];
 $tradecodes = $_POST['tradecode'];
 

$sql = "INSERT INTO pickup_person (order_id,cart_id,first_name,last_name,email,phone,tradecode,storeid,user_order_type) VALUES ('$GOOD_SHOP_USERID','$cart','$first_name','$last_name','$email','$phone','$tradecodes','$store_id','$GOOD_SHOP_PART')";
	//echo $sql;
mysql_query($sql);
$val = mysql_insert_id(); 

mysql_query("delete from cart where userid='$GOOD_SHOP_USERID'");

header("location:https://fahair.com/orderplaced.php?store_id=$store_id&tradecode=$tradecode&totalP=$totalM");	

$to = "dranatech@yahoo.com";
$subject = "New order is placed by user on fahair";

$message = "
<html>
<head>
<title>New order placed </title>
</head>
<body>
<p> Dear store admin</p>
<table>
<tr>
<th> A new order is places please check the store</th>

</tr>

</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@fahair.com>' . "\r\n";
$headers .= 'Cc: admin@fahair.com' . "\r\n";

mail($to,$subject,$message,$headers);



}

?>


<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pickup person -fahair.com</title>

<link rel="stylesheet" href="./colorbox/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<meta name="viewport" content="width=device-width" />
		


<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<style type="text/css">

@media (min-width: 100px) and (max-width: 500px) {
.wsmenucontainer {
min-height:0px !important; 
}
}
</style>

</head>
<body>


  <!--header start-->
 <div class="full"><?php include'var1.php'?>
  
<!--body start-->
<div class="full" style="background-color:white;">
   <?php 
     $store=mysql_fetch_assoc(mysql_query("select * from store where id='$getid'"));
   ?>    

  <div class="container">
    <div class="row" style="padding:1em;">
<b style="color:#000; font-size:18px;">ENTER THE PICKUP PERSON</b>
    </div>
     
  </div>
   <div class="full" style=" background:#DEDEDE; height:3px;margin:.9em 0;"></div>
  <div class="container">
    <div class="row" style="padding: 1em 10% 1em 10%;"> 
      <!--list item start --> 
      
      <!--category and their product start-->
      <div class="full">
       <form method="post" enctype="multipart/form-data" >
       <!-- left part start --> 
        <div class="col-lg-6 col-md-6">
        <input type="hidden" value="<?=$name1?>" name="name1">
        <input type="hidden" value="<?=$name2?>" name="name2">
        <input type="hidden" value="<?=$address1?>" name="address1">
        <input type="hidden" value="<?=$address2?>" name="address2">
        <input type="hidden" value="<?=$city?>" name="city">
        <input type="hidden" value="<?=$zipcode?>" name="zipcode">
        <input type="hidden" value="<?=$country?>" name="country">
        <input type="hidden" value="<?=$state?>" name="state">
        
      
    <div class="form-group">
      <label for="fname">First name on photo ID</label>
      <input type="text" class="form-control" id="fname" placeholder="first name" name="first_name">
      <input name="tradecode" value="<?=$tradecode;?>" type="hidden">
       <input name="storeid" value="<?=$store_id;?>" type="hidden">
      
    </div>
    <div class="form-group">
      <label for="lname">Last name on photi ID:</label>
      <input type="text" class="form-control" id="lname" placeholder="last name" name="last_name">
    </div>
     <div class="form-group">
      <label for="email">Enter email for notification:</label>
      <input type="eamil" class="form-control" id="eamil" placeholder="email" name="email">
    </div>
     <div class="form-group">
      <label for="number">mobile number for notification:</label>
      <input type="text" class="form-control" id="number" placeholder="number" name="phone">
    </div>
   

       
       </div>
         <!-- left part end --> 
          <!-- right part start --> 
        <div class="col-lg-6 col-md-6">
              <div class="row" style="padding:.3em .5em;">
        
         <div class="full" style="padding-left: 10%;">
         <span style="font-size:18px;"><b>we'll notify you </b>when your order is ready and hold it for <b>one week </b>at the store</span>
         <br><br>
          <span style="font-size:16px;" class="glyphicon glyphicon-home"><b style="color: red; font-size: 25px; padding-left: 57px;"><?=$storerow['s_name']?></b></span>
          <br><br>
          <span style="font-size:18px;"><?=$storerow['s_location']?></span><br>
          
          <span style="font-size:18px;"> <?=$storerow['s_city']?> <?=$storerow['s_state']?><?=$storerow['zip']?> </span><br>
          <br>
          <span style="font-size:18px;">1mi</span>
          <br><br>
          <span style="font-size:18px; color:red;">please pay wher picking up at the store</span><br><br>
          
          <span style="font-size:18px;"><a href="/cart.php" style="padding: 10px">cancel</a><a href="/checkout.php" style="padding: 10px">edit</a><input type="submit" class="btn btn-warning" style="width: 30%" value="OK" name="submit"></span>
          
          
         </div>
        
       
          </form>
          </div>
           
            
          </div>
          <!-- right part end --> 
     
          
   
    
        
        
        
        </div>
        
        </div>
 
  </form>
</div>

<!--body end--> 

<!-- footer start-->
<div>
<?php include'foot.php'?>
</div>
<!--footer end  -->






<!-- bulk order start -->


</body>
</html>



