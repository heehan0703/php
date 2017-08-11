<?php
session_start();

require_once('wp-admin/include/connectdb.php');

 $member_id=$_SESSION['member_id'];
 

 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];


 $message_query=mysql_query("SELECT * FROM `message` where member_id='$member_id' and trash='0' and archive='0' and sent='0'");
 
 $count = mysql_num_rows($message_query);
 
?>

<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Message</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">

var trash_variable=false;
	
 function show_content_slide(cls){
 $("."+cls).slideToggle('fast');
 }
   
function show_content(cls){
	if($(window).width()<700){
$("."+cls).show(0);
	}
	
}
function hide_content(cls){
	if($(window).width()<700){
	$("."+cls).hide(0);
	}
}
	
function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
}	

function validate(){

var email=document.getElementById('email_login').value;
var pwd=document.getElementById('pwd_login').value
	
	if(email==''){
	alert('Please enter email !');
	document.getElementById('email_login').focus();
	return false;
		
	}
	
	if(pwd==''){
	alert('Please enter password !');
	document.getElementById('pwd_login').focus();
	return false;
		
	}
	
}



$(document).on('change','input[name="checkbox_name"]',function() {
    $('.checkbox-cls').prop("checked" , this.checked);
});

function update_checkbox(){
 var mark_type=$("#mark_type").val();	
 if(mark_type=='all'){
	  $('.checkbox-cls').prop("checked" , "checked"); 
 }
 if(mark_type=='none' || mark_type==''){
	 $('.checkbox-cls').prop("checked" , false); 
 }
 if(mark_type=='read'){
	  $('.checkbox-cls').prop("checked" , false); 
  $('.read-checkbox-cls').prop("checked","checked");
 }
 if(mark_type=='unread'){
	  $('.checkbox-cls').prop("checked" , false); 
  $('.unread-checkbox-cls').prop("checked","checked");
 }
}

function read_msg(th,id){
	$("#reply_msg_container").hide();
	$("#bottom_action_div").show();
	show_message(id);
 if($(th).hasClass("unread-cls")){
 $(th).removeClass("unread-cls");
 $(th).addClass("read-cls");
$.post( "ajax.php", { message_update:1, message_id: id });
 }
}

function show_message(id){
	$("#checkbox_hddn").val(id);
	$("#message_body_container").slideUp('slow');
var from=	$("#from_content_"+id).html();
	$("#from_container").html(from);
var subject= $("#subject_content_"+id).html();
	$("#subject_container").html(subject);
	var msg=$("#message_content_"+id).val();
 $("#message_container").html(msg);
 var date=$("#date_content_"+id).html();
 $("#date_container").html(date);
 $("#message_body_container").slideDown('slow');
 scroll_down();
}

function show_by(by){
if(by=='all'){
$(".message-cls").show();	
}
if(by=='unread'){
$(".message-cls").hide();
$(".unread-cls").show();	
}
	
}

function slide_up_msg(){
	
	$("#reply_msg_container").hide();
	$("#forward_message_container").hide();
	$("#bottom_action_div").hide();
	$("#message_body_container").slideUp('slow');
}

function close_reply(){
$("#reply_msg_container").slideUp('slow');
$("#message_body_container").slideDown('slow');	
}

$(document).ready(function(e) {
    
$(".checkbox-cls").click(function(e) {
   //do something
   e.stopPropagation();
});
});



function archive_message(){
  
   var names = [];
$('.checkbox-cls:checked').each(function() {
 
     // alert($(this).val());
	 // $(this).closest('div.full').hide();
	   names.push($(this).val());
   });
  //alert(names);
   $.post( "ajax.php", { archive_msg:1, archive_msg_id: names }).done(function(data){
	 if(data=='invalid'){
	alert('Please login first !');	 
	 }
	 else{
	$('.checkbox-cls:checked').each(function() {
 
     // alert($(this).val());
	  $(this).closest('div.full').remove();
   });	 
	 }
	
	   
   });

}


