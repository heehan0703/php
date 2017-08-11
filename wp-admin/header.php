<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" height="100"><a href="/wp-admin/"> <font size="+4" color="#FFFFFF"><img src="images/logo_admin.png"  /> </font></a></td>
        <td width="80%" align="left"><table width="100%" border="0" cellspacing="5" cellpadding="0" align="left" 
        style="font-size:13px; color:#484848; font-weight:bold;">
          <tr>
            <td  class="">Welcome <?=$_SESSION['ADMIN_NAME'];?></td>
          </tr>
          <tr>
            <td  class=""><a href="#" class="" style="color:#484848;">My Account</a> &nbsp; |&nbsp; <a href="logout.php"
          style="color:#484848;"   class="">Logout</a></td>
          </tr>
           <tr>
            <td class="">Time:<? 
			   $date = date_default_timezone_set('Asia/Kolkata');

echo date(" h:i:s a", time());

			//=date("g:i A");?><br />
               </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
 
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="menu-br"><table align="center" width="60%" border="0" cellspacing="0" cellpadding="0" style="color:#FFF; font-size:16px;">
              <tr>
              
               <td align="center"  valign="middle" style="width:auto;">
           <a href="?tab=profile" style="color:#fff;" >  Profile </a></td>
            <td width="5">|</td>
             <td align="center" valign="middle" style="width:auto;">
              <a href="supplier_member_list.php?tab=supplier" style="color:#fff;">  Supplier  </a></td>
            <td width="5">|</td>
             <td align="center" valign="middle" style="width:auto;">
             <a href="register_member_list.php?tab=buyer" style="color:#fff;">  Buyer </a></td>
            <td width="5">|</td>
             <td align="center" valign="middle" style="width:auto;">
             <a href="product_list.php?tab=products" style="color:#fff;">  Products </a></td>
            <td width="5">|</td>
             <td align="center" valign="middle" style="width:auto;">
        <a href="buyer_order_list_total.php?tab=orders" style="color:#fff;">    Orders</a></td>
            <td width="5">|</td>
             <td align="center" valign="middle" style="width:auto;">
             <a href="page_management.php?tab=blog" style="color:#fff;">  Blog </a></td>
            <td width="5"></td>
             <td width="5">|</td>
               <td align="center" valign="middle" style="width:auto;">
             <a href="admin_bulk_order.php?tab=bulk" style="color:#fff;">  BULK </a></td>
            <td width="5"></td>
             <td width="5">|</td>
              <td align="center" valign="middle" style="width:auto;">
                   <a href="category_manage.php?tab=category" style="color:#fff;"> category manage </a></td>
            <td width="5"></td> 
             <td width="5">|</td>
              <td align="center" valign="middle" style="width:auto;">
                   <a href="newsletter.php?tab=newsletter" style="color:#fff;"> Newsletter </a></td>
            <td width="5"></td>  
             <td width="5">|</td>
              <td align="center" valign="middle" style="width:auto;">
                   <a href="store.php?tab=store" style="color:#fff;"> Store </a></td>
            <td width="5"></td> 
            <td width="5">|</td>
              <td align="center" valign="middle" style="width:auto;">
                   <a href="managecoupon.php" style="color:#fff;"> Coupon </a></td>
              <td width="5">|</td>
              <td align="center" valign="middle" style="width:auto;">
                   <a href="notice.php" style="color:#fff;"> Notice </a></td> 
                   
                 <td width="5">|</td>
              <td align="center" valign="middle" style="width:auto;">
                   <a href="agents.php" style="color:#fff;"> Agent </a></td>        
            <td width="5"></td>     
                <!--<td width="11%" align="left"><img src="images/icon-6.png" width="16" height="14" />&nbsp;&nbsp;<a href="search_options.php" class="white-12">Search Student Accounts</a></td>-->
               
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
