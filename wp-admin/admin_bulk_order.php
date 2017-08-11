<?php
session_start();
require_once('include/connectdb.php');
if($_SESSION["ADMIN_ID"]==""){	
header("location:login.php");		
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));

 $query=mysql_query("SELECT * FROM `product` order by id asc ");
*/ 
$member_id=$_GET['uid'];
    $wig_list=mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where supplier = 1 and member_id = '$member_id'"));
	$wig_list_query=mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where supplier = 1 order by member_id asc"));
	 if(isset($_FILES['csv']) && $_FILES['csv']!='' && isset($_FILES['zip']) && $_FILES['zip']!=''){
	   
	   mysql_query("delete from `product_csv_file`");
	 
	  $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
       if(in_array($_FILES['csv']['type'],$mimes)){
	
	   $file_csv=$_FILES['csv'];
  	   $name_csv=time().'_'.$file_csv['name'];
       move_uploaded_file($file_csv['tmp_name'],'bulk_csv/'.$name_csv);
}
      
      $mimes_zip = array('application/octet-stream','application/zip','application/x-zip-compressed');
      if(in_array($_FILES['zip']['type'],$mimes_zip)){
	    
	   $file_zip=$_FILES['zip'];
  	   $name_zip=time().'_'.$file_zip['name'];
       move_uploaded_file($file_zip['tmp_name'],'bulk_zip/'.$name_zip);
}

 //create a ZipArchive instance
         $zip = new ZipArchive;
         //open the archive
         if ($zip->open("bulk_zip/$name_zip") === TRUE) {
         //extract contents to /data/ folder
         $zip->extractTo('../product_img/');
         //close the archive
         $zip->close();

		 }

$row = 1;
if (($handle = fopen("bulk_csv/".$name_csv, "r")) !== FALSE) {
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
		$hair_type='';
		$hair_type_length='';
		$hair_type_style='';
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
		$color='';
		$price='';
		$stock='';
		$manufactureprice2="";
		$wholesaleprice2="";
		$regularprice2="";
		
		
		$length_size='';
		$min_quantity='';		

		$count=0;
        for ($c=0; $c < $num; $c++) {
           $count++;
		  //$query_val = "'$data[$c]',";
		  //echo $data[$c].'vimal<br>';
		  
		   if($count>39){
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
			 $hair_type .=$data[$c].",";
			   }
			   if($count==10){
			 $hair_type_length .=$data[$c].",";
			   }
		   if($count==11){
			 $hair_type_style .=$data[$c].",";
			   }
		   if($count==12){
			 $quantity .=$data[$c].",";
			   }
		    if($count==13){
			 $quantity_type .=$data[$c].",";
			   }
			if($count==14){
			 $manufacture_price .=$data[$c].",";
			   }
			   if($count==15){
			 $wholesale_price .=$data[$c].",";
			   }
			   if($count==16){
			 $msrp_price .=$data[$c].",";
			   }
			   if($count==17){
			 $discount_option_check .=$data[$c].",";
			   }
			   if($count==18){
			 $discount_option_value .=$data[$c].",";
			   }
			   if($count==19){
			 $special_promotion_check .=$data[$c].",";
			   }
			   if($count==20){
			 $special_promotion_value .=$data[$c].",";
			   }
			   if($count==21){
			   $delivery_time .=$data[$c].",";
			   }
			    if($count==22){
			 $dropship .=$data[$c].",";
			   }
		    if($count==23){
			 $shipping_method .=$data[$c].",";
			   }
			if($count==24){
			 $shipping_price .=$data[$c].",";
			   }
			   if($count==25){
			 $place_origin .=$data[$c].",";
			   }
			   if($count==26){
			 $package_weight .=$data[$c].",";
			   }
			   if($count==27){
			 $package_unit .=$data[$c].",";
			   }
			   if($count==28){
			 $description .=$data[$c].",";
			   }
			   if($count==29){
			 $product_seen .=$data[$c].",";
			   }
			   if($count==30){
			 $sku .=$data[$c].",";
			   }
			     if($count==31){
			   $length .=$data[$c].",";
			   }
			     if($count==32){
			  $color .=$data[$c].",";
			   }
			   if($count==33){
			 $price.=$data[$c].",";
			   }
			  if($count==34){
			 $stock .=$data[$c].",";
			   }
			   if($count==35){
				 $manufactureprice2 .=$data[$c].",";
			   
			   }
			 if($count==36){
				 $wholesaleprice2 .=$data[$c].",";
			   
			   }
			   if($count==37){
				 $regularprice2 .=$data[$c].",";
			   
			   }
			   
			   if($count==38){
			 $length_size .=$data[$c].",";
			   }
			   if($count==39){
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
		$hair_type=rtrim($hair_type,',');
		$hair_type_length=rtrim($hair_type_length,',');
		$hair_type_style=rtrim($hair_type_style,',');
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
		$sku=rtrim($sku,',');
		$user_id=rtrim($user_id,',');
		$length=rtrim($length,',');
		$color=rtrim($color,',');
		$price=rtrim($price,',');
		$stock=rtrim($stock,',');
		$manufactureprice2=rtrim($manufactureprice2,',');
		$wholesaleprice2=rtrim($wholesaleprice2,',');
		$regularprice2=rtrim($regularprice2,',');
		$length_size=rtrim($length_size,',');
		$min_quantity=rtrim($min_quantity,',');
		$csv_value = 1;
        
		
mysql_query("INSERT INTO `product_csv_file`(`product_code`, `user_id`, `supplier_code`, `category`, `subcategory`, `sub_subcategory`, `product_name`, `images`, `hair_type`, `hair_type_length`, `hair_type_style`, `quantity`, `quantity_type`, `manufacture_price`, `wholesale_price`, `msrp_price`, `discount_option_check`, `discount_option_value`, `special_promotion_check`, `special_promotion_value`, `delivery_time`, `dropship`, `shipping_method`, `shipping_price`, `place_origin`, `package_weight`, `package_unit`, `description`, `product_seen`, `sku`, `length`, `color`, `price`, `stock`, `length_size`, `min_quantity`, `csv_value`,`manufactureprice2`,`wholesaleprice2`,`regularprice2`) VALUES ('$product_code', '$user_id', '$supplier_code', '$category', '$subcategory', '$sub_subcategory', '$product_name', '$images', '$hair_type', '$hair_type_length', '$hair_type_style', '$quantity', '$quantity_type', '$manufacture_price', '$wholesale_price', '$msrp_price', '$discount_option_check', '$discount_option_value', '$special_promotion_check', '$special_promotion_value', '$delivery_time', '$dropship', '$shipping_method', '$shipping_price', '$place_origin', '$package_weight', '$package_unit', '$description', '$product_seen', '$sku', '$length', '$color', '$price', '$stock', '$length_size', '$min_quantity','$csv_value','$manufactureprice2','$wholesaleprice2','$regularprice2')");

																																																																																																																																																																																																																																																																																											}	}

	
	fclose($handle);
	
	$query = mysql_query("select `product_code`, `user_id`, `supplier_code`, `category`, `subcategory`, `sub_subcategory`, `product_name`, `images`, `hair_type`, `hair_type_length`, `hair_type_style`, `quantity`, `quantity_type`, `manufacture_price`, `wholesale_price`, `msrp_price`, `discount_option_check`, `discount_option_value`, `special_promotion_check`, `special_promotion_value`, `delivery_time`, `dropship`, `shipping_method`, `shipping_price`, `place_origin`, `package_weight`, `package_unit`, `description`, `product_seen`, 	    group_concat(sku separator ',') as sku ,
	group_concat(length separator ',') as length,
    group_concat(color separator ',') as color,
    group_concat(price separator ',') as price,
	group_concat(stock separator ',') as stock,
	group_concat(manufactureprice2 separator ',') as manufactureprice2,
	group_concat(wholesaleprice2 separator ',') as wholesaleprice2,
	group_concat(regularprice2 separator ',') as regularprice2,
	'$length_size', '$min_quantity','$csv_value'
	from `product_csv_file` where sku in (select distinct(sku) from `product_csv_file`) group by sku");
	
while($query_row = mysql_fetch_assoc($query))
	{
		$query_item = explode(',',$query_row['sku']);
		
		$query_products = mysql_fetch_assoc(mysql_query("select * from `product` where product_name = '$query_item[0]'"));
		
		if($query_products['product_name'] == $query_item[0])
		{
			
			mysql_query("UPDATE `product` SET `product_code`='$query_row[product_code]',`user_id`='$query_row[user_id]',`supplier_code`='$query_row[supplier_code]',`category`='$query_row[category]',`subcategory`='$query_row[sub]',`sub_subcategory`='$query_row[sub_subcategory]',`product_name`='$query_row[product_name]',`images`='$query_row[images]',`hair_type`='$query_row[hair_type]',`hair_type_length`='$query_row[hair_type_length]',`hair_type_style`='$query_row[hair_type_style]',`quantity`='$query_row[quantity]',`quantity_type`='$query_row[quantity_item]',`manufacture_price`='$query_row[manufacture_price]',`wholesale_price`='$query_row[wholesale_price]',`msrp_price`='$query_row[msrp_price]',`discount_option_check`= '$query_row[discount_option_check]',`discount_option_value`='$query_row[discount_option_value]',`special_promotion_check`='$query_row[special_promotion_check]',`special_promotion_value`='$query_row[special_promotion_value]',`delivery_time`='$query_row[delivery_time]',`dropship`='$query_row[dropship]',`shipping_method`='$query_row[shipping_method]',`shipping_price`='$query_row[shipping_price]',`place_origin`='$query_row[place_origin]',`package_weight`='$query_row[package_weight]',`package_unit`='$query_row[package_unit]',`description`='$query_row[description]',`product_seen`='$query_row[product_seen]',`sku`='$query_row[sku]',`length`='$query_row[length]',`color`='$query_row[color]',`price`='$query_row[price]',`stock`='$query_row[stock]',`length_size`='$query_row[length_size]',`min_quantity`='$query_row[min_quantity]',`csv_value`='1',manufactureprice2='$query_row[manufactureprice2]',wholesaleprice2='$query_row[wholesaleprice2]',regularprice2='$query_row[regularprice2]' WHERE user_id ='$member_id' and product_name = '$query_item[0]' and csv_value = 1 ");
			
			
			
				}
		else
		{
			
			
		
		mysql_query("INSERT INTO `product` (`product_code`, `user_id`, `supplier_code`, `category`, `subcategory`, `sub_subcategory`, `product_name`, `images`, `hair_type`, `hair_type_length`, `hair_type_style`, `quantity`, `quantity_type`, `manufacture_price`, `wholesale_price`, `msrp_price`, `discount_option_check`, `discount_option_value`, `special_promotion_check`, `special_promotion_value`, `delivery_time`, `dropship`, `shipping_method`, `shipping_price`, `place_origin`, `package_weight`, `package_unit`, `description`, `product_seen`, `sku`, `length`, `color`, `price`, `stock`, `length_size`, `min_quantity`, `csv_value`,`manufactureprice2`,`wholesaleprice2`,`regularprice2`) VALUES ('$query_row[product_code]', '$query_row[user_id]', '$query_row[supplier_code]', '$query_row[category]', '$query_row[subcategory]', '$query_row[sub_subcategory]', '$query_row[product_name]', '$query_row[images]', '$query_row[hair_type]', '$query_row[hair_type_length]', '$query_row[hair_type_style]', '$query_row[quantity]', '$query_row[quantity_type]', '$query_row[manufacture_price]', '$query_row[wholesale_price]', '$query_row[msrp_price]', '$query_row[discount_option_check]', '$query_row[discount_option_value]', '$query_row[special_promotion_check]', '$query_row[special_promotion_value]', '$query_row[delivery_time]', '$query_row[dropship]', '$query_row[shipping_method]', '$query_row[shipping_price]', '$query_row[place_origin]', '$query_row[package_weight]', '$query_row[package_unit]', '$query_row[description]', '$query_row[product_seen]', '$query_row[sku]', '$query_row[length]', '$query_row[color]', '$query_row[price]', '$query_row[stock]', '$query_row[length_size]', '$query_row[min_quantity]','1','$manufactureprice2','$wholesaleprice2','$regularprice2')");
		
		
		
		
		
		}
	}

	 }
	




 
 
 
 
 
 if(isset($_FILES['csv_3']) && $_FILES['csv_3']!=''){
	    
		mysql_query("delete FROM `stock_csv_file`");
		$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
       if(in_array($_FILES['csv_3']['type'],$mimes)){
	    $file_csv=$_FILES['csv_3'];
  	    $name_csv=time().'_'.$file_csv['name'];
        move_uploaded_file($file_csv['tmp_name'],'bulk_csv/'.$name_csv);
}
	 $row = 1;
if (($handle = fopen("bulk_csv/".$name_csv, "r")) !== FALSE) {
	fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
	 
	    $row++;
	    
		$item='';
		$length='';
		$color='';
		$type='';
		$price='';
		$stock='';
		$mprice='';
		$wprice='';
		$rprice='';
		$pro_id='';
		$agentprice='';

	  $count=0;
        for ($c=0; $c < $num; $c++) {
        $count++;
		  //$query_val = "'$data[$c]',";
		  //echo $data[$c].'vimal<br>';
		  
		   
		     if($count>12){
		   $count=0;
		   }
		     if($count==1){
			 $pro_id =$data[$c];
			   }
			   
		     if($count==2){
			  $product_code .=$data[$c].",";
			   }
		     if($count==3){
			  $item .=$data[$c].",";
			   }
		    if($count==4){
			 $length .=$data[$c].",";
			   }
			if($count==5){
			 $color .=$data[$c].",";
			   }
			   if($count==6){
			 $type .=$data[$c].",";
			   }
			   if($count==7){
			 $price .=$data[$c].",";
			   }
			   if($count==8){
			 $stock .=$data[$c].",";
			   }
			   if($count==9){
			 $mprice .=$data[$c].",";
			   }
			   if($count==10){
			 $wprice .=$data[$c].",";
			   }
			   if($count==11){
			 $rprice .=$data[$c].",";
			// echo "dhirendra";
			   }
			    if($count==12){
				//echo "dhirendra";
			 $agentprice .=$data[$c].",";
			   }
			   
			   
		}
		 
		
		$item=rtrim($item,',');
		$length=rtrim($length,',');
		$color=rtrim($color,',');
		$type=rtrim($type,',');
		$price=rtrim($price,',');
		$stock=rtrim($stock,',');
		$mprice=rtrim($mprice,',');
		$wprice=rtrim($wprice,',');
		$rprice=rtrim($rprice,',');
		$agent_price=rtrim($agentprice,',');
		
		//echo "$agent_price";
		
		
		mysql_query("INSERT INTO `stock_csv_file`(`user_id`,`item`, `length`, `color`, `type`, `price`, `stock`,`mprice`,`wprice`,`rprice`,`pro_id`,`agentprice`) VALUES                      ('$member_id','$item','$length','$color','$type','$price','$stock','$mprice','$wprice','$rprice','$pro_id','$agent_price')");
		
	
		// echo"select group_concat(item separator ', ') as item ,group_concat(color separator ', ') as color from `stock_csv_file` where item in (select distinct(item) from `stock_csv_file` where user_id = '$member_id' ) group by item";
	 
	}
	}
	fclose($handle);
	
	$querystock = mysql_query("select pro_id, group_concat(item separator ',') as item ,
	group_concat(length separator ',') as length,
    group_concat(color separator ',') as color,
    group_concat(type separator ',') as type,
    group_concat(price separator ',') as price,
	group_concat(stock separator ',') as stock,
	group_concat(mprice separator ',') as mprice,
	group_concat(wprice separator ',') as wprice,
	group_concat(rprice separator ',') as rprice,
	group_concat(agentprice separator ',') as agentprice
	from `stock_csv_file` where pro_id in (select distinct(pro_id) from `stock_csv_file` where user_id = '$member_id' ) group by pro_id");
	
	
	while($query_row = mysql_fetch_assoc($querystock))
	{
		
		
	echo "dhirendra- $query_row[agentprice]";
		
		
		//$query_item = explode(',',$query_row['item']);
		mysql_query("update `product` set `sku` = '$query_row[item]', `length` = '$query_row[length]', `color` = '$query_row[color]',`length_size`='$query_row[type]',
		 `price`= '$query_row[price]', `stock`= '$query_row[stock]',`manufactureprice2`='$query_row[mprice]',`wholesaleprice2`='$query_row[wprice]',`regularprice2`='$query_row[rprice]',`agent_price`='$query_row[agentprice]' where id = '$query_row[pro_id]'");
		
		
	}
	
	 }
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin Bulk Order</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />




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

        <td width="80%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">

          
          <tr>

            <td>

              <table width="100%" border="0" cellspacing="10" cellpadding="0">

                <tr>

                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td class="lite-blue-bx"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td width="1%" ><img src="image/lft-menu-hd-corner-1.png" width="10" height="35" /></td>

                          <td width="99%" class="blue-bx-topmid-bg" ><table width="100%" border="0" cellspacing="5" cellpadding="0">

                            <tr>

                              <td align="left" class="white-18">Bulk order</td>

                            </tr>

                          </table></td>

                          <td width="0%" ><img src="image/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="4"></td>
                              
                       
                            </tr>

                      <tr>
                     <td><table width="100%" cellpadding="3" cellspacing="3">
<!-- code here -->




<tr>
<td colspan="2" style="text-align: right;">
<a href ="export_excel_bulk_product.php">Click here for Sample Bulk upload File</a>
</td>
</tr>


<tr>
<th colspan="2">
Add/Edit Product (in Bulk)
</th>

</tr>

<form method="post" action="" enctype="multipart/form-data" onSubmit="return validate()">
<tr>
<td>Upload Files </td>
<td><input type="file" name="csv" id="csv" style="display:inline-block;"></td>
</tr>

<tr>
<td>Upload Product Pictures
</td>
<td><input type="file" name="zip" id="zip" style="display:inline-block;" >
</td>
</tr>

<tr>
<td colspan="2">
<input  type="submit" name="submit" value="Add/Edit Products" class="red-btn" onclick="return confirm('You want edit product')"  style="background:#17B4BB; font-size:1.3em; width:9em; margin-left: 357px; margin-top: 20px;">
</td>

</tr>
</form>
 
 <tr>
<td colspan="2">
<hr />
</td>
</tr>





<tr>
<th colspan="2">
Add/Edit Stock (in Bulk)
</th>

</tr>

<tr>
<td colspan="2" style="text-align: right;">
<a href ="export_excel_bulk_stock.php?member_id=<?= $member_id ?>">Click here for Sample stock upload File</a>
</td>
</tr>


<form method="post" action="" enctype="multipart/form-data" onSubmit="">
<tr>
<td>Upload Files </td>
<td><input type="file" name="csv_3" id="csv_3" style="display:inline-block;"></td>
</tr>


<tr>
<td colspan="2">
<input  type="submit" name="submit" value="Add/Edit Stock" class="red-btn" onclick="return confirm('You want edit product')"  style="background:#17B4BB; font-size:1.3em; width:9em; margin-left: 357px; margin-top: 20px;">
</td>

</tr>
</form>


 <tr>
<td colspan="2">
<hr />
</td>
</tr>

 <tr>
<td colspan="2">
<span style="color:#F00;">Note *-</span>
<span>Your USER ID =></span><span style="color:#F00;"><?= $member_id ?></span>,
<span>Your SUPPLIER CODE =></span><span style="color:#F00;"><?=  $wig_list['email'] ?></span>,
<span> <a href="category_list.csv">CLICK HERE FOR VIEW CATEGORY LIST </a></span>



</td>
</tr>



</tr>
</form>


                      </table>
                      </td>
                      </tr>
                                        
                          


                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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

   </td>

  </tr>
  

  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>