function delete_message(){
  
   var names = [];
$('.checkbox-cls:checked').each(function() {
 
     // alert($(this).val());
	 // $(this).closest('div.full').hide();
	   names.push($(this).val());
   });
    if(trash_variable==true){ 
	trash_val=1;
	}
	else{
	trash_val=0;
	}
  //alert(names);
   $.post( "ajax.php", { delete_msg:1,trash_val:trash_val, del_msg_id: names }).done(function(data){
	 if(data=='invalid'){
	alert('Please login first !');	 
	 }
	 else{
	$('.checkbox-cls:checked').each(function() {
 
     // alert($(this).val());
	  $(this).closest('div.full').remove();

   });	 
	 }
	
	   
   });

}

function move_to(){
	update_checkbox();
var move_to = $("#move_to").val();
	if(move_to=='archive'){
	archive_message();	
	}
	if(move_to=='delete'){
	//alert('dele');
	delete_message();	
	}
	
}

function move_to_single(){
	
var move_to = $("#move_to_single").val();
	if(move_to=='archive'){
	archive_message_single();	
	}
	if(move_to=='delete'){
	//alert('dele');
	delete_message_single();	
	}
	
}

function archive_message_single(){
	var checkbox_hddn=$("#checkbox_hddn").val();
	 var names = [];
 names=checkbox_hddn;
  //alert(names);
   $.post( "ajax.php", { archive_msg:1, archive_msg_id: names }).done(function(data){
	 if(data=='invalid'){
	alert('Please login first !');	 
	 }
	 else{
	slide_up_msg();
	$('.checkbox-cls:checkbox').each(function() {
    if($(this).val()==checkbox_hddn){
	 $(this).closest('div.full').remove();
	}
   });		 
	 }
	
	   
   });
	
}

function delete_message_single(){
  var checkbox_hddn=$("#checkbox_hddn").val();
   var names = [];
names=checkbox_hddn;
  //alert(names);
    if(trash_variable==true){ 
	trash_val=1;
	}
	else{
	trash_val=0;	
	}
   $.post( "ajax.php", { delete_msg:1,trash_val:trash_val, del_msg_id: names }).done(function(data){
	 if(data=='invalid'){
	alert('Please login first !');	 
	 }
	 else{
		slide_up_msg();
	$('.checkbox-cls:checkbox').each(function() {
    if($(this).val()==checkbox_hddn){
	 $(this).closest('div.full').remove();	 
	 }
	
	   
   });
	 }
   });

}

function load_content(content,th){
$(".bg-add-cls").removeClass("bg-select");
$(th).addClass("bg-select");
	
$("#message_body_container").hide();
$("#reply_msg_container").hide();
$("#bottom_action_div").hide();
	$("#loader_container").show();
	if(content=='trash'){
	trash_variable=true;	
	}
	else{
		trash_variable=false;
	}
	
	if(content=='inbox'){
 $(".action-cls").show();		
	}
	else{
 $(".action-cls").hide();		
	}
		
	
 $("#all_msg_container").html('');
 $.post("ajax.php",{content_type:content}).done(function(data){
	if(data!=0){
	$("#loader_container").hide();
	$("#all_msg_container").html(data);	
	$(".checkbox-cls").click(function(e) {
   //do something
   e.stopPropagation();
});
	}
 });
	
}

//function delete_row(obj){

//$('.'+cls).parent().prop('className').html('');	
//$('.'+cls).parents(this).prop('className').val();
//$(obj).closest('div.full-class').html('');
//}

function search_content(){
	
$("#message_body_container").hide();
$("#reply_msg_container").hide();
$("#bottom_action_div").hide();
	$("#loader_container").show();
	var search_text = $("#search_text").val();
 	
	
 $(".action-cls").show();		
		
	
 $("#all_msg_container").html('');
 $.post("ajax.php",{search_inbox:1,search_text:search_text}).done(function(data){
	if(data!=0){
	$("#loader_container").hide();
	$("#all_msg_container").html(data);	
	$(".checkbox-cls").click(function(e) {
   //do something
   e.stopPropagation();
});
	}
 });
	
}
    </script>
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:400,700,900);

