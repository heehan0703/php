<?php

session_start();
//print_r($_SESSION);
//echo $_SESSION['cart_continus_url']."dhi";
require_once('wp-admin/include/connectdb.php');
 $res=$_SESSION['member_id'];
 $crack="select * from member where member_id='$res'";
 $switch=mysql_query($crack);
 $desc=mysql_fetch_assoc($switch);
 $desc_name=$desc['f_name'];
//$first=$_POST['first'];
//echo $first;
$id=$_GET['goods_Id'];
$dated=date(DATE_RFC822);
$star=$_POST['star'];
$com=$_POST['content_p'];
$title=$_POST['title'];
//echo $video;
$img=$_FILES['img_p']['name'];
$video=$_POST['video'];
if($star)
{
$date="insert into rating (star,video,title,pic,vid,user_name,date,goods_id) values ('$star','$com','$title','$img','$video','$desc_name','$dated','$id')";
$result=mysql_query($date);
}
if($title)
{
$target_path = "upload/";
$target_path = $target_path . basename( $_FILES['img_p']['name']);

//$imageFileType holds the file extension of the file
$imageFileType = pathinfo($target_path,PATHINFO_EXTENSION);


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
} 
 // Check file size
if ($_FILES["img_p"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
} 

else {
 
 // Check if file already exists
if (file_exists($target_path)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
else{

if(move_uploaded_file($_FILES['img_p']['tmp_name'],
 $target_path)) {
  //  echo "The file ".  basename( $_FILES['img_p']['name']). 
   // " has been uploaded";
	
} else{
    echo "There was an error uploading the file, please try again!";
}
}
}

}


 $id=$_GET['goods_Id'];
 mysql_query("update product set product_seen=product_seen+1 where id='$id'");
 $product_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$id'"));
 
 
 
 
 $productcategory=$product_info['cat_id'];
 //echo $product_info['wholesale_price'];
//echo $product_info['quantity_type'];

// echo "SELECT * FROM `product` where id='$id'";
// echo $product_info['stock'];
 $productlen=$product_info['capsize'];
 $lacecolor=$product_info['lacecolor'];
 // echo $productlen;
 //echo $lacecolor;
  $supplier_name = mysql_result(mysql_query("SELECT CONCAT(f_name,' ' , l_name) as full_name from member where member_id='$product_info[user_id]'  "),0);

 if($_SESSION['member_id']!=''){
 $buyer_name = mysql_result(mysql_query("SELECT CONCAT(f_name,' ' , l_name) as full_name from member where member_id='$_SESSION[member_id]'  "),0);
 }

 if (strpos($product_info['images'],',') !== false) {
  $product_img=explode(',',$product_info['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$product_info['images'];	
}



 $array_img=explode(',',$product_info['images']);
 $count_img= count($array_img);

$color_img= $product_info['color'];

 $color_img=explode(',',$color_img);
 
 $color_img_array = $color_img;
 
// sort($color_img);

 
 $color_img = array_unique($color_img);
 
  $color_img_count=count(array_filter($color_img_array));
  
  if($product_info['length']!=''){
  
  $length_option_arr= $product_info['length'];
  
  $length_option_arr = rtrim($length_option_arr,',');
  
 $length_option_arr=explode(',',$length_option_arr);
 
 $length_option_aray = $length_option_arr;
 
 $length_option_count=count(array_filter($length_option_arr));
 
 sort($length_option_arr);
 
$length_option_arr = array_unique($length_option_arr);
 
// print_r($length_option_arr);
  }
  
  else{
	$length_option_count=0;  
  }
 // $_SESSION['level']=2;
  
  $product_stock=explode(',',$product_info['stock']);
   $product_price=explode(',',$product_info['regularprice2']);
   
   if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)){
   $product_price_regular=explode(',',$product_info['regularprice2']);
   // $product_price_wholesale=array_map('intval', explode(',',$product_info['wholesaleprice2']));
   $product_price_wholesale2=explode(',',$product_info['wholesaleprice2']);
 // $product_price_wholesale= number_format($product_price_wholesale, 2)
    foreach ($product_price_wholesale2 as $each_number) {
      $product_price_wholesale[] = number_format((float)$each_number, 2);
  }
 
 
   //var_dump($product_price_wholesale);
   
   }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){
        $product_price=explode(',',$product_info['price']);
		$product_price_regular=explode(',',$product_info['regularprice2']);
   }else if(($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){
        $product_price=explode(',',$product_info['agent_price']);
		$product_price_regular=explode(',',$product_info['regularprice2']);
   }else{
        $product_price=explode(',',$product_info['manufactureprice2']);
		$product_price_regular=explode(',',$product_info['regularprice2']);
		 }


$supplier_query=mysql_query("SELECT * FROM `product` where supplier_code='$product_info[supplier_code]' limit 16 ");

 $supplier_product_count=mysql_num_rows($supplier_query);

 $supplier_product_count=$supplier_product_count/4;
 $supplier_product_count= ceil($supplier_product_count);
 
 if(isset($_POST['content_p'])){
	
	if($_SESSION['GOOD_SHOP_PART'] != 'member')
	{
	
		  echo '<script type="text/javascript">
	   alert("Please log-in with your account.");
	   </script>';
		exit;
	}


	if(empty($_POST['goodsId']))
	{
		 echo '<script type="text/javascript">
	   alert("You\'ve come through invalid path.");
	   </script>';
		exit;
	}
   $goodsId=$_POST['goodsId'];
  $content=$_POST['content_p'];
     $img_name=time().$_FILES['img']['name'];
	 $temp_name=$_FILES['img']['temp_name'];
	 $title_p=$_POST['title_p'];
	 $rating=$_POST['rating'];
	//attachment
	
	if(!empty($img_name))
	{
		move_uploaded_file($_FILES["img"]["tmp_name"], "upload/comment/".$img_name);
	}	
		$now=time();
		$qry = "insert into product_comment (product_id,userid,content,rating,writeday,img,title)values(";
		$qry.= "$goodsId,";
		$qry.= "'$_SESSION[member_id]',";
		$qry.= "'$content',";
		$qry.= "'$rating',";
		$qry.= "'$now',";
		$qry.= "'$img_name',";
			$qry.= "'$title_p'";
		$qry.= ")";

		if(mysql_query($qry))
		{
			header("location:goods_detail.php?goods_Id=$goodsId");
		}
		else
		{
			echo"Err. : $qry";
		}
		exit;
	//}
	
}

/// for randam data ///


$offset_row = mysql_result(mysql_query( " SELECT id FROM product where quantity!='0' ORDER BY RAND() LIMIT 1  "),0);
$randam_product_info = mysql_fetch_assoc(mysql_query( " SELECT * FROM `product` where id='$offset_row' " )); 
 if (strpos($randam_product_info['images'],',') !== false) {
  $randam_product_img=explode(',',$randam_product_info['images']);
$randam_product_img=$randam_product_img[0];
}
else{
  $randam_product_img=$randam_product_info['images'];	
}
	
	if($_SESSION['verify_status']==1){
				  if($product_info['special_promotion_check']==1){
					$special_promotion_value = $product_info['special_promotion_value'];
				 $spec_promotion_rate =	($product_info['wholesale_price']*$special_promotion_value)/100;
				 
				 $spec_promotion_pricee = $product_info['wholesale_price']-$spec_promotion_rate;
				 
				  }
				  
	}
	
	 if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)){
		  if($product_info['special_promotion_check']==1){
		$product_hiddn_price = $spec_promotion_pricee ;	  
		  }else{
 $product_hiddn_price	=  $product_info['wholesale_price'];	 
		  }
	 }
	 else{
 $product_hiddn_price	=  $product_info['msrp_price'];	 		 
	 }
	 
	$min_quantity = $product_info['min_quantity'];
	
	if($min_quantity==''){
	$min_quantity=1;
	}
	


	
	
 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');

