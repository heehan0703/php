<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];

$orderid=$_GET['id'];
if($_GET['act']=='delete')
{
	//print_r($_GET);
	$member_id =$_GET['member_id'];
	$user_id =$_GET['user_id'];
	$tradecode =$_GET['tradecode'];
$query3=mysql_query("delete from `trade` where id='$member_id' ");
$query4 =mysql_query("delete from `trade_goods` where tradecode='$tradecode'");	
	 // echo "delete from `trade` where id='$member_id' "; 
	  //echo "delete from `trade_goods` where tradecode='$tradecode'";
header("Location: /order-list.php");
	 	  
}

 if(isset($_POST['submit'])) 

{
	 $tradecode = $_POST['tradecode'];
     $status = $_POST['status'];
	 $trans_company=$_POST['trans_company'];
	 $trans_number=$_POST['trans_number'];
	  mysql_query("update `trade` set status='$status',trans_company='$trans_company',trans_number='$trans_number' where id='$id' and tradecode ='$tradecode'");
}

$order=mysql_query("select * from trade where ISR=$mem_id");

if($_GET['userid']){
$userid=$_GET['userid'];
$order=mysql_query("select * from trade where ISR=$mem_id and userid='$userid'");
//echo "select * from trade where ISR=$mem_id and userid=$userid";
}


