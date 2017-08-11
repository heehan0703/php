<? 
header("Cache-Control: max-age=300, must-revalidate");
session_start();
 $member_id=$_SESSION['member_id'];
// echo "$member_id";
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];
 //echo "$GOOD_SHOP_USERID";
require_once('wp-admin/include/connectdb.php');
require_once('ups_rate1.php');
require_once('usps_shipping.php');
//$total_P =str_replace(',','',12);
//$total_weight = $_POST['total_weight'];
//echo"$total_weight";
/*
if($total_weight!=0){
	$total_weight=$total_weight/8;
	$total_weight=number_format($total_weight,2);
	$response=explode('.',$total_weight);
	$ponds=$response[0];
	//echo "$ponds-";
    $onces=$response[1]*8;
	//echo "$onces";
}	*/
$ponds=$total_weight;
$onces=0;
//echo "ponds $ponds--waight $total_weight"
$member_query=mysql_query("SELECT * FROM `member` where member_id='$member_id'");
$member_row=mysql_fetch_assoc($member_query);
$iam=$member_row['i_am'];
$verifystatus=$member_row['verify_status'];
$state=$member_row['state'];
//echo $iam;
 $rzip = $member_row['zipcode'];
 $ups_country=mysql_result(mysql_query("select country_name from country where country_Id='$member_row[country]'"),0);
if($ups_country=='United States'){	 
$ups_country="US" ;
}
$country_query=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");
$country_query2=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");
$country_query_gust=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");
$country_query_gust2=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");
$userstate=mysql_fetch_array(mysql_query("SELECT * FROM `state` where state_id='$member_row[state]'"));
//var_dump($userstate);
//get price of product other country 
$check_othercountry_product=false;
$shipping_charge=0;
$cart_goods_query = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'");
$cart_goods_query2 = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'");
while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
$goods_infocheck= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
if($cart_goods_row['dropship']==0){
$total_weight +=$goods_infocheck['package_weight']*$cart_goods_row['cnt'];	
}
if($total_weight==''){
	$total_weight=0;
}
if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)){
	       ///for dealer price////////////
	   $userpricecheck=explode(',',$goods_infocheck['wholesaleprice2']);
	   $price1check=$userpricecheck[$cart_goods_row['option_index']];
	     // echo "$price1check";	   
	   if(count($userpricecheck)<=1){
	   $userpricecheck=$goods_infocheck['manufacture_price'];
	   $price1check=$userpricecheck;
	      // echo "shashi";
	    }
		$pricecheck=$price1check;
		$sub_totalcheck +=$pricecheck*$cart_goods_row['cnt'];		
		//echo "dhirendra";
  }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){
  
      $userpricecheck=explode(',',$goods_infocheck['price']);
		$pricecheck=$userpricecheck[$cart_goods_row['option_index']];
		   //echo count($userprice);
		if(count($userpricecheck)<=1){
	   $userpricecheck=$goods_infocheck['msrp_price'];
	    $pricecheck=$userpricecheck;
		}
		$price1check=$pricecheck;
		  $sub_totalcheck +=$pricecheck*$cart_goods_row['cnt'];
  }else if(($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){
  
      $userpricecheck=explode(',',$goods_infocheck['agent_price']);
		$pricecheck=$userpricecheck[$cart_goods_row['option_index']];
		   //echo count($userprice);
		if(count($userpricecheck)<=1){
	   $userpricecheck=$goods_infocheck['agentprice1'];
	    $pricecheck=$userpricecheck;
		}
		$price1check=$pricecheck;
		  $sub_totalcheck +=$pricecheck*$cart_goods_row['cnt'];
		  
		  
		  
  }else{
	     // echo "dhirendra";
		$userpricecheck=explode(',',$goods_infocheck['manufactureprice2']);
		$pricecheck=$userpricecheck[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userpricecheck)<=1){
	   $userpricecheck=$goods_infocheck['wholesale_price'];
	    $pricecheck=$userpricecheck;
		}
		$price1check=$pricecheck;
		  $sub_totalcheck +=$pricecheck*$cart_goods_row['cnt'];
	    }
$total_P=$sub_totalcheck;

//echo "$total_P";

$query=mysql_query("SELECT * FROM `product` where  place_origin!='USA' and id='$cart_goods_row[goodsId]'");

$other_count=mysql_num_rows($query);
if($other_count>0){
 $check_othercountry_product=true;
  $product_row=mysql_fetch_assoc($query);
 $shipping_charge +=$product_row['shipping_price'];
 }
}
$ponds=$total_weight;
$onces=0;
if($total_weight==0){
	$shipping_charge=0;
}
$query=mysql_query("SELECT * FROM `product` where  place_origin!='USA'");
if($total_weight!=0){
if($ups_country=='US'){
$USPSParcelRate=USPSParcelRate_local($ponds,$onces,$rzip);
$Alluspsprice_list=USPSParcelRate_local_All($ponds,$onces,$rzip);
$usps_servicepost_charge = USPSParcelRate_service_post($ponds,$onces,$rzip);
//echo "$usps_servicepost_charge  $ponds,$onces,$rzip-dhirendra";
$ship_price=$usps_servicepost_charge;
//echo $ship_price;
$resck=number_format($ship_price,2);
$draw=$resck;
//echo $draw;
//echo $iam;
//echo "$ship_price";
if($iam=='generalmember')
{
//echo $resck;
if($resck>35)
{
	$draw=0;
	//echo "hiii";
}
else
{
	//echo "hlo";
	$draw=$resck;
}
}
//echo "$ship_price";
$ups_three_day = get_UPS_Price_Ups_three_day($rzip,$ups_country,$total_weight);
   $ups_gnd=  get_UPS_Price_Ups_GND($rzip,$ups_country,$total_weight);
  // echo "$ups_gnd--dhirendra";
   
    $ups_2da=  get_UPS_Price_Ups_2da($rzip,$ups_country,$total_weight);
	$ship_price=$ups_gnd;
	
	 
	
}

if($ups_country!='US'){
	$USPSParcelRate=USPSParcelRate_international($ponds,$onces,$ups_country);
	
	$usps_international_all= USPSParcelRate_international_All($ponds,$onces,$ups_country);
	$ship_price=$USPSParcelRate;
	
}
}


	
//	exit();

if($total_weight==0){
$ship_price=0;	
}
//echo "$_SESSION[level]";
if(($_SESSION['level']==0 )&& $total_P>35 && $ups_country=='US' and ($state!='AI'or $state!='HI')){
//$ship_price=0;
//$draw_free=0;
//$ship_over35=1;
}
$payM=$total_P+$ship_price;
//making ordering code
srand(time());
$time = substr(time(),3,7);
for($i=0;$i<3;$i++)
{
$asc=rand()%26+65;
$c.=chr($asc);
}
$tradecode=$c.$time;
//echo $tradecode;
?>
<!doctype html>
<html class="no-js" lang="">
 <head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checkout Page</title>

<link href='https://fonts.googleapis.com/css?family=Roboto:400,500.00,700,300' rel='stylesheet' type='text/css'>
		
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="shopick/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="shopick/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="shopick/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="shopick/css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="shopick/lib/css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="shopick/css/owl.carousel.css">
		<!-- flaticon css -->
        <link rel="stylesheet" href="shopick/css/shopick-icon.css">
		<!-- pe-icon-7-stroke css -->
        <link rel="stylesheet" href="shopick/css/pe-icon-7-stroke.css">
		<!-- lightbox css -->
        <link rel="stylesheet" href="shopick/css/lightbox.min.css">
		<!-- style css -->
       <!-- <link rel="stylesheet" href="shopick/style.css"> -->
		 <link rel="stylesheet" href="shopick/fstyle.css"> 
		<!-- responsive css -->
        <link rel="stylesheet" href="shopick/css/responsive.css">
		<!-- modernizr css -->
        <base href="/" />
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="js_page/index.js"></script> 

<!--Bootstrap-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#card_number").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right, down, up
(e.keyCode >= 35 && e.keyCode <= 40)) {
// let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});

$("#cvv").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right, down, up
(e.keyCode >= 35 && e.keyCode <= 40)) {
// let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});
});
	
 function show_content_slide(cls){
 $("."+cls).slideToggle('fast');
 }
   
function show_content(cls){
$("."+cls).show(0);
}
function hide_content(cls){
	$("."+cls).hide(0);
}
	
function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
}	

$(document).ready(function(e) {
	setTimeout(function() {
    $("#overlay-mask-1").fadeIn('slow');}, 5000);
	$(".paypalForm-cls :input").prop("disabled", true);	

});

