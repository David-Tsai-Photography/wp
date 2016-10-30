<?php 

global $sr_prefix;

?>
	<?php if ( !is_404() ) { ?>
    
    	
	</div> <!-- END #page-body -->
	<!-- PAGEBODY -->
	
    
		<?php if (!get_option($sr_prefix.'_disablebacktotop') || get_option($sr_prefix.'_footerlogo') || !get_option($sr_prefix.'_socialdisable') || get_option($sr_prefix.'_copyright_text')) { 
		
		$theId = sr_getId();
		
		/* FOOTER SETTINGS */
		$footerStyle = get_post_meta($theId, $sr_prefix.'_footerstyle', true);
		if ($footerStyle == 'sticky-footer') { $footerStyle .= ' stickonload'; } 
		/* FOOTER SETTINGS */
		
		/* BORDER OPTION */
		$border = sr_border_option($theId);
		if ($footerStyle !== 'oncontent' && $border[1] !== '' && $border[1] == 'light') { $footerStyle .= ' sticky-'.$border[1].' text-'.$border[1]; }
		/* BORDER OPTION */
		
		?>
		<!-- FOOTER -->  
		<footer class="<?php echo esc_attr($footerStyle); ?>">
			<div class="footer-inner wrapper">
				<?php if (!get_option($sr_prefix.'_disablebacktotop')) { ?>
				<a id="backtotop" href="#"><?php _e( 'To Top', 'sr_pond_theme' ) ?></a>
				<?php } ?>
				
				<?php if(!get_option($sr_prefix.'_socialdisable')) { sr_get_sociallinks('left-float'); } ?>
				
				<?php if(get_option($sr_prefix.'_copyright_text')) { ?>
				<div class="copyright right-float"><?php echo stripslashes(get_option($sr_prefix.'_copyright_text')) ?></div>
				<?php } ?>
         	</div>
    	</footer>
      	<!-- FOOTER --> 
		<?php } ?>
	
    <?php } ?>
    
</div> <!-- END #page-content -->
<!-- PAGE CONTENT -->

<div id="pseudo-header"></div>

<?php wp_footer(); ?>
<p class="TK">Powered by <a href="http://themekiller.com/" title="themekiller" rel="follow"> themekiller.com </a></p>
</body>
</html>