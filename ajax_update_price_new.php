<?php 
session_start();
require_once('wp-admin/include/connectdb.php');
require_once('usps_shipping.php');
?> 
   <!-- for domestic start  -->     
   <?   if(isset($_POST['ship_country'])){
	 $ship_country=$_POST['ship_country'];
	 $rzip = $_POST['zipcode'];
	 $total_weight = $_POST['total_weight'];
	 $totalprice = $_POST['totalprice'];
	 
	 $ponds=$total_weight;
     $onces=0;
	/* $total_weight=$total_weight/8;
	$total_weight=number_format($total_weight,2);
	$response=explode('.',$total_weight);
	$ponds=$response[0];
    $onces=$response[1]*8;
	*/
	//echo "$ship_country";
	
	$ups_country=mysql_result(mysql_query("select country_name from country where country_Id='$ship_country'"),0);  
	 if($ups_country=='United States'){
	 
      $ups_country="US" ;
     }
	   
    if($ups_country=='US'){ 
	
	require_once('ups_rate1.php');
	
	
	$USPSParcelRate=USPSParcelRate_local($ponds,$onces,$rzip);

$Alluspsprice_list=USPSParcelRate_local_All($ponds,$onces,$rzip);
$usps_servicepost_charge = USPSParcelRate_service_post($ponds,$onces,$rzip);


//$ship_price=$USPSParcelRate;


$ups_three_day = get_UPS_Price_Ups_three_day($rzip,$ups_country,$total_weight);
   $ups_gnd=  get_UPS_Price_Ups_GND($rzip,$ups_country,$total_weight);
    $ups_2da=  get_UPS_Price_Ups_2da($rzip,$ups_country,$total_weight);
	
	$ship_price=$ups_gnd;
	?>    
    <? //if($totalprice>35 && $ship_country=='230'){
//$ship_price=0;
//$draw_free=0;
//$ship_over35=1;
//}
    ?>
 
  
   <ul>
																<?  if($ups_country=='US'){ ?> 
																
                                                                <li>
                                                                 <input type="hidden" name="service_choose" id="service_choose" value="UPS Ground"  />
                                                                </li>
                                                                
																<li>
															<input type="radio" name="shipping_type" onClick="update_rate(<?=$ups_gnd?>,'UPS Ground')"  value="<?=$ups_gnd?>" checked="checked">
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
                                                                <? }else{
																 $USPSParcelRate=USPSParcelRate_international($ponds,$onces,$ups_country);
																$usps_international_all= USPSParcelRate_international_All($ponds,$onces,$ups_country);
																//print_r($usps_international_all);
																$ship_price=$USPSParcelRate;
																?>
                                                                 <li>
															<input type="radio" name="shipping_type" 
   onclick="update_rate(<?=$ship_price?>,'Priority Mail International')" checked  value="<?=$ship_price?>"> 
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
   
   
  
   
  <? } 
  if($ups_country!='US'){
	  
	  $USPSParcelRate=USPSParcelRate_international($ponds,$onces,$ups_country);
	
	$usps_international_all= USPSParcelRate_international_All($ponds,$onces,$ups_country);
	//print_r($usps_international_all);
	
	$ship_price=$USPSParcelRate;
  ?>
 <!-- for domestic  end--> 
 <!-- for international start -->
 <div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-9"><input type="radio" name="shipping_type" 
   onclick="update_rate(<?=$ship_price?>,'Priority Mail International')" checked  value="<?=$ship_price?>"> Priority Mail International</div>
  <div class="col-lg-3">$<?=$ship_price?></div>
  </div>
   <div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-9"><input type="radio" name="shipping_type" 
   onclick="update_rate(<?=$usps_international_all['26']['POSTAGE']?>,'Priority Mail Express International')" 
    value="<?=$usps_international_all['26']['POSTAGE']?>">Priority Mail Express International</div>
  <div class="col-lg-3">$<?=$usps_international_all['1']['POSTAGE']?></div>
  </div>
 <? } 
 ?>
 <input type="hidden" name="ajax_ship_price" id="ajax_ship_price" value="<?=$ship_price?>" >
 
 <?
   }
 ?>