function update_form(formname){
	 if(formname=='paypal'){
$(".authorizeFrm-cls :input").prop("disabled", true);	
$(".paypalForm-cls :input").prop("disabled", false); 
$("#pay_method_select").val('paypal');
	 }
	 if(formname=='authorize'){
$(".paypalForm-cls :input").prop("disabled", true);	
$(".authorizeFrm-cls :input").prop("disabled", false); 		
$("#pay_method_select").val('creditcard'); 
	 }
 }

function edit_info(cls){
	$("."+cls+" :input").toggleClass("no-border");	
	}

$(document).ready(function(e) {
    
	if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	   $("#state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#country").val());	
			
			}
			else{
		$("#state_div").hide('fast');		
			}
			
			if($("#ship_country").val()=='230'  || $("#ship_country").val()=='45')	{
		$("#ship_state_div").show('fast');	
				
	   $("#ship_state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#ship_country").val());	
			
			}
			else{
		$("#ship_state_div").hide('fast');		
			}

});

function update_rate(rate,shiping_name){
	$("#service_choose").val('');
	$("#service_choose").val(shiping_name);
	
	
	var new_tax=rate;
	
	
	
	var total=$("#totalM").val();
	$("#ship_price_hidden").val('');
	$("#ship_price_hidden").val(new_tax);
	<? if($check_othercountry_product==true){ ?>
	var other_country_charge=<?=$shipping_charge?>;
	var new_total=parseFloat(total)+parseFloat(new_tax)+parseFloat(other_country_charge);
	<? }
	else{
	?>
	var new_total=parseFloat(total)+parseFloat(new_tax);
	<? } ?>
	new_total=new_total.toFixed(2);
	$(".tax_span").html('');
	$(".tax_span").html(new_tax);
	$(".total_span").html('');
	$(".total_span").html(new_total);
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);
}

function update_zip(){
 var zipcode= $("#ship_zipcode").val();
 var ship_country = $("#ship_country").val();
 var total_weight = $("#total_weight").val();
 
 $("#loader_container").show();
  
$.post("ajax_update_price.php",{zipcode:zipcode,ship_country:ship_country,total_weight:total_weight}).done(function(data){
	
	$("#shipping_price_container").html(data);
	var ajax_ship_price=$("#ajax_ship_price").val();
	var total=$("#totalM").val();
	$("#ship_price_hidden").val('');
	$("#ship_price_hidden").val(ajax_ship_price);
	<? if($check_othercountry_product==true){ ?>
	var other_country_charge=<?=$shipping_charge?>;
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(other_country_charge);
	<? }
	else{
	?>
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price);
	<? } ?>
	new_total=new_total.toFixed(2);
	$(".tax_span").html('');
	$(".tax_span").html(ajax_ship_price);
	$(".total_span").html('');
	$(".total_span").html(new_total);
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);
	
	$("#loader_container").hide();
	
	//alert(data);
});
 	
}

function pickup(id){
var storeid=id;
//alert("dhirendra");
$("#storepickup").val(storeid);
var discount=$("#discountval").val();
$("#ship_price_hidden").val('');
var ajax_ship_price=$("#ajax_ship_price").val();
var total=$("#totalM").val();
var new_total=parseFloat(total)-parseFloat(discount);
$(".total_span").html('');
$(".total_span").html(new_total);
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);
	
	

}

function setpayment(type){

$('#paymenttype').val(type);
$('#pay_method_select').val(type);
}
  function createacc(){
  
  
		 if(document.getElementById('checkaccount').checked) {
			$("#accountpart").show();
			
		} else {
			$("#accountpart").hide();
			
		}
  }
  
  function shiptodiffrent(){
  
  
		 if(document.getElementById('checkshipdiff').checked) {
			$("#shippart").show();
			//alert("dhirendra");
			
		} else {
			$("#shippart").hide();
			//alert("shashi");
			
		}
  }
  
  function billvalidate(){
 

 var tax=$("#tax").val();
 // var email=document.getElementById('email').value;
 // var password=document.getElementById('pass').value;
  var gustname1=document.getElementById('gustname1').value;
  var billlastname=document.getElementById('billlastname').value;
  var billTel=document.getElementById('billTel').value;
  var billcity=document.getElementById('billcity').value;
  var billzip=document.getElementById('billzip').value;
  var billcountry=document.getElementById('billcountry').value;
   var billaddress=document.getElementById('billaddress').value;
   var billstate=document.getElementById('billstate').value;
   
  
  var countryoption=$("#billcountry :selected").text();
   var stateoption=$("#billstate :selected").text();
 // alert("dhirendra");
  
<? if(!$_SESSION['member_id']) {  ?>
if(document.getElementById('checkaccount').checked){
   var username=document.getElementById('username').value;
    var password=document.getElementById('password').value;
  }
        if(document.getElementById('checkaccount').checked && username==''){
			alert('Please enter the username');
			document.getElementById('username').focus();
			return false;
	    }else if(document.getElementById('checkaccount').checked && password==''){
			alert('Please enter the password');
			document.getElementById('password').focus();
			return false;
	    } else <? } ?>if(gustname1==''){
			alert('Please enter the Billing first Name');
			document.getElementById('gustname1').focus();
			return false;
		
		}else if(billlastname==''){
			alert('Please enter the Billing Last Name');
			document.getElementById('billlastname').focus();
			return false;
		
		}else if(billTel==''){
		alert('Please enter the bill Telephone');
		document.getElementById('billTel').focus();
		return false;
		
		}else if(billcountry==''){
		alert('Please enter the Billing country.');
		document.getElementById('billcountry').focus();
		return false;
		
		}else if(billaddress==''){
		alert('Please enter the Billing Address');
		document.getElementById('billaddress').focus();
		return false;
		
		}else if(billcity==''){
		alert('Please enter the Billing city');
		document.getElementById('billcity').focus();
		return false;
		
		}else if(billstate=='' && billcountry=='230'){
		alert('Please enter the Billing state');
		document.getElementById('billstate').focus();
		return false;
		
		}else if(billzip==''){
		alert('Please enter the Billing zip');
		document.getElementById('billzip').focus();
		return false;
		
		}else{
		  
			if(document.getElementById('checkshipdiff').checked){
			
			
			var shipfname=document.getElementById('shipfname').value;
             var shiplname=document.getElementById('shiplname').value;
			 var shipphone=document.getElementById('shipphone').value;
			 
             var ship_country=document.getElementById('ship_country').value;
			 var shipaddress=document.getElementById('shipaddress').value;
			 
             var shipcity=document.getElementById('shipcity').value;
			 var shipstate=document.getElementById('ship_state').value;
			 
             var shipzip=document.getElementById('ship_zipcode').value;
            // var shipcountry=document.getElementById('ship_country').value;
             var shipcountryoption=$("#ship_country :selected").text();
             var shipstateoption=$("#ship_state :selected").text();
			 
						    if(shipfname==''){
							alert('Please enter the shipping first Name');
							document.getElementById('shipfname').focus();
							return false;
							
							}else if(shiplname==''){
							alert('Please enter the shipping Last Name');
							document.getElementById('shiplname').focus();
							return false;
							
							}else if(shipphone==''){
							alert('Please enter the shipping Phone ');
							document.getElementById('shipphone').focus();
							return false;
							
							}else if(ship_country==''){
							alert('Please select  the shipping Country ');
							document.getElementById('ship_country').focus();
							return false;
							
							}else if(shipaddress==''){
							alert('Please enter  the shipping address ');
							document.getElementById('shipaddress').focus();
							return false;
							
							}else if(shipcity==''){
							alert('Please enter the shipping City ');
							document.getElementById('shipcity').focus();
							return false;
							
							}else if(shipstate==''){
							alert('Please enter the shipping state ');
							document.getElementById('ship_state').focus();
							return false;
							
							}else if(shipzip==''){
							alert('Please enter the shipping Zip code ');
							document.getElementById('ship_zipcode').focus();
							return false;
							
							}
							
							$('#detailboth').show();
							
		var billaddressfull='<p>'+gustname1+" "+billlastname+'</p>'+'<p>'+billaddress+'</p><p>'+billcity+'</p><p>'+billzip+'</p><p>'+countryoption+'</p><p>'+stateoption+'</p>';
		var shippaddressfull='<p>'+shipfname+" "+shiplname+'</p>'+'<p>'+shipaddress+'</p><p>'+shipcity+'</p><p>'+shipzip+'</p><p>'+shipcountryoption+'</p><p>'+shipstateoption+'</p>';
			   
			 $('#billing').html('<p>'+billaddressfull+'</p>');
			 $('#shipping').html('<p>'+shippaddressfull+'</p>');
			 
			 $('#buttoncon').hide();	
			 $('#billingdetail').hide();
			  $('#shippart').hide();
			  
			 $('#updatede').hide(); 
			 
			 $(".total_span").html('');
	         $(".total_span").html(new_total);	
			  var total_weight = $("#total_weight").val();
			 // alert(shipzip);
			 var total=$("#totalM").val();
			 
					 $.post("ajax_update_price_new.php",{zipcode:shipzip,ship_country:shipcountryoption,total_weight:total_weight,totalprice:total}).done(function(data){
							
							  $('#pickup').show();
							  $('#shipp').show();
								$("#shipping_price_container").html(data);
								
								var ajax_ship_price=$("#ajax_ship_price").val();
								
			var total=$("#totalM").val();
			var discount=$("#discountval").val();
			$("#ship_price_hidden").val('');
			alert(ajax_ship_price);
			$("#ship_price_hidden").val(ajax_ship_price);
			<? if($check_othercountry_product==true){ ?>
			var other_country_charge=<?=$shipping_charge?>;
			var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(other_country_charge)-parseFloat(discount)+parseFloat(tax);
			<? }
			else{
			?>
			var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(tax);
			<? } ?>
			
			new_total=new_total.toFixed(2);
			$(".tax_span").html('');
			$(".tax_span").html(ajax_ship_price);
			$(".total_span").html('');
			$(".total_span").html(new_total);
			$("#payM").val(new_total);
			$("#amount_paypal").val(new_total);
			
			$.post("ajax_store.php",{zipcode:shipzip}).done(function(data){
			
			    $("#pickajax").html(data);
			
			  });
								 
						  });			
							
			}else{		 
             
	 var billaddressfull='<p>'+gustname1+" "+billlastname+'</p>'+'<p>'+billaddress+'</p><p>'+billcity+'</p><p>'+billzip+'</p><p>'+countryoption+'</p><p>'+stateoption+'</p>';
			    
			 $('#billing').html('<p>'+billaddressfull+'</p>');
			 $('#shipping').html('<p>'+billaddressfull+'</p>');
			  $('#buttoncon').hide();	
			 $('#billingdetail').hide();
			 $('#shippart').hide();	
			 //$('#shipp').show();
			 $('#paymentpart').show();
			 
			$('#detailboth').show();
  
             $('#updatede').hide();
  
			 
			 $("#shipfname").val(gustname1);
			 $("#shiplname").val(billlastname);
			 $("#shipphone").val(billTel);
			 $("#shipcity").val(billcity);
			 $("#ship_zipcode").val(billzip);
			 $("#shipaddress").val(billaddress);
			 $("#ship_country").val(billcountry);
		     $("#ship_state").val(billstate);
			 
			// alert("dhirendra");
			  var ship_country = $("#billcountry").val();
               var total_weight = $("#total_weight").val();
			   var total=$("#totalM").val();
			 $.post("ajax_update_price_new.php",{zipcode:billzip,ship_country:ship_country,total_weight:total_weight,totalprice:total}).done(function(data){
			          $('#pickup').show();
					  $('#shipp').show();
			            $("#shipping_price_container").html(data);
						var ajax_ship_price=$("#ajax_ship_price").val();
						
	var total=$("#totalM").val();
	var discount=$("#discountval").val();
	$("#ship_price_hidden").val('');
	//alert(total);
	$("#ship_price_hidden").val(ajax_ship_price);
	<? if($check_othercountry_product==true){ ?>
	var other_country_charge=<?=$shipping_charge?>;
	if(discount){
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(other_country_charge)-parseFloat(discount)+parseFloat(tax);
	}else{
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(other_country_charge)+parseFloat(tax);
	}
	<? }
	else{
	?>
	//alert("dhirendra");
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(tax);
	<? } ?>
	new_total=Number(new_total).toFixed(2);
	//alert(new_total);
	
	$(".tax_span").html('');
	$(".tax_span").html(ajax_ship_price);
	$(".total_span").html('');
	$(".total_span").html(new_total);
	 $("#shippingtr").show();
	 $(".shipping_span").html(ajax_ship_price);
	// $(".total_span").html(new_total);
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);	
	//alert(billzip);
	$.post("ajax_store.php",{zipcode:billzip}).done(function(data){
	  // alert(data);
			    $("#pickajax").html(data);
			  });
						 
			      });
								   
			 
				  }
		
		
		
		}
		

}


