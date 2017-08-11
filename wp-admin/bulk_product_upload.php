<?php

session_start();

require_once('include/connectdb.php');

$user_email=$_POST['user_email'];
$csv_name=$_POST['csv_name'];
$zip_name=$_POST['zip_name'];
$user_id=$_POST['user_id'];



if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	 
 


	 
	
	
	
	if(isset($_POST['csv_name_1']) && $_POST['csv_name_1']!=''){
		$csv_name_1=$_POST['csv_name_1'];
		$zip_name_1=$_POST['zip_name_1'];
		$user_id_1=$_POST['user_id_1'];
		
	
		
		
		mysql_query("update bulk_upload_file set status = 1  where id ='$user_id_1'");
		
		 //create a ZipArchive instance
         $zip = new ZipArchive;
         //open the archive
         if ($zip->open("../supplier/bulk_zip/$zip_name_1") === TRUE) {
         //extract contents to /data/ folder
         $zip->extractTo('../product_img/');
         //close the archive
         $zip->close();
   } 
		
		//$csv_name = $_POST['csv_name'];
	$row = 1;
if (($handle = fopen("../supplier/bulk_csv/".$csv_name_1, "r")) !== FALSE) {
	
	fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       // echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		//$query_val ="";
		$product_code='';
		$user_id='';
		$supplier_code='';
		$subcategory='';
		$sub_subcategory='';
		$product_name='';
		$images='';
		$hair_type_check='';
		$hair_type_value='';
		$category='';
		$quantity='';
		$quantity_type='';
		$manufacture_price='';
		$wholesale_price='';
		$msrp_price='';
		$discount_option_check='';
		$discount_option_value='';
		$special_promotion_check='';
		$special_promotion_value='';
		$delivery_time='';
		$dropship='';
		$shipping_method='';
		$shipping_price='';
		$place_origin='';
		$shipping_price='';
		$package_weight='';
		$package_unit='';
		$description='';
		$product_seen='';
		$sku='';
		$length='';
		$price='';
		$stock='';
		$length_size='';
		$min_quantity='';
		
		$count=0;
        for ($c=0; $c < $num; $c++) {
           $count++;
		  //$query_val = "'$data[$c]',";
		  //echo $data[$c].'vimal<br>';
		  
		   if($count>35){
		   $count=0;
		   }
		  
		     if($count==1){
			 $product_code .=$data[$c].",";
			   }
		    if($count==2){
			 $user_id .=$data[$c].",";
			   }
			if($count==3){
			 $supplier_code .=$data[$c].",";
			   }
			   if($count==4){
			 $category .=$data[$c].",";
			   }
			   if($count==5){
			 $subcategory .=$data[$c].",";
			   }
			   if($count==6){
			 $sub_subcategory .=$data[$c].",";
			   }
			   if($count==7){
			 $product_name .=$data[$c].",";
			   }
			   if($count==8){
			 $images .=$data[$c].",";
			   }
			   if($count==9){
			 $hair_type_check .=$data[$c].",";
			   }
			   if($count==10){
			 $hair_type_value .=$data[$c].",";
			   }
		   if($count==11){
			 $quantity .=$data[$c].",";
			   }
		    if($count==12){
			 $quantity_type .=$data[$c].",";
			   }
			if($count==13){
			 $manufacture_price .=$data[$c].",";
			   }
			   if($count==14){
			 $wholesale_price .=$data[$c].",";
			   }
			   if($count==15){
			 $msrp_price .=$data[$c].",";
			   }
			   if($count==16){
			 $discount_option_check .=$data[$c].",";
			   }
			   if($count==17){
			 $discount_option_value .=$data[$c].",";
			   }
			   if($count==18){
			 $special_promotion_check .=$data[$c].",";
			   }
			   if($count==19){
			 $special_promotion_value .=$data[$c].",";
			   }
			   if($count==20){
			   $delivery_time .=$data[$c].",";
			   }
			    if($count==21){
			 $dropship .=$data[$c].",";
			   }
		    if($count==22){
			 $shipping_method .=$data[$c].",";
			   }
			if($count==23){
			 $shipping_price .=$data[$c].",";
			   }
			   if($count==24){
			 $place_origin .=$data[$c].",";
			   }
			   if($count==25){
			 $package_weight .=$data[$c].",";
			   }
			   if($count==26){
			 $package_unit .=$data[$c].",";
			   }
			   if($count==27){
			 $description .=$data[$c].",";
			   }
			   if($count==28){
			 $product_seen .=$data[$c].",";
			   }
			   if($count==29){
			 $sku .=$data[$c].",";
			   }
			   if($count==30){
			   $length .=$data[$c].",";
			   }
              if($count==31){
			 $color .=$data[$c].",";
			   }
		    if($count==32){
			 $price .=$data[$c].",";
			   }
			if($count==33){
			 $stock .=$data[$c].",";
			   }
			   if($count==34){
			 $length_size .=$data[$c].",";
			   }
			   if($count==35){
			 $min_quantity .=$data[$c].",";
			   }

        }
										 			 								 				

		$product_code=rtrim($product_code,',');
        $user_id=rtrim($user_id,',');
		$supplier_code=rtrim($supplier_code,',');
		$category=rtrim($category,',');
		$subcategory=rtrim($subcategory,',');
		$sub_subcategory=rtrim($sub_subcategory,',');
		$product_name=rtrim($product_name,',');
		$images=rtrim($images,',');
		$hair_type_check=rtrim($hair_type_check,',');
		$hair_type_value=rtrim($hair_type_value,',');
		$quantity=rtrim($quantity,',');
		$quantity_type=rtrim($quantity_type,',');
		$manufacture_price=rtrim($manufacture_price,',');
		$wholesale_price=rtrim($wholesale_price,',');
		$msrp_price=rtrim($msrp_price,',');
		$discount_option_check=rtrim($discount_option_check,',');
		$discount_option_value=rtrim($discount_option_value,',');
		$special_promotion_check=rtrim($special_promotion_check,',');
		$special_promotion_value=rtrim($special_promotion_value,',');
		$delivery_time=rtrim($delivery_time,',');
		$dropship=rtrim($dropship,',');
		$shipping_method=rtrim($shipping_method,',');
		$shipping_price=rtrim($shipping_price,',');
		$place_origin=rtrim($place_origin,',');
		$package_weight=rtrim($package_weight,',');
		$package_unit=rtrim($package_unit,',');
		$description=rtrim($description,',');
		$product_seen=rtrim($product_seen,',');
		$sku=rtrim($sku,',');$user_id=rtrim($user_id,',');
		$length=rtrim($length,',');
		$color=rtrim($color,',');
		$price=rtrim($price,',');
		$stock=rtrim($stock,',');
		$length_size=rtrim($length_size,',');
		$min_quantity=rtrim($min_quantity,',');
	     
	    $product_code_info = mysql_num_rows(mysql_query("select product_code from product where product_code ='$product_code'"));
		
	     if($product_code_info>0)
		 {
			 
			  mysql_query("UPDATE `product` SET `product_code`='$product_code',`user_id`='$user_id',`supplier_code`='$supplier_code',`category`='$category',`subcategory`= '$subcategory',`sub_subcategory`= '$sub_subcategory',`product_name`= '$product_name',`images`= '$images',`hair_type_check`='$hair_type_check',`hair_type_value`='$hair_type_value',`quantity`='$quantity',
	         `quantity_type`='$quantity_type',`manufacture_price`='$manufacture_price',`wholesale_price`='$wholesale_price',`msrp_price`='$msrp_price',`discount_option_check`='$discount_option_check',`discount_option_value`='$discount_option_value',`special_promotion_check`= '$special_promotion_check',`special_promotion_value`='$special_promotion_value',`delivery_time`='$delivery_time',
																															                                                                                                                                                                         `dropship`='$dropship',`shipping_method`= '$shipping_method',`shipping_price`= '$shipping_price',`place_origin`='$place_origin',`package_weight`='$package_weight',`package_unit`='$package_unit',`description`= '$description',`product_seen`= '$product_seen',`sku`= '$sku',`length`='$length',`color`='$color',`price`='$price',`stock`='$stock',`length_size`='$length_size',`min_quantity`='min_quantity' WHERE `product_code` = '$product_code'");
		 }
	else
	{
	mysql_query("INSERT INTO `product`( `product_code`, `user_id`, `supplier_code`, `category`, `subcategory`, `sub_subcategory`,`product_name`, `images`, `hair_type_check`, `hair_type_value`, `quantity`, `quantity_type`, `manufacture_price`, `wholesale_price`,`msrp_price`, `discount_option_check`, `discount_option_value`, `special_promotion_check`, `special_promotion_value`,`delivery_time`, `dropship`, `shipping_method`, `shipping_price`, `place_origin`, `package_weight`, `package_unit`,`description`, `product_seen`, `sku`, `length`, `color`, `price`, `stock`, `length_size`, `min_quantity`) VALUES   ('$product_code','$user_id','$supplier_code','$category','$subcategory','$sub_subcategory','$product_name','$images','$hair_type_check','$hair_type_value','$quantity','$quantity_type','$manufacture_price','$wholesale_price','$msrp_price','$discount_option_check','$discount_option_value','$special_promotion_check','$special_promotion_value','$delivery_time','$dropship','$shipping_method','$shipping_price','$place_origin','$package_weight','$package_unit','$description','$product_seen','$sku','$length','$color','$price','$stock','$length_size','$min_quantity')");
  echo "INSERT INTO `product`( `product_code`, `user_id`, `supplier_code`, `category`, `subcategory`, `sub_subcategory`,`product_name`, `images`, `hair_type_check`, `hair_type_value`, `quantity`, `quantity_type`, `manufacture_price`, `wholesale_price`,`msrp_price`, `discount_option_check`, `discount_option_value`, `special_promotion_check`, `special_promotion_value`,`delivery_time`, `dropship`, `shipping_method`, `shipping_price`, `place_origin`, `package_weight`, `package_unit`,`description`, `product_seen`, `sku`, `length`, `color`, `price`, `stock`, `length_size`, `min_quantity`) VALUES   ('$product_code','$user_id','$supplier_code','$category','$subcategory','$sub_subcategory','$product_name','$images','$hair_type_check','$hair_type_value','$quantity','$quantity_type','$manufacture_price','$wholesale_price','$msrp_price','$discount_option_check','$discount_option_value','$special_promotion_check','$special_promotion_value','$delivery_time','$dropship','$shipping_method','$shipping_price','$place_origin','$package_weight','$package_unit','$description','$product_seen','$sku','$length','$color','$price','$stock','$length_size','$min_quantity') ";
	}
	}
    fclose($handle);
}
	
		
	}
	
	$admin_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `admin` where idx=1"));


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Bulk Upload</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />

