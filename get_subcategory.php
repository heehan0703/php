<?php
require_once('wp-admin/include/connectdb.php');
 
if(isset($_REQUEST['level']) && $_GET['level']==1){

$cat_name=$_GET['cat_name'];

$cat_id=mysql_result(mysql_query("select id from `category` where category_name='$cat_name'"),0);

$sub_cat=mysql_query("SELECT * FROM `subcategory` where cat_id='$cat_id'");

$count=mysql_num_rows($sub_cat);

if($count>0){

echo '<option value="">Select Option</option> ';
	  while ($sub_cat_row = mysql_fetch_assoc($sub_cat)) {
	?>	
	<option value="<?=$sub_cat_row['name']?>"><?=$sub_cat_row['name']?></option>
	
	<?php } 
	
}

}

  
 
  
  if(isset($_REQUEST['level']) && $_GET['level']==2){

$sub_name=$_GET['sub_name'];

$subcat_row=mysql_fetch_assoc(mysql_query("select * from subcategory where name='$sub_name'"));

$sub_subcat=mysql_query("SELECT * FROM sub_subcategory where cat_id='$subcat_row[cat_id]' and sub_cat_id='$subcat_row[id]'");

$count=mysql_num_rows($sub_subcat);

if($count>0){

  echo '<option value="">Select Option</option> ';
	  while ($sub_subcat_row = mysql_fetch_assoc($sub_subcat)) {
	?>	
	<option value="<?=$sub_subcat_row['name']?>"><?=$sub_subcat_row['name']?></option>
	
	<?php } 
	
}

}

  
  ?>