$user_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id='$member_id'"));

$email = mysql_result(mysql_query("select email from `member` where member_id ='$member_id'"),0); 



$country_query=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");

$country_query2=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");

$state_name=mysql_result(mysql_query("SELECT state_name FROM `state` where state_id=$user_row[state]"),0);

$category=mysql_query("SELECT * FROM `category` where category_name!='' order by category_name ASC ");




$mail_variable=false;


if(isset($_POST['email'])){
//print_r($_POST);

   $company_name = $_POST['company_name'];
   $address1 = $_POST['address1'];
   $address2 = $_POST['address2'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $zipcode = $_POST['zipcode'];
   $country = $_POST['country'];
   $email = $_POST['email'];
   $cel = $_POST['cel'];
   
   $rcompany_name = $_POST['rcompany_name'];
   $raddress1 = $_POST['raddress1'];
   $raddress2 = $_POST['raddress2'];
   $rcity = $_POST['rcity'];
   $rstate =$_POST['rstate'];
   $rzipcode = $_POST['rzipcode'];
   $rcountry = $_POST['rcountry'];
   $remail =$_POST['remail'];
   $rcel = $_POST['rcel'];
   $description = $_POST['description'];
   $pay = $_POST['pay'];
   
   $preview_page_length=count($_POST['product_category']);
  
   $product_category_preview=$_POST['product_category'];
   $product_name_preview=$_POST['product_name'];
   $product_length_preview=$_POST['product_length'];
   $product_color_preview=$_POST['product_color'];
   $product_quantity_preview =$_POST['product_quantity'];
   $product_dropship_preview=$_POST['product_dropship'];
 
  
		
 $product_category=implode(',',$_POST['product_category']); 
 $product_name=implode(',',$_POST['product_name']);
 $product_length=implode(',',$_POST['product_length']);
 $product_color=implode(',',$_POST['product_color']);
  $product_quantity =  implode(',',$_POST['product_quantity']);
 $product_dropship=implode(',',$_POST['product_dropship']);
 $time=time();
}

 
 
 

 if(isset($_POST['submit'])){
	
	
 $insert=mysql_query("INSERT INTO `sample_order`( `user_id`, `company_name`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `email`, `phone`, `rcompany_name`, `raddress1`, `raddress2`, `rcity`, `rstate`, `rcountry`, `rzip`, `remail`, `rphone`, `description`, `pay_method`, `product_type`, `product_name`, `product_length`, `product_color`, `product_quantity`,`custom_package`, `writeday`) VALUES ('$member_id','$company_name','$address1','$address2','$city','$state','$country','$zipcode','$email','$cel','$rcompany_name','$raddress1',
'$raddress2','$rcity','$rstate','$rcompany_name','$rzipcode','$remail','$rcel','$description','$pay','$product_category','$product_name',
'$product_length','$product_color','$product_quantity','$product_dropship','$time')");
	
	echo "INSERT INTO `sample_order`( `user_id`, `company_name`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `email`, `phone`, `rcompany_name`, `raddress1`, `raddress2`, `rcity`, `rstate`, `rcountry`, `rzip`, `remail`, `rphone`, `description`, `pay_method`, `product_type`, `product_name`, `product_length`, `product_color`, `product_quantity`,`custom_package`, `writeday`) VALUES ('$member_id','$company_name','$address1','$address2','$city','$state','$country','$zipcode','$email','$cel','$rcompany_name','$raddress1',
'$raddress2','$rcity','$rstate','$rcompany_name','$rzipcode','$remail','$rcel','$description','$pay','$product_category','$product_name',
'$product_length','$product_color','$product_quantity','$product_dropship','$time')";
	
	
	$message_body ="<html><body><table width='900' cellpadding='5' cellspacing='5' style='border:2px solid #000;'>
	 <tr><td style='background:#155597; margin:5px;' colspan='2' height='100'>
  <table>
  <tr><td width='30%'><img style='border:0px; background:#94C95F;' src='https://ebhahair.com/images/sample_order-logo.png'> </td>
  <td height='70%'><h2 style='color:#fff;'>Custom Order</h2></td></tr>
  </table>
  </td></tr>
<tr>
<td width='450'>
<h2>Buyer Information</h2>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
<th width='50%'>Company Name</th><td width='50%'>$company_name</td>
</tr>
<tr>
<th width='50%'>Street Address</th><td width='50%'>$address1</td>
</tr>
<tr>
<th width='50%'>Street Address Line 2 </th><td width='50%'>$address2</td>
</tr>
<tr>
<th width='50%'>City</th><td width='50%'>$city</td>
</tr>
<tr>
<th width='50%'>State / Province</th><td width='50%'>$state</td>
</tr>
<tr>
<th width='50%'>Postal / Zip Code</th><td width='50%'>$zipcode</td>
</tr>
<tr>
<th width='50%'>Country</th><td width='50%'>$country</td>
</tr>
<tr>
<th width='50%'>E-mail</th><td width='50%'>$email</td>
</tr>
<tr>
<th width='50%'>Phone</th><td width='50%'>$cel</td>
</tr>
</table>
</td>
<td width='450'>
<h2>Shipping Information</h2>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
<th width='50%'>Company Name</th><td width='50%'>$rcompany_name</td>
</tr>
<tr>
<th width='50%'>Street Address</th><td width='50%'>$raddress1</td>
</tr>
<tr>
<th width='50%'>Street Address Line 2 </th><td width='50%'>$raddress2</td>
</tr>
<tr>
<th width='50%'>City</th><td width='50%'>$rcity</td>
</tr>
<tr>
<th width='50%'>State / Province</th><td width='50%'>$rstate</td>
</tr>
<tr>
<th width='50%'>Postal / Zip Code</th><td width='50%'>$rzipcode</td>
</tr>
<tr>
<th width='50%'>Country</th><td width='50%'>$rcountry</td>
</tr>
<tr>
<th width='50%'>E-mail</th><td width='50%'>$remail</td>
</tr>
<tr>
<th width='50%'>Phone</th><td width='50%'>$rcel</td>
</tr>
</table>
</td>
</tr>
<tr><td colspan='2' height='10'></td></tr>
<tr><td width='50%'>Description </td><td width='50%'>$description</td></tr>

<tr><td colspan='2' height='10'></td></tr>
<tr><td width='50%'>Payment Method </td><td width='50%'>$pay</td></tr>
<tr><td width='50%'>Product Type</td><td width='50%'>$product_category</td></tr>
<tr><td width='50%'>Product Name </td><td width='50%'>$product_name</td></tr>
<tr><td width='50%'>Length </td><td width='50%'>$product_length</td></tr>
<tr><td width='50%'>Color</td><td width='50%'>$product_color</td></tr>
<tr><td width='50%'>Quantity</td><td width='50%'>$product_quantity</td></tr>
<tr><td width='50%'>Custom Package </td><td width='50%'>$product_dropship</td></tr>
</table></body></html>";

$forward_to='info@ebhahair.com';
//$forward_to='kaushiknitin2701@gmail.com';
//$forward_to='kvaidh02@gmail.com';
$forward_subject='Sample Order query submitted.';

         $headers =  "From:ebhahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
mail($forward_to, $forward_subject,$message_body, $headers);
header('Location: contactus_after_preview.php');

$mail_variable=true;

}


 if(isset($_POST['sample_order_mail'])){
$product_img = $_POST['product_img'];
$category = $_POST['category'];
$product_code = $_POST['product_code'];
$msrp_price = $_POST['msrp_price'];
$wholesale_price = $_POST['wholesale_price'];
$supplier_name = $_POST['supplier_name'];
$buyer_name = $_POST['buyer_name'];
$email = $_POST['email'];
$subject_mail_1 = $_POST['subject_mail_1'];
$message_mail_1 = $_POST['message_mail_1'];

//$forward_to='kvaidh02@gmail.com';
//$forward_to='kaushiknitin2701@gmail.com';
$forward_to='info@ebhahair.com';
$forward_subject='Sample Order query submitted.';

$message_body ="
<html><body>
<table width='900' cellpadding='5' cellspacing='5' style='border:2px solid #000;'>
<tr>
<td align='center'><h2>Sample Order</h2></td>
</tr>

<tr>
<td> <img src='https://ebhahair.com/product_img/$product_img' style='width: 200px; height: 150px;'></td>
</tr>

<tr>
<td>$category</td>
</tr>

<tr>
<td>Item Number : $product_code</td>
</tr>

<tr>
<td> Msrp Price : $msrp_price</td>
</tr>

<tr>
<td> wholesale_price : $wholesale_price</td>
</tr>


<tr>
<td> Topic : $subject_mail_1</td>
</tr>

<tr>
<td> hii, $supplier_name </td>
</tr>

<tr>
<td> $message_mail_1 </td>
</tr>


<tr>
<td> $buyer_name ($email) </td>
</tr>

</table>
</body></html>";

         $headers =  "From:ebhahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
mail($forward_to, $forward_subject,$message_body, $headers);
 }
 
 if(isset($_POST['supplier_order_mail'])){
	 $supplier_name = $_POST['supplier_name'];

$product_img = $_POST['product_img'];
$category = $_POST['category'];
$product_code = $_POST['product_code'];
$msrp_price = $_POST['msrp_price'];
$wholesale_price = $_POST['wholesale_price'];
$supplier_name = $_POST['supplier_name'];
$buyer_name = $_POST['buyer_name'];
//$forward_to='kvaidh02@gmail.com';
//$forward_to='kaushiknitin2701@gmail.com';
$forward_to='info@ebhahair.com';
$forward_subject='Sample Order query submitted.';

$message_body ="
<html><body>
<table width='900' cellpadding='5' cellspacing='5' style='border:2px solid #000;'>
<tr>
<td align='left'><h2>contact</h2> <span> $supplier_name </span> </td>
</tr>

<tr>
<td> <img src='https://ebhahair.com/product_img/$product_img' style='width: 200px; height: 150px;'></td>
</tr>

<tr>
<td>$category</td>
</tr>

<tr>
<td>Item Number : $product_code</td>
</tr>

<tr>
<td> Msrp Price : $msrp_price</td>
</tr>

<tr>
<td> wholesale_price : $wholesale_price</td>
</tr>



<tr>
<td> hii, $supplier_name </td>
</tr>



<tr>
<td> $buyer_name </td>
</tr>

</table>
</body></html>";

         $headers =  "From:fahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
mail($forward_to, $forward_subject,$message_body, $headers);
 }
 

 ?>
 <?php
