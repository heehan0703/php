	<!-- REVOLUTION STYLE SHEETS -->
        <link rel="stylesheet" href="revolution/css/settings.css" media="none" onload="if(media!='all')media='all'">
<noscript><link rel="stylesheet" href="revolution/css/settings.css"></noscript>
        
        
		<!-- REVOLUTION JS FILES -->
		<script type="text/javascript" src="revolution/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="revolution/js/jquery.themepunch.revolution.min.js"></script>
	<section class="example">
		<article class="content">
			<div class="rev_slider_wrapper">			
				<!-- START REVOLUTION SLIDER 5.0 auto mode -->
				<div id="rev_slider" class="rev_slider"  data-version="5.0">
					<ul>	
						<!-- SLIDE  -->
						<li data-transition="fade">
							<!-- MAIN IMAGE -->
							<img src="images/title_1.jpg"  alt=""  width="1920" height="1080">							
			</li>
						<!-- SLIDE  -->
						<li data-transition="fade">
							
							<!-- MAIN IMAGE -->
							<img src="images/title_2.jpg"  alt=""  width="1920" height="1080">							

							<!-- LAYER NR. 2 -->
								
									<div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0" 
									 id="slide-16-layer-1" 
									 data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
									 data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
												data-fontsize="['70','70','70','45']"
									data-lineheight="['70','70','70','50']"
									data-width="none"
									data-height="none"
									data-whitespace="nowrap"
									data-transform_idle="o:1;"
						 
									 data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" 
									 data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
									 data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
									 data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" 
									data-start="1000" 
									data-splitin="chars" 
									data-splitout="none" 
									data-responsive_offset="on" 

									data-elementdelay="0.05" 
									
									style="z-index: 5; white-space: nowrap;"> 
								</div>
					</li>

				</ul>				
				</div><!-- END REVOLUTION SLIDER -->
			</div><!-- END REVOLUTION SLIDER WRAPPER -->	
		</article>
	</section>
<script>
	var revapi;
	jQuery(document).ready(function() {		
		revapi = jQuery("#rev_slider").revolution({
			sliderType:"standard",
			sliderLayout:"auto",
			delay:4000,
			navigation: {
				arrows:{enable:true}				
			},			
			gridwidth:1920,
			gridheight:1080		
		});		
	});	/*ready*/
</script>			