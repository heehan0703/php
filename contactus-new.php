<?php
if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$desc=$_POST['desc'];
$to = "info@ebhahair.com";
$from = $_POST['$email'];
$subject = "A User submitted the contact form - EBHA";

$body = "<html><body>
              <p><strong>A User $c_name submitted the contact form</strong></p>
              <table border ='2'>
                   <tr><td>Email :</td><td>$email</td></tr>
                   <tr><td>Message :</td><td>$desc</td></tr>
                   </tr>
			</table>
		</body></html>";
 
		 $headers =  "From:EBHAHAIR\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
if(mail($to,$subject,html_entity_decode($body),$headers)){
header("location:contactus_after_preview.php");
}}?>