$j=0;
$robin=mysql_query("SELECT * FROM rating where goods_id=$id ORDER BY id DESC LIMIT 3;"); 
//$resk=mysql_fetch_assoc($robin);
//echo "SELECT * FROM rating where goods_id=$id ORDER BY id DESC LIMIT 3;";
//echo $resk['vid'];


//print_r($product_stock);


$category_id=mysql_result(mysql_query("SELECT id  FROM `category` where category_name='$product_info[category]'"),0);
$new_arrivals=mysql_query("SELECT * FROM `product` where cat_id='$productcategory' order by id DESC limit 10"); 
?>
      <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?=strtolower($product_info['product_name'])?> || ebhahair.com</title>
        <meta charset="utf-8">
        <meta name="Keywords" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces - ebhahair.com">
        <meta name="description" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces  <?=strtolower($product_info['product_name'])?> - ebhahair.com">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		
		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,500.00,700,300' rel='stylesheet' type='text/css'>
		
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="/shopick/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="/shopick/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="/shopick/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="/shopick/css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="/shopick/lib/css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="/shopick/css/owl.carousel.css">
		<!-- flaticon css -->
        <link rel="stylesheet" href="/shopick/css/shopick-icon.css">
		<!-- pe-icon-7-stroke css -->
        <link rel="stylesheet" href="/shopick/css/pe-icon-7-stroke.css">
		<!-- lightbox css -->
        <link rel="stylesheet" href="/shopick/css/lightbox.min.css">
		<!-- style css -->
		
        <link rel="stylesheet" href="/shopick/fstyle.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="/shopick/css/responsive.css">
		<!-- modernizr css -->
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script language="javascript">
 
 function searchstore(){
var x = document.forms["searchform"]["address"].value;
if (x == null || x == "") {
        alert("Address must be filled out");
        return false;
    }else{
    document.forms["searchform"].submit();
	}
}

