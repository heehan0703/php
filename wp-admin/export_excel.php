<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	

// Clear any previous output
ob_end_clean();

//$result = mysql_query("SELECT member_id,CONCAT(f_name,' ',l_name) as fullname,email,registered_date,i_am,status FROM `member` where supplier = 0 order by member_id asc"); 
$result = mysql_query("SELECT member_id,CONCAT(f_name,' ',l_name) as fullname,email,DATE_FORMAT(FROM_UNIXTIME(`registered_date`), '%d-%m-%Y') AS 'Registered',i_am,CASE status WHEN '1' THEN 'Active' WHEN '0' THEN 'Inactive' ELSE NULL END as 'status' FROM `member` where supplier = 0 order by member_id asc ");

// I assume you already have your $result
$num_fields = mysql_num_fields($result);

// Fetch MySQL result headers
$headers = array();
$headers[] = "[Row]";
for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = strtoupper(mysql_field_name($result , $i));
}

// Filename with current date
$current_date = date("y/m/d");
$filename = "beautco" . $current_date . ".csv";

// Open php output stream and write headers
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Pragma: no-cache');
    header('Expires: 0');
    echo "Beautco User List\n\n";
    // Write mysql headers to csv
    fputcsv($fp, $headers);
    $row_tally = 0;
    // Write mysql rows to csv
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $row_tally = $row_tally + 1;
    echo $row_tally.",";
        fputcsv($fp, array_values($row));
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
    
  