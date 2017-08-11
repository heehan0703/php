<?php
session_start();


require_once('wp-admin/include/connectdb.php');

if(isset($_POST['email_check']) && $_POST['email_check']!=''){

$email_check= mysql_real_escape_string($_POST['email_check']);


$count=mysql_num_rows(mysql_query("select * from member where email='$email_check'"));

echo $count;

}


if(isset($_POST['message_update']) && $_POST['message_update']==1){

if($_SESSION['member_id']!=''){
 $message_id=$_POST['message_id'];	
  mysql_query("update message set status=1 where id='$message_id' and member_id='$_SESSION[member_id]'");
}
}

if(isset($_POST['archive_msg']) && $_POST['archive_msg']==1){
if($_SESSION['member_id']!=''){
	$msg_id=$_POST['archive_msg_id'];
 $count=count($msg_id);	
 for($i=0;$i<$count;$i++){
 	 $new_id=$msg_id[$i];
 mysql_query("update message set archive='1',trash='0' where id='$new_id' and member_id='$_SESSION[member_id]'");
 }
}
 else{
echo 'invalid';	 
 
 }

}

if(isset($_POST['delete_msg']) && $_POST['delete_msg']==1){
if($_SESSION['member_id']!=''){
	
	if($_POST['trash_val']==1){
	$msg_id=$_POST['del_msg_id'];
 $count=count($msg_id);	
 for($i=0;$i<$count;$i++){
 	 $new_id=$msg_id[$i];
 mysql_query("delete from message  where id='$new_id' and member_id='$_SESSION[member_id]'");
 }	
	}
	else{
	
	$msg_id=$_POST['del_msg_id'];
 $count=count($msg_id);	
 for($i=0;$i<$count;$i++){
 	 $new_id=$msg_id[$i];
 mysql_query("update message set trash='1',archive='0' where id='$new_id' and member_id='$_SESSION[member_id]'");
 }
	}
}
 else{
echo 'invalid';	 
 
 }

}