.overlay-mask {
	background: none repeat scroll 0 0 rgba(28, 45, 50, 0.8);
	bottom: 0;
	height: 100%;
	left: 0;
	position: fixed;
	right: 0;
	top: 0;
	width: 100%;
	z-index: 999999;
	display: none;
	overflow-y:auto;
	overflow-x:hidden;
}
.overlay.iframe-content {
	border: 2em solid #fff;
	border-radius: 6px;
	box-sizing: content-box;
	padding: 0;
	width: 90%;
}
.overlay {
	background: none repeat scroll 0 0 #fff;
	border-radius: 3px;
	box-shadow: 0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);
	box-sizing: border-box;
	margin: 50px auto 0;
	padding: 30px;
	position: relative;
	
}
.overlay.iframe-content .title {
	border: medium none;
	margin: 0;
	position: absolute;
}
.overlay .title {
	border-bottom: 1px solid #e2e8ea;
	margin-bottom: 20px;
}

.overlay .close-icon {
	font: 32px Dingbatz;
	color: #b3c5d0;
	content: "";
	display: block;
	font: bold 20px "Dingbatz";
	position: absolute;
	right: 0;
}
.overlay.iframe-content .close-icon {
	/*background: none repeat scroll 0 0 white;
	border-radius: 32px;
	height: 32px;
	left: 706px;
	position: absolute;
	top: -16px;
	width: 32px;

*/
  background: none repeat scroll 0 0 #000;
    border-radius: 32px;
    color: white;
    height: 32px;
    opacity: 1;
    position: absolute;
    right: -2em;
    top: -2em;
    width: 32px;

}
.overlay .close-icon {
	cursor: pointer;
	float: right;
}