$trade_row= mysql_fetch_assoc(mysql_query("SELECT id,tradecode,userid_part,totalM,userid,shipM,payM,paymethod,shipotherM,
DATE_FORMAT(FROM_UNIXTIME(`writeday`), '%m-%d-%Y') as date,
name1,name2,adr1,adr2,city,state,country,zip,rname1,rname2,radr1,radr2,rcity,rstate,rcountry,rzip,totalweight,order_status,
order_status,status,trans_company,trans_number,servicechoose,storeid,order_type FROM `trade` where id='$orderid' "));



$stmt =mysql_query("SELECT * FROM `trade_goods` where tradecode='$trade_row[tradecode]'");	
if(isset($_POST['submit3'])) 
{
	 $id = $_POST['retuen_issue_id'];
     $return_status = $_POST['return_status'];
	  mysql_query("update `trade_goods` set return_issue='$return_status' where id='$id'");
      
}

if(isset($_POST['submit1']))
{    
     $user_id=$_POST['user_id'];	 
	 $supplier_id = mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id='$user_id' "));
	 $supplier_email=$supplier_id['email'];
	 $product_name=$_POST['product_name'];
     $product_img=$_POST['product_img'];
     $product_code=$_POST['product_code'];
     $product_color=$_POST['product_color'];
     $product_price=$_POST['product_price'];
     $product_cnt=$_POST['product_cnt'];     
	 $to = $supplier_email;
     $from = "info@ebhahair.com/";
     $subject = "ORDER Product";

$body = "<html><body>
              <p><strong>New Product Details</strong></p>
              <table border ='2'>
                   <tr><td>Product Name :</td><td>$product_name</td></tr>
                   <tr><td>Product Image :</td><td><img width='100' height='100' src='http://beautco.com/product_img/$product_img'></td></tr>
                   <tr><td>Product Code:</td><td>$product_code</td></tr>
                   <tr><td>Product Color:</td><td>$product_color</td></tr>
                   <tr><td>Product Price:</td><td>$product_price</td></tr>
				   <tr><td>Product No.:</td><td>$product_cnt</td></tr>
                   
			</table>
		</body></html>";
 
		 $headers =  "From:fahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 

		 
		
		
        mail($to,$subject,html_entity_decode($body),$headers);
		
}

if(isset($_POST['email_1']))
{    
     $user_email=$_POST['user_email'];
	 
	
	
	  
	 
	 $tradecode=$_POST['tradecode'];
     $status=$_POST['status'];
     $trans_company=$_POST['trans_company'];
     $trans_number=$_POST['trans_number'];
    
     
	 $to = $user_email;
     $from = "info@ebhahair.com";
     $subject = "User Trans Details";

$body = "<html><body>
              <p><strong>New Product Details</strong></p>
              <table border ='2'>
                   <tr><td>Order Name :</td><td>$tradecode</td></tr>
                   <tr><td>Status:</td><td>$status</td></tr>
                   <tr><td>Trans Company:</td><td>$trans_company</td></tr>
                   <tr><td>Trans number:</td><td>$trans_number</td></tr>
				   
                   
			</table>
		</body></html>";
 
		 $headers =  "From:fahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 

		 
		
		
        mail($to,$subject,html_entity_decode($body),$headers);
		
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>aside - Bootstrap 4 web application</title>
  <meta name="description" content="Responsive, Bootstrap, BS4" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="css/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="css/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/material-design-icons/material-design-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/ionicons/css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />

  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="css/styles/app.css" type="text/css" />
  <link rel="stylesheet" href="css/styles/style.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="css/styles/font.css" type="text/css" />
  <style type="text/css">
  .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th {
    padding-left: 0px;
    padding-right: 0px;
	 

    
}
.img1{
 height:85px; width:auto;

}
.projecthead{
font-size: 100%;
}
.statu{
width:150px;
}
.tdimg{
float:left;
}

@media only screen and (max-width:600px) {

  
}

@media screen and (max-width: 640px) {

.img1{
width:100%; max-width:100%;
height:auto;

}
.tdimg{
float:none;
}
.statu{
width:50px;
}
 .projecthead{
font-size: 50%;
}
	table {
		overflow-x: auto;
		display: block;
	}
}

  </style>
  
</head>
<body>
 <div class="app" id="app">

<!-- ############ LAYOUT START-->

 <!-- ############ LAYOUT START-->

 <?php include'isr_left.php'?>
 
 
  <!-- / -->
  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">Dashboard</div>
                <!-- nabar right -->
                <ul class="nav navbar-nav pull-right">
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link" data-toggle="dropdown">
                      <i class="ion-android-search w-24"></i>
                    </a>
                    <div class="dropdown-menu text-color w-md animated fadeInUp pull-right">
                      <!-- search form -->
                      <form class="navbar-form form-inline navbar-item m-a-0 p-x v-m" role="search">
                        <div class="form-group l-h m-a-0">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search projects...">
                            <span class="input-group-btn">
                              <button type="submit" class="btn white b-a no-shadow"><i class="fa fa-search"></i></button>
                            </span>
                          </div>
                        </div>
                      </form>
                      <!-- / search form -->
                    </div>
                  </li>
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <i class="ion-android-notifications-none w-24"></i>
                      <span class="label up p-a-0 danger"></span>
                    </a>
                    <!-- dropdown -->
                    <div class="dropdown-menu pull-right w-xl animated fadeIn no-bg no-border no-shadow">
                        <div class="scrollable" style="max-height: 220px">
                          <ul class="list-group list-group-gap m-a-0">
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a0.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                Use awesome <a href="#" class="text-primary">animate.css</a><br>
                                <small class="text-muted">10 minutes ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a1.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Joe</a> Added you as friend<br>
                                <small class="text-muted">2 hours ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white text-color box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a2.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Danie</a> sent you a message<br>
                                <small class="text-muted">1 day ago</small>
                              </span>
                            </li>
                          </ul>
                        </div>
                    </div>
                    <!-- / dropdown -->
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <span class="avatar w-32">
                        <img src="images/a3.jpg" class="w-full rounded" alt="...">
                      </span>
                    </a>
                    <div class="dropdown-menu w dropdown-menu-scale pull-right">
                      <a class="dropdown-item" href="profile.html">
                        <span>Profile</span>
                      </a>
                      <a class="dropdown-item" href="setting.html">
                        <span>Settings</span>
                      </a>
                      <a class="dropdown-item" href="app.inbox.html">
                        <span>Inbox</span>
                      </a>
                      <a class="dropdown-item" href="app.message.html">
                        <span>Message</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="docs.html">
                        Need help?
                      </a>
                      <a class="dropdown-item" href="signout.php">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
   
                                 

                            

    <div class="app-body" style="height:100%;  right:0; top:0; z-index:1; visibility:visible; visibility:; visibility:;">
	<br><div align="center"><table><tr>

                              <td align="left" class="white-18"><font size="+2"><b>Order List</b></font></td>
                              
                                 </tr></table></div>

    <div id="datatable" style="width:100%; ">
      <table class="table" style=" width:100%; padding:0px; margin:0px;table-layout:fixed"  cellpadding="0" cellspacing="">
             
                <tr>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Ordering Number</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Ordered Date</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Delete</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Status</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>E-mail</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Trans Company</b></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Trans Number</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>E-mail to buyer</b></span></td>
                    
                    
                </tr>
            
            
           
             <form action="" method="post" >
             
                <tr>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><input type="hidden" value="<?=$trade_row['tradecode']?>" name="tradecode" /><?=$trade_row['tradecode']?></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><?=$trade_row['date']?></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><a href="buyer_order_list_details.php?act=delete&member_id=<?= $trade_row['id'] ?>&userid=<?=$trade_row['userid']?>&tradecode=<?=$trade_row['tradecode']?>"
                       onclick="return confirm('You want delete this order!');">Delete</a></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead">
                   <select name="status" class="statu" >
<option  value="Ordered" <?php if($trade_row['status']=='Ordered'){?> selected<?php } ?>>
Ordered</option>
<option value="Confirming Payment" <?php if($trade_row['status']=='Confirming Payment'){?> selected<?php } ?>>
Confirming Payment</option>
<option value="Now Shipping" <?php if($trade_row['status']=='Now Shipping'){?> selected<?php } ?>>
Now Shipping</option>
<option value="Shipping Completed" <?php if($trade_row['status']=='Shipping Completed'){?> selected<?php } ?> >
Shipping Completed</option>
<option value="Order Cancelled" <?php if($trade_row['status']=='Order Cancelled'){?> selected<?php } ?>>
Order Cancelled</option>
<option value="Returning" <?php if($trade_row['status']=='Returning'){?> selected<?php } ?>>
Returning</option>
<option value="Not Paid" <?php if($trade_row['status']=='Not Paid'){?> selected<?php } ?>>
Not Paid</option>
<option value="Paypal Not Paid" <?php if($trade_row['status']=='Paypal Not Paid'){?> selected<?php } ?>>
Paypal Not Paid</option>
<option value="PAID" <?php if($trade_row['status']=='PAID'){?> selected<?php } ?>>
PAID</option>
                                            </select></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><input type="button" id="email" name="email" value="Email" /></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><input  type="text" name="trans_company" size="12" value="<?=$trade_row['trans_company']?>"></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><input  type="text" name="trans_number" size="12" value="<?=$trade_row['trans_number']?>"></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><input type="submit" name="submit" value="Update" /></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><input type="submit" name="email_1" value="Email" onClick="alert('You mail successfully sent to <?=$trade_row['userid']?>');" /></span></td>
                   
                    
                </tr>
                
                
                 <tr>
                      <td colspan="9"><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="9" align="center"><h2>List Ordering</h2></td></tr>
                      
                      
                       <tr>
                     <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Product Name</b></span></td>
                     <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Product Code</b></span></td>
                     <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Option</b></span></td>
                      <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Price/ Quantity</b></span></td>
                      <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Subtotal</b></span></td>
                      <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Ship Status</b></span></td>
                      <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b> Ship details</b></span></td>
                      <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Order to Supplier</b></span></td>
                      <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Return</b></span></td>
                      </tr>
                       <tr><td colspan="9"><hr color="#CCCCCC"></td></tr>
                      <?php
                      $count=0;	
					   while($trade_goods_row=mysql_fetch_assoc($stmt)){
					   $userid= $trade_goods_row['userid'];
					       $ordered_user = mysql_fetch_array(mysql_query("SELECT * FROM `member` where email='$userid'"));
						   $level=$ordered_user['level'];
			           $count++;
                       $product_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$trade_goods_row[goodsId]'"));
					   //echo "SELECT * FROM `product` where id='$trade_goods_row[goodsId]'";
                       
                       if (strpos($product_row['images'],',') !== false) {
                       $product_img=explode(',',$product_row['images']);
                       $product_img=$product_img[0];
					    }
                        else{
                      $product_img=$product_row['images'];	
                          }
						  
					   $lenght=explode('-',$trade_goods_row['option2']);
                       $lenght=$lenght[1];	
					   
					   $subtotal +=$trade_goods_row['cnt']*$trade_goods_row['price'];	
                       ?>
                      <tr>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center">
                      
                     <table><tr>
                      <td width="100%" align="center">
                      <div class="tdimg"><img width="100" height="100" src="../product_img/<?=$product_img?>"  class="img1"> </div>
                      <div class="tdimg"><span class="projecthead"><?=$product_row['product_name']?></span> </div> 
                      
                      </td>
					 
                      </tr></table>
                      </td>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead"><?=$product_row['product_code']?></span></td>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead"><?=$lenght?>"/<?= $trade_goods_row['option1']?></span></td>
                       <? if($_SESSION['ISR_ID']){ 
					   
					      
	                        $userprice=explode(',',$product_row['wholesaleprice2']);
	                         $price1=$userprice[$trade_goods_row['option_index']];
					   
					   
					   ?>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">$<?=$price1."/".$trade_goods_row['cnt']?></span></td>
                      <? }else{ ?>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">$<?=$trade_goods_row['price']."/".$trade_goods_row['cnt']?></span></td>
                       <? } ?>
                      <? if($_SESSION['ISR_ID']){
					   
	                        $userprice=explode(',',$product_row['wholesaleprice2']);
	                         $price1=$userprice[$trade_goods_row['option_index']];
					    ?>
                        <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">$<?=$trade_goods_row['cnt']*$price1?></span></td>
                      <? }else{ ?>
                         <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">$<?=$trade_goods_row['cnt']*$trade_goods_row['price']?></span></td>
                      <? } ?>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">
                      <select name="shipping_status" class="statu" >
                      <option value="0">Select </option>
                      <option value="1" <?php if($trade_goods_row['shipping_status'] =='1'){ ?> selected <?php } ?>>Not Ship Yet</option>
                      <option value="2" <?php if($trade_goods_row['shipping_status'] =='2'){ ?> selected <?php } ?>>Ship Completed</option>
                      <option value="3" <?php if($trade_goods_row['shipping_status'] =='3'){ ?> selected <?php } ?> >Out of Stock</option>
                      </select>
                      </span>
                      
                      </td>
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">Trans Company :<br />
                                           <select name="trans_company" class="statu" >
<option value ="USPS" <?php if($product_row['shipping_method'] =='USPS'){ ?> selected <?php } ?>>USPS</option>
<option value ="SINA SHIPPING" <?php if($product_row['shipping_method'] =='SINA SHIPPING'){ ?> selected <?php } ?>>SINA SHIPPING</option>
<option value ="UPS" <?php if($product_row['shipping_method'] =='UPS'){ ?> selected <?php } ?>>UPS</option>
<option value ="DHL" <?php if($product_row['shipping_method'] =='DHL'){ ?> selected <?php } ?>>DHL</option>
<option value ="Fedex" <?php if($product_row['shipping_method'] =='Fedex'){ ?> selected <?php } ?>>Fedex</option>
<option value ="FREE SHIPPING" <?php if($product_row['shipping_method'] =='FREE SHIPPING'){ ?> selected <?php } ?>>FREE SHIPPING</option>
</select><br />
                                                     Tracking  : <br /><input type="text" name="tracking" value="<?= $trade_goods_row['tracking'] ?>"  class="statu" />
                                                    </span> </td>
                       <form method="post"  action="" >   
                 <input type="hidden" name="product_name" value="<?=$product_row['product_name']?>"  /> 
                 <input type="hidden" name="product_img" value="<?=$product_img?>"  />  
                 <input type="hidden" name="product_code" value="<?=$product_row['product_code']?>"  /> 
                 <input type="hidden" name="product_color" value="<?=$color?>"  /> 
                 <input type="hidden" name="product_price" value="<?=$trade_goods_row['price']?>"  /> 
                 <input type="hidden" name="product_cnt" value="<?=$trade_goods_row['cnt']?>"  />  
                 <input type="hidden" name="user_id" value="<?=$product_row['user_id']?>"  />          
                                               
                      <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">
                  <input type="submit" name="submit1" value="E-Mail" onClick="show_alert();" 
                   style="border:0px; background:transparent;"  /></span></td>
                    
                   <script>
                  function show_alert() {
                  alert("Your Mail Send Successfully to Supplier");
                    }
                  </script>
                   </form>
                   <form method="post"  action="" name= "form1">
                  <td style="width:10%;padding:0px; margin:0px;text-align:center;" align="center"><span class="projecthead">
                  <input type="hidden" name="retuen_issue_id" value ="<?=$trade_goods_row['id'] ?>" />
                  <select name="return_status" class="statu" >
                  <option value="0">Select</option>
                  <option value="1" <?php if($trade_goods_row['return_issue'] =='1'){ ?> selected <?php } ?>>Not Return</option>
                  <option value="2" <?php if($trade_goods_row['return_issue'] =='2'){ ?> selected <?php } ?>>Missing Item</option>
                  <option value="3" <?php if($trade_goods_row['return_issue'] =='3'){ ?> selected <?php } ?>>Wrong Shipment</option>
                  <option value="4" <?php if($trade_goods_row['return_issue'] =='4'){ ?> selected <?php } ?>>Quality Issue</option>
                  <option value="5" <?php if($trade_goods_row['return_issue'] =='5'){ ?> selected <?php } ?>>Defective Product</option>
                  <option value="6" <?php if($trade_goods_row['return_issue'] =='6'){ ?> selected <?php } ?>>Damaged Product</option>
                  </select>
                  <br />
                  <input align="middle" type="submit" name="submit3" value="Update" />
                   </span></td></form>
                                        </tr>
                      
                      <tr><td colspan="9"><hr color="#CCCCCC"></td></tr>
                     <?php } 
					  ?>
                      
                      
                      </table></td></tr>
                      
                      
                       <tr>
                      <td colspan="9"><table width="100%" cellpadding="3" cellspacing="3">
                      <tr>
                      <td colspan="2" align="center"><h2>Payment Information</h2></td>
                      </tr>
                      <tr>
                      
                      <td width="8%" align="left"><strong>Subtotal</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['totalM'],2)?></td>
                      </tr>
                     
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Price/Shipping Method</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['shipM'],2) ?>&nbsp; &nbsp;/&nbsp; &nbsp;<?=$trade_row['servicechoose']?></td>
                      </tr>
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                       <tr>
                      <td width="8%" align="left"><strong>Tax</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Used Points</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>
                        <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Used Coupon</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['discount'],2) ?></td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                    <tr>
                      <td width="8%" align="left"><strong>Shiping cost for other country</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['shipotherM'],2) ?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>

                      <tr>
                      <td width="8%" align="left"><strong> Total amount you will pay</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['totalM'] + $trade_row['shipM']+$trade_row['shipotherM'],2)  ?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong> Payment Method</strong></td>
                      <td width="8%" align="left"><?=$trade_row['paymethod']?> </td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Method</strong></td>
                      <td width="8%" align="left"><?=$product_row['shipping_method']?></td>
                      </tr>
                      
                    <?   if($trade_row['order_type']=='Pickup') { ?>
                      
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Pickup Store Name</strong></td>
                      <td width="8%" align="left"><?=$storerow['s_name']?></td>
                      </tr>
                      
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Pickup Store Phone</strong></td>
                      <td width="8%" align="left"><?=$storerow['s_phone']?></td>
                      </tr>
                      
                     <? }  ?>
                      
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      </table>
                      </td>
                      </tr>
                      
                          <?php  
						  $useremail=$trade_row['userid'];
						 // echo "select * from member email='$useremail'";
						 $customerinfo =mysql_fetch_array(mysql_query("select * from member where email='$useremail'"));
						  
						  
						  ?>
                           <tr>
                      <td colspan="9"><table width="100%" cellpadding="3" cellspacing="3">
                      <tr>
                      <td colspan="2" align="center" ><h2>Billing Information</h2></td>
                      </tr>
                      <tr>
                      <td width="8%" align="left"><strong>Customer</strong></td>
                      <td width="8%" align="left"><?=$trade_row['userid']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Name</strong></td>
                      <td width="8%" align="left"><?=$trade_row['name1']?> <?=$trade_row['name2']?></td>
                      </tr>
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                       
                      <tr>
                      <td width="8%" align="left"><strong>Address</strong></td>
                      <td width="8%" align="left"><?=$trade_row['adr1']?> <?=$trade_row['adr2']?></td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>City</strong></td>
                      <td width="8%" align="left"><?=$trade_row['city']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <?php $state = mysql_result(mysql_query("select state_name from state where state_id ='$trade_row[state]' "),0);
					        $country = mysql_result(mysql_query("select country_name from country where country_id ='$trade_row[country]' "),0);
					  
					   ?>
                      <tr>
                      <td width="8%" align="left"><strong>State/Country</strong></td>
                      <td width="8%" align="left"><?=$state?>/<?=$country?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Zip Code</strong></td>
                      <td width="8%" align="left"><?=$trade_row['zip']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                     <tr>
                      <td width="8%" align="left"><strong>Phone Number</strong></td>
                      <td width="8%" align="left"><?=$customerinfo['tel']?></td>
                      </tr>
                       <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      
                      </table>
                      </td>
                      </tr>
                     
                     
                     
                                 <tr>
                      <td colspan="9"><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="2" align="center" ><h2>Shipping Address Information</h2></td></tr>
                      
                      <tr>
                      <td width="8%" align="left"><strong>Name</strong></td>
                      <td width="8%" align="left"> <?=$trade_row['rname2']?></td>
                      </tr>
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Address</strong></td>
                      <td width="8%" align="left"><?=$trade_row['radr1']?> </td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>City</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rcity']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <?php $rstate = mysql_result(mysql_query("select state_name from state where state_id ='$trade_row[rstate]' "),0);
					        $rcountry = mysql_result(mysql_query("select country_name from country where country_id ='$trade_row[rcountry]' "),0);
					  
					   ?>
                      <tr>
                      <td width="8%" align="left"><strong>State/Country</strong></td>
                      <td width="8%" align="left"><?=$rstate?>/<?=$rcountry?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Zip Code</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rzip']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                     <tr>
                      <td width="8%" align="left"><strong>Ship to Phone Number</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>
                      
                     
                      
                      </table>
                      </td>
                      </tr>
                      
           
            </form>
           
			
        
           
        
      </table>
    </div>          
  </div>
       <div align="center"> <p><span class="red-18" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid blue; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space:
normal; widows: 2; word-spacing:
0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><b style="box-sizing: border-box; font-weight: 700;">1</b></span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width:
0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(2)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps:
normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;2&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align:
right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(3)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica
Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;3&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style:
normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(4)" style="box-sizing: border-box; display: inline-block; width: 30px;
border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;4&nbsp;</span><span
style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span
class="blue-12" onClick="dhirendra(5)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2;
word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;5&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color:
rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(6)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight:
normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;6&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent:
0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(7)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica,
Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;7&nbsp;</span></p></DIV>
        <p><!-- ############ PAGE END-->
</p>
    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
   
<!-- ############ SWITHCHER END-->

<!-- ############ LAYOUT END-->
</div>
<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
  <script src="libs/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="libs/tether/dist/js/tether.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/PACE/pace.min.js"></script>
  <script src="libs/jquery-pjax/jquery.pjax.js"></script>
  <script src="libs/blockUI/jquery.blockUI.js"></script>
  <script src="libs/jscroll/jquery.jscroll.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-modal.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-list.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>
  <script src="scripts/ui-taburl.js"></script>
  <script src="scripts/app.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->

</body>
</html>

 