function update_rate(rate,shiping_name){
//alert("dhirendra");
var tax=$("#tax").val();
	//alert(tax);
  var shippingtype=shiping_name;
	$("#service_choose").val('');
	//alert(shiping_name);
	$('#currentshipmethod').html('<p>'+shippingtype+'</p>');
	$("#service_choose").val(shippingtype);
	var new_tax=rate;
	
	
	
	
	var total=$("#totalM").val();
	 var discount=$("#discountval").val();
	 if(!discount){
	  discount=0;
	 }
	 
	// alert(discount);
	 
	$("#ship_price_hidden").val('');
	$("#ship_price_hidden").val(new_tax);
	
	<? if($check_othercountry_product==true){ ?>
	var other_country_charge=<?=$shipping_charge?>;
	
	   if(document.getElementById('checkcredit').checked){
	      var credit=$("#usedcredit").val();
		  var total_with_ship=parseFloat(total)+parseFloat(new_tax)+parseFloat(other_country_charge)+parseFloat(tax);
	      var new_total=parseFloat(total)+parseFloat(new_tax)+parseFloat(other_country_charge)-parseFloat(discount)-parseFloat(credit)+parseFloat(tax);
	     }else{
		      var total_with_ship=parseFloat(total)+parseFloat(new_tax)+parseFloat(other_country_charge)+parseFloat(tax);
		      var new_total=parseFloat(total)+parseFloat(new_tax)+parseFloat(other_country_charge)-parseFloat(discount)+parseFloat(tax);
		      }
	
	<? }
	else{
	?>
	
	if(document.getElementById('checkcredit').checked){
	//alert("shashi");
	
	      var credit=$("#usedcredit").val();
		  var total_with_ship=parseFloat(total)+parseFloat(new_tax)+parseFloat(tax);
	   var new_total=parseFloat(total)+parseFloat(new_tax)-parseFloat(discount)-parseFloat(credit)+parseFloat(tax);
	  }else{
	  //alert("dhirendra");
	        var total_with_ship=parseFloat(total)+parseFloat(new_tax)+parseFloat(tax);
	       var new_total=parseFloat(total)+parseFloat(new_tax)-parseFloat(discount)+parseFloat(tax);
		   }
	
	
	<? } ?>
	new_total=Number(new_total).toFixed(2);
	
	
	//$(".total_order").html(total_with_ship);
	
	//alert(new_tax);
	
	$(".tax_span").html('');
	$(".tax_span").html(new_tax);
	$(".total_span").html('');
	$(".total_span").html(new_total);
	$(".shipping_span").html(new_tax);
	 $("#shippingtr").show();
	
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);
}
  
  function requestquote(){
  // var email=document.getElementById('email').value;
 // var password=document.getElementById('pass').value;
  var gustname1=document.getElementById('gustname1').value;
  var billlastname=document.getElementById('billlastname').value;
  var billTel=document.getElementById('billTel').value;
  var billcity=document.getElementById('billcity').value;
  var billzip=document.getElementById('billzip').value;
  var billcountry=document.getElementById('billcountry').value;
   var billaddress=document.getElementById('billaddress').value;
   var billstate=document.getElementById('billstate').value;
   
  
  var countryoption=$("#billcountry :selected").text();
   var stateoption=$("#billstate :selected").text();
   
   if(gustname1==''){
			alert('Please enter the Billing first Name');
			document.getElementById('gustname1').focus();
			return false;
		
		}else if(billlastname==''){
			alert('Please enter the Billing Last Name');
			document.getElementById('billlastname').focus();
			return false;
		
		}else if(billTel==''){
		alert('Please enter the bill Telephone');
		document.getElementById('billTel').focus();
		return false;
		
		}else if(billcountry==''){
		alert('Please enter the Billing country.');
		document.getElementById('billcountry').focus();
		return false;
		
		}else if(billaddress==''){
		alert('Please enter the Billing Address');
		document.getElementById('billaddress').focus();
		return false;
		
		}else if(billcity==''){
		alert('Please enter the Billing city');
		document.getElementById('billcity').focus();
		return false;
		
		}else if(billstate=='' && billcountry=='230'){
		alert('Please enter the Billing state');
		document.getElementById('billstate').focus();
		return false;
		
		}else if(billzip==''){
		alert('Please enter the Billing zip');
		document.getElementById('billzip').focus();
		return false;
		
		}else{
		 
			if(document.getElementById('checkshipdiff').checked){
			var shipfname=document.getElementById('shipfname').value;
             var shiplname=document.getElementById('shiplname').value;
			 var shipphone=document.getElementById('shipphone').value;
			 
             var ship_country=document.getElementById('ship_country').value;
			 var shipaddress=document.getElementById('shipaddress').value;
			 
             var shipcity=document.getElementById('shipcity').value;
			 var shipstate=document.getElementById('ship_state').value;
			 
             var shipzip=document.getElementById('ship_zipcode').value;
            // var shipcountry=document.getElementById('ship_country').value;
             var shipcountryoption=$("#ship_country :selected").text();
             var shipstateoption=$("#ship_state :selected").text();
			 
						    if(shipfname==''){
							alert('Please enter the shipping first Name');
							document.getElementById('shipfname').focus();
							return false;
							
							}else if(shiplname==''){
							alert('Please enter the shipping Last Name');
							document.getElementById('shiplname').focus();
							return false;
							
							}else if(shipphone==''){
							alert('Please enter the shipping Phone ');
							document.getElementById('shipphone').focus();
							return false;
							
							}else if(ship_country==''){
							alert('Please select  the shipping Country ');
							document.getElementById('ship_country').focus();
							return false;
							
							}else if(shipaddress==''){
							alert('Please enter  the shipping address ');
							document.getElementById('shipaddress').focus();
							return false;
							
							}else if(shipcity==''){
							alert('Please enter the shipping City ');
							document.getElementById('shipcity').focus();
							return false;
							
							}else if(shipstate==''){
							alert('Please enter the shipping state ');
							document.getElementById('ship_state').focus();
							return false;
							
							}else if(shipzip==''){
							alert('Please enter the shipping Zip code ');
							document.getElementById('ship_zipcode').focus();
							return false;
							
							}else{
							$("#placeorderform").submit();
							}
					}else{
					$("#placeorderform").submit();
					}
					
						}	
  
  
  }
  
  
  function placeorder(){
     var paymenttype=$("#paymenttype").val();
	  if(paymenttype=="card"){
	        var card_number=document.getElementById('card_number').value;
             var card_month=document.getElementById('card_month').value;
			 var card_year=document.getElementById('card_year').value;
			 var cvv=document.getElementById('cvv').value;
			             if(card_number==''){
							alert('Please enter the card number');
							document.getElementById('card_number').focus();
							return false;
							
							}else if(card_month==''){
							alert('Please enter the card expire month');
							document.getElementById('card_month').focus();
							return false;
							
							}else if(card_year==''){
							alert('Please enter the card expire year ');
							document.getElementById('card_year').focus();
							return false;
							
							}else if(cvv==''){
							alert('Please enter the cvv ');
							document.getElementById('cvv').focus();
							return false;
							
							}else{
							$("#placeorderform").submit();
							
							}
	 
	  }else{
	   $("#placeorderform").submit();
	  }
  }
  
  function changedetail(){
  
   $('#billingdetail').show();
   $('#shippart').show();	
   $('#updatede').show();
   $('#detailboth').hide();
   
   
  
  }
  
  function coupon()
  {
    //alert("dhirendra");
	var tax=$("#tax").val();
        var couponcode=document.getElementById('couponcode').value;
                          if(couponcode==''){
							alert('Please enter the Coupon Code');
							document.getElementById('couponcode').focus();
							return false;
							}else{
							     $.post("coupon_check.php",{couponcode:couponcode},"dataType:json").done(function(data){
								     //
								     //alert(data);
								 if(data=="error"){
								   alert("sorry this is wrong coupon code");
								  
								  }else{
								        var response=$.parseJSON(data);
								      if(response.discounttype=="coupon"){
									     //alert("coupon");
										  var ajax_ship_price=$("#ajax_ship_price").val();
									      var ship_price_hidden=$("#ship_price_hidden").val(); 
										if(response.type=="fix"){
									          var discount=response.value;
									        var total=$("#totalM").val();
									// alert(total);
									// alert(discount);
									discount=Number(discount).toFixed(2);
									if(ship_price_hidden!=""){
									       if(document.getElementById('checkcredit').checked){
											   var credit=$("#usedcredit").val();
										       var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount)-parseFloat(credit)+parseFloat(tax);
											   }else{
											        var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount)+parseFloat(tax);
													}
										}else{
										      var new_total=parseFloat(total)-parseFloat(discount)+parseFloat(tax);
											 }
									// var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount);
									new_total=Number(new_total).toFixed(2);
									    $("#discounttr").show();
										$(".discount_span").html(discount);
										//alert(new_total);
									 $(".total_span").html(new_total);
	                                 $("#payM").val(new_total);
	                                 $("#amount_paypal").val(new_total);
									  // alert(response.value);
									  $("#checkout_coupon").hide();
									  $("#discountval").val(discount);
									  $("#subtotal").show();
									  $("#usedcoupon").val(couponcode);
									    
										}else{
										
									    var total=$("#totalM").val();
										//alert(total);
										var discount=response.value*total/100;
										//alert(discount);
										//alert(ajax_ship_price);
										discount=Number(discount).toFixed(2);
										if(ship_price_hidden!=""){
										     if(document.getElementById('checkcredit').checked){
											   var credit=$("#usedcredit").val();
									            var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount)-parseFloat(credit)+parseFloat(tax);
												}else{
												      var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount)+parseFloat(tax);
													  }
										
										}else{
										      var new_total=parseFloat(total)-parseFloat(discount)+parseFloat(tax);
											 }
									   	 new_total=Number(new_total).toFixed(2);
										
										$("#usedcoupon").val(couponcode);	 
										$("#discounttr").show();
										$(".discount_span").html(discount);
									    $(".total_span").html(new_total);
	                                    $("#payM").val(new_total);
										$("#discountval").val(discount);
										
	                                    $("#amount_paypal").val(new_total);
										$("#checkout_coupon").hide();
										 $("#subtotal").show();
										   // alert(response.type);
										   }
										 
										 
										 }else{
									//alert(response);  
								   var discount=response.value;
								   
								   discount=Number(discount).toFixed(2);
								   //alert("refrel");
								  
								  $("#discounttr").show();
								    //alert("dhirendra");
									var total=$("#totalM").val();
									
									var ship_price_hidden=$("#ship_price_hidden").val();
									
										//alert(total);
										var discount=15*total/100;
										
										discount=Number(discount).toFixed(2);
										
										//alert(discount);
										//alert(ship_price_hidden);
										var payamount=$("#payM").val();
										//alert(payamount);
										$("#usedcoupon").val(couponcode);
										if(ship_price_hidden!=""){
										    if(document.getElementById('checkcredit').checked){
										         var credit=$("#usedcredit").val();
									              var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount)-parseFloat(credit)+parseFloat(tax);
											 }else{
											    var new_total=parseFloat(total)+parseFloat(ship_price_hidden)-parseFloat(discount)+parseFloat(tax);  
												}
										}else{
										   var new_total=parseFloat(total)-parseFloat(discount)+parseFloat(tax); 
										   }
										//alert(new_total);
										new_total=Number(new_total).toFixed(2);
										$("#subtotal").show();
										$("#discounttr").show();
										$(".discount_span").html(discount);
									    $(".total_span").html(new_total);
	                                    $("#payM").val(new_total);
										$("#discountval").val(discount);
										
	                                    $("#amount_paypal").val(new_total);
										$("#checkout_coupon").hide();		
								  
								  }		 
								}
								 
								 });
							}
  
  }
  
  function check(){
	var login=document.getElementById("email_login").value;
	var pass=document.getElementById("pwd_login").value;
	                 if(login==''){
							alert('Please enter the username');
							document.getElementById('email_login').focus();
							return false;
							
							}else if(pass==''){
							alert('Please enter the password');
							document.getElementById('pwd_login').focus();
							return false;
							}else{
							
							
							$.ajax({url:'ajax_login.php',data:{email:login,pass:pass},
							error:function(){
							$('#info').html('<p>An error has occurred</p>');
							},
							success:function(data){
							  if(data=='sucess'){
							    document.location.href="checkout-new.php"
								}else{
								alert("Username and Password do not match");
								
								}
								},
							  type:'POST'});
							
							
							}
	}
	
	function usercredit(){
	var total=$("#payM").val();
	var credit=$("#usedcredit").val();
	var tax=$("#tax").val();
	
	var product_total_price=$("#totalM").val();
	//alert(product_total_price);
	//var usedcredit = $("#usedcredit").val();
	//alert(product_total_price);
	//alert(credit);
	var discount=$("#discountval").val();
	//alert(discount);
	var ship_price_hidden=$("#ship_price_hidden").val(); 
	 
	if(credit==""){
	   credit=0;
	   //alert(credit);
	   }
	   
	   if(parseFloat(credit) > parseFloat(product_total_price)){
	     alert("You can not use Store Credit Products Price");
	     $("#usedcredit").val(0);
		 credit=0;
	 }
	
	   
	 if(document.getElementById('checkcredit').checked){
	
	 if(ship_price_hidden){
	     if(discount){
	     var new_total=parseFloat(product_total_price)+parseFloat(ship_price_hidden)-parseFloat(credit)-parseFloat(discount)+parseFloat(tax);
		 }else{
		      var new_total=parseFloat(product_total_price)+parseFloat(ship_price_hidden)-parseFloat(credit)+parseFloat(tax);
	     }
	  }else{
	        if(discount){
	         var new_total=parseFloat(product_total_price)-parseFloat(credit)-parseFloat(discount)+parseFloat(tax);
			 }else{
			 var new_total=parseFloat(product_total_price)-parseFloat(credit)+parseFloat(tax);
			 } 
	  }
	  
	    new_total= Number(new_total).toFixed(2);
		
		//alert(new_total);
	  
	  $("#creditused").show();
	  $(".creditused_amount").html(credit);
	 $(".total_span").html(new_total);
	  $("#payM").val(new_total);
	 $("#subtotal").show();
	 
	 
	 }else{
	  //alert("dhirendra");
	     if(ship_price_hidden){
	            if(discount){
				var new_total=parseFloat(product_total_price)+parseFloat(ship_price_hidden)-parseFloat(discount)+parseFloat(tax);
				}else{
				 var new_total=parseFloat(product_total_price)+parseFloat(ship_price_hidden)+parseFloat(tax);
				 }
	  }else{
	        if(discount){
			var new_total=parseFloat(product_total_price)-parseFloat(discount)+parseFloat(tax);
			}else{
			   var new_total=parseFloat(product_total_price)+parseFloat(tax);
			 } 
	  }
	  
	    
		 new_total= Number(new_total).toFixed(2);
		 
		// alert($new_total);
		 
		  $("#payM").val(new_total);
		 $(".total_span").html(new_total);
		 $("#creditused").hide();
		 }
	
  // alert(total);
 //  alert(credit);
	}
  
  function changesused(){
   if(document.getElementById('checkcredit').checked){
		     var usedcredit = $("#usedcredit").val();
			//alert("Seacrh suggestion satrting with - " + searchQuery);
			$("#creditused").show();
			 $(".creditused_amount").html(usedcredit);
			 
    }			 
  }
  
 function chnagestate(){
   var iam=$("#iam").val();
   var resaler=$("#resaler").val();
   
    if(($("#billstate").val() =='14') && (iam==''||iam=='General Buyer' || (iam=='Agent' && resaler==''))){
	var totalM=$("#totalM").val();
	var total=$("#payM").val();
	var taxval=totalM*0.1;
	
	taxval= Number(taxval).toFixed(2);
	   $("#taxtr").show();
	
	   $("#tax").val(taxval);
	   $(".total_tax").html(taxval);
	   var new_total=parseFloat(total)+parseFloat(taxval);
	   $("#payM").val(new_total);
		$(".total_span").html(new_total);
	   
	 }else{
	 var total=$("#payM").val();
	// alert(total);
	 var tax=$("#tax").val();
	 tax= Number(tax).toFixed(2);
	  $("#taxtr").hide();
	  $("#tax").val(0);
	  var new_total=parseFloat(total)-parseFloat(tax);
	 new_total= Number(new_total).toFixed(2);
	   $("#payM").val(new_total);
		$(".total_span").html(new_total);
	 }
   
  }
    </script>
   <style type="text/css">
   select {
   background: #f0f0f0 none repeat scroll 0 0;
  border: 1px solid #e5e5e5;
  height: 40px;
  margin: 0 0 14px;
  max-width: 100%;
  padding: 0 0 0 10px;
  width: 100%;
   }
   
   </style>
   
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
  color:#003300;
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
.smallscreen{
display:none;
}
.bigscreen{
display:block;
}

