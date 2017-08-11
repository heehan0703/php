<?php

session_start();

require_once('include/connectdb.php');


$member_id=$_GET['member_id'];


if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	

// Clear any previous output
ob_end_clean();

//$result = mysql_query("SELECT member_id,CONCAT(f_name,' ',l_name) as fullname,email,registered_date,i_am,status FROM `member` where supplier = 0 order by member_id asc"); 
/*$result = mysql_query("SELECT  `product`.`id`,`product`.`product_code`,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.sku, ',', numbers.n), ',', -1) item,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.length, ',', numbers.n), ',', -1) length,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.color, ',', numbers.n), ',', -1) color,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.length_size, ',', numbers.n), ',', -1) type,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.price, ',', numbers.n), ',', -1) price,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.stock, ',', numbers.n), ',', -1) stock,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.manufactureprice2, ',', numbers.n), ',', -1) mprice,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.wholesaleprice2, ',', numbers.n), ',', -1) wprice,
 SUBSTRING_INDEX(SUBSTRING_INDEX(product.regularprice2, ',', numbers.n), ',', -1) rprice
 FROM numbers INNER JOIN product ON CHAR_LENGTH(product.sku) -CHAR_LENGTH(REPLACE(product.sku, ',', ''))>=numbers.n-1
  ORDER BY id, n"); */
 
 $previousid="";
 
 $result = mysql_query("SELECT  id ,product_code,sku,length,color,length_size as type,price,stock,manufactureprice2 as manufactureprice,wholesaleprice2 as wholesaleprice,regularprice2 as regularprice,agent_price from product");
 

 

	 
// I assume you already have your $result
$num_fields = mysql_num_fields($result);

  $num_fields;
// Fetch MySQL result headers
$headers = array();
//$headers[] = "[Row]";
for ($i = 0; $i <= $num_fields; $i++) {
	//echo "dhirendra";
    $headers[] = strtoupper(mysql_field_name($result , $i));

}

// Filename with current date
$current_date = date("y/m/d");
$filename = "ebhahair" . $current_date . ".csv";

// Open php output stream and write headers
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Pragma: no-cache');
    header('Expires: 0');
   // echo "Beautco User List\n\n";
    // Write mysql headers to csv
    fputcsv($fp, $headers);
   // $row_tally = 0;
    // Write mysql rows to csv
	
	//$row_new=array();


    while ($row = mysql_fetch_array($result)) {
    //$row_tally = $row_tally + 1;
    //echo "$row[8]  <br>";
	//$stock .=$row[3].",";
	//echo $row[3];
	
	
	$row_new['stock']=$row[3];
	$id=$row[0];
	$product_code=$row[1];
    $sku	= explode(",",$row[2]);
	$length=explode(",",$row[3]);
	
	
	
	
	$color=explode(",",$row[4]);
	$length_size=explode(",",$row[5]);
	$price=explode(",",$row[6]);
	$stock=explode(",",$row[7]);
	$manufactureprice2=explode(",",$row[8]);
	$wholesaleprice2=explode(",",$row[9]);
	$regularprice=explode(",",$row[10]);
	$agentprice=explode(",",$row[11]);
	
	$lengthcount=count($sku);
	 for($i=0;$i<$lengthcount;$i++)
	 {
	 
	  $data['id']=$id;
	  $data['product_code']=$product_code;
	  $data['sku']=$sku[$i];
	  $data['length']=$length[$i];
	  
	  
	  $data['color']=$color[$i];
	  $data['length_size']=$length_size[$i];
	  $data['price']=$price[$i];
	  $data['stock']=$stock[$i];
	  $data['manufactureprice2']=$manufactureprice2[$i];
	  $data['wholesaleprice2']=$wholesaleprice2[$i];
	 
	  $data['regularprice']=$regularprice[$i];
	  $data['agentprice']=$agentprice[$i];
	  
	   fputcsv($fp, array_values($data));
	  
	   }
	
	
	//print_r($row_new);
       // fputcsv($fp, array_values($row));
    }
   die;
}


/*
/*$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
/*$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
  $result = mysql_query("SELECT * FROM `member` where supplier = 0 order by member_id asc"); 
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>

       <?php
$filename = "Webinfopen.xls"; // File Name
// Download file
 
	
	$wig_list_query=mysql_query("SELECT * FROM `member` where supplier = 0 order by member_id asc"); 
	$flag = false;
			while($wig_list_row=mysql_fetch_assoc($wig_list_query))
			 {
			  
			

    if (!$flag) {
        // display field/column names as first row
         implode("\t", array_keys($wig_list_row)) . "\r\n";
        $flag = true;
    }
    implode("\t", array_values($wig_list_row)) . "\r\n";

			 }
			 
			 header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");	*/


?>   
    
  