.full {
	width: 100%;
	overflow: hidden;
}
.search-header {
	border: 1px solid #e5e5e5;
	border-bottom-left-radius: 2px;
	border-top-left-radius: 2px;
	color: #828282;
	height: 40px;
	margin-right: -1px;
	padding: 8px;
}
.arrow-down-cls {
	-webkit-appearance: none;
	-moz-appearance: none;
	background: transparent url("https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") no-repeat right center;
//width:100%;
}
#pts_search_query_top {
	border: 1px solid #e5e5e5;
	color: #828282;
	display: inline;
	height: 40px;
	margin-right: -1px;
	min-width: 310px;
	padding: 8px 10px;
}
.red-btn {
	border: 0 none;
	border-radius: 2px;
	color: #fff;
	padding: 0.8em;
	background: #F14E47;
}
.blue-btn {
	background: #2992C1;
	border: 0 none;
	border-radius: 2px;
	color: #fff;
	padding: 0.8em;
}
.menu-home {
	list-style: none outside none;
}
.menu-home >li {
	float: left;
	padding: 10px 5px;
	color: #FFF;
}
.vertical-menu {
	background: none repeat scroll 0 0 #fff;
	color: #000;
	float: left;
	list-style: outside none none;
	position: absolute;
	width: 90%;
}
.vertical-menu > li {
	padding: 0.5em 0;
}
#body_container {
	background-image: url("images/strip.png");
	background-repeat: repeat-x;
	background-color: #F5F5F5;
}
.category_title {
	font-family: "shruti-bold";
	font-size: 16px;
	height: 85px;
	line-height: 85px;
	margin: 0;
	padding: 0 10px 0 25px;
}
.active-menu {
	color: #60AACC;
	border: 1px solid #EEEEEE;
	border-right: 0px;
}
.footer-menu {
	list-style: none outside none;
	padding-left: 0px;
}
.footer-menu li {
	padding: 5px 0px;
	text-transform: uppercase;
}
.full-hidden {
	display: none;
}
.full-hidden-menu {
	height: 0;
	width: 0;
}
.background-img {
	background-image: url('images/flower_strip.png');
	height: 130px;
}
.atss {
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
	position: fixed;
	top: 20%;
	width: 48px;
	z-index: 100020;
}
.atss a {
 //background: none repeat scroll 0 0 #e8e8e8;
	display: block;
	float: left;
	//line-height: 48px;
	margin: 0;
	outline: medium none;
	overflow: hidden;
	padding: 0px 0;
	position: relative;
	text-align: center;
 // text-indent: -9999em;
	transition: width 0.15s ease-in-out 0s;
	width: 48px;
	z-index: 100030;
}
.atss-right {
	float: right;
	left: auto;
	right: 0;
}

 @media (max-width: 426px) {
.full-hidden {
	display: block;
}
.row-30-small {
	width: 30% !important;
	float: left !important;
}
#pts_search_query_top {
	min-width: 70% !important;
	width: 120px;
}
.search-header {
	font-size: .6em;
}
.row-30-small-right {
	float: right;
	padding-top: 3em;
	position: absolute;
	right: 0;
	width: 50%;
}
.small-hidden {
	display: none;
}
.small-margin-5 {
	margin-top: 5em;
}
.small-margin-2 {
	margin-top: 2em;
}
.small-margin-bottom-1 {
	margin-bottom: 1em;
}
.vertical-menu {
	margin-top: -1em;
	width: 82.5% !important;
	z-index: 222;
	border: 1px solid #909090;
	border-top: 0px;
}
.small-rotate-img {
	margin-left: 42%;
	text-align: center;
	transform: rotate(270deg);
	margin-bottom: -11em;
	margin-top: -10em;
}
.col-lg-4, .col-lg-3 {
	margin-bottom: 1em;
}
.small-padding-hidden {
	padding-top: 0px !important;
}
.small-width-full {
	width: 96% !important;
	padding: 0 2% !important;
}
.small-width-60 {
	width: 60% !important;
}
.row-25-small {
	width: 25% !important;
	float: left !important;
}
.row-50-small {
	width: 50% !important;
	float: left !important;
}
.small-width-40 {
	width: 40% !important;
}
.small-text-center {
	text-align: center !important;
}
.small-padding-left-15 {
	padding: 0 15% !important;
}
.small-border-dotted {
	border: 1px dashed !important;
	padding: .5em !important
}
.small-margin-bottom-hidden {
	margin-bottom: 0px !important;
}
.small-font {
	font-size: .7em;
}
.menu-small {
	background-color: rgba(0, 0, 0, 0.3);
	color: #fff;
	height: 42px;
	margin-left: 2em;
	margin-top: 1em;
	padding-top: 14px;
	text-align: center;
	width: 50px;
}
.full-hidden-menu {
	list-style: none outside none;
	background-color: #242424;
	margin: 1% 5%;
	padding-left: 0;
	width: 90%;
	height: auto;
}
.full-hidden-menu >li {
	border-bottom: 1px solid;
	color: #fff;
	padding: 0.5em;
	position: relative;
}
.overlay.iframe-content {
	width:70% !important;
}
}
.dotted-text{
	overflow: hidden !important;
    text-overflow: ellipsis;
    white-space: nowrap !important;
}
.unread-cls{
	background:#DCDCDC;
}
#message_body_container{
	display:none;
}
.bg-select{
	background:url('images/message_img1.png');
	 background-repeat:no-repeat;
	  background-size:100%;
	 
}
pre{
	  white-space: pre-wrap; 
    white-space: moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap; 
    word-wrap: break-word;
	 background-color:#FFF !important;
}
</style>
<link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="full"> 
  <!--header start-->
 <?php include('header_supplier.php')?>


<!--header end--> 

<!--body start-->
<div class="full" id="" style=" margin-bottom:2em;">
  <div class="container" style=" box-shadow:2px 3px 10px 0px rgba(0, 0, 0, 0.61); margin-top:1em;">
<div class="row">

<div class="full" style="padding-top:1em; background:#FFF; border-bottom:1px solid #AAAAAB;">
<div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
<div class="col-lg-10 col-md-10 col-sm-11 col-xs-11"><h4 class="h4">My Account > Message</h4></div>
</div>

<div class="full" style="background:#F5F5F5; font-size:1.2em;">
<!--left side start-->
<div class="col-lg-2"><h4 class="h4">Inbox</h4>
<div class="full" style="margin:.5em 0; border-bottom:1px solid #DDDDDD; color:#F00; cursor:pointer;" onClick="show_compose_section()">
Compose</div>
<div class="full bg-add-cls bg-select" style="margin:.5em 0; border-bottom:1px solid #DDDDDD; cursor:pointer;" onClick="load_content('inbox',this)">
From Beautco(<?=$count?>)</div>
<div class="full bg-add-cls" style="margin:.5em 0;border-bottom:1px solid #DDDDDD; cursor:pointer;"
 onClick="load_content('sent',this)">Sent</div>
