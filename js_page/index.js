var j=jQuery.noConflict();j(document).ready(function(){j('.bxslider').bxSlider({pagerCustom:'#bx-pager',mode:'fade'});});j(function($){$(document).ready(function(){$('.slider1').bxSlider({slideWidth:200,minSlides:2,maxSlides:5,slideMargin:1});});});function show(){$("#overlay-mask-1").fadeIn('slow');}var user_not_login;user_not_login=false;function show_content_slide(cls){if(!$('.small-hidden').is(':visible')){$("."+cls).slideToggle('fast');}}function show_content(cls){$("."+cls).show(0);}function hide_content(cls){$("."+cls).hide(0);}function close_popup(id){$("#"+id).fadeOut('slow');}function check(){var login=document.getElementById("email_login").value;var pass=document.getElementById("pwd_login").value;if(login==""){document.getElementById("uerror").innerHTML="Please enter the username";}else if(pass==""){document.getElementById("perror").innerHTML="Please enter the password";}else{$.ajax({url:'ajax_login.php',data:{email:login,pass:pass},error:function(){$('#info').html('<p>An error has occurred</p>');},success:function(data){if(data=='sucess'){document.location.href="index.php"}else{document.getElementById("berror").innerHTML="Username and Password do not match ";}},type:'POST'});}return false;}function show_item(id,countt){$(".add_hidden_"+countt).addClass("hidden-class");$(".li-cls-"+countt).removeClass("active-menu");$("#li_"+id).addClass("active-menu");$(".div_"+id).removeClass("hidden-class");}