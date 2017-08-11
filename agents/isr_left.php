 <!-- ############ LAYOUT START-->
 <?
 $mem_id=$_SESSION['ISR_ID'];
 $resultpopupleft=mysql_query("select * from member where ISR=$mem_id");
 ?>
 <style type="text/css">
   .overlay-mask{background:none repeat scroll 0 0 rgba(28, 45, 50, 0.8);bottom:0;height:100%;left:0;position:fixed;right:0;top:0;width:100%;z-index:999999;display:none;overflow-y:auto;overflow-x:hidden;}
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:23%;}
.overlay{background:none repeat scroll 0 0 #fff;border-radius:3px;box-shadow:0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);box-sizing:border-box;margin:50px auto 0;padding:30px;position:relative;}
.overlay.iframe-content .title{border:medium none;margin:0;position:absolute;}
.overlay .title{border-bottom:1px solid #e2e8ea;margin-bottom:20px;}
.overlay .close-icon{font:32px Dingbatz;color:#b3c5d0;content:"?";display:block;font:bold 20px "Dingbatz";position:absolute;right:0;}
.overlay.iframe-content .close-icon{background:none repeat scroll 0 0 #000;border-radius:32px;color:white;height:32px;opacity:1;position:absolute;right:-2em;top:-2em;width:32px;}
.overlay .close-icon{cursor:pointer;float:right;}
@media screen and (max-width: 540px) {

.overlay-mask{background:none repeat scroll 0 0 rgba(28, 45, 50, 0.8);bottom:0;height:100%;left:0;position:fixed;right:0;top:0;width:100%;z-index:999999;display:none;overflow-y:auto;overflow-x:hidden;}
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:255px;}
.overlay{background:none repeat scroll 0 0 #fff;border-radius:3px;box-shadow:0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);box-sizing:border-box;margin:50px auto 0;padding:30px;position:relative; margin-left:10px}
.overlay.iframe-content .title{border:medium none;margin:0;position:absolute;}
.overlay .title{border-bottom:1px solid #e2e8ea;margin-bottom:20px;}
.overlay .close-icon{font:32px Dingbatz;color:#b3c5d0;content:"?";display:block;font:bold 20px "Dingbatz";position:absolute;right:0;}
.overlay.iframe-content .close-icon{background:none repeat scroll 0 0 #000;border-radius:32px;color:white;height:32px;opacity:1;position:absolute;right:-2em;top:-2em;width:32px;}
.overlay .close-icon{cursor:pointer;float:right;}

}

</style>

 <script type="text/javascript">
  function show(){$("#overlay-mask-1").fadeIn('slow');}
  
  function subpopup(){
  $("#pop_form").submit();
 
  }
  
  function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
 window.location = 'https://ebhahair.com/isr/dashboard.php';
}
  </script>


  <!-- aside -->
   <div id="aside" class="app-aside fade nav-dropdown black folded">
    <!-- fluid app aside -->
    <div class="navside dk" data-layout="column">
      <div class="navbar no-radius">
        <!-- brand -->      
        <a href="index.html" class="navbar-brand">
        	<div data-ui-include="'images/EBHA_LOGO_S.png'"></div>
        	<img src="images/EBHA_LOGO_S.png" alt=".">
        	        </a>
        <!-- / brand -->
      </div>
      <div>
           <nav class="scroll nav-stacked nav-stacked-rounded nav-color">
            
            <ul class="navside" data-ui-nav>
              <li class="nav-header hidden-folded">
                <span class="text-xs">Main</span>
              </li>
              <li>
                <a href="dashboard.php" class="b-danger">
                  <span class="nav-icon text-white no-fade">
                    <i class="ion-filing"></i>
                  </span>
                  <span class="nav-text">Dashboard</span>
                </a>
              </li>
               <li>
                <a href="myteam.php" class="b-danger">
                  <span class="nav-icon text-white no-fade">
                    <i class="ion-filing"></i>
                  </span>
                 <span class="nav-text"><b><font size="+1" color="white">My&nbsp;Team</font></b></span>
                </a>
              </li>
              
              <li>
                <a href="commition_statement.php" class="b-danger">
                  <span class="nav-icon text-white no-fade">
                    <i class="ion-filing"></i>
                  </span>
                 <span class="nav-text">Commission</font></span>
                </a>
              </li>
              
              <li>
                <a onClick="show()" class="b-success">
                  <span class="nav-icon text-white no-fade">
                    <i class="fa-tags"></i>
                  </span>
                  <span class="nav-text">INVENTORY</span>
                </a>
              </li>
                                         <li>
                <a href="https://ebhahair.com/agent_register.php" target="_blank" >
                  <span class="nav-icon">
                    <i class="ion-person"></i>
                  </span>
                  <span class="nav-text">Add&nbsp;an&nbsp;Agent</span>
                </a>
              </li>
                 <li>
                <a href="order-list.php" class="b-default">
                  <span class="nav-icon">
                    <i class="ion-person"></i>
                  </span>
                  <span class="nav-text">ORDER&nbsp;LIST</span>
                </a>
              </li>
			               <li>
                <a href="https://ebhahair.com" target="_parent" >
                  <span class="nav-icon">
                    <i class="ion-person"></i>
                  </span>
                  <span class="nav-text"><b><font size="+1" color="white"> SHOP</font></b></span>
                </a>
              </li>
                      </nav>
      </div>
      <div data-flex-no-shrink>
        <div class="nav-fold dropup">
          <a data-toggle="dropdown">
              <div class="pull-left">
                <div class="inline"><a href="http://ebhahair.com/isr/inventory.php"><span class="avatar w-40 grey">Agent</span></a></div>
                <img src="images/a0.jpg" alt="..." class="w-40 img-circle hide">
              </div>
              <div class="clear hidden-folded p-x" style="overflow:hidden;">
                <a href="http://ebhahair.com/isr/inventory.php"><span class="block _500 text-muted">ISR ONLY</span></a>
                <div class="progress-xxs m-y-sm lt progress" style="overflow:hidden;">
                    <div class="progress-bar info">
                    </div>
                </div>
              </div>
          </a></div>
      </div>
    </div>
  </div>
  <!-- / -->
  
  <!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content" style="height:200px;">
  <a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content" style="float:left; "> 
      <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="pop_form" action="./inventory.php" method="post"   autocomplete="on"  id="pop_form">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"></div>
  
   
     <h3 class="h3">Select Buyer</h3>
     <select style="width:250px; height:30px; background:#999999; border:1px solid #000000" name="user">
     <? while($userrowpopupleft=mysql_fetch_array($resultpopupleft)){ ?>
     <option value="<?=$userrowpopupleft['member_id']?>"><?=$userrowpopupleft['f_name']?>&nbsp;<?=$userrowpopupleft['l_name']?> &nbsp;( <?=$userrowpopupleft['i_am']?>) </option>
	 <? } ?>
     </select>
     <div class="full" style="color:#999999; margin-top:1em;">
     
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group">
   
   
   
   
   </div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
  
   
   
   <div class="" style="margin-top:2em;">
   
   <div style=" text-align:center width:100%">
   <div style="margin-bottom:10px;">
   <button type="button"  class="blue-btn glyphicon " onClick="subpopup()" style="background:#268BB9; color:#FFF; width:85%; height:35px;">
   <span class="" style="font-family:sans-serif;" > INVENTORIES</span>
   </button>
   </div>
   <div>
       
       <a href="./add-buyer.php"><button type="button"  class="blue-btn glyphicon "  style="background:#268BB9; color:#FFF; width: 85%;height:35px;">
      <span class="" style="font-family:sans-serif;" >ADD BUYER</span>
      </button></a>
  </div>
  
   </div>
   
 
   
   </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   
     
  </div>
    </div>
  
    
    </div>
<!-- login popup end -->