<div class="full bg-add-cls" style="margin:.5em 0;border-bottom:1px solid #DDDDDD; cursor:pointer;" 
onClick="load_content('trash',this)">Trash</div>
<div class="full bg-add-cls" style="margin:.5em 0;border-bottom:1px solid #DDDDDD; cursor:pointer;"
 onClick="load_content('archive',this)">Archive</div>
<div class="full" style="margin:.5em 0;border-bottom:1px solid #DDDDDD;">Announcements<br>
<span style="color:#6971FF; font-size:.6em;">See all Beautco Announcements</span>
</div>
<div class="full" style="margin:.5em 0; margin-top:1.3em;border-bottom:1px solid #DDDDDD; font-weight:bold;">
My Account
</div>
<div class="full" style="margin:.5em 0;border-bottom:1px solid #DDDDDD;">Supplier Account</div>
<div class="full" style="margin:.5em 0; border-bottom:1px solid #DDDDDD;">Business Information</div>
<div class="full" style="margin:.5em 0; border-bottom:1px solid #DDDDDD;">PayPal Account</div>
<div class="full" style="margin:.5em 0; border-bottom:1px solid #DDDDDD;">Message</div>
</div>
<!--left side end-->

<!--right side start-->
<div class="col-lg-10">
<div class="full" style="margin:.7em 0;">
<div class="col-lg-3"><h3 class="h3" style="margin-top:5px;">From Beautco</h3></div>
<div class="col-lg-5"><input type="text" id="search_text" name="search_text" placeholder="Search Inbox" class="form-group" style="border-radius:3px;
 border:1px solid #ddd;">
<select style="border:1px solid #DDDDDD; background:#FBFBFB; color:#0678D0; border-radius:3px;">
<option>By keyword</option>
</select></div>
<div class="col-lg-4">    <input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;
 border:1px solid #DDDDDD;" onClick="search_content();" value="Search" > &nbsp;
 <span style="color:#0678D0;;">
Advanced search</span>
</div>
</div>
<!-- right portion start -->
<div class="full" style="border:1px solid #ddd; border-radius:3px; background:#FFF; padding:.5em;">
<div class="full"><div class="col-lg-8" style="color:#000;"><span style="cursor:pointer;" onClick="show_by('all')">All </span>| <span style="color:#0678D0; cursor:pointer;" onClick="show_by('unread')"> Unread </span>| 
<span style="color:#0678D0;"> Flagged </span>
| <span style="color:#0678D0;">Filter</span></div></div>
<div class="full" style=" margin-top:1em;">
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"> <input type="checkbox" class="selectall" name="checkbox_name"> </div>
<div class="col-lg-1 col-md-1 col-sm-3 col-xs-4"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Delete" onClick="delete_message()" ></div>
<div class="col-lg-1 col-md-1 col-sm-3 col-xs-3 action-cls"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Archive" onClick="archive_message()" ></div>
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 action-cls"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Forward" ></div>
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 action-cls">
<select style="border:1px solid #DDDDDD; background:#FBFBFB; color:#0678D0;padding:.3em .5em;border-radius:3px;" name="move_to"
 id="move_to" onChange="move_to()">