if(isset($_POST['content_type']) && $_POST['content_type']!=''){
 
 $content_type=$_POST['content_type'];
 if($_SESSION['member_id']!=''){
if($content_type=='archive'){
	 $message_query=mysql_query("SELECT * FROM `message` where member_id='$_SESSION[member_id]' and  archive='1' and sent='0'");
}
if($content_type=='trash'){
	$message_query=mysql_query("SELECT * FROM `message` where member_id='$_SESSION[member_id]' and  trash='1' and sent='0'");
}
if($content_type=='inbox'){
	$message_query=mysql_query("SELECT * FROM `message` where member_id='$_SESSION[member_id]' and  trash='0' and archive='0'
	and sent='0' ");
}
if($content_type=='sent'){
	$message_query=mysql_query("SELECT * FROM `message` where member_id='$_SESSION[member_id]' and  trash='0' and archive='0'
	and sent='1' ");	
}
	$count=mysql_num_rows($message_query);
	 if($count>0){
	 while($message_row=mysql_fetch_assoc($message_query)) { ?>
<div class="full message-cls <? if($message_row['status']==0) {?> unread-cls <? } ?> " 
onClick="read_msg(this,<?=$message_row['id']?>)" style=" border-bottom:1px solid #E8E8E8; padding:.7em 0; cursor:pointer;">
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><input class="checkbox-cls <? if($message_row['status']==0){?> unread-checkbox-cls
 <? } else {?> read-checkbox-cls <? } ?>" type="checkbox" name="checkbox_name[]" value="<?=$message_row['id']?>" >
</div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><span class="glyphicon glyphicon-flag" style="color:#CCCCCC;"></span></div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" id="from_content_<?=$message_row['id']?>" ><?=$message_row['from']?></div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " ><span class="small-hidden">--</span>
<input type="hidden" name="message_content" id="message_content_<?=$message_row['id']?>" value="<?=$message_row['message_detail']?>" >
</div>
<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 dotted-text" id="subject_content_<?=$message_row['id']?>"><?=$message_row['subject']?></div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right" ><?=date("M j",$message_row['date'])?>
<span style="display:none;" id="date_content_<?=$message_row['id']?>"><?=date("M-j-y g:i a",$message_row['date'])?>  </span></div>
</div>

<?php } 
	 }
	 else{
	?>
    <div align="center" class="full message-cls "  style=" border-top:1px solid #e8e8e8; border-bottom:1px solid #E8E8E8; padding:.7em 0; cursor:pointer;">
    Your <span style=" text-transform:capitalize;"><?=$content_type?></span>  Box is empty !
    	</div> 
	<? }
 }

else{
echo 0;	
}

 
}

if(isset($_POST['set_reply'])  && $_POST['set_reply']==1){
if($_SESSION['member_id']!=''){
 $from_reply=$_POST['from_reply'];
 $subject_reply = $_POST['subject_reply'];
 $textarea_reply = $_POST['textarea_reply'];
 $time=time();
 
$insert=("INSERT INTO `message`( `member_id`, `from`, `subject`, `message_detail`, `date`, `sent`,`user_type`) VALUES
 ('$_SESSION[member_id]','$from_reply','$subject_reply','$textarea_reply','$time','1','$_SESSION[user_type]')");	
 
 if(mysql_query($insert)){
echo 1;	 
 }

}

}


///compose msg start //
if(isset($_POST['set_compose'])  && $_POST['set_compose']==1){
if($_SESSION['member_id']!=''){
 //$from_reply=$_POST['from_reply'];
 $subject_compose = $_POST['subject_compose'];
 $textarea_compose = $_POST['textarea_compose'];
 $time=time();
 
$insert=("INSERT INTO `message`( `member_id`, `from`, `subject`, `message_detail`, `date`, `sent`,`user_type`) VALUES
 ('$_SESSION[member_id]','Beautco','$subject_compose','$textarea_compose','$time','1','$_SESSION[user_type]')");	
 
 if(mysql_query($insert)){
echo 1;	 
 }

}

}
// compose msg end //

if(isset($_POST['message_forward']) && $_POST['message_forward']==1){

if($_SESSION['member_id']!=''){

  $forward_to = $_POST['forward_to'];
  
  //$user_id=mysql_result(mysql_query("SELECT member_id FROM `member` where  email='$forward_to' "),0);
  
  $forward_subject = $_POST['forward_subject'];
  $forward_msg = $_POST['forward_msg'];
   $time=time();
	
//$email_to="address@gmail.com";
//$email_subject="It works";
//$email_message="Hello. I can send mail!";
//$headers = "From: Beautco.com\r\n".
//"Reply-To: $forward_to\r\n'" .
//"X-Mailer: PHP/" . phpversion();
$insert=("INSERT INTO `message`( `member_id`, `from`, `subject`, `message_detail`, `date`, `sent`,`user_type`) VALUES
 ('$_SESSION[member_id]','Beautco','$forward_subject','$forward_msg','$time','1','$_SESSION[user_type]')");	
 
 if(mysql_query($insert)){
	
echo 1;
	}
}
}
?>

<?
if(isset($_POST['search_inbox']) && $_POST['search_inbox']==1){
	if($_SESSION['member_id']!=''){
	$search_text = $_POST['search_text'];
$message_query=mysql_query("SELECT * FROM `message` where member_id='$_SESSION[member_id]' and  trash='0' and archive='0' and sent='0' and ( `from`  like  '%$search_text%' or `subject` like '%$search_text%' or `message_detail` like '%$search_text%')");

$count=mysql_num_rows($message_query);
	 if($count>0){
	 while($message_row=mysql_fetch_assoc($message_query)) { ?>
<div class="full message-cls <? if($message_row['status']==0) {?> unread-cls <? } ?> " 
onClick="read_msg(this,<?=$message_row['id']?>)" style=" border-bottom:1px solid #E8E8E8; padding:.7em 0; cursor:pointer;">
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><input class="checkbox-cls <? if($message_row['status']==0){?> unread-checkbox-cls
 <? } else {?> read-checkbox-cls <? } ?>" type="checkbox" name="checkbox_name[]" value="<?=$message_row['id']?>" >
</div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><span class="glyphicon glyphicon-flag" style="color:#CCCCCC;"></span></div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" id="from_content_<?=$message_row['id']?>" ><?=$message_row['from']?></div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " ><span class="small-hidden">--</span>
<input type="hidden" name="message_content" id="message_content_<?=$message_row['id']?>" value="<?=$message_row['message_detail']?>" >
</div>
<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 dotted-text" id="subject_content_<?=$message_row['id']?>"><?=$message_row['subject']?></div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right" ><?=date("M j",$message_row['date'])?>
<span style="display:none;" id="date_content_<?=$message_row['id']?>"><?=date("M-j-y g:i a",$message_row['date'])?>  </span></div>
</div>

<?php } 
	 }
	 else{
	?>
    <div align="center" class="full message-cls "  style=" border-top:1px solid #e8e8e8; border-bottom:1px solid #E8E8E8; padding:.7em 0; cursor:pointer;">
    Your <span style=" text-transform:capitalize;"><?=$content_type?></span>  Box is empty !
    	</div> 
	<? }
 
}
}
?>
<? if(isset($_POST['mail']) && $_POST['mail']==1){
if($_SESSION['member_id']!=''){	
	
	//$to='info@beautco.com';
	$to= 'nitinkaushik01@yahoo.co.in';
	$subject_mail = mysql_real_escape_string($_POST['subject_mail']);
	$message_mail = mysql_real_escape_string($_POST['message_mail']);
	$product_id = $_POST['product_id'];
	
	$message_body ="User $to send a mail to you.
	 Description : ".$message_mail;
	
	$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
	
	
 mysql_query("INSERT INTO `ask_question`(`user_id`,`product_id`, `user_email`, `subject`, `message`) VALUES ('$_SESSION[member_id]','$product_id','$GOOD_SHOP_USERID','$subject_mail','$message_mail')");

 
 $headers = "From: Beautco.com\r\n".
"Reply-To: $GOOD_SHOP_USERID\r\n'" .
"X-Mailer: PHP/" . phpversion();
if(mail($to, $subject_mail, $message_body, $headers)){
	 
echo 1;
	}
	?>

 
<? }

}


if(isset($_POST['text'])){

 $text = $_POST['text'];
 
   $search_by = $_POST['search_by'];
	
	if($search_by=='supplier'){
	
	$query=mysql_query("select * from member where email like '%$text%' and supplier='1'");
	}
	
	elseif($search_by=='member'){

$query=mysql_query("select * from member where email like '%$text%' and supplier='0' ");			
	}
	else{

$query=mysql_query("select * from member where email like '%$text%'  ");		
	}
	
	
	?>
    
    <script type="text/javascript">
   function update_forward_val(val){
	//alert(val);   
	$("#forward_to").val(val);
	$(".ajax-search").hide();
	
   }
   </script>
    <?
	while($query_row=mysql_fetch_assoc($query)){
	echo "<li onClick='update_forward_val(\"$query_row[email]\")'>$query_row[email]</li>";
		
	}
	
}


?>
<?
if(isset($_POST['cart_id']) && $_POST['cart_id']!=''){
	
	$userid = $_POST['userid'];
$cart_id = $_POST['cart_id'];
$count = $_POST['count'];

//echo "update  `cart` set cnt='$count' where id='$cart_id' and userid='$userid'";
mysql_query("update  `cart` set cnt='$count' where id='$cart_id' and userid='$userid'");
	
	$cart_goods_query = mysql_query("select * from cart where userid='$userid'");
	while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
		
	$sub_total +=$cart_goods_row['price']*$cart_goods_row['cnt'];	
	
	}
 echo $sub_total;
 
}
?>

<?php
if(isset($_POST['dropship_val']) && $_POST['dropship_val']!=''){
  $dropship_val = $_POST['dropship_val'];
 	$cart_id =$_POST['cart_id'];
	$uid =$_POST['uid'];
	//echo "update `cart` set dropship='$dropship_val' where id='$cart_id' and userid='$uid'";
	mysql_query("update `cart` set dropship='$dropship_val' where id='$cart_id' and userid='$uid'");
}
?>

<?php

if(isset($_POST['bulk_order_search']) && $_POST['bulk_order_search']!=''){

$bulk_cat1 = $_POST['bulk_cat1'];
$bulk_cat2 = $_POST['bulk_cat2'];
$bulk_cat3 = $_POST['bulk_cat3'];

$bulk_order_search =$_POST['bulk_order_search'];
	
	$query= mysql_query("SELECT * FROM `product` where category='$bulk_cat1' and subcategory='$bulk_cat2' and sub_subcategory='$bulk_cat3' and (product_name like '%$bulk_order_search%' or description like '%$bulk_order_search%') order by id desc");

 $count = mysql_num_rows($query);

if($count>0){

while($bulk_result_row=mysql_fetch_assoc($query)){
	
	$color_string= $bulk_result_row['color'];
	$color_array = explode(',',$color_string);
	
	$length_string= $bulk_result_row['length'];
	$length_array = explode(',',$length_string);
	
	$price_string= $bulk_result_row['price'];
	$price_array = explode(',',$price_string);
	
	$stock_string= $bulk_result_row['stock'];
	$stock_array = explode(',',$stock_string);
	
	$sku_string= $bulk_result_row['sku'];
	$sku_array = explode(',',$sku_string);
	
	$counter=0;
	for($i=0;$i<count($color_array);$i++){
	$counter++;
	
	?>
    <div class="full" style="background:<? if($counter%2==0) {?> #fff<? } else {?>#E8E8E8 <? } ?>;  ">
   <div class="col-lg-2" style="border-right:1px solid #FFF; min-height:26px;"><?=$bulk_result_row['product_name']?></div>  
   <div class="col-lg-1" style="border-right:1px solid #FFF;min-height:26px;"><?=$sku_array[$i]?></div> 
   <div class="col-lg-2" style="border-right:1px solid #FFF;min-height:26px;"><?=$length_array[$i]?></div> 
   <div class="col-lg-2" style="border-right:1px solid #FFF;min-height:26px;"><?=$color_array[$i]?></div> 
   <div class="col-lg-1" style="border-right:1px solid #FFF;min-height:26px;"><?=$price_array[$i]?></div> 
   <div class="col-lg-2" style="border-right:1px solid #FFF;min-height:26px;"><?=$stock_array[$i]?></div> 
   <div class="col-lg-2" style="min-height:26px;"><input type="text" class="form-group" name="quantity[]" value="0" style="height:24px;">
   <input type="hidden" name="product_id[]" value="<?=$bulk_result_row['id']?>"  >
      <input type="hidden" name="supplier_id[]" value="<?=$bulk_result_row['user_id']?>"  >
   <input type="hidden" name="color[]" value="<?=$color_array[$i]?>"  >
   <input type="hidden" name="price[]" value="<?=$price_array[$i]?>"  >
   </div> 
     </div> 
     
    
	<?
	}
}
}
else{
?>
 <div class="full" style="background:#E8E8E8; padding:.4em; color:#F00; ">No result found please try with different values</div>
<?	
}

}

?>