@media (min-width:266px) and (max-width:600px){
.smallscreen{
display:block;
}
.bigscreen{
display:none;
}

}

/*----------------------------------
 9. Testimonials-Area
----------------------------------*/
.testimonials-area {
	background: rgba(0, 0, 0, 0) url("img/bg/testimonial-bg.jpg") no-repeat scroll center center / cover;
	overflow: hidden;
	position: relative;
	background-image: url(images/parallax1.jpg);
}
.testimonials2 {
	background: rgba(0, 0, 0, 0) url("img/bg/testimonial-bg.jpg") no-repeat scroll center center / cover;
	overflow: hidden;
	position: relative;
	background-image: url(images/parallax2.jpg);
    padding: 70px 0
}
.testimonials-area .testimonials{
  background: rgba(0, 0, 0, 0.8) ;
  padding: 70px 0;
}
.testimonials-area .container {position: relative;}
.testimonials-area .container::before, .testimonials-area .container::after {
  content: "";
  display: block;
  height: 100%;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 999;
}

.upcomming-product-area {
  margin-top: 55px;
  position: relative;
}
.upcomming-product {
  padding: 0;
  position: relative;
}
.upcomming-product::before {
  background: #000 none repeat scroll 0 0;
  content: "";
  height: 100%;
  opacity: 0.7;
  position: absolute;
  width: 100%;
}
.upcomming-about {
  position: absolute;
  right: 250px;
  top: 50%;
  transform: translateY(-50%);
  width: 502px;
}
.upcomming-product.upcomming-product-2 .upcomming-about {
  left: 250px;
}
.upcomming-about h2 {
  color: #fff;
  font-size: 48px;
  font-weight: 900;
  line-height: 52px;
  margin-bottom: 25px;
  text-transform: uppercase;
}
.upcomming-about p {
  color: #fff;
  margin-bottom: 35px;
}
.shop-now i {
  border-left: 1px solid #fff;
  display: inline-block;
  float: right;
  font-size: 24px;
  height: 32px;
  line-height: 31px;
  width: 33px;
  transition: all 0.3s ease 0s;
}
.shop-now:hover i {
  border-left: 1px solid transparent;
}
.count-down {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translateY(-50%) translateX(-50%);
}
.count-down .timer {
  overflow: hidden;
  width: 200px;
}
.cdown {
  background: #32c4d1 none repeat scroll 0 0;
  color: #fff;
  float: left;
  font-size: 35px;
  font-weight: 900;
  height: 100px;
  line-height: 39px;
  padding-top: 15px;
  text-align: center;
  width: 50%;
}
.cdown p {
  margin:0;
  font-size:24px;
  line-height: 28px;
  font-weight:normal;
  text-transform: capitalize;
}
.cdown.hour, .cdown.minutes {
	background: #fff;
	color: #32c4d1;
}

