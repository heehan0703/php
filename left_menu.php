<?
/*************************************************
    admin left sub-menu 

	   profile	
	   supplier	
	   buyer	
	   products
	   order
	   blog
**************************************************/
session_start();
if(isset($_GET['tab'])){
$tab=mysql_real_escape_string($_GET['tab']);
$_SESSION['tab_menu']=$tab;
}
$tab_menu=$_SESSION['tab_menu'];

?>
<html>
<head>
<body>
<table width="235" border="0" cellspacing="10" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="235" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="lite-blue-bx"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="left-menu-hd-bg"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td align="left" class="white-18">Sidebar menu</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><div id="left-menu">
                    <? if($tab_menu=='profile'){?>
<ul>
  <li><a href="id_setting.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Setting</a></li>
  <li><a href="sns_setting.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; SNS Setting</a></li>
  <li><a href="payment_setting.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Payment Setting</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Shipping Setting</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Tax Setting</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;E-mail Marketing</a></li>
   <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Make Coupon</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Send Coupon</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Newsletters List</a></li>
    <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Send Coupon</a></li>
  <li><a href="message_list.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Message List</a></li>
   <li><a href="message_outgoing.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Message Sent</a></li>
   <li><a href="message_compose.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Message Compose</a></li>
</ul>
                    <? } ?>
                    
                    
               <? if($tab_menu=='supplier'){?>
<ul>
  <li><a href="supplier_member_list.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;List</a></li>
  <li><a href="supplier_product_list"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; Authorize</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Payment</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Order</a></li>
 
</ul>
                    <? } ?>
 
  <? if($tab_menu=='buyer'){?>
<ul>
  <li><a href="register_member_list.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;List</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; Authorize</a></li>
  <li><a href="buyer_order_list_total.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Order</a></li>
 
</ul>
                    <? } ?>                   
 
  <? if($tab_menu=='products'){?>
<ul>
  <li><a href="product_list.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;List</a></li>
  <li><a href="product_list_add"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; Add Product</a></li>
  <!--<li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; Order Production List</a></li>-->
  <li><a href="list_by_supplier.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;List By Supplier</a></li>
  <li><a href="bulk_order_supplier_details.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Bulk Order Details</a></li>
   <li><a href="bulk_product_upload.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;
   Bulk Upload By CSV</a></li>
 
</ul>
                    <? } ?>             
  <? if($tab_menu=='orders'){?>
<ul>
  <li><a href="buyer_order_list_total.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Order List</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; Shipping</a></li>
 
</ul>
                    <? } ?>
 
  <? if($tab_menu=='blog'){?>
<ul>
  <li><a href="page_management.php"><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Notice</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp; Product Review</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Gallery</a></li>
  <li><a href=""><img src="images/lite-blue-arrow.png" width="4" height="6" /> &nbsp;&nbsp;Beauty News</a></li>
 
</ul>
                    <? } ?>           </div></td>
                          </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="235" border="0" cellspacing="0" cellpadding="0">
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
