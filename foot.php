<?php  
require_once('wp-admin/include/connectdb.php');
 $fname = $_POST['fname'];

$lname = $_POST['lname'];

$email =  $_POST['email'];

$state = $_POST['state'];
if(isset($_POST['submitted'])){
	   $sql = "INSERT INTO newsletter (fname, lname, email, state) VALUES ('$fname', '$lname', '$email', '$state')";

mysql_query($sql);
}
?><head>
<style type="text/css">
.font{
	color:#FFF; font-size:x-large;}
	
.containe{
  width: auto;
  max-width: 100%;
  background-image:url(../images/newfooter-compressor.png);
  background-repeat:no-repeat !important;
}

.search{
		width:250px;
		
}

.downlogo{
display:none;
}
 @media (max-width:800px) {
 .option{

width:130px;
}
.search{
width:130px;
}	
.downlogo{
			display:inherit;
			width:150px; 
			margin-left:0px;
			margin-top:10px;
			
			}
			.footer{
				display:none;
				
				}
				.font{
				color:#FFF; 
	            font-size:large;}
			 }
	@media (max-width:500px){
		
		.downlogo{
			display:inherit;
			width:150px; 
			margin-left:0px;
			margin-top:10px;
			
			}
			
.option{

width:100px;
}
.search{
width:100px;
}			
	
.font{
	color:#FFF; font-size:large;}
	

		.subsimag{
			width: 120px; 
			 margin-left: 157px;
			}
.footer{
display:none;
				
}
.form-inline{margin-left: 13px;}
	.mar{
	margin-left:10%;
	width:200px;height:75px; vertical-align:middle;text-align:center;}			
				
				
		}
		.mar{
	margin-left:10%;
	width:400px;
	height:75px; 
	vertical-align:middle;text-align:center;}	
	@media (min-width: 1024px) {
 .containe{width:1200px;}
 .news{width:1200px;}
 #kari {width:1200px;background-color:#D8D8D8; text-align:center height:100px; vertical-align:middle}
 .footer{
 width:1200px;}
  }


</style>
</head>

<? $cat_query=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc"); ?> 
<div align="center">

<div id="kari" >
 <center>
  <div  class="mar"><center>
        <div style="height:20px">&nbsp;</div>
          <form class="form-inline" role="form" action="search_result.php">
          
            <div class="form-group" style="float:left;" >
             	<select class="form-control option"  name="search_cat">
<option value="state" style="font-size:9px">All category</option>
<?php while($cat_row=mysql_fetch_assoc($cat_query)){ ?>
           <option value="<?=$cat_row['category_name']?>"><?=$cat_row['category_name']?></option>  
           <? } ?> 
</select>
            </div>
            <div class="form-group"  style="float:left;" >
              <input type="text" class="form-control search"  placeholder="search" name="search_text" />
            </div>
             <div class="form-group"  style="float:left;" >
               <button style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); padding-left: 6px;  height: 31px;" type="submit" class="button1"> Search</button>
            </div>
           
          </form>
          <div style="height:20px">&nbsp;</div>
          </center>
          </div>
       
        </center>
        
        
</div>

</div>


<!--start footer middle -->
<div align="center">
<div class="containe" >
        <div class="row" >
              <div class="col-md-2">
              </div>
              <div class="col-md-6">
             
              <h2 style="color:#FFF;" class="font">Contact&nbsp;Us</h2>
                       <form method="post">
         
           <div class="col-md-6 col-xs-6" style="padding-bottom: 10px; padding-left: 0px; padding-right: 10px;">
          
	<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control" placeholder="First name"  name="fname" type="text">
											</div>
           </div>
            <div class="col-md-6 col-xs-6" style="padding-bottom: 10px; padding-left: 0px; padding-right: 0px;">
            	<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input class="form-control" placeholder="Last name"  name="lname" type="text" >
											</div>
            </div>
            
           <div class="form-group"> 	<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-envelope"></i>
												</span> 
												<input class="form-control" placeholder="Email" name="email" type="text" >
											</div></div>
             <div class="form-group">

<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-tint"></i>
												</span> 
                                                <input class="form-control" placeholder="Short message" name="state" type="text" >
												
											</div>

</div>

       <div class="form-group" align="right"><input name="submitted" type="hidden" value="true" /> <input type="image" class="subsimag" src="images/subs-compressor.png" 
       name="submits" /></div>
                   </form>
                
              </div>
              <div class="col-md-2"><br><br>
               <h2 class="font">EBHA</h2>
              <p> 
								<br />
								<i class="glyphicon glyphicon-envelope"  style="color:white"></i>&nbsp;<a style="color:#FFF" href="mailto:info@EBHAhair.com">info@EBHAhair.com</a> <br />
                                
    				</p>		
              </div>
              <div class="col-md-2">
              </div>
           
            </div>
            
            <div class="row footer" style="background-color:#FFF;">
            <div class="col-md-2" style="padding-left: 0px;"> <img src="images/footer-left-compressor.png"  style="width:61px; float:left;"/></div>
<div class="col-md-5"><a href="https://fahair.com" title="fahair"><img src="images/footer-logo-compressor.png"   style="width: 263px; float:left;" alt="EBHAhair"/></a></div>
<div class="col-md-3"><img src="images/footer-text-compressor.png"  style="width: 245px;" alt="2016 fa fashion all rights reserved"/></div>
<div class="col-md-2" style="padding-right: 0px;"> <img src="images/footer-right-compressor.png"  style="width: 61px; float: right;"/></div>
         
        </div>
            
 </div>  
<div class="col-xs-12 col-md-12 col-sm-12">
    <img src="images/logo1-compressor.png"  class="downlogo" alt="fa hair"/>
    
    </div>
  </div>   
<!-- End footer middle -->