.owl-controls {

display:none;
}
</style>
    
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- HEADER-AREA START -->
        <?php include'header-new.php'?>
		<!-- HEADER-AREA END -->

		<!-- PAGE-CONTENT START -->
		
				<div class="container">
					
								<h3>Checkout</h3>
								<ul>
									<li><a href="index.html">Home</a> &nbsp; I &nbsp;Checkout</li>
									
								</ul>
							</div>
			
			<!-- PAGE-BANNER END -->
			<!-- CHECKOUT-AREA START -->
			<div class="checkout-area margin-bottom-80">
				<div class="container">
					
					<div class="coupon-area">
						<div class="row">
							<div class="col-md-12">
								<div class="coupon-accordion">
                                <? if(!$_SESSION['member_id']){ ?>
									<!-- ACCORDION START -->
									<h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
									<div id="checkout-login" class="coupon-content">
										<div class="coupon-info">
											
											
												<div class="row">
													<div class="col-md-6">
														<p class="form-row-first">
															<label>Username or email <span class="required">*</span></label>
															<input type="text" id="email_login" name="email_login" />
														</p>
													</div>
													<div class="col-md-6">
														<p class="form-row-last">
															<label>Password  <span class="required">*</span></label>
															<input type="password" name="pwd_login" id="pwd_login" />
														</p>
													</div>
												</div>
												<p class="form-row">					
													<input type="submit" value="Login" onClick="check()" />
													<label>
														<input type="radio" />
														 Remember me 
													</label>
												</p>
												<p class="lost-password">
													<a href="#">Lost your password?</a>
												</p>
											
										</div>
									</div>
									<!-- ACCORDION END -->	
									<!-- Genaral Login start -->
								<!--	<div class="coupon-info margin-bottom-50">
										<p class="coupon-text margin-bottom-50">If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>
										<form action="#">
											<div class="row">
												<div class="col-md-6">
													<p class="form-row-first">
														<label>Username or email <span class="required">*</span></label>
														<input type="text" />
													</p>
												</div>
												<div class="col-md-6">
													<p class="form-row-last">
														<label>Password  <span class="required">*</span></label>
														<input type="password" />
													</p>
												</div>
											</div>
											<p class="form-row">					
												<input type="submit" value="Login" />
												<label>
													<input type="radio" />
													 Remember me 
												</label>
											</p>
											<p class="lost-password">
												<a href="#">Lost your password?</a>
											</p>
										</form>
									</div> -->
                                    <? } ?>
									<!-- Genaral Login end -->
									<!-- ACCORDION START -->
                                    <?
									if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1) or($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1) or($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){
									
									$coupon=1;
									
									}
									?>
                                    
                                    <? if(!$SubDomain and !$coupon ){ ?>
									<h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3> 
									<div id="checkout_coupon" class="coupon-checkout-content" style="display:block;">
										<div class="coupon-info">
											
												<p class="checkout-coupon">
													<input type="text" placeholder="Coupon code" id="couponcode" />
													<input type="submit" value="Apply Coupon"  onClick="coupon()" />
												</p>
											
										</div>
									</div>
                                    <? } ?>
									<!-- ACCORDION END -->						
								</div>
							</div>
						</div>
					</div>
					<!-- Checkout-Billing-details and order start -->
					<div class="checkout-bill-order">
						<form action="checkout_process_new.php" method="post" name="placeorderform" id="placeorderform" >
							<div class="row" >
								<div class="col-md-6" >
									<div class="checkout-bill">
										<div style="float:left; width:50%"><h3 class="title-7 margin-bottom-50">Billing Details</h3></div>
                                       
                            <div  style=" float:left; margin-top:15px;   <? if(!$_SESSION['member_id']) { ?> display:block; <? }else{ ?>display:none <? } ?>"> 
                            <h4 class="title-8">Create Account <input type="checkbox" checked="checked" onClick="createacc()"  id="checkaccount" name="checkoutoption" value="member"/></h4>
										
											
                                        </div>
                                       
								
									</div>
                                    <div   id="billingdetail">
                                    <? if(!$_SESSION['member_id']) { ?>
									<div class="row coupon-info" style="clear:both; " id="accountpart">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>Username or email <span class="required">*</span></label>
												<input type="text" name="username"  id="username" />
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Password  <span class="required">*</span></label>
												<input type="password" id="password" name="password" />
											</p>
										</div>
									</div>
                                    <? } ?>
                                    <div class="row coupon-info" style="clear:both;">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>First Name <span class="required">*</span></label>
												<input type="text" name="gustname1" id="gustname1"  value="<?=$member_row['f_name']?>"/>
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Last Name  <span class="required">*</span></label>
												<input type="text" name="billlastname" id="billlastname" value="<?=$member_row['l_name']?>" />
											</p>
										</div>
									</div>
                                    
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Company Name </label>
												<input type="text" />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>Email Address <span class="required">*</span></label>
												<input type="text" name="billemail" value="<?=$member_row['email']?>" />
											</p>
										</div>
                                        
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Phone  <span class="required">*</span></label>
												<input type="text" name="billTel" id="billTel" value="<?=$member_row['tel']?>" />
											</p>
										</div>
									</div>
                                   
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Country <span class="required">*</span> </label>
												<!--<input type="text" placeholder="United states (US)" /> -->
                                                <select class="full no-border" name="country" id="billcountry" >
       <option value="" selected>Select Country</option>		 
		
	<?php
	  while ($country_result = mysql_fetch_assoc($country_query_gust)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($member_row['country']==$country_result['country_Id']){?>
	 selected<? } ?>><?=$country_result['country_name']?></option>
	
	<?php } ?>      
             </select> </span> 
         <script type="text/javascript">
			$("#billcountry").change(function(){
			
			if($("#billcountry").val()=='230'  || $("#billcountry").val()=='45')	{
		$("#billstate_div").show('fast');	
	$("#billstate").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#billcountry").val());				
	
	    	//$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#billstate_div").hide('fast');		
			}
						});		

                                       </script>  
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Address <span class="required">*</span> </label>
												<input type="text" placeholder="Street address"  name="billaddress" id="billaddress" value="<?=$member_row['address1']?>" />
												<input type="text" placeholder="Site, Unite etc (optional)" name="billadress2" />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Town / City <span class="required">*</span></label>
												<input type="text" placeholder="City"  id="billcity" name="billcity" value="<?=$member_row['city']?>"/>
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>State <span class="required">*</span></label>
												 <select class="full no-border" name="state" id="billstate" onChange="chnagestate()">
                                                 <? if($_SESSION['member_id']) { ?>
                                                 <option value="<?=$userstate['state_id']?>" selected> <?=$userstate['state_name']?></option>
                                                 <? }else{ ?>
                                                   <option value="">select state</option> 
                                                   <? } ?>    
                                                        </select>
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Zip  <span class="required">*</span></label>
												<input type="text" id="billzip" name="billzip" value="<?=$member_row['zipcode']?>" />
											</p>
										</div>
									</div>
									
									
									<div class="row coupon-info" style="margin-left:1px;" ><h4 class="title-8">Ship to a different address <input type="checkbox" checked="checked" id="checkshipdiff" onClick="shiptodiffrent()" /></h4> </div>
                                     </div>
									<div id="shippart" class="row coupon-info" style="margin-left:1px; margin-right:0px;" >
                                    
									<div class="row coupon-info">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>First Name <span class="required">*</span></label>
												<input type="text" name="shipfname" id="shipfname" value="<?=$member_row['f_name']?>" />
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Last Name  <span class="required">*</span></label>
												<input type="text" name="shiplname" id="shiplname" value="<?=$member_row['l_name']?>"  />
											</p>
										</div>
									</div>
                                    
                                    <div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Company Name </label>
												<input type="text" id="shipcompany" />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>Email Address <span class="required">*</span></label>
												<input type="text"  name="billemail" id="shipemail"  value="<?=$member_row['email']?>" />
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Phone  <span class="required">*</span></label>
												<input type="text" name="shipphone" id="shipphone" value="<?=$member_row['cel']?>"  />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Country <span class="required">*</span> </label>
												<select class="full no-border" name="ship_country" id="ship_country"  >
       <option value="" selected>Select Country</option>		 
		
	<?php
	  while ($country_result2 = mysql_fetch_assoc($country_query_gust2)) {
	?>	
	<option value="<?=$country_result2['country_Id']?>" <? if($member_row['country']==$country_result2['country_Id']){?>
	 selected<? } ?> ><?=$country_result2['country_name']?></option>
	
	<?php } ?>      
             </select> </span>
         <script type="text/javascript">
			$("#ship_country").change(function(){
			if($("#ship_country").val()=='230'  || $("#ship_country_gust").val()=='45')	{
		$("#ship_state_div").show('fast');	
	$("#ship_state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#ship_country").val());				
	
	    	//$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#ship_state_div").hide('fast');		
			}
						});		

                                       </script>   
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Address <span class="required">*</span> </label>
												<input type="text" placeholder="Street address" name="shipaddress" id="shipaddress" value="<?=$member_row['address1']?>"  />
												<input type="text" placeholder="Site, Unite etc (optional)" name="shipaddress2" />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Town / City <span class="required">*</span> </label>
												<input type="text" placeholder="City" id="shipcity" name="shipcity" value="<?=$member_row['city']?>" />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-6">
											<p class="form-row-first">
												<label>State <span class="required">*</span></label>
												<select class="full no-border" name="ship_state" id="ship_state"   onChange="update_ship()">
                                                   <option value="">Select State</option>     
                                                        </select> 
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
												<label>Zip  <span class="required">*</span></label>
												<input type="text" name="ship_zipcode" id="ship_zipcode" value="<?=$member_row['zipcode']?>" />
											</p>
										</div>
									</div>
									<div class="row coupon-info">
										<div class="col-md-12">
											<p class="form-row-first">
												<label>Additoional Information</label>
												<textarea name="addinfo"></textarea>
											</p>
										</div>
									</div>
                                    
                                    
								</div>
                                    <div class="row coupon-info"  id="buttoncon">
										<div class="col-md-12" align="center">
											<p class="form-row-first">
                                             <? if($_SESSION['member_id']){ ?>
												<div class="order-button-payment">
												<input  type="button"  value="Update"  onClick="billvalidate()" />
											   </div>
                                               <? }else{ ?>
                                               <div class="order-button-payment">
												<input  type="button"  value="Click to continue order"  onClick="billvalidate()" />
											   </div>
                                               <? } ?>
												
											</p>
										</div>
									</div>
                                 <div class="row coupon-info" >
									<div class="col-md-12" align="center">	
                                        <div class="order-button-payment" style="display:none" id="updatede">
                                           <input  type="button"  value="update"  onClick="billvalidate()" />
                                        </div>
                                     </div>   
										
									</div>
                                
                                <div class="row coupon-info" style="background:#f0f0f0; display:none" id="detailboth">
										<div class="col-md-6">
											<p class="form-row-first">
												<b>Billing Detail</b>
												
											</p>
										</div>
										<div class="col-md-6">
											<p class="form-row-last">
											 <b> Shipping Detail</b>
												
											</p>
										</div>
                                        <div class="col-md-6"  id="billing">
											
										</div>
										<div class="col-md-6" id="shipping">
											
										</div>
                                      <div class="col-md-6 order-button-payment" style="width:100%; text-align:right;">
                                       <input  type="button" value="Change"  onClick="changedetail()" />
                                      </div>  
								</div>
                                
                               
                               
                               </div>
								<div class="col-md-6">
									<div class="your-order">
										<h3 class="title-7 margin-bottom-50">Your Order</h3>
                                        <?  if($SubDomain){ 
										
									    $discount=$total_P*15/100;
										$discount=number_format($discount,2);
										$payM=$total_P-$discount+$ship_price+$tax;
										}
										if(($member_row['i_am']=="General Buyer" or $member_row['i_am']=="" or ($member_row['i_am']=='Agent' and $member_row['resaler']=='')) and ($member_row['state']=="14")){
										   $tax=$total_P*0.1;
										   $payM=$total_P-$discount+$ship_price+$tax;
										}else{
										$tax=0;
										}
										?>
                                        
										<div class="your-order-table table-responsive">
                                          <input type="hidden" name="totalM" id="totalM" value="<?=$total_P?>">
                                           <input  type="hidden" name="payM" id="payM" value="<?=$payM?>">
                                           <input type="hidden" name="ship_price_hidden" id="ship_price_hidden" value="<?=$ship_price?>">
                                           <input type="hidden" name="tradecode" value="<?=$tradecode;?>" >
                                           <input type="hidden" name="discountval" id="discountval" value="<?=$discount?>" >
                                           <input type="hidden" name="pay_method_select" id="pay_method_select" value="creditcard" >
                                           <input type="hidden" name="total_weight" id="total_weight" value="1"  >
                                           <input type="hidden" name="shipping_charge_other_countery" id="shipping_charge_other_countery" value="<?=$shipping_charge?>" >
                                           <input  type="hidden" name="storepickup" id="storepickup" value=""/>
                                           <input  type="hidden" name="credit" id="credit" value="<?=$member_row['account_credit']?>"/>
                                           <input  type="hidden" name="usedcoupon" id="usedcoupon" value=""/>
										   <input type="hidden" name="subdomain" id="subdomain" value="<?=$SubDomain?>">
                                           <input type="hidden" name="tax" value="<?=$tax?>" id="tax">
                                           <input type="hidden" name="i_am" value="<?=$member_row['i_am']?>" id="iam">
                                           <input type="hidden" name="resaler" value="<?=$member_row['resaler']?>" id="resaler">
                                           
                                           
                                     	<table>
												<thead>
													<tr>
														<th class="product-name">Product</th>
														<th class="product-total">Total</th>
													</tr>
												</thead>
												<tbody>
                                                <?  $cart_cnt=0; 

                                                 while($cart_goods_row=mysql_fetch_assoc($cart_goods_query2)){
												 
												$cart_cnt++;
	
	//echo "SELECT * FROM `product` where id='$cart_goods_row[goodsId]'";
	$goods_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
	
	if (strpos($goods_info['images'],',') !== false) {
  $product_img=explode(',',$goods_info['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$goods_info['images'];	
}
if($cart_goods_row['dropship']==0){

$total_weight +=$goods_info['package_weight']*$cart_goods_row['cnt'];	
}
if($total_weight==''){
	$total_weight=0;
}


  if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)){
	  ///for dealer price////////////
	   
	   $userprice=explode(',',$goods_info['wholesaleprice2']);
	   $price1=$userprice[$cart_goods_row['option_index']];
	   
	   if(count($userprice)<=1){
	   $userprice=$goods_info['manufacture_price'];
	   $price1=$userprice;
	    }
	 
	 
		$price=$price1;
		
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
		  
		 // echo "$price1";
		
  }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){ 
  
       $userprice=explode(',',$goods_info['price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['msrp_price'];
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
  
  }else if(($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){ 
  
       $userprice=explode(',',$goods_info['agent_price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['agentprice1'];
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
  
  }else{
	    
		$userprice=explode(',',$goods_info['manufactureprice2']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['wholesale_price'];
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
		 
	    }


 
$length_opt_val = explode('Length-',$cart_goods_row['option2']);

$length_opt_val = $length_opt_val[1];
 
 $quantity = $goods_info['quantity'];

if($goods_info['min_quantity']==''){
$min_quantity =1;	
}
else{
$min_quantity = $goods_info['min_quantity'];	
}

$producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $goods_info['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
												 
												  ?>
													<tr>
														<td class="product-name"><?=$goods_info['product_name']?>	(<?=$cart_goods_row['cnt']?>)</td>
														<td class="product-total"><?=number_format($cart_goods_row['cnt']*$price1,2)?></td>
													</tr>
                                                    <? } ?>
                                                    
													
										<tr class="shipping" <? if($_SESSION['member_id']) { ?>  <? }else{ ?> style="display:none;" <? } ?> id="shipp" >
                                        
														<th>Shipping</th>
														<td id="shipping_price_container" >
															<ul>
																<? if($ups_country=='US'){ ?> 
																<? if($ship_over35==1){ ?>
                                                                <li>
																	<input type="radio" name="shipping_type" value="<?=$draw_free?>" 
 onclick="update_rate(<?=$draw_free?>,'Priority Mail Express 1-Day')"  checked="checked" >
   <input type="hidden" name="service_choose" id="service_choose" value="free shipping w/35 order"  />
																	<label for="1">
																		Free shipping w/$35 order  $<?=$draw_free?>
																	</label>
																</li>
                                                              
                                                                <? } ?>
																<li>
									<input type="radio" name="shipping_type" onClick="update_rate(<?=$ups_gnd?>,'UPS Ground')"  value="<?=$ups_gnd?>" checked>
																	<label for="2">
																		UPS Ground  <span class="amount">$<?=$ups_gnd?></span>
																	</label>
																</li>
																<li>
									<input type="radio" name="shipping_type"  onclick="update_rate(<?=$ups_2da?>,'UPS 2nd Day Air')"  value="<?=$ups_2da?>">
																	<label for="3">
																		UPS 2nd Day Air <span class="amount">$<?=$ups_2da?></span>
																	</label>
																</li>
                                                                
                                                                <li>
															<input type="radio" name="shipping_type"  onclick="update_rate(<?=$usps_servicepost_charge?>,'USPS Standard')"  value="<?=$usps_servicepost_charge?>">
																	<label for="3">
																		USPS Piroity 2day <span class="amount">$<?=$usps_servicepost_charge?></span>
																	</label>
																</li>
                                                                <? }else{?>
                                                                 <li>
								<input type="radio" name="shipping_type" onClick="update_rate(<?=$ship_price?>,'Priority Mail International')" checked  value="<?=$ship_price?>"> 
																	<label for="3">
																		Priority Mail International <span class="amount">$<?=$ship_price?></span>
																	</label>
																</li>
                                                                 <li>
															<input type="radio" name="shipping_type" 
   onclick="update_rate(<?=$usps_international_all['26']['POSTAGE']?>,'Priority Mail Express International')" 
    value="<?=$usps_international_all['1']['POSTAGE']?>">
																	<label for="3">
																		Priority Mail Express International <span class="amount">$<?=number_format($usps_international_all['26']['POSTAGE'],2)?></span>
																	</label>
																</li>
                                                                
                                                                <? } ?>
                                                                
															</ul>
														</td>
													</tr>	
                                                    
                                        <!--    <tr class="shipping" <? if($_SESSION['member_id']) { ?>  <? }else{ ?> style="display:none;" <? } ?> id="pickup" >
														<th><font style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FREE pickup<?=$_SESSION['i_am']?></font></th>
														<td id="pickajax">
															<ul>
																<?
																for ($t=0; $t<3; $t++)
																{
																$pickup_storid=$arr1[$t]['id'];
																if($pickup_storid!=""){
																$row=mysql_fetch_array(mysql_query("select * from store where id=$pickup_storid"));
																$row1=mysql_fetch_array(mysql_query("select * from Pickup where store_id=$pickup_storid"));
																?> 
                                                                <li>
                                                                <div style="float:left; vertical-align:top;">
                                                                  <input type="radio" onClick="pickup(<?=$row['id']?>)" name="shipping_type" checked="">
                                                                </div>
                                                                <div>
                                                                <label for="1"> <b style="color:#000; font-size:18px;">&nbsp;&nbsp;<?=$row['s_name']?></b> <br> <font style="font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp; <?=$row['s_location']?></font>
																	</label>
                                                                </div>
																	
																	
																</li>
                                                               <?php } } ?>
                                                                
																
															</ul>
														</td>
													</tr>   -->
                                                     
                                                     <tr>
														<td class="product-name order-total">Order Total</td>
														<td class="product-total order-total">$<span class="total_order"><?=number_format($total_P,2)?></span></td>
													</tr>	
                                                    
                                                    
                                                    
                                                     <tr  <? if($tax==0){?> style="display:none" <? } ?> id="taxtr">
														<td class="product-name order-total">Tax</td>
														<td class="product-total order-total">$<span class="total_tax"><?=number_format($tax,2)?></span></td>
													</tr>	
                                                   
                                                   
                                                    <tr id="storecredit" <? if(!$_SESSION['member_id']){ ?> style="display:none" <? } ?>>
														<td class="product-name order-total">Store Credit</td>
														<td class="product-total order-total"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" color ="grey">Input Amount</font> <input name="usedcredit" id="usedcredit" style="background:#FFFFFF; width:100px;" onKeyUp="usercredit()" ><br/>
                                                        $<span class="credit_span"> <?=$member_row['account_credit']?> </span>
                                                        <input type="checkbox" name="storecredit" onClick="usercredit()" value="1" id="checkcredit"> Use Store Credit</td>
													</tr> 
                                                   
                                                    <tr id="creditused" style=" display:none;">
														<td class="product-name order-total"><font color="#FF0000">Royalty Rewards </font></td>
														<td class="product-total order-total">-$<span class="creditused_amount"> </span></td>
													</tr>
                                                    <? if(!$coupon){ ?>
                                                    <tr id="discounttr" <? if(!$SubDomain){ echo ""; ?> style=" display:none;" <? } ?>>
														<td class="product-name order-total">Discount <font color="#FF0000">15% OFF </font></td>
														<td class="product-total order-total">-$<span class="discount_span"><?=$discount?> </span></td>
													</tr>
                                                    <? } ?>
                                                    
                                                    <tr id="shippingtr" <? if(!$_SESSION['member_id']){ ?> style="display:none" <? } ?> >
														<td class="product-name order-total">Shipping</td>
														<td class="product-total order-total">$<span class="shipping_span"><?=$ups_gnd?> </span></td>
													</tr>
                                                    
													<tr id="subtotal"  >
														<td class="product-name order-total">Sub Total</td>
														<td class="product-total order-total">$<span class="total_span"><?=number_format($payM,2)?></span></td>
													</tr>												
												</tbody>
											</table> 
                                            
                                            
                                            
                                           
							<div class="payment-method" <? if($_SESSION['member_id']) { ?> style="display:block;"  <? }else{ ?> style="display:none;" <? } ?> id="paymentpart" >
                                            <input    type="hidden"  value="card" id="paymenttype"/>
                                            
												
                                              <!--  <div class="col-lg-12 col-sm-12 col-xs-12">
                                                    <div class="col-lg-6 col-sm-12 col-xs-12">test1</div>
                                                
                                                   <div class="col-lg-6 col-sm-12 col-xs-12">test2</div>
                                                
                                                
                                                </div>
                                                -->
                                                
                                                
                                                
                                                <div class="payment-accordion">
                                                
                                                
                                                
													<!-- ACCORDION START -->
													<h3 class="payment-accordion-toggle active" onClick="setpayment('creditcard')">Pay By Card</h3>
													<div class="payment-content default">
														<p> <div class="full"><img src="images/card_demo.png" ></div>  
                                                        <div class="full" style="margin-top:1em;"><span>Card Type</span><br>
                                                              <select name="card_type" class="form-control" >
                                                             <option value="visa" selected="selected">Visa</option>
                                                             <option value="mastercard">MasterCard</option>
                                                             <option value="discover">Discover</option>
                                                             <option value="amex">American Express</option>
                                                             </select>
                                                              </div> 
                                                              
                                                              <div class="full" style="margin-top:1em;"><span>Card Number</span><br>
                                                                 <input type="text" class="form-control" name="card_number" id="card_number">
                                                                  </div>
                                                                  
                                                               <div class="row" style="margin-top:1em;">
                                                                 <div class="col-lg-6 col-sm-6 col-xs-6"><span>Expiry date</span><br>
                                                                
                                                                <div style="float:left">
                                                            <input type="text" size="3" name="card_month" id="card_month" placeholder="MM" style="border-radius:5px; border:1px solid #BDC3CB; height:40px; margin-right:2px;"> &nbsp;&nbsp;</div> 
                                                                <div style="float:left">
                              <input type="text" name="card_year" id="card_year" size="3"placeholder="YYYY" style="border-radius:5px; border:1px solid #BDC3CB; height:40px; ">
                              </div>
                                                                 </div> 
                                                                 <div class="col-lg-6 col-sm-6 col-xs-6">
                                                                 <span>Security Code</span><br>
                                                                 <input type="text" name="cvv" id="cvv" size="5" style="border-radius:5px; border:1px solid #BDC3CB; height:40px;">
                                                                  &nbsp;<img src="images/card_demo2.png" >
                                                                 </div> 
                                                                  </div>   
                                                          </p>
													</div>
													<!-- ACCORDION END -->  
													
													<!-- ACCORDION START -->
													<h3 class="payment-accordion-toggle" onClick="setpayment('paypal')">PayPal</h3>
													<div class="payment-content">
														<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
														<a href="#"><img src="images/checkout_paypal.png" class="img-thumbnail" style="border:0;"></a>
													</div>
													<!-- ACCORDION END -->                                  
												</div>
                                                <div class="order-button-payment">
												<input  type="button" value="Order"  onClick="placeorder()" />
											</div>
                                                
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- Checkout-Billing-details and order end -->
				</div>
			</div>
			<!-- CHECKOUT-AREA END -->
			<!-- BRAND-LOGO-AREA START -->
			<div class="brand-logo-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-12">
							<div class="brand-brief">
								<h2 class="border-left-right">EBHA BRAND</h2>
								<p></p>
							</div>
						</div>
						<div class="col-md-7 col-sm-12">
							<div class="brand-logo fix">
								<div class="single-logo">
									<img src="img/brand/1.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/2.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/3.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/4.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/5.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/6.png" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BRAND-LOGO-AREA END -->
		</section>
		<!-- PAGE-CONTENT END -->	
		
		<!-- FOOTER-AREA START -->
		<div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>
		<!-- FOOTER-AREA END -->

		
		<!-- all js here -->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- jquery.nivo.slider js -->
        <script src="lib/js/jquery.nivo.slider.js"></script>
        <script src="lib/home.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- jquery-ui js -->
        <script src="js/jquery-ui.min.js"></script>
		<!-- lightbox.min js -->
        <script src="js/lightbox.min.js"></script>
		<!-- countdon.min js -->
        <script src="js/countdon.min.js"></script>
		<!-- wow js -->
        <script src="js/wow.min.js"></script>
		<script type="text/javascript">
			new WOW().init();
		</script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