<option value="">Move to</option>
<option value="archive">Archive</option>
<option value="delete">Delete</option>
</select></div>
<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 action-cls"><select style="border:1px solid #DDDDDD; background:#FBFBFB; color:#0678D0;
padding:.3em .5em;border-radius:3px;" id="mark_type" onChange="update_checkbox()">
<option value="">mark as</option>
<option value="all">All</option>
<option value="none">None</option>
<option value="read">Read</option>
<option value="unread">Unread</option>
</select></div>
</div>
<!-- for large screen start -->
<form method="post" action="" >
<div class="full" style="height:330px; overflow-y:scroll; margin:.5em 0;">
<div class="full" style="margin:.5em 0;">
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><span class="glyphicon glyphicon-flag" style="color:#CCCCCC;"></span>
&nbsp;<span class="glyphicon glyphicon-paperclip"></span></div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="color:#0699DE;">From</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 small-hidden" style="color:#0699DE;">Item Ends</div>
<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="color:#0699DE;">Subject</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right" style="color:#0699DE;">Received</div>
</div>
<div class="full" id="all_msg_container">
<?php 
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
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" ><span class="small-hidden">--</span>
<input type="hidden" name="message_content" id="message_content_<?=$message_row['id']?>" value="<?=$message_row['message_detail']?>" >
</div>
<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 dotted-text" id="subject_content_<?=$message_row['id']?>"><?=$message_row['subject']?></div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right" ><?=date("M j",$message_row['date'])?>
<span style="display:none;" id="date_content_<?=$message_row['id']?>"><?=date("M-j-y g:i a",$message_row['date'])?>  </span>
</div>
</div>

<?php }  } else { ?>
<div align="center" class="full message-cls "  style=" border-top:1px solid #e8e8e8; border-bottom:1px solid #E8E8E8; padding:.7em 0; cursor:pointer;">
    Your InBox is empty !
    	</div> 
<? } ?>
</div>


</div>

</form>
<!-- for large screen end -->
<!-- for small screen start -->

<!-- for small screen end -->

<div class="full" style="background:#F5F5F5; height:10px; border:2px solid #CCCCCC; color:#ccc; border-radius:3px; 
text-align:center; padding-top:2px; height:11px;">
<img src="images/dot.png" style="vertical-align:top;">&nbsp;<img src="images/dot.png" style="vertical-align:top;">&nbsp;
<img src="images/dot.png" style="vertical-align:top;">
</div>
<div class="row" id="bottom_action_div" style="margin-top:1.5em; display:none;">
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Delete" onClick="delete_message_single()"></div>
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 action-cls"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Archive" onClick="archive_message_single()" ></div>
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 action-cls"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Reply" onClick="msg_reply()" ></div>
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 action-cls"><input type="button" class="red-btn" style="background:#FBFBFB; color:#0678D0; padding:.2em .5em;border:1px solid #DDDDDD;" value="Forward" onClick="show_forward()" ></div>
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 action-cls"><img src="images/msg_arrow_down.png"><img src="images/msg_arrow_up.png" style="margin-left:-1px;" ></div>
<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 action-cls">
<select name="move_to_single" id="move_to_single" onChange="move_to_single()">
<option value="">Move to</option>
<option value="archive">Archive</option>
<option value="delete">Delete</option>
</select> &nbsp;<span style="color:#D6D6D6;">|</span> <span class="glyphicon glyphicon-flag" style="color:#D6D6D6;"></span>
</div>
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4" style="color:#0678D0;">Print</div>
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4" style="color:#0678D0;">View full message</div>
<div class="col-lg-1 col-md-1 col-sm-4 col-xs-4"><img src="images/cross.png" onClick="slide_up_msg()" style="cursor:pointer;" ></div>
</div>

<!--reply part start-->
<div class="full" style="padding:.5em; display:none;" id="reply_msg_container" >
<form method="post" id="reply_form" name="reply_form">
<div class="full" style="padding:.5em 0;">
<div class="col-lg-4 col-md-4">To</div>
<div class="col-lg-8 col-md-8"><input type="text" class="form-group" name="from_reply" value="Beautco" readonly style="border:1px solid #DDD;" ></div>
</div>
<div class="full" style="padding:.5em 0;">
<div class="col-lg-4 col-md-4">Subject</div>
<div class="col-lg-8 col-md-8"><input type="text" name="subject_reply" id="subject_reply" placeholder="Subject" style="border:1px solid #DDD;" class="form-group" ></div>
</div>

<div class="full" style="padding:.5em 0;">
<div class="col-lg-4 col-md-4">Message</div>
<div class="col-lg-8 col-md-8"><textarea id="reply_textarea" name="textarea_reply" style="width:90%; border:1px solid #DDD;" rows="13"></textarea></div>
</div>
<div class="full" align="center" style="padding:1em 0;">
 <input type="button" class="red-btn" style="color:#fff; width:6em;"
 value="Cancel" onClick="close_reply()" >&nbsp; <input type="button" class="red-btn" style="background:#0678D0; color:#fff; width:6em;"
 value="Reply" onClick="give_reply()" >
