<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
if(isset($_POST["submit"])){
$email=$_POST['email'];
$password=$_POST['password'];
//echo "select * from member where  email='$email' and pwd='$password' and i_am='ISR'";
$result=mysql_query("select * from member where  email='$email' and pwd='$password' and i_am='ISR' and verify_status='1'");
$num=mysql_num_rows($result);
if($num){
		$row=mysql_fetch_array($result);
		//var_dump($row);
		$_SESSION['ISR_ID']=$row['member_id'];
		$_SESSION['ISR_NAME']=$row['f_name'];
		$_SESSION['user_type']=$row['i_am'];
		$_SESSION['tempuser']=$row['member_id'].time();
		$_SESSION['level']=$row['level'];
		//echo $_SESSION['ISR_ID'];
		header("location:dashboard.php");
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-Agent-SIGNIN</title>
  <meta name="description" content="BHA-ISR" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="css/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="css/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/material-design-icons/material-design-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/ionicons/css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />

  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="css/styles/app.css" type="text/css" />
  <link rel="stylesheet" href="css/styles/style.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="css/styles/font.css" type="text/css" />
  <style  type="text/css">
 



/*
Navbar 
*/
.navbar {
  border: none;
  padding: 0 1rem;
  flex-shrink: 0;
  min-height: 250px; }
  
 



.navbar-nav &gt; .nav-link,
.navbar-nav &gt; .nav-item &gt; .nav-link,
.navbar-item,
.navbar-brand {
  padding: 0;
  line-height: 300px;
  white-space: nowrap; }

 .navbar-brand img,
  .navbar-brand svg {
    position: relative;
    max-height: 200px;
    top: 0.75rem;
    display: inline-block;
    vertical-align: top; }
 






  
  </style>
</head>
<body>
<img src="under.jpg">

  
</body>
</html>
