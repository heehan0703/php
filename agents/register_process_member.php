<?php
session_start();
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];

require_once('../wp-admin/include/connectdb.php');
 
 $country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
  
  
 if(isset($_POST['email']) && $_POST['email']!='' && $_POST['pass']==$_POST['conf_pass']){ 
  

  
  $email=$_POST['email'];
  $pass =$_POST['pass'];
  $country =$_POST['country'];
  $state=$_POST['state'];
 
  $address1 =$_POST['address1'];
  $address2 =$_POST['address2'];
  $city =$_POST['city'];
  $zipcode = $_POST['zipcode'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  
   $social = $_POST['social'];
  $InstagramID = $_POST['InstagramID'];
  $ReferralPerson = $_POST['ReferralPerson'];
  
  
  
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cel1'].'-'.$_POST['cel2'].'-'.$_POST['cel3']; 
  $i_am = $_POST['i_am'];
  
  
 
  if($i_am=="Wholesaler"){
  $level=2;
  }else{
  $level=0;
  }
  $time=time();
  
 
 $stmt=$con_pdo->prepare("insert into member set `f_name`=:f_name, `l_name`=:l_name, `email`=:email, `pwd`=:pwd, `address1`=:address1, `address2`=:address2, `city`=:city, `state`=:state, `country`=:country, `zipcode`=:zipcode, `i_am`=:i_am, `company_name`=:company_name, `tel`=:tel, `cel`=:cel, `registered_date`=:time,`ISR`=:ISR,level=:level,`Social`=:Social,`InstagramID`=:InstagramID,`Referral`=:Referral");
 
 

 $stmt->bindParam(':f_name',$f_name);
 $stmt->bindParam(':l_name',$l_name);
 $stmt->bindParam(':email',$email);
 $stmt->bindParam(':pwd',$pass);
 $stmt->bindParam(':address1',$address1);
 $stmt->bindParam(':address2',$address2);
 $stmt->bindParam(':city',$city);
 
 if($social!=''){
 $stmt->bindParam(':Social',$social);
 }else{
$stmt->bindParam(':Social',$social='');	 
 }
 
 if($InstagramID!=''){
 $stmt->bindParam(':InstagramID',$InstagramID);
 }else{
$stmt->bindParam(':InstagramID',$InstagramID='');	 
 }
 
 
 if($ReferralPerson!=''){
 
 $stmt->bindParam(':Referral',$ReferralPerson);
 }else{
$stmt->bindParam(':Referral',$ReferralPerson='');	 
 }
 
 
 
 if($_POST['state']!=''){
 
 $stmt->bindParam(':state',$state);
 }
 else{
$stmt->bindParam(':state',$state='');	 
 }
 
 $stmt->bindParam(':country',$country);
 $stmt->bindParam(':zipcode',$zipcode);
 $stmt->bindParam(':i_am',$i_am);
 $stmt->bindParam(':level',$level);
 $stmt->bindParam(':company_name',$com_name);
 $stmt->bindParam(':tel',$tel);
 $stmt->bindParam(':cel',$cel);
 $stmt->bindParam(':time',$time);
 $stmt->bindParam(':ISR',$mem_id);
 $stmt->execute();
 
  $fname = strtoupper($f_name);
  $lname= strtoupper($l_name);
 
 
 $from = "ebha <info@ebha.com>";
 $to= "$email";
 //$to = "baislavimal@gmail.com";
 $subject ="[ebha] Order confirmation";
 $body ="<!doctype html>
<html>
<head>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
 <style type='text/css'>
@font-face {
	font-family: 'Cambria Math';
	panose-1: 2 4 5 3 5 4 6 3 2 4;
	mso-font-charset: 0;
	mso-generic-font-family: roman;
	mso-font-pitch: variable;
	mso-font-signature: -536870145 1107305727 0 0 415 0;
}
@font-face {
	font-family: '맑은 고딕';
	panose-1: 2 11 5 3 2 0 0 2 0 4;
	mso-font-charset: 129;
	mso-generic-font-family: modern;
	mso-font-pitch: variable;
	mso-font-signature: -1879047505 701988091 18 0 524429 0;
}
@font-face {
	font-family: Calibri;
	panose-1: 2 15 5 2 2 2 4 3 2 4;
	mso-font-charset: 0;
	mso-generic-font-family: swiss;
	mso-font-pitch: variable;
	mso-font-signature: -536870145 1073786111 1 0 415 0;
}
@font-face {
	font-family: '\@맑은 고딕';
	panose-1: 2 11 5 3 2 0 0 2 0 4;
	mso-font-charset: 129;
	mso-generic-font-family: modern;
	mso-font-pitch: variable;
	mso-font-signature: -1879047505 701988091 18 0 524429 0;
}
p.MsoNormal, li.MsoNormal, div.MsoNormal {
	mso-style-unhide: no;
	mso-style-qformat: yes;
	mso-style-parent: '';
	margin: 0in;
	margin-bottom: .0001pt;
	mso-pagination: widow-orphan;
	font-size: 12.0pt;
	font-family: 'Times New Roman', serif;
	mso-fareast-font-family: '맑은 고딕';
	mso-fareast-theme-font: minor-fareast;
}
a:link, span.MsoHyperlink {
	mso-style-noshow: yes;
	mso-style-priority: 99;
	color: blue;
	text-decoration: underline;
	text-underline: single;
}
a:visited, span.MsoHyperlinkFollowed {
	mso-style-noshow: yes;
	mso-style-priority: 99;
	color: purple;
	text-decoration: underline;
	text-underline: single;
}
p {
	mso-style-noshow: yes;
	mso-style-priority: 99;
	mso-margin-top-alt: auto;
	margin-right: 0in;
	mso-margin-bottom-alt: auto;
	margin-left: 0in;
	mso-pagination: widow-orphan;
	font-size: 12.0pt;
	font-family: 'Times New Roman', serif;
	mso-fareast-font-family: '맑은 고딕';
	mso-fareast-theme-font: minor-fareast;
}
span.title {
	mso-style-name: title;
	mso-style-unhide: no;
}
span.subtitle {
	mso-style-name: subtitle;
	mso-style-unhide: no;
}
.MsoChpDefault {
	mso-style-type: export-only;
	mso-default-props: yes;
	font-size: 10.0pt;
	mso-ansi-font-size: 10.0pt;
	mso-bidi-font-size: 10.0pt;
}
@page WordSection1 {
	size: 8.5in 11.0in;
	margin: 85.05pt 1.0in 1.0in 1.0in;
	mso-header-margin: .5in;
	mso-footer-margin: .5in;
	mso-paper-source: 0;
}
div.WordSection1 {
	page: WordSection1;
}
 @list l0 {
	mso-list-id: 1434402645;
	mso-list-template-ids: -433651878;
}
ol {
	margin-bottom: 0in;
}
ul {
	margin-bottom: 0in;
}
div.MsoNormal1 {
	mso-style-unhide: no;
	mso-style-qformat: yes;
	mso-style-parent: '';
	margin: 0in;
	margin-bottom: .0001pt;
	mso-pagination: widow-orphan;
	font-size: 12.0pt;
	font-family: 'Times New Roman', serif;
	mso-fareast-font-family: '맑은 고딕';
	mso-fareast-theme-font: minor-fareast;
}
li.MsoNormal1 {
	mso-style-unhide: no;
	mso-style-qformat: yes;
	mso-style-parent: '';
	margin: 0in;
	margin-bottom: .0001pt;
	mso-pagination: widow-orphan;
	font-size: 12.0pt;
	font-family: 'Times New Roman', serif;
	mso-fareast-font-family: '맑은 고딕';
	mso-fareast-theme-font: minor-fareast;
}
p.MsoNormal1 {
	mso-style-unhide: no;
	mso-style-qformat: yes;
	mso-style-parent: '';
	margin: 0in;
	margin-bottom: .0001pt;
	mso-pagination: widow-orphan;
	font-size: 12.0pt;
	font-family: 'Times New Roman', serif;
	mso-fareast-font-family: '맑은 고딕';
	mso-fareast-theme-font: minor-fareast;
}
.WordSection1 .MsoNormalTable tr td div .MsoNormalTable tr td .MsoNormalTable tr td ol .MsoNormal .MsoNormal1 {
	font-family: Arial, Helvetica, sans-serif;
}
.WordSection1 .MsoNormalTable tr td div .MsoNormalTable tr td .MsoNormalTable tr td ol .MsoNormal .MsoNormal1 {
	font-family: Georgia, Times New Roman, Times, serif;
}
.WordSection1 .MsoNormalTable tr td div .MsoNormalTable tr td .MsoNormalTable tr td div p {
	font-family: Arial, Helvetica, sans-serif;
}
.WordSection1 .MsoNormalTable tr td div .MsoNormalTable tr td .MsoNormalTable tr td div p {
	color: #808080;
}
.MsoNormalTable tr td .MsoNormalTable tr td .MsoNormalTable tr td .MsoNormal1 {
	font-family: Arial, Helvetica, sans-serif;
}

</style>
</head>
<body bgcolor=white lang=EN-US link=blue vlink=purple style='tab-interval:.5in'>
<div class=WordSection1>
  <table class=MsoNormalTable border=0 cellpadding=0 width='100%'
 style='width:100.0%;mso-cellspacing:1.5pt;mso-yfti-tbllook:1184'>
    <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
      <td width=20 style='width:15.0pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal style='margin-top:7.5pt'><span style='mso-fareast-font-family:
  'Times New Roman''>&nbsp;
          <o:p></o:p>
          </span></p></td>
      <td style='padding:5.25pt 0in 5.25pt 0in'><div align=center>
          <table class=MsoNormalTable border=0 cellpadding=0 width='100%'
   style='width:100.0%;mso-cellspacing:1.5pt;background:white;mso-yfti-tbllook:
   1184'>
            <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
              <td style='border:none;border-bottom:solid #333333 3.0pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal align=center style='text-align:center'><span
    style='mso-fareast-font-family:'Times New Roman''><a
    href='http://pavodemo.com'
    title=MegaShop><span style='color:#337FF1;text-decoration:none;text-underline:
    none'><!--[if gte vml 1]><v:shapetype id='_x0000_t75' coordsize='21600,21600'
     o:spt='75' o:preferrelative='t' path='m@4@5l@4@11@9@11@9@5xe' filled='f'
     stroked='f'>
     <v:stroke joinstyle='miter'/>
     <v:formulas>
      <v:f eqn='if lineDrawn pixelLineWidth 0'/>
      <v:f eqn='sum @0 1 0'/>
      <v:f eqn='sum 0 0 @1'/>
      <v:f eqn='prod @2 1 2'/>
      <v:f eqn='prod @3 21600 pixelWidth'/>
      <v:f eqn='prod @3 21600 pixelHeight'/>
      <v:f eqn='sum @0 0 1'/>
      <v:f eqn='prod @6 1 2'/>
      <v:f eqn='prod @7 21600 pixelWidth'/>
      <v:f eqn='sum @8 21600 0'/>
      <v:f eqn='prod @7 21600 pixelHeight'/>
      <v:f eqn='sum @10 21600 0'/>
     </v:formulas>
     <v:path o:extrusionok='f' gradientshapeok='t' o:connecttype='rect'/>
     <o:lock v:ext='edit' aspectratio='t'/>
    </v:shapetype><v:shape id='_x0000_i1025' type='#_x0000_t75' alt='MegaShop'
     href='http://pavodemo.com/prestabrain/megashop/default/index.php' title='&quot;MegaShop&quot;'
     style='width:104.25pt;height:31.5pt' o:button='t'>
     <v:imagedata src='Welcome!_files/image001.png' o:href='cid:swift-142378536054dd3d9007bcf.0@pavodemo.com'/>
    </v:shape><![endif]--><![if !vml]><img src='https://fahair.com/e-mail/beautco_logo-01.jpg' width='187' height='67' border='0'><![endif]></span></a>
                  <o:p></o:p>
                  </span></p></td>
            </tr>
            <tr style='mso-yfti-irow:1'>
              <td style='padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal align=center style='text-align:center'><span
    class=title><span style='font-size:21px;font-family:'Arial',sans-serif;
    mso-fareast-font-family:'Times New Roman';color:#555454;text-transform:
    uppercase'><h2 align='center'>Hi $fname $lname,</h2></span></span><span style='font-size:10.0pt;
    font-family:'Arial',sans-serif;mso-fareast-font-family:'Times New Roman';
    color:#555454'><br>
                  </span><span class=subtitle><span style='font-family:'Arial',sans-serif;
    mso-fareast-font-family:'Times New Roman';color:#555454;text-transform:
    uppercase'>Thank you for creating a customer account at beautco.com wholesale.</span></span> <span style='mso-fareast-font-family:
    'Times New Roman''>
                  <o:p></o:p>
                  </span></p></td>
            </tr>
            <tr style='mso-yfti-irow:2'>
              <td style='padding:.75pt .75pt .75pt .75pt 0!important'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                  <o:p></o:p>
                  </span></p></td>
            </tr>
            <tr style='mso-yfti-irow:3'>
              <td style='border:solid #D6D4D4 1.0pt;mso-border-alt:solid #D6D4D4 .75pt;
    background:#F8F8F8;padding:5.25pt 0in 5.25pt 0in'><table class=MsoNormalTable border=0 cellpadding=0 width='100%'
     style='width:100.0%;mso-cellspacing:1.5pt;mso-yfti-tbllook:1184'>
                  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                    <td width=10 style='width:7.5pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                        <o:p></o:p>
                        </span></p></td>
                    <td style='padding:5.25pt 0in 5.25pt 0in'><div style='mso-element:para-border-div;border:none;border-bottom:solid #D6D4D4 1.0pt;
      mso-border-bottom-alt:solid #D6D4D4 .75pt;padding:0in 0in 8.0pt 0in'>
                        <p style='margin-top:2.25pt;margin-right:0in;margin-bottom:5.25pt;
      margin-left:0in;border:none;mso-border-bottom-alt:solid #D6D4D4 .75pt;
      padding:0in;mso-padding-alt:0in 0in 8.0pt 0in' data-html-only=1><span
      style='font-size:13.5pt;font-family:'Arial',sans-serif;color:#555454;
      text-transform:uppercase'>Your <span style='font-family:&quot;Arial&quot;,sans-serif;
    mso-fareast-font-family:&quot;Times New Roman&quot;;color:#555454;text-transform:
    uppercase'>beautco.com</span> login details
                          <o:p></o:p>
                          </span></p>
                      </div>
                      <p class=MsoNormal><span style='font-size:10.0pt;font-family:'Arial',sans-serif;
      mso-fareast-font-family:'Times New Roman';color:#777777'>Here are your
                        login details:<br>
                        </span><strong><span style='font-size:10.0pt;font-family:'Arial',sans-serif;
      mso-fareast-font-family:'Times New Roman';color:#333333'>E-mail address: <a
      href='mailto:$email'><span style='color:#337FF1'>$email</span></a></span></strong><span
      style='font-size:10.0pt;font-family:'Arial',sans-serif;mso-fareast-font-family:
      'Times New Roman';color:#777777'><br>
                        </span><strong><span style='font-size:10.0pt;font-family:'Arial',sans-serif;
      mso-fareast-font-family:'Times New Roman';color:#333333'>Password:</span></strong><span
      style='font-size:10.0pt;font-family:'Arial',sans-serif;mso-fareast-font-family:
      'Times New Roman';color:#777777'> $pass </span><span
      style='mso-fareast-font-family:'Times New Roman''>
                        <o:p></o:p>
                        </span></p></td>
                    <td width=10 style='width:7.5pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                        <o:p></o:p>
                        </span></p></td>
                  </tr>
                </table></td>
            </tr>
            <tr style='mso-yfti-irow:4'>
              <td style='padding:.75pt .75pt .75pt .75pt 0!important'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                  <o:p></o:p>
                  </span></p></td>
            </tr>
            <tr style='mso-yfti-irow:5'>
              <td style='border:solid #D6D4D4 1.0pt;mso-border-alt:solid #D6D4D4 .75pt;
    background:#F8F8F8;padding:5.25pt 0in 5.25pt 0in'><table class=MsoNormalTable border=0 cellpadding=0 width='100%'
     style='width:100.0%;mso-cellspacing:1.5pt;mso-yfti-tbllook:1184'>
                  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes'>
                    <td width=10 style='width:7.5pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                        <o:p></o:p>
                        </span></p></td>
                    <td style='padding:5.25pt 0in 5.25pt 0in'><p class='MsoNormal1'>Thank you for your registeration with beautco.com</p>
                      <p class='MsoNormal1'>If you wish to continue as business membership please follow one of the steps below.</p>
                      <p class='MsoNormal1'>&nbsp;</p>
                      <p class='MsoNormal1'>step A - attach (file attach form need it, jpg, png format) ONE of the business <br>
                        documentation down below</p>
                      <p class='MsoNormal1'>&nbsp;</p>
                      <p class='MsoNormal1'><strong>a.State Tax Resale Certificate<br>
                        b.Business Certificate or License</strong><br>
                      </p>
                      <p class='MsoNormal1'>step B - Fax(847-364-9926) or E-mail (info@beautco.com) your copy of certificate or license </p>
                      <p class='MsoNormal1'>&nbsp; </p>
                      <p class='MsoNormal1'>A confirmation letter will be sent to you after the review of your document. <br>
                        This process will take few hours after we recieve your document.<br>
                      </p>
                      <p class='MsoNormal1'>Please be advised that major of Beautco.com Products only for the qualified re-sellers in beauty industry and beauty product related category. <br>
                        ex) nail salon, cosmetic profession, beauty profession, salon owner etc..</p>
                      <p><span class='MsoNormal1'>If you are not a business owner nor own one of the business category above, <br>
                        You will be able to check 
                        all the products with Retail Price only until your application is confirmed.</span><br>
                      </p>
                      <p style='margin-top:2.25pt;margin-right:0in;margin-bottom:5.25pt;
      margin-left:0in;border:none;mso-border-bottom-alt:solid #D6D4D4 .75pt;
      padding:0in;mso-padding-alt:0in 0in 8.0pt 0in'>&nbsp;</p>
                      <p style='margin-top:2.25pt;margin-right:0in;margin-bottom:5.25pt;
      margin-left:0in;border:none;mso-border-bottom-alt:solid #D6D4D4 .75pt;
      padding:0in;mso-padding-alt:0in 0in 8.0pt 0in'><span style='font-size:
      13.5pt;font-family:'Arial',sans-serif;color:#555454;text-transform:uppercase'>Important
                        Security Tips:
                        <o:p></o:p>
                        </span></p>
                      <ol start=1 type=1>
                        <li class=MsoNormal style='color:#555454;mso-margin-top-alt:auto;
           mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo1;tab-stops:list .5in'><span
           style='font-size:10.0pt;font-family:'Arial',sans-serif;mso-fareast-font-family:
           'Times New Roman''>Always keep your account details safe.
                          <o:p></o:p>
                          </span></li>
                        <li class=MsoNormal style='color:#555454;mso-margin-top-alt:auto;
           mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo1;tab-stops:list .5in'><span
           style='font-size:10.0pt;font-family:'Arial',sans-serif;mso-fareast-font-family:
           'Times New Roman''>Never disclose your login details to anyone.
                          <o:p></o:p>
                          </span></li>
                        <li class=MsoNormal style='color:#555454;mso-margin-top-alt:auto;
           mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo1;tab-stops:list .5in'><span
           style='font-size:10.0pt;font-family:'Arial',sans-serif;mso-fareast-font-family:
           'Times New Roman''>Change your password regularly.
                          <o:p></o:p>
                          </span></li>
                        <li class=MsoNormal style='color:#555454;mso-margin-top-alt:auto;
           mso-margin-bottom-alt:auto;mso-list:l0 level1 lfo1;tab-stops:list .5in'><span
           style='font-size:10.0pt;font-family:'Arial',sans-serif;mso-fareast-font-family:
           'Times New Roman''>Should you suspect someone is using your account
                          illegally, please notify us immediately.
                          <o:p></o:p>
                          </span>
                          <p class='MsoNormal1'>&nbsp;</p>
                        </li>
                      </ol></td>
                    <td width=10 style='width:7.5pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                        <o:p></o:p>
                        </span></p></td>
                  </tr>
                </table></td>
            </tr>
            <tr style='mso-yfti-irow:6'>
              <td style='padding:.75pt .75pt .75pt .75pt 0!important'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                  <o:p></o:p>
                  </span></p></td>
            </tr>
            <tr style='mso-yfti-irow:7'>
              <td style='padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal><span style='font-size:10.0pt;font-family:'Arial',sans-serif;
    mso-fareast-font-family:'Times New Roman';color:#555454'>You can now place
                  orders on our shop:<span style='font-family:&quot;Arial&quot;,sans-serif;
    mso-fareast-font-family:&quot;Times New Roman&quot;;color:#555454;text-transform:
    uppercase'><a href='beautco.com'>beautco.com</a></span></span></p></td>
            </tr>
            <tr style='mso-yfti-irow:8'>
              <td style='padding:.75pt .75pt .75pt .75pt 0!important'><p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>&nbsp;
                  <o:p></o:p>
                  </span></p></td>
            </tr>
            <tr style='mso-yfti-irow:9;mso-yfti-lastrow:yes'>
              <td style='border:none;border-top:solid #333333 3.0pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal>&nbsp;</p></td>
            </tr>
          </table>
        </div></td>
      <td width=20 style='width:15.0pt;padding:5.25pt 0in 5.25pt 0in'><p class=MsoNormal style='margin-top:7.5pt'><span style='mso-fareast-font-family:
  'Times New Roman''>&nbsp;
          <o:p></o:p>
          </span></p></td>
    </tr>
  </table>
  <p class=MsoNormal><span style='mso-fareast-font-family:'Times New Roman''>
    <o:p>&nbsp;</o:p>
    </span></p>
</div>
</body>
</html>";

         $headers =  "From:ebha.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		 $to ='dranatech@yahoo.com';
		 

		mail($to,$subject,html_entity_decode($body),$headers);
		
			
 
header("location:dashboard.php");	
 }
  
else{
header("location:add-buyer.php");	
}


?>