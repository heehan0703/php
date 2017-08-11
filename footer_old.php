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
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet">

<style>
/* Footer styles
-------------------------------------------------- */

#footer1 {
 
  bottom: 0%;
  width: 100%;
  /* Set the fixed height of the footer here */
  height:auto;

  
}


/* Custom footer CSS
-------------------------------------------------- */

.containe{
  width: auto;
  max-width: 100%;
  padding: 0 15px;
  background-image:url(images/newfooter.png);
  background-repeat:no-repeat !important;
}
.container .text-muted {

}
.footertext {
  color: #ffffff;
}
.action { 
    margin:10px 10px 10px 10px; 
    padding:20px 20px 20px 20px; 
    background-color:#D8D8D8;
	height:98px;
	z-index:1000;
	
	
    }
	.search{
		width:250px;
		
		}
.button1{
	margin-left:-5px;
	
		}
		.downlogo{
			display:none;
			}
	@media (max-width:500px){
		.downlogo{
			display:inherit;
			width:150px; 
			margin-left:53px;
			margin-top:10px;
			
			}
	.option{
		width:97px; 
		margin-left:-196px;
		}
		
		.search{
		width:133px; 
		margin-left:21px;
		 margin-top:-48px;
	}
	.button1{
	margin-left:189px; 
	margin-top:-58px !important ;
	}
.font{
	font-size:large;}
	
	.font1{
		font-size:9px;
		}
		.subsimag{
			width: 120px; 
			 margin-left: 157px;
			}
			.footer{
				display:none;
				
				}
				.form-inline{margin-left: 13px;}
				
				
		}
	@media (min-width: 1024px) {
 .containe{width:1379px;}
 .news{width:1379px;}
 #kari {width:1379px;}
  }
</style>
</head>

<? $cat_query=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc"); ?>  
 
<div align="center">
<div id="kari" >
		<div class="col-xs-12 col-lg-12 col-md-12 action" style="margin: 0px;">
      <center>
        
          <form class="form-inline" role="form" action="search_result.php">
            <div class="form-group">
             	<select class="form-control option"  name="search_cat">
<option value="state" style="font-size:9px">All category</option>
<?php while($cat_row=mysql_fetch_assoc($cat_query)){ ?>
           <option value="<?=$cat_row['category_name']?>"><?=$cat_row['category_name']?></option>  
           <? } ?> 
</select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control search"  placeholder="search" name="search_text" />
            </div>
            
           <button style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); padding-left: 6px;  height: 31px;" type="submit" class="button1"> Search</button>
          </form>
        </center>
      </div>
      <div id="footer1" align="center" style="width:100%;">


	

    <div class="containe" style="">
   
    
        <div class="row" style="margin-top: -13px; padding-top: 9px;">
           
             
              <div class="col-md-2">
              </div>
              <div class="col-md-6">
             
              <h2 style="color:#FFF; padding-right:100%;" class="font">Newsletter</h2>
            <h5 style="color:#FFF" class="font1">Do you want to receive daily newsletter? no spam</h5>
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

       <div class="form-group" align="right"><input name="submitted" type="hidden" value="true" /> <input type="image" class="subsimag" src="images/subs.png" 
       name="submits" /></div>
       
            
            </form>
                
              </div>
              <div class="col-md-2">
               <h2 style="color:#FFF;  padding-right: 20%;">contact us</h2
              
							><p> 
								<i class="glyphicon glyphicon-earphone"  style="color:white"></i>&nbsp;<span style="color:#FFF">Phone : 847-621-2289<br> Fax : 847-621-2291<br>
                                1951 Landmeier Rd Elk Grove Village, IL 60007</span><br />
								<i class="glyphicon glyphicon-envelope"  style="color:white"></i>&nbsp;<a style="color:#FFF" href="mailto:info@fahair.com">info@fahair.com</a> <br />
                                
    				</p>		
              </div>
              <div class="col-md-2">
              </div>
           
            </div>
            <div class="row footer" style="background-color:#FFF;">
            <div class="col-md-2" style="padding-left: 0px;"> <img src="images/footer-left.png"  style="width:61px; float:left;"/></div>
<div class="col-md-5"><a href="index1.php"><img src="images/footer-logo.png"   style="width: 263px; float:left;"/></a></div>
<div class="col-md-3"><img src="images/footer-text.png"  style="width: 245px;"/></div>
<div class="col-md-2" style="padding-right: 0px;"> <img src="images/footer-right.png"  style="width: 61px; float: right;"/></div>
         
        </div>
    </div>
    <div class="col-xs-12 col-md-12 col-sm-12">
    <img src="images/logo1.PNG"  class="downlogo"/>
    
    </div>
    
</div>

      </div>
      
      
      
	</div>



