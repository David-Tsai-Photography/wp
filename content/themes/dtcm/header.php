<?php 
global $sr_prefix;
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="utf-8">

<!-- scaling not possible (for smartphones, ipad, etc.) -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?><?php wp_title(" | "); ?> | <?php bloginfo('description'); ?></title>

<?php sr_get_social_metas(); ?>
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73704219-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<?php
$theId = sr_getId();
$border = sr_border_option($theId);
 
$bClass = 'bordered'; 
if (get_option($sr_prefix.'_viewportborder') == 'bigborder') { $bClass .= ' big-border'; } 
else if (get_option($sr_prefix.'_viewportborder') == 'noborder') { $bClass = ''; } 

if ($border && $border[1] !== '') { $bClass .= ' border-'.$border[1]; }
if (get_option($sr_prefix.'_disablepreloader')) { $bClass .= ' disable-preloader'; }
?>
<body <?php body_class($bClass); ?>>

<?php if ($bClass !== '') { ?>
<!-- BORDERS -->
<div id="bodyborder-left"></div>
<div id="bodyborder-right"></div>
<div id="bodyborder-top"></div>
<div id="bodyborder-bottom"></div>
<!-- BORDERS -->
<?php } ?>

<?php if (!get_option($sr_prefix.'_disablepreloader')) { ?>
<!-- PAGELOADER -->
<div id="page-loader" class="text-light">
	<div class="page-loader-inner">
		<?php 
			if (get_option($sr_prefix.'_preloaderlogo') == 'light') { $loaderLogo = get_option($sr_prefix.'_logolight'); } 
			else if (get_option($sr_prefix.'_preloaderlogo') == 'dark') { $loaderLogo = get_option($sr_prefix.'_logodark');  }
			else { $loaderLogo = get_option($sr_prefix.'_custompreloaderlogo');  }
		?>
    	<div class="loader-logo-name"><?php if ($loaderLogo) { ?><img src="<?php echo esc_url($loaderLogo); ?>" alt=""/><?php } ?></div>
		<h6 class="alttitle title-minimal"><?php _e("Loading","sr_pond_theme"); ?></h6>
	</div>
</div>
<!-- PAGELOADER -->
<?php } ?>

