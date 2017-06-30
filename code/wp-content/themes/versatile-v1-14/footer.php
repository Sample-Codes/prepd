	<?php global $theme_option; ?>
	<div class="clear" ></div>
	</div><!-- content wrapper -->

	<?php 
		// page style
		global $gdlr_post_option;
		if( empty($gdlr_post_option) || empty($gdlr_post_option['page-style']) ||
			  $gdlr_post_option['page-style'] == 'normal' || 
			  $gdlr_post_option['page-style'] == 'no-header'){ 
	?>	
	<footer class="footer-wrapper" >
		<?php if( $theme_option['show-footer'] != 'disable' ){ ?>
		<div class="footer-container container">
			<?php 	
				$i = 1;
				$theme_option['footer-layout'] = empty($theme_option['footer-layout'])? '1': $theme_option['footer-layout'];
				$gdlr_footer_layout = array(
					'1'=>array('twelve columns'),
					'2'=>array('three columns', 'three columns', 'three columns', 'three columns'),
					'3'=>array('three columns', 'three columns', 'six columns',),
					'4'=>array('four columns', 'four columns', 'four columns'),
					'5'=>array('four columns', 'four columns', 'eight columns'),
					'6'=>array('eight columns', 'four columns', 'four columns'),
				);
			?>
			<?php foreach( $gdlr_footer_layout[$theme_option['footer-layout']] as $footer_class ){ ?>
				<div class="footer-column <?php echo esc_attr($footer_class); ?>" id="footer-widget-<?php echo esc_attr($i); ?>" >
					<?php dynamic_sidebar('Footer ' . $i); ?>
				</div>
			<?php $i++; ?>
			<?php } ?>
			<div class="clear"></div>
		</div>
		<?php } ?>
		
		<?php if( $theme_option['show-copyright'] != 'disable' ){ ?>
		<div class="copyright-wrapper">
			<div class="copyright-container container">
				<div class="copyright-left">
					<?php if( !empty($theme_option['copyright-left-text']) ) echo gdlr_escape_string($theme_option['copyright-left-text']); ?>
				</div>
				<div class="copyright-right">
					<?php if( !empty($theme_option['copyright-right-text']) ) echo gdlr_escape_string($theme_option['copyright-right-text']); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php } ?>
	</footer>
	<?php } // page style ?>
</div> <!-- body-wrapper -->

<?php wp_footer(); ?>

<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 923496931;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display: inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/923496931/?guid=ON&amp;script=0"/>
</div>
</noscript>


</body>
</html>