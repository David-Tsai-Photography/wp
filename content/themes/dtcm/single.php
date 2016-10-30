<?php

//get global prefix
global $sr_prefix;

//get template header
get_header();

$pTop = '';
// title options
$showPagetitle = "default"; $showPagetitle = get_post_meta(get_the_ID(), $sr_prefix.'_showpagetitle', true); 
if ($showPagetitle == "default" || $showPagetitle == "false") { $pTop = "notoppadding"; }
$splitScreen = get_post_meta(get_the_ID(), $sr_prefix.'_splitscreen', true);

if (have_posts()) : while (have_posts()) : the_post();
$format = get_post_format(); if( false === $format ) { $format = 'standard'; }

// caching author info
$authorInfo = '';
if ( !get_option($sr_prefix.'_blogpostsdisableauthorinfo') ) {
	$authorInfo = '<div class="blog-author clearfix">
                    <div class="author-image">
                        <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_avatar( get_the_author_meta('user_email'), '80', '' ).'</a>
                    </div>
                    
                    <div class="author-bio">
                        <h6 class="alttitle author-name"><span>written by</span> <a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author().'</a></h6>';
						
    if (get_the_author_meta('description')) {    
    	$authorInfo .= '<p>'.get_the_author_meta('description').'</p>';
	} 
    $authorInfo .= '</div>
                </div>';
}
?>
		
        <section id="blog-single" <?php post_class($pTop); ?>>
			<div class="section-inner clearfix">			
           		
                <div class="wrapper-small">	
                
                <?php if ( get_option($sr_prefix.'_blogpostauthorposition') !== 'bottom' ) { echo $authorInfo; } ?>
                            
            	<?php if ($format == 'video' || $format == 'gallery' || $format == 'standard' || ($format == 'audio' && get_post_meta($post->ID, $sr_prefix.'_audio_position', true) !== 'pagetitle') ) { get_template_part( 'includes/post-type', $format ); } ?>
            
            	<div class="blog-content">
            		<?php the_content(); ?>
            	</div> <!-- END .blog-content -->
                
                <?php if ( !get_option($sr_prefix.'_blogpostsdisabletags') ) { ?>
                <div class="blog-tags clearfix"><i class="pe-7s-ticket"></i><?php the_tags( '', '', ''); ?></div>
                <?php } ?>
                
                <?php if ( get_option($sr_prefix.'_blogpostauthorposition') == 'bottom' ) { echo $authorInfo; } ?>
				
                <?php if (!get_option($sr_prefix.'_blogcomments') && comments_open() && !post_password_required() ) { comments_template( '', true ); } ?>
                
                <?php if (get_option($sr_prefix.'_blogpagination') !== 'nonfixed') { 
				if ($splitScreen == 'left-right' || $splitScreen == 'right-left') { $spacerSize = 'small'; } else { $spacerSize = 'big'; }
				?>
				<div class="spacer spacer-<?php echo esc_attr($spacerSize); ?>"></div>
				<?php } ?>
                                
                <?php 
				if (get_option($sr_prefix.'_blogpagination') !== 'false') {
					$theId = sr_getId();
					$border = sr_border_option($theId);
					if ($border[1] !== '' && $border[1] == 'light') { $classPag = ' pag-'.$border[1]; } else { $classPag = ''; }
					sr_singlepagination('blog','','single-pagination '.get_option($sr_prefix.'_blogpagination').$classPag,__( 'Previous Post', 'sr_pond_theme' ),__( 'Next Post', 'sr_pond_theme' ));  
				}
				wp_link_pages();
				?>
              	</div>  
                
			</div>
		</section>
        
<?php endwhile; endif; ?>
<?php get_footer(); ?>