<!-- PAGE CONTENT -->
<div id="page-content" <?php if (!get_option($sr_prefix.'_disablefixedheader')) { ?>class="fixed-header"<?php } ?>>
	
	<?php
		/* HEADER SETTINGS */
		
		$showPagetitle = get_post_meta($theId, $sr_prefix.'_showpagetitle', true);
		if (is_tag() || is_category() || is_search() || is_archive() || is_tax()) { $showPagetitle = "default"; }
		$splitScreen = get_post_meta($theId, $sr_prefix.'_splitscreen', true);
		$headerStyle = get_post_meta($theId, $sr_prefix.'_headerstyle', true);
		$overlayLogo = get_post_meta($theId, $sr_prefix.'_overlaylogo', true);
		$overlayMenu = get_post_meta($theId, $sr_prefix.'_overlaymenu', true);
		$overlayPosition = get_post_meta($theId, $sr_prefix.'_overlayposition', true);
		
		$classHeader = 'non-overlay';
		$logoHeader = get_option($sr_prefix.'_logolight');
		$classMenu = '';
		if ($headerStyle == 'overlay') { $classHeader = 'overlay-'.$overlayPosition; } else if ($headerStyle == 'sticky') { $classHeader = 'sticky-header';  }
		if ($overlayLogo == 'dark' ) { $logoHeader = get_option($sr_prefix.'_logodark'); }
		if ($overlayMenu == 'dark' ) { $classMenu = 'nav-dark'; }
		if ($showPagetitle == 'default' && $headerStyle == 'overlay') { 
			$classHeader = 'non-overlay'; 
			$logoHeader = get_option($sr_prefix.'_logolight');
			$classMenu = '';
		}
		
		// SPLIT SCREEN
		$altHeader = true;
		$pBodyClass = '';
		if ($showPagetitle == 'color' || $showPagetitle == 'image' || $showPagetitle == 'video' || $showPagetitle == 'slider' || $showPagetitle == 'fullslider') {
			if ($splitScreen == 'left-right') { 
				$pBodyClass = 'splitscreen-right'; 
				$classHeader = 'sticky-header';
				$altHeader = false; 
			} else if ($splitScreen == 'right-left') { 
				$pBodyClass = 'splitscreen-left';
				$classHeader = 'sticky-header'; 
				$altHeader = false; 
			}
		}
		
		/* HEADER SETTINGS */
		
		/* BORDER OPTION */
		if ($border && $border[1] !== '') { $classHeader .= ' sticky-'.$border[1]; }
		/* BORDER OPTION */
	?>
	
	<!-- HEADER -->
	<header id="header" class="<?php echo esc_attr($classHeader); ?>">        
		<div class="header-inner clearfix">
			
			<?php if (	(is_single() && get_post_type() == 'portfolio'  && get_option($sr_prefix.'_portfolioaltheader') !== 'false' && $altHeader) || 
						(is_single() && get_post_type() == 'post'  && get_option($sr_prefix.'_blogaltheader') !== 'false' && $altHeader)) { ?>
			<!-- FIXED HEADER CONTENT -->
			<div class="fixed-header-content<?php if ($border && $border[1] !== '') { echo ' text-'.$border[1]; } ?>"> 
				<h1 id="header-name" class="alttitle title-minimal left-float"><strong><?php  wp_title(""); ?></strong></h1>
				
				<?php 
				if (get_post_type() == 'portfolio' && get_option($sr_prefix.'_portfoliobacktoworks') !== 'false' ||
				get_post_type() == 'post' && get_option($sr_prefix.'_blogbacktoblog') !== 'false'	) { 
					
					if (get_post_type() == 'portfolio') { $backToText = __("Back to Works", 'sr_pond_theme'); $backToUrl = sr_get_backtoworks_link(); } 		
					else if (get_post_type() == 'post') { $backToText = __("Back to Blog", 'sr_pond_theme'); $backToUrl = get_permalink( get_option('page_for_posts' )); }
					?>
                    <a href="<?php echo esc_url($backToUrl); ?>" id="backtoworks" class="transition">
                    	<span class="icon"></span>
                    	<span class="text"><?php echo $backToText; ?></span>
                    </a>
				<?php } ?>
				
				<?php if (get_post_type() == 'portfolio'  && !get_option($sr_prefix.'_portfoliodisableshare') || get_post_type() == 'post'  && !get_option($sr_prefix.'_blogdisableshare')) { ?>
				<div id="social-share" class="right-float">
					<a href="#" class="show-share"><?php _e("Share", 'sr_pond_theme'); ?></a>
					<?php sr_Share(get_post_type()); ?>
				</div>
				<?php } ?>
			</div>
			<!-- FIXED HEADER CONTENT -->
			<?php } ?>
			
           <!-- DEFAULT HEADER CONTENT -->
		   	<div class="default-header-content">                 
				<div id="logo" class="<?php if (get_option($sr_prefix.'_headerlogomenu') == 'opposite') { ?>right-float<?php } else { ?>left-float<?php } ?>">
					<?php if ($logoHeader) { ?><a id="default-logo" class="logotype" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($logoHeader); ?>" alt="Logo"></a><?php } ?>
					<?php if ($border && $border[1] !== '') { ?>
                    <a id="fixed-logo" class="logotype" href="<?php echo esc_url(home_url()); ?>">
                    <img src="<?php echo esc_url(get_option($sr_prefix.'_logo'.$border[1])); ?>" alt="Logo"></a>
					<?php } else { ?>
                    <a id="fixed-logo" class="logotype" href="<?php echo esc_url(home_url()); ?>">
                    <img src="<?php echo esc_url(get_option($sr_prefix.'_logodark')); ?>" alt="Logo"></a>
                    <?php } ?>
				</div>    
				
				<?php if(has_nav_menu('primary-menu')) {  ?>
				<div class="menu <?php if (get_option($sr_prefix.'_headerlogomenu') == 'opposite') { ?>left-float<?php } else { ?>right-float<?php } ?> clearfix">
					
                    <?php if (get_option($sr_prefix.'_headermenuappearence') == 'traditional') { ?>
                    	<?php	
							wp_nav_menu(  
								array(  
									'theme_location'  => 'primary-menu', 
									'container'       => 'nav',  			        
									'container_id'    => 'traditional-nav',  
									'container_class' => '',  
									'menu_class'      => $classMenu, 
									'menu_id'         => 'primary' ,
									'before'          => '',
									'after'           => '',
									'walker' 			=> new sr_menu_output()
								)
							);  
						?>
                    <?php } ?>
                    
                    
                    <a href="#" class="open-nav <?php echo esc_attr($classMenu); ?>"><span class="hamburger"></span>
                    <?php if (get_option($sr_prefix.'_headermenuappearence') == 'texticon') { ?>
                    <span class="open-nav-text"><?php _e("Menu","sr_pond_theme"); ?></span>
                    <?php } ?>
                    </a>
					<nav id="main-nav" class="text-light">
						<?php if(!get_option($sr_prefix.'_menudisablelogo')) { ?>
                        <div class="nav-logo"><?php if (get_option($sr_prefix.'_logolight')) { ?><img src="<?php echo esc_url(get_option($sr_prefix.'_logolight')); ?>" alt="Logo Menu"><?php } ?></div>
                        <?php } ?>
						<?php	
							wp_nav_menu(  
								array(  
									'theme_location'  => 'primary-menu', 
									'container'       => 'div',  			        
									'container_id'    => '',  
									'container_class' => 'nav-inner',  
									'menu_class'      => '', 
									'menu_id'         => 'primary' ,
									'before'          => '',
									'after'           => '',
									'walker' 			=> new sr_menu_output()
								)
							);  
						?>
						<?php if(!get_option($sr_prefix.'_menudisablesocial')) { ?>
						<div class="nav-social"><?php sr_get_sociallinks(false); ?></div>
						<?php } ?>
						<div class="nav-bg"></div>
					</nav>
				</div>
				<?php } // END if has_nav_menu ?>
			</div>
           <!-- DEFAULT HEADER CONTENT -->
                    
		</div> <!-- END .header-inner -->
	</header> <!-- END header -->
	<!-- HEADER -->
	
    <?php if ( !is_404() ) { ?>
    
	<?php $inHeader = true; include(locate_template('includes/page-title.php')); $inHeader = false; ?>
    
	<!-- PAGEBODY -->
	<div id="page-body" class="<?php echo esc_attr($pBodyClass); ?>">
    
    <?php } ?>
 	<!-- Youtube responsive script -->
        <script>
    (function() {
        var v = document.getElementsByClassName("youtube-player");
        for (var n = 0; n < v.length; n++) {
            var p = document.createElement("div");
            p.innerHTML = labnolThumb(v[n].dataset.id);
            p.onclick = labnolIframe;
            v[n].appendChild(p);
        }
    })();
     
    function labnolThumb(id) {
        return '<img class="youtube-thumb" src="//i.ytimg.com/vi/' + id + '/hqdefault.jpg"><div class="play-button"></div>';
    }
     
    function labnolIframe() {
        var iframe = document.createElement("iframe");
        iframe.setAttribute("src", "//www.youtube.com/embed/" + this.parentNode.dataset.id + "?autoplay=1&autohide=2&border=0&wmode=opaque&enablejsapi=1&controls=0&showinfo=0");
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("id", "youtube-iframe");
        this.parentNode.replaceChild(iframe, this);
    }
    </script>

	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<link rel="dns-prefetch" href="//maps.gstatic.com">
	<link rel="dns-prefetch" href="//maps.google.com">
	<link rel="dns-prefetch" href="//maps.googleapis.com">
	<link rel="dns-prefetch" href="//mt0.googleapis.com">
	<link rel="dns-prefetch" href="//mt1.googleapis.com">
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="dns-prefetch" href="//themes.googleusercontent.com">
	<link rel="dns-prefetch" href="//www.linkedin.com">
	<link rel="dns-prefetch" href="//platform.linkedin.com">
	<link rel="dns-prefetch" href="//static.licdn.com">
	<link rel="dns-prefetch" href="//connect.facebook.net">
	<link rel="dns-prefetch" href="//static.ak.facebook.com">
	<link rel="dns-prefetch" href="//s-static.ak.facebook.com">
	<link rel="dns-prefetch" href="//fbstatic-a.akamaihd.net">
	<link rel="dns-prefetch" href="//apis.google.com">
	<link rel="dns-prefetch" href="//ssl.gstatic.com">
	<link rel="dns-prefetch" href="//oauth.googleusercontent.com">
	<link rel="dns-prefetch" href="//accounts.google.com">
	<link rel="dns-prefetch" href="//oauth.googleusercontent.com">