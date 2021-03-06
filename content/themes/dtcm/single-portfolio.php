<?php

//get global prefix
global $sr_prefix;

//get template header
get_header();

if (have_posts()) : while (have_posts()) : the_post();

$pTop = '';
if (get_post_meta(get_the_ID(), $sr_prefix.'_paddingtop', true) == 'false') { $pTop = "notoppadding"; }

// title options
$showPagetitle = "default"; $showPagetitle = get_post_meta(get_the_ID(), $sr_prefix.'_showpagetitle', true);
if ($showPagetitle == "default" || $showPagetitle == "false") { $pTop = "notoppadding"; }
$splitScreen = get_post_meta(get_the_ID(), $sr_prefix.'_splitscreen', true);

?>

		<!-- SECTION PORTFOLIO -->
		<section id="portfolio-single" class="<?php echo esc_attr($pTop); ?>">
			<div class="section-inner">				
           		
          	<?php if  (get_the_content() != '') { ?>
           		<div class="wrapper">
				<?php the_content(); ?>
				</div>
                
           		<div class="wrapper-small">
                <?php if (!get_option($sr_prefix.'_portfoliocomments') && comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
                </div>
                
                <?php if (get_post_meta(get_the_ID(), $sr_prefix.'_paddingbottom', true) == 'true' && get_option($sr_prefix.'_portfoliopagination') !== 'nonfixed') { 
					if ($splitScreen == 'left-right' || $splitScreen == 'right-left') { $spacerSize = 'small'; } else { $spacerSize = 'big'; }
				?>
				<div class="spacer spacer-<?php echo esc_attr($spacerSize); ?>"></div>
				<?php } ?>
       		<?php } ?>
                                
                <?php 
				if (get_option($sr_prefix.'_portfoliopagination') !== 'false') {
					$theId = sr_getId();
					$border = sr_border_option($theId);
					if ($border[1] !== '' && $border[1] == 'light') { $classPag = ' pag-'.$border[1]; } else { $classPag = ''; }
					echo '<div class="wrapper">';
					sr_singlepagination('portfolio','','single-pagination '.get_option($sr_prefix.'_portfoliopagination').$classPag,__( 'Previous Project', 'sr_pond_theme' ),__( 'Next Project', 'sr_pond_theme' ));
					echo '</div>';  
				}
				?>
                
			</div>
		</section>
		<!-- SECTION PORTFOLIO -->
		
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>