</script>
        
        <!-- new files end --->
<style type="text/css">
.main-menu ul li .submenu li:hover a, .subwigs span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subwigs span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subwigs {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subwigs {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subwigs span .subwigs-title:before,
.subwigs-photo a::before {
  display: none;
}
.main-menu ul li .subwigs {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subwigs span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subwigs span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subwigs span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subwigs span a:hover::before {
  opacity: 1;
}


/* for subweaves  */
.main-menu ul li .submenu li:hover a, .subweaves span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subweaves span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subweaves {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subweaves {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subweaves span .subweaves-title:before,
.subweaves-photo a::before {
  display: none;
}
.main-menu ul li .subweaves {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subweaves span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subweaves span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subweaves span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subweaves span a:hover::before {
  opacity: 1;
}
.container2{
margin-left:60px;
}


@media (min-width:200px) and (max-width: 600px) {
body{
overflow-x: hidden;
}
html { overflow-x: hidden; }​
  table{
 border-collapse: collapse;
    border-spacing: 0;
    table-layout: fixed;
    width: 100%;
    word-break: break-all;
	}
div > p >span{
font-size:9px !important;
}
.container2{
margin-left:0px !important;
}
.MsoNormal{
font-size:9px !important;
}
.single-pro-product-description{
width:400px; !important;
margin-left:5px;
}
.container2{
margin-left:0px;
}

.single-pro-product-description span {
font-size:10pt !important;
text-align:left;
width:300px !important;
word-break: break-all !important; 
white-space: normal !important;
}
.single-pro-product-description p {
text-align:left !important;
word-break: break-all !important;
white-space: normal !important;
max-width:300px; !important;
	
}
.single-pro-product-description font {
font-size:8pt !important;
word-break: break-all !important;
white-space: normal !important;
}
.single-pro-product-description table{
width:300px !important;
word-break: break-all !important;
    white-space: normal !important;
}	
.single-pro-product-description tr{
width:300px !important;
word-break: break-all !important;
    white-space: normal !important;
}	
.single-pro-product-description td{
width:auto !important;
word-break: break-all !important;
    white-space: normal !important;
}	

.single-pro-product-description table p{
width:inherit;}


.single-pro-product-description > p > font > span {
font-size:2px;
}

</style>

<base href="/" />

<script type="text/javascript" src="menu/js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link href="https://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="./colorbox/colorbox.css" />
		
		<script src="./colorbox/jquery.colorbox.js"></script>
		<script>
		
			jQuery(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				jQuery(".group4").colorbox({rel:'group4', slideshow:true , maxWidth:'95%', maxHeight:'95%'});
				//Example of preserving a JavaScript event for inline calls.
				jQuery("#click").click(function(){ 
					jQuery('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
</script>
<!--right sidebar start-->
<script src="bx/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="bx/jquery.bxslider.css" rel="stylesheet" /> 
  <script language="javascript">
 var j = jQuery.noConflict();

         j(document).ready(function() 
         {
            j('.bxslider').bxSlider({
                pagerCustom: '#bx-pager',
                mode: 'fade'
            });

         });  
   j(function ($) {
  $(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 200,
    minSlides: 2,
    maxSlides: 5,
    slideMargin: 0
  });
});
});
  </script>

<script language="javascript">

////////////////////this function is used to set the cap size based on radio button selected small,medium,large, custom/////////////////


function cap_size(val){
jQuery.noConflict();
if(val=="S"){
//alert("dhirendra");
jQuery("#ist").val("21.5");
jQuery("#sect").val("13.5");
jQuery("#thi").val("11");
jQuery("#first").val("12");
jQuery("#sec").val("14");
jQuery("#third").val("5");
} else if(val=="M"){
					jQuery("#ist").val("22.5");
					jQuery("#sect").val("14.4");
					jQuery("#thi").val("11.5");
					jQuery("#first").val("12.5");
					jQuery("#sec").val("14.5");
					jQuery("#third").val("5.5");
					} else if(val=="L"){
									jQuery("#ist").val("23.5");
									jQuery("#sect").val("15.5");
									jQuery("#thi").val("12");
									jQuery("#first").val("13.5");
									jQuery("#sec").val("15.5");
									jQuery("#third").val("6");
									}else if(val=="C"){
												jQuery("#ist").val("");
												jQuery("#sect").val("");
												jQuery("#thi").val("");
												jQuery("#first").val("");
												jQuery("#sec").val("");
												jQuery("#third").val("");
												}

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

</script>

<!-- Bootstrap -->
<style>
 <? if($length_option_count>0) {  ?>
.color-clss{
	
}
<? } ?>
</style>
 

<script type="text/javascript">
 function show_account_menu(){
 jQuery("#account_menu").toggle();
  
  function show_content(cls){
jQuery("."+cls).show(0);
}
function hide_content(cls){
	jQuery("."+cls).hide(0);
}

	 
 }
</script>
<script type="text/javascript">
jQuery.noConflict();

/*jQuery(document).ready(function(e) {
    jQuery("#color_option").val(0);
});*/

var optioncolor_lengthArr = new Array();

optioncolor_lengthArr = [<?php if(count(array_filter($color_img_array))>0){
	 for($i=0;$i<count($color_img_array);$i++) { ?>"<?=$length_option_aray[$i].'_'.$color_img_array[$i]?>",<?php } } ?>];


var optioncolorArr = new Array();

optioncolorArr = [<?php if(count(array_filter($color_img_array))>0){
	 for($i=0;$i<count($color_img_array);$i++) { ?>"<?=$color_img_array[$i]?>",<?php } } ?>];

var optionlengthArr = new Array();
<? if(count($length_option_aray)>0){ ?>

optionlengthArr = [<?php  for($i=0;$i<count(array_filter($length_option_aray));$i++) { ?>"<?=$length_option_aray[$i]?>",<?php }  ?>]; <? }
	 ?>

function getAllIndexes(arr, val) {
    var indexes = [], i;
    for(i = 0; i < arr.length; i++)
        if (arr[i] === val)
            indexes.push(i);
    return indexes;
}




var optionpriceArr = new Array();

var optionprice_promotionArr = new Array();

var product_price_regular= new Array();

var product_price_wholesale=new Array();

//////wholesale  price setting in javascript variable/////
 //var_dump($product_price_wholesale);
// var test=2.00;
//test= parseFloat(test).toFixed(2);
//alert(test);
<?php if(count(array_filter($product_price_wholesale))>0){
 for($i=0;$i<count($product_price_wholesale);$i++) { ?>
 
  
product_price_wholesale[<?=$i?>]= parseFloat(<?=$product_price_wholesale[$i]?>).toFixed(2);
 <? }}?>



//////regular price setting in javascript variable/////
<?php if(count(array_filter($product_price_regular))>0){
 for($i=0;$i<count($product_price_regular);$i++) { ?>
  
product_price_regular[<?=$i?>]= parseFloat(<?=$product_price_regular[$i]?>).toFixed(2);
 <? }}?>




<?php if(count(array_filter($product_price))>0){
 for($i=0;$i<count($product_price);$i++) { ?>
<?  if($_SESSION['verify_status']==1){ 
  if($product_info['special_promotion_check']==1){
	 $price_promotion= $product_price[$i] - ($product_price[$i]*$special_promotion_value/100);
?>
optionprice_promotionArr[<?=$i?>]= <?=$price_promotion?>;
<? } ?>
optionpriceArr[<?=$i?>]= parseFloat(<?=$product_price[$i]?>).toFixed(2);
<? } else {?>
optionpriceArr[<?=$i?>]= parseFloat(<?=$product_price[$i]?>).toFixed(2);
<? } ?>

<?php } } ?>

var optionstockArr = new Array();
<?php if(count(array_filter($product_stock))>0){
	 for($i=0;$i<count($product_stock);$i++) { ?>

optionstockArr[<?=$i?>]= <?=$product_stock[$i]?>;

<?php } } ?>



function update_val(casee){
  var quantity=jQuery("#cnt").val();
	if(casee=='inc'){
		var new_quantity=parseInt(quantity)+1;

   jQuery("#cnt").val(new_quantity);
}
if(casee=='desc' && quantity>1){
	var new_quantity=parseInt(quantity)-1;
	jQuery("#cnt").val(new_quantity);
}
}



function length_update(id,val){
	jQuery(".color-clss").hide();
	//jQuery(".color-clss").removeClass("select-cls");
	// jQuery("#color_option").val(0);
	 jQuery("#length").val(val);
	 jQuery("#length_opt_cont").html(val);
	jQuery(".length-clss").removeClass("select-cls");
	jQuery("#length_"+id).addClass("select-cls");
	 var index_val = getAllIndexes(optionlengthArr, val);
	var count_length = index_val.length;
	//alert(count_length);
	var i;
for (i = 0; i < count_length; i++) {
    // do something with `substr[i]`
	 var length_indx = index_val[i];
	  //alert(optioncolorArr[length_indx]);
	  jQuery(".clss_"+optioncolorArr[length_indx]).show();
}
	//alert(index_val);
	var form=document.goodsForm;
	<? if($length_option_count>0){ ?>
	var colorval = jQuery("#color_option").val();
	var variable1 = val+'_'+colorval;
	//alert(variable1);
	var new_index=optioncolor_lengthArr.indexOf(variable1); 
	//alert(optionpriceArr[vv]);
	<? } else {?>
var new_index =	optioncolorArr.indexOf(val);
	<? } ?>
	//alert(new_index);
//	optioncolor_lengthArr.indexOf(variable1); 
	form.option_stock.value = optionstockArr[new_index];
	form.index_option.value=new_index;
	
	form.price.value = optionpriceArr[new_index];
	<?  if($_SESSION['i_am']=='Wholesaler'  or $_SESSION['i_am']=='ISR'){
		 if($product_info['special_promotion_check']==1){
		?>
		form.price.value = optionprice_promotionArr[new_index];
	 jQuery("#price_promotion_span").html(optionprice_promotionArr[new_index]);
	 jQuery("#price_span_regular").html(product_price_regular[new_index]);	
	<? } ?>
	jQuery("#price_wholesale_span").html(product_price_wholesale[new_index]);	
		jQuery("#price_span").html(optionpriceArr[new_index]);
		jQuery("#price_span_regular").html(product_price_regular[new_index]);	
	<? } else {?>
	//alert(product_price_regular[new_index]);
	jQuery("#price_span").html(optionpriceArr[new_index]);
	jQuery("#price_span_regular").html(product_price_regular[new_index]);
		
	<? } ?>
}

function color_update(id,val){
	//alert('hello');
	var form=document.goodsForm;
	<? if($length_option_count>0){ ?>
	var lengthh = jQuery("#length").val();
	var variable1 = lengthh+'_'+val;
	//alert(variable1);
	var new_index=optioncolor_lengthArr.indexOf(variable1); 
	//alert(optionpriceArr[vv]);
	<? } else {?>
var new_index =	optioncolorArr.indexOf(val);
	<? } ?>
	//alert(new_index);
//	optioncolor_lengthArr.indexOf(variable1); 
	form.option_stock.value = optionstockArr[new_index];
	form.index_option.value=new_index;
	
	form.price.value = optionpriceArr[new_index];
	<?  if($_SESSION['i_am']=='Wholesaler'  or $_SESSION['i_am']=='ISR'){
		 if($product_info['special_promotion_check']==1){
		?>
		form.price.value = optionprice_promotionArr[new_index];
	 jQuery("#price_promotion_span").html(optionprice_promotionArr[new_index]);
	 jQuery("#price_span_regular").html(product_price_regular[new_index]);	
	<? } ?>
	form.price.value = product_price_wholesale[new_index];
	jQuery("#price_wholesale_span").html(product_price_wholesale[new_index]);	
		jQuery("#price_span").html(optionpriceArr[new_index]);
		jQuery("#price_span_regular").html(product_price_regular[new_index]);	
	<? } else {?>
	//alert(product_price_regular[new_index]);
	jQuery("#price_span").html(optionpriceArr[new_index]);
	jQuery("#price_span_regular").html(product_price_regular[new_index]);
		
	<? } ?>
	 jQuery("#color_option").val(val);
	 jQuery("#color_opt_cont").html(val);
	jQuery(".color-clss").removeClass("select-cls");
	jQuery("#color_"+id).addClass("select-cls");
}


function addCart(Channel)
{
	var form=document.goodsForm;
	var Cnt	= form.cnt.value;
	<? if(count(array_filter($product_stock))>0){ ?>
	var stock = form.option_stock.value; 
	<? } else { ?>
	<? if($product_info['quantity']=='limitless'){ ?>
var stock = 100;
    <?  }else{ ?>
	  var stock = <?=$product_info['quantity']?>;
       <? }?>
	<? }?>
	 <? if($color_img_count>0) {?>
	var color_option = form.color_option.value; <? } ?>
	
	if(Cnt=="" || Cnt=="0" ||Cnt==0){
		alert("Quantity for the item is incorrect.");
		form.cnt.focus();
	}
	 <? if($color_img_count>0) {?>
	else if(color_option==0){
		alert("Please select color .");
		form.color_option.focus();
	}
	<? } ?>
	else if(stock<1){
		alert("We're sorry. This item is out of stock.");
	}
	/*else if(optionArr[0].length && form.option1.selectedIndex==0){
		alert("["+optionArr[0]+"] Please select this.");
		form.option1.focus();
	}else if(optionArr[1].length && form.option2.selectedIndex==0){
		alert("["+optionArr[1]+"] Please select this.");
		form.option2.focus();
	}*/
	else{
	form.action="cart.php?act=add&channel="+Channel;
	form.target="";
	form.submit();
	}
}

function multi_cart(Channel)
{
	//var form=document.goodsForm;
	var form=document.bulkform;

	var multi_cnt = document.getElementsByName('multi_cnt[]');
	var count = 0;
	for (i=0; i<multi_cnt.length; i++) {
		if (multi_cnt[i].value > 0) {
			count++;
		}
	}
	if (!count) {
		alert('Quantity for the item is incorrect');
		return false;
	}
	
	form.action="cart.php?bulk_order=1&act=add&channel="+Channel;
	form.target="";
	form.submit();
}

 function countChar(val) {
        var len = val.value.length;
        if (len > 1000) {
          val.value = val.value.substring(0, 1000);
        } else {
          jQuery('#textarea_count').text(1000 - len);
        }
      }
	  
	  function countChar_text(val) {
        var len = val.value.length;
        if (len > 32) {
          val.value = val.value.substring(0, 32);
        } else {
          jQuery('#text_count').text(32 - len);
        }
      }
	  function largeimage(){

}

function dhirendra(){
jQuery("#large_img").click();
}

</script>
 <? $product_img = str_replace(' ', '', $product_img);?> 


<script type="text/javascript">
	
	
	function show(){
 $("#overlay-mask-8").fadeIn('slow');	
 
}


function check()
{
	//alert("dhirendra");
	var login = document.getElementById("email_login").value;
	var pass = document.getElementById("pwd_login").value;
	
	if(login=="")
	{
     // alert("please enter the username");
	  document.getElementById("uerror").innerHTML="Please enter the username";
	 
		}else if(pass==""){
		//alert("please enter the password");
		 document.getElementById("perror").innerHTML="Please enter the password";
		}else{
		
					   $.ajax({
						  url: 'ajax_login.php',
					 data: {
					  email: login,
					  pass: pass
					   },
					 error: function() {
						 $('#info').html('<p>An error has occurred</p>');
						   },
					 success: function(data) {
					  //alert(data);
					   if(data=='sucess'){
					    document.location.href="index.php"
						}else{
						 document.getElementById("berror").innerHTML="Username and Password do not match ";
						}
					
					},
					type: 'POST'
				   });
		
		
		
		}
		
		
		
	//alert("login"+login);
	return false;
	
}



</script>
<script language="javascript">
function test(event)
{
  if(event.keyCode==13){
   check();
   }
}
</script>
<style type="text/css">
.select-cls{
	color:#FFF !important;
	background:#B20024 !important;
}
</style>

    </head>
    <body >
   
    
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- HEADER-AREA START -->
         <?php include'header-new.php'?>
		<!-- HEADER-AREA END -->
   <form name="goodsForm" method="post">
          <input type="hidden" name="option_stock" value="<?=$product_stock[0]?>" readonly size="2">
<input type="hidden" name="goodsId" value="<?=$id?>"><!-- item idx -->
<input   type="hidden" name="price" id="price" value="<?=$product_hiddn_price?>">
<input type="hidden" name="supplier_id" value="<?=$product_info['user_id']?>" >
<input type="hidden" name="index_option" value="" >
		<!-- PAGE-CONTENT START -->
		<!--<section class="page-content">
			<!-- PAGE-BANNER START -->
 <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
	
			

		
<!--<div class="container">
								<h3>EBHA HAIR PRODUCTS</h3>
								<ul>
									<li><a href="index.html">Home&nbsp;</a>/&nbsp;Product Detail</li>
									
								</ul>
							</div>-->
			
			<!-- PAGE-BANNER END -->
			<!-- SINGLE-PRODUCT-AREA START -->
<section class="page-content">
			<div class="single-product-aea margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-5 col-xs-12">
							<div class="single-product-tab-content">
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="img-one">
										<img src="/product_img/<?=$product_img?>" alt="<?=strtolower($product_info['product_name'])?>" />
										<a href="/product_img/<?=$product_img?>"  data-lightbox="roadtrip" data-title="<?=strtolower($product_info['product_name'])?>">
											<span class="view-full-screen" ><i class="sp-full-view"></i> view full screen</span>
										</a>
									</div>
                                    <?php for($j=1;$j<$count_img;$j++) {
	                                  $new_imagesmall = str_replace(' ', '', $array_img[$j]);
	                            ?>
									<div role="tabpanel" class="tab-pane" id="<?=$j?>">
										<img src="./product_img/<?=$new_imagesmall?>" alt="<?=strtolower($product_info['product_name'])?>" />
										<a href="./product_img/<?=$new_imagesmall?>"  data-lightbox="roadtrip" data-title="<?=strtolower($product_info['product_name'])?>">
											<span class="view-full-screen" ><i class="sp-full-view"></i> view full screen</span>
										</a>
									</div>
                                    
                                    <? } ?>
									
								</div>
								<!-- Nav tabs -->
								<ul class="" >
                                <li class="active"><a href="#img-one"  data-toggle="tab"><img src="./product_img/<?=$product_img?>" alt="" /></a></li>
                                 <?php for($j=1;$j<$count_img;$j++) {
	    $new_imagesmall = str_replace(' ', '', $array_img[$j]);
	   ?>
									<li><a href="#<?=$j?>"  data-toggle="tab"><img src="./product_img/<?=$new_imagesmall?>" alt="" /></a></li>
                                  
                                    <?php } ?>
									
								</ul>
							</div>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-12">
							<div class="single-product-description">
								<h3><?=$product_info['product_name']?></h3>
								<h4 class="price"> <? if($_SESSION['level']!=2){?>
                     <b>
                     
                    
                     
                      <? } ?>
                      
                      
                      <? if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)){ ?>
            
                
                 <? if($length_option_count==0){?>
                   
                  <font size="+1" color="gray">Msrp</font> <strike>  $<span id="price_span"><?=number_format((float)$product_info['regular_price'], 2, '.', '')?></span> </strike>,
                   
                    <? }else{ ?>
                    
                    <font size="+1" color="gray">Msrp</font> <strike> $ <span id="price_span"><?=number_format((float)$product_price[0], 2, '.', '')?>  </span></strike> ,
                     
                    <? } ?>
                
                  
                  
                   
                   
                   
                <font size="+1" color="gray">Wholesale Price</font><font size="+2" color="#e90c0c">&nbsp;&nbsp; $
                 <? if( $length_option_count==0){?>
                
				 <span id="price_wholesale_span" style="color:#F00;">
				 
				 <?=number_format((float)$product_info['manufacture_price'], 2, '.', '')?> .</span>
                <? }else{ ?>
                <span id="price_wholesale_span" style="color:#F00;"><?=number_format((float)$product_price_wholesale[0], 2, '.', '')?> </span> 
                <? } ?>
               <b style="color:#F00; font-size:14px;"> </b>
               </font>
                
                
                  
                   
                
                <? }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){  ?>
				
				<? if($length_option_count==0){?> 
                <font size="+1" color="gray">Regular Price:</font>
                    <span id="price_span_regular" style="font-size:18px;"> 

                      <strike>$ <? $regularprice=number_format((float)$product_info['regular_price'], 2, '.', '');?>
					 <?=$regularprice?>  </strike></span>
                     <? }else{ ?>
                     <span id="price_span_regular">
                     <? $product_price_regularnew= number_format((float)$product_price_regular[0], 2, '.', ''); ?>  
					<strike>$ <?=$product_price_regularnew?> </strike> , </span>
                      <? }?>
               
                 <font size="+1" color="gray">&nbsp;Salon Price:</font> <font size="+2" color="#e90c0c">&nbsp;
                
                                <font size="+2" color="#e90c0c">$<? if( $length_option_count==0){
                                      $product_info_price=number_format((float)$product_info['msrp_price'], 2, '.', '');
                                      ?><span id="price_span"><?=$product_info_price?></span> 
                                       
                                        <? }else{  
                                        $product_info_price=number_format((float)$product_price[0], 2, '.', ''); ?>
                                        
                                         <span id="price_span"><?=$product_info_price?></span>
                                         
                                        <? } ?>		
            <? }else if(($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){  ?> 
            
            
            <? if($length_option_count==0){?> 
                <font size="+1" color="gray">Regular Price:</font>
                    <span id="price_span_regular" style="font-size:18px;"> 

                      <strike>$ <? $regularprice=number_format((float)$product_info['regular_price'], 2, '.', '');?>
					 <?=$regularprice?>  </strike></span>
                     <? }else{ ?>
                     <span id="price_span_regular">
                     <? $product_price_regularnew= number_format((float)$product_price_regular[0], 2, '.', ''); ?>  
					<strike>$ <?=$product_price_regularnew?> </strike> , </span>
                      <? }?>
               
                 <font size="+1" color="gray">&nbsp;Agent Price:</font> <font size="+2" color="#e90c0c">&nbsp;
                
                                <font size="+2" color="#e90c0c">$<? if( $length_option_count==0){
                                      $product_info_price=number_format((float)$product_info['agentprice1'], 2, '.', '');
                                      ?><span id="price_span"><?=$product_info_price?></span> 
                                       
                                        <? }else{  
                                        $product_info_price=number_format((float)$product_price[0], 2, '.', ''); ?>
                                        
                                         <span id="price_span"><?=$product_info_price?></span>
                                       	<? } ?>	
				
			<?	}else{  ?>
                <? if($length_option_count==0){?> 
                <font size="+1" color="gray">Regular Price:</font>
                    <span id="price_span_regular" style="font-size:18px;"> 

                      <strike>$ <? $regularprice=number_format((float)$product_info['regular_price'], 2, '.', '');?>
					 <?=$regularprice?>  </strike></span>
                     <? }else{ ?>
                     <span id="price_span_regular">
                     <? $product_price_regularnew= number_format((float)$product_price_regular[0], 2, '.', ''); ?>  
					<strike>$ <?=$product_price_regularnew?> </strike> , </span>
                      <? }?>
               
                 <font size="+1" color="gray">&nbsp;MSRP:</font><font size="+2" color="#e90c0c">&nbsp;
                
                                <font size="+2" color="#e90c0c">$<? if( $length_option_count==0){
                                      $product_info_price=number_format((float)$product_info['wholesale_price'], 2, '.', '');
                                      ?><span id="price_span"><?=$product_info_price?></span> 
                                       
                                        <? }else{  
                                        $product_info_price=number_format((float)$product_price[0], 2, '.', ''); ?>
                                        
                                         <span id="price_span"><?=$product_info_price?></span>
                                         
                                        <? } ?>
                    
                   
                <? } ?>
         
                     </font></font>
                     <!-- <font style="font-size:14px; color:#FF6633;">Save up to 20%</font>--> 
                     
                     </h4>
                     
							
                            
                      <div class="pro-size">
									
     <? if($length_option_count>0) {
				
				  ?>
              <div class="row" align="center" style="padding:.3em .5em;">
              <input   type="hidden" name="length_option" id="length" value="<?=$length_option_arr[0]?>" >
              <div  class="col-xs-12" align="left">
                 <div style="float:left;">&nbsp;&nbsp;Select LENGTH:&nbsp;</div>  
                 <div><span id="length_opt_cont"></span></div>
              </div>
              <div class="col-xs-12" align="center">
          <!-- length start -->
                <? for($z=0;$z<$length_option_count;$z++) {   if($length_option_arr[$z]!=''){?>
      <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 length-clss" id="length_<?=$z?>" onClick="length_update('<?=$z?>','<?=$length_option_arr[$z]?>')" align="center" style="margin:3px 5px; height:25px; background:#CCCCCC; cursor:pointer; padding-top:3px;" > 
         <?=$length_option_arr[$z]?>
 
  
  </div> 
  <? } } ?>
          <!-- length end -->    
              
              </div>
          
              </div>
              <? } ?>
								</div>      
                            
                            	<div class="pro-color">
									
									 <? if($color_img_count>0) {?>
        <!-- color start -->
        
      
              <div class="row" align="center" style="padding:.3em .5em;">
              <input  type="hidden" name="color_option" id="color_option" value="<?=$color_img[0]?>" >
              <div class="col-xs-12" align="left">
                  <div style="float:left">Select COLOR:</div> 
                  <div><span id="color_opt_cont"></span></div>
              </div>
              <div class="col-xs-12" align="center">
          <!-- color start -->
            <?php for($k=0;$k<$color_img_count;$k++){ if($color_img[$k]!=''){  ?> 
            
            <!--  <div class="col-lg-2 col-sm-4 col-xs-5 color-clss clss_<?=$color_img[$k]?>" id="color_<?=$k?>" 
      onClick="color_update('<?=$k?>','<?=$color_img[$k]?>')" align="center" style="margin:3px 5px; height:100px; background:#CCCCCC; cursor:pointer; padding:0px; padding-top:3px;" > <?=$color_img[$k]?> -->
     
      <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 color-clss clss_<?=$color_img[$k]?>" id="color_<?=$k?>" 
      onClick="color_update('<?=$k?>','<?=$color_img[$k]?>')" align="center" style="margin:3px 5px; height:100px; background:#CCCCCC; cursor:pointer; padding:0px; padding-top:3px;" > <?=$color_img[$k]?>
      
   <img src="<? if(file_exists("upload/color/$color_img[$k].jpg") || file_exists("upload/color/".strtoupper($color_img[$k]).".jpg")) { ?> upload/color/<?=$color_img[$k]?>.jpg <? } else {?> upload/color/no_image_available.jpg<? }?>" class="full" 
  style="border:0px; background:none; padding:0; border-radius:0; width:100%; height:80px;">    
		
 
  
  </div> 
  <? } } ?>
  
   <!-- color end -->    
              
              </div>
                 </div>
            
        <!-- color end -->  
              <? } ?>
								</div>
								
								<div class="product-counts fix margin-top-80">
									<form action="#">
										<div class="cart-plus-minus"><input type="text" value="1" id="cnt" name="cnt"/></div>
									</form>
									<div class="single-pro-add-cart">
										<a class="shop-now" onClick="javascript:addCart('cart');">Add to cart </a>
									</div>
								</div>
								<div class="single-pro-share">
									<ul>
										<li><a href="#"><i class="sp-share"></i><span>Share</span></a></li>
										<li><a href="#"><i class="sp-heart"></i><span>Add to Wishlist</span></a></li>
										<li><a href="#"><i class=" sp-compare-alt"></i><span>Compare</span></a></li>
									</ul>
								</div>
								<div class="categories-tags">
									<div class="categories">
										<span>CATEGORIES:</span>
										<a href="#"><?=$product_info['category']?></a>
										
									</div>
									<div class="categories tags">
										<span>Tags:</span>
										<a href="#">#remy hair,#human hair,#wigs,#weaving,#lace wig,#hair extensions</a>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SINGLE-PRODUCT-AREA END -->
			<!-- SINGLE-PRODUCT-REVIEWS-AREA START -->
			<div class="single-product-reviews-area margin-bottom-80">
				<div class="container2">
					<div  style="width:95%">
						<div  style="width:90%">
							<div class="discription-reviews-tab">
								<!-- Nav tabs -->
								<ul class="reviews-tab-menu" role="tablist">
									<li role="presentation" class="active"><a href="#description" data-toggle="tab">Description</a></li>
									<!--<li role="presentation"><a href="#reviews"  data-toggle="tab">Reviews</a></li>-->
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="description" style="margin-left:0px;">
										<div class="single-pro-product-description" >
											<?=utf8_encode($product_info['description']);?>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SINGLE-PRODUCT-REVIEWS-AREA END -->
			<!-- SINGLE-PRODUCT-RELATED-AREA START -->
			<div class="single-product-related-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="related-product-title"> 
								<h3>Related Product</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="active-related-product shop-grid">
					 <? while($new_arrival1=mysql_fetch_assoc($new_arrivals)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
		$producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $new_arrival1['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
   
 
		   ?>
                    
                    <!-- Single-product start -->
					<div class="single-product">
						<div class="product-photo">
							<a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html" title="<?=strtolower($new_arrival1['product_name'])?>">
								<img class="primary-photo" src="product_img/<?=$new_arrival1_img?>" alt="<?=strtolower($new_arrival1['product_name'])?>" />
								<img class="secondary-photo" src="product_img/<?=$new_arrival1_img?>" alt="<?=strtolower($new_arrival1['product_name'])?>" />
							</a>
							<div class="pro-action">
							<!--	<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a> -->
								<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
							<!--	<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a> -->
							</div>
						</div>
						<div class="product-brief">
							<h2><a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html" title="<?=strtolower($new_arrival1['product_name'])?>"><?php echo $new_arrival1['product_name']?></a></h2>
							<h3><?php if($_SESSION['verify_status']==1){ ?> 
                            <!-- <strike>$<?php echo $new_arrival1['msrp_price']?></strike>   
                               <span  class="size">$<b><?php echo $new_arrival1['rp_price']?></b> </span> -->
                         <? } else {?>
                         
                        <!--  <strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp;<span style="color:#F00;" class="size">
                          $<b><?php echo $new_arrival1['msrp_price']?> </b></span> -->
             
              <? } ?>
               
               </h3>
						</div>
					</div>
					<!-- Single-product end -->
                    
                     <? } ?>
                    
                    
					
					
					
					
				</div>
			</div>
			<!-- SINGLE-PRODUCT-RELATED-AREA END -->
			<!-- SERVICE-AREA START -->
			<div class="service-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-transport"></i>
								</div>
								<div class="service-brief">
									<h3>EBHA</h3>
									<p>Fast shipping by UPS, USPS, Fedex</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-head-phone"></i>
								</div>
								<div class="service-brief">
									<h3>help line</h3>
									<p>info@ebahair.com </p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-business"></i>
								</div>
								<div class="service-brief">
									<h3>High quality guarantee</h3>
									<p>&nbsp;</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SERVICE-AREA END -->
		</section>
		<!-- PAGE-CONTENT END -->
        </form>
		
		<!-- FOOTER-AREA START -->
		<div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>

<div id="overlay-mask-1" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content"> 
    <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" id="loginform'" onSubmit="return_validate()" autocomplete="on">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"><img class="img-responsive" src="images/logo1.png"></div>
  
   
     <h3 class="h3">Member Login</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="email" placeholder="email" id="email_login" name="email_login" class="form-control"></div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="password" placeholder="password" name="pwd_login" id="pwd_login" class="form-control"></div>
   
   
   <div class="" style="margin-top:2em;">
   <button type="button"  class="blue-btn glyphicon glyphicon-lock" onClick="check()" style="background:#268BB9; color:#FFF; width: 85%;">
  <span class="" style="font-family:sans-serif;" >SIGN IN</span>
  </button>
  <br>
   <span style="text-decoration:underline;"> <a href ="forget_password.php">Forgot Your Password ?</a></span><br>
   
  
   <br>
    <button type="button" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF; width: 85%;" onClick="close_popup('overlay-mask-1')">
  <span class="" style="font-family:sans-serif;">Cancel</span>
  </button>
   </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   <div style="border:0px solid #97cf00; padding:1em;" class="content"> 
    <div style="width:98%; padding:0;;" class="row">
    <div class="col-lg-12 col-xs-12 col-xs-12 text-center">
      <strong> <a href="/register.php" target="_blank">NEW MEMBER REGISTER</a></strong>
      </div>
      </div>
      </div>
     
    </div>
    </div>
  
    
    </div>
<!-- login popup end -->

    </body>
</html>