</div>
<input type="hidden" name="set_reply" id="set_reply" value="" >
</form>
</div>

<script type="text/javascript">
function give_reply(){
$("#set_reply").val('1');
$("#subject_reply").focus();
if($("#subject_reply").val()!=''){
	$("#loader_container").show();
$.post( "ajax.php", $( "#reply_form" ).serialize() ).done(function(data){
if(data==1){
	$("#message_body_container").slideUp();
	$("#reply_msg_container").slideUp();
	$("#loader_container").hide();
}
});

}
else{
alert('Please enter subject !');
$("#subject_reply").focus();	
}

}

function msg_reply(){
	$("#forward_message_container").hide();	
	$("#message_body_container").slideUp('slow');
	$("#reply_msg_container").slideDown('slow');
var html= $("#message_container").html();
$("#reply_textarea").val("\n\n"+"==================="+"\n"+"Original message:"+"\n"+"==================="+"\n"+html);
	setCaretToPos(document.getElementById("reply_textarea"),1);

}

		function setSelectionRange(input, selectionStart, selectionEnd) {
				  if (input.setSelectionRange) {
					//input.focus();
					input.setSelectionRange(selectionStart, selectionEnd);
				  }
				  else if (input.createTextRange) {
					var range = input.createTextRange();
					range.collapse(true);
					range.moveEnd('character', selectionEnd);
					range.moveStart('character', selectionStart);
					range.select();
				  }
				}
				function setCaretToPos (input, pos) {
				  setSelectionRange(input, pos, pos);
				}
</script>
<!--reply part end -->

<!-- forward part start -->
<style type="text/css">
.ajax-search{
	width:100%;
	padding-left:5px;
	list-style:none outside none;	
	border:1px solid #666;
	display:none;	
}
.ajax-search li{
	padding:.3em 0;
	cursor:pointer;
}
.ajax-search li:hover{
	background:#F5F5F5;
}

</style>
<script type="text/javascript">
function search_item(){
	var text=$("#forward_to").val();
	var search_by = $("#search_user_by").val();
	$(".ajax-search").html('');
	$(".ajax-search").show();
	
$.post("ajax.php",{text:text,search_by:search_by}).done(function(data){
	//$("#testing").after(data);
	//alert(data);
	$(".ajax-search").html(data);
	
	
});
	
}

</script>
<div class="full" style="padding:.5em 0; display:none;" id="forward_message_container">
<div class="full">
<!--
<div class="col-lg-12"> <input type="text" name="forward_to" id="forward_to" onKeyUp="" placeholder="To" >&nbsp;
<select name="search_user_by" id="search_user_by">
<option value="">Search User</option>
<option value="member">Member</option>
<option value="supplier">Supplier</option>
</select>

<br>
<ul class="ajax-search">

</ul>
</div>
-->
</div>
<div class="full" align="center">
 <input type="button" class="red-btn" style="color:#fff; width:6em;"
 value="Cancel" onClick="close_forward()" >&nbsp; 
 <input type="button" class="red-btn" style="background:#0678D0; color:#fff; width:6em;" value="Send" onClick="send_forward()" >
 </div>

</div>

<script type="text/javascript">
function show_forward(){
	$("#reply_msg_container").hide();
$("#message_body_container").show();	
$("#forward_message_container").slideDown('slow');
}

function close_forward(){
$("#reply_msg_container").hide();
$("#forward_message_container").slideUp('slow');	
}

function send_forward(){
	$("#reply_msg_container").hide();
$("#forward_message_container").show();	
	var to=$("#forward_to").val();
var subject=$("#subject_container").html();	
var msg=$("#message_container").html();
$.post("ajax.php",{message_forward:1,forward_to:to,forward_subject:subject,forward_msg:msg}).done(function(data){
	if(data==1){
	alert('Your message forward successfully to '+to+'.');
	$("#reply_msg_container").hide();
    $("#forward_message_container").hide();	
	}
});
}
</script>

<!-- forward part end  -->