<style type="text/css">
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}

table#t02 tr:nth-child(even) {
    background-color: #eee;
}
table#t02 tr:nth-child(odd) {
   background-color:#fff;
}

</style>



</head>



<body style="font-size:16px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><? include('header.php')?></td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="20%" valign="top"><? include('left_menu.php');?></td>

        <td width="60%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">
		      <tr>
			  <td><table width="100%" border="0" cellspacing="10" cellpadding="0">
			       <tr>
				       <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				    <tr>
               <td style="color:#CCC;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			        <tr>
                        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"
                          style="background-color:#CCC;">
						          <tr>
                                   <td align="left" style="color:#333; font-size:24px;">Bulk Product Upload</span></td>

                                   </tr>
                          </table></td>
                          

                     </tr>

                     <tr>

                           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                              <tr>

                                 <td colspan="7"></td>
                              
                       
                               </tr>

                              <tr>
                                 <td><table width="100%" id="t01" cellpadding="3" cellspacing="3" border="0" style="color:#333;">                         
                                   <form action="" method="post">
                                  <tr><th colspan="2" align="center">Bulk Product Upload</th></tr>
                                 <tr> <td>CSV File name<br /> 
          like  (sample.csv)</td><td><input type="text" name="csv_name_1" id="csv_name_1" value="<?=$csv_name?>" 
          style="width: 200px; padding-left: 2px; margin-left: 10px;" /> </td></tr>
          <input type="hidden" name="zip_name_1" id="zip_name_1" value="<?=$zip_name?>" />
          <input type="hidden" name="user_id_1" id="user_id_1" value="<?=$user_id?>" />
         <tr><td colspan="2" align="center"><input type="submit" value="Save Change" name="submit" /></td></tr>
                                </form>
                              </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                	<td colspan="2" align="left">
                                   <font size="+2"> <?php // echo leftpaging(); ?> </font>
                                    </td>
                                </tr>					
                               

                              </table></td>

                            </tr>

                          </table></td>

                          <td >&nbsp;</td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                       <td  align="left"></td>

                        </tr>

                      </table></td>

                    </tr>

                  </table></td>

                </tr>

                <tr>

                  <td>&nbsp;</td>

                </tr>

              </table>

           </td>

          </tr>

          <tr>

            <td>&nbsp;</td>

          </tr>

        </table></td>
       </tr>

   

  
  

  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>