<!-- message dynamic start -->
<!-- message start  -->
<div class="full" style="padding:.5em;" id="message_body_container">
<input type="hidden" name="checkbox_hddn" id="checkbox_hddn" >
<div class="full" >
<h4 class="h4" style="color:#222CFF;" id="subject_container">Your Beautco Invoice for February is now ready to view </h4></div>
<div class="full" style="color:#222CFF;">From : <span id="from_container">Beautco </span> </div>
<div class="full" style="color:#222CFF;padding-bottom:1.2em; border-top:1px solid #CCCCCC;">Sent : <span id="date_container">Mar-04-14 05:13AM </span> </div>
<div class="full">
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div> 
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
<div class="full" style="border-bottom:3px solid #98C93C;"><img src="images/logo_message.png" class="img-thumbnail"
 style="border:0px;" ></div>
 <pre><div class="full" id="message_container"></div></pre>
 
</div> 
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
</div>

</div>
<!-- message end -->

<!-- message dynamic end -->



</div>
<!-- right portion end  -->
</div>
<!--right side end-->
</div>

</div>

    
  </div>
</div>

<!--body end--> 


<!-- footer start-->
<?php include('footer.php')?>

<!--footer end  -->

</div>

<!-- loader show start -->
<div id="loader_container" class="overlay-mask" style="">
 
 <div class="full" align="center" style="margin-top:6em;">
 <img src="images/loader.gif" width="100" height="100" >
 </div>
 </div>
<!-- loader show end  -->

<!-- compose section start -->
<div id="overlay-mask-1" class="overlay-mask" style="">
  <div class="overlay iframe-content">
 <div class="container" style="padding:1em;">
 
 <div class="full" style="padding:.5em;" >
<form method="post" id="compose_form" name="compose_form">
<div class="full" style="padding:.5em 0;">
<div class="col-lg-4 col-md-4">To</div>
<div class="col-lg-8 col-md-8"><input type="text" class="form-group"  value="admin@beautco.com" readonly style="border:1px solid #DDD;" ></div>
</div>
<div class="full" style="padding:.5em 0;">
<div class="col-lg-4 col-md-4">Subject</div>
<div class="col-lg-8 col-md-8"><input type="text" name="subject_compose" id="subject_compose" placeholder="Subject" style="border:1px solid #DDD;" class="form-group" ></div>
</div>

<div class="full" style="padding:.5em 0;">
<div class="col-lg-4 col-md-4">Message</div>
<div class="col-lg-8 col-md-8"><textarea id="textarea_compose" name="textarea_compose" style="width:90%; border:1px solid #DDD;" rows="13"></textarea></div>
</div>
<div class="full" align="center" style="padding:1em 0;">
 <input type="button" class="red-btn" style="color:#fff; width:6em;"
 value="Cancel" onClick="document.getElementById('overlay-mask-1').style.display='none'" >&nbsp; <input type="button" class="red-btn" style="background:#0678D0; color:#fff; width:6em;"
 value="SEND" onClick="compose_msg()" >
</div>
<input type="hidden" name="set_compose" id="set_compose" value="" >
</form>
</div>
 
 </div>
 </div>
 </div>
 
 <script type="text/javascript">
 
 function show_compose_section(){
  $("#subject_compose").val('');
  $("#textarea_compose").val('');
  $("#overlay-mask-1").show();	 
 }
 
 function compose_msg(){
$("#set_compose").val('1');
$("#subject_compose").focus();
if($("#subject_compose").val()==''){
	alert('Please enter subject !');
$("#subject_compose").focus();
return false
}
if($("#textarea_compose").val()==''){
	alert('Please enter message !');
$("#textarea_compose").focus();
 return false
}
else{
	 $("#overlay-mask-1").hide();
	$("#loader_container").show();
$.post( "ajax.php", $( "#compose_form" ).serialize() ).done(function(data){
if(data==1){
    
	$("#loader_container").hide();
}
});

}


}
 </script>
<!-- compose sectiom end -->

<script type="text/javascript">
function scroll_down(){
    $('html, body').animate({
    scrollTop: $("#message_body_container").offset().top
    }, 1000);
}
</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
