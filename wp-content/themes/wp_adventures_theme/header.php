<?php 

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 * 
 */

defined('ABSPATH') or die('No script kiddies please!');

$featured_img = has_post_thumbnail();
$get_hp_header = get_theme_mod( 'adventures_headset_hp', 'over-slider' );
$get_ip_header = get_theme_mod( 'adventures_headset_ip', 'over-slider' );

/* @since v1.1.5 
 * Replaced the native code of WordPres 'get_theme_mod' from the image logo with the following one.
 * This custom function 'get_theme_mod_img' will avoid problems with img url protocol with some SERVERS.
 */
$get_hp_logo = get_theme_mod_img( 'adventures_hplogo_setting' );
$get_ip_logo = get_theme_mod_img( 'adventures_seclogo_setting' );

$get_header_bg = get_theme_mod( 'adventures_header_bg', '#fff' );


// Check if we are in the homepage and, in the internal pages, if they have the Features Image.
if (is_front_page() || is_home() || ('yes' === get_theme_mod('adventures_header_allpages_settings', 'no'))) {
	$slider_status = 'head-slider-enabled';
} else if(!empty($featured_img) && is_page()) {
	$slider_status = 'head-slider-enabled';
} else {
	$slider_status = 'head-slider-disabled';
}
$template_blank = "page-templates/page-blank.php";
$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
$template_homepage = "page-templates/page-homepage.php";

?>

<?php 
/* 
 * If has been selected the Page Blank don't print the header.
 */

if($template != $template_blank) { ?>

	<header class="<?php echo (get_theme_mod('adventures_settings_menusticky', 'yes') === 'yes' ? 'headfixed' : ''); ?>">
		<div id="headt-part" class="head-top-part <?php echo $slider_status; ?>
			<?php
			// If HP check if the menu has been setup to the top or over the slider.
			if ( is_front_page() || is_home() ) { 
				if ( $get_hp_header == 'over-slider' ) {
					echo " slider-over";
				} else {
					echo " slider-above";
				}
			} else {
				if ( $get_ip_header == 'over-slider' ) {
					echo " slider-over";
				} else {
					echo " slider-above";
				}
			} ?>"
			<?php // END creation Classes 
			// Start Creation inline Styles
			?>
			style="
				<?php if ( is_front_page() || is_home() ) { 
					if ( $get_hp_header == 'top' ) {
						echo "background:".$get_header_bg.";";
					}
				} else {
					if ( $get_ip_header == 'top' ) {
						echo "background:".$get_header_bg.";";
					}
				}
				?>">
				<?php // End Creation inline Styles
				// End DIV 
				?>
			
			<!-- Extra Navigation -->
			<?php
			 if ((is_active_sidebar( 'topbar')) || (is_active_sidebar( 'topbar-left'))) {
				get_template_part('template-parts/navigation/navigation', 'extra');
			} ?>
			<!-- End Extra Navigation --> 
			<div class="logomenupart e4j-mainmenu <?php echo (get_theme_mod('adventures_settings_menusticky', 'yes') === 'yes' ? 'fixedmenu' : ''); ?>">
				<div id="lmpart">
					<div class="menumob-btn">
						<div id="menumob-btn-ico" onclick="vikShowResponsiveMenu();">
						  <span></span>
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
					</div>
					<div class="logomenu-cnt <?php echo (has_nav_menu('main-menu-right') or has_nav_menu('main-menu')) ? 'main-menu-cnt' : ''; ?>">

						<!-- Main Navigation --> 
						<?php if(has_nav_menu('main-menu')) {
							get_template_part('template-parts/navigation/navigation', 'main');
						} ?>
						<!-- End Main Navigation -->
					
						<?php //By default the logo has been printed on the left. From the Menu module you need to select the Layout logo-centered to have the logo centered and the menu splitted.
						if ( is_front_page() || is_home() ) { // Print logo hp 
						?>
						<div id="tbar-logo" class="<?php echo ( has_nav_menu( 'main-menu-right' ) ) ? 'logo-center' : ''; ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" alt="<?php echo get_theme_mod( 'adventures_logoalt_setting' ); ?>">
								<img src="<?php echo $get_hp_logo; ?>" alt="<?php echo get_theme_mod( 'adventures_logoalt_setting' ); ?>" />
							</a>
						</div>
						<?php } else { 
							if ( !empty($get_ip_logo) ) { // If for the internal pages the logo is empty, print the hp logo. ?> 
								<div id="tbar-logo" class="<?php echo ( has_nav_menu( 'main-menu-right' ) ) ? 'logo-center' : ''; ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" alt="<?php echo get_theme_mod( 'adventures_logoalt_setting' ); ?>">
										<img src="<?php echo $get_ip_logo; ?>" alt="<?php echo get_theme_mod( 'adventures_logoalt_setting' ); ?>" />
									</a>
								</div>
						 <?php } else { ?>
						 	<div id="tbar-logo" class="<?php echo ( has_nav_menu( 'main-menu-right' ) ) ? 'logo-center' : ''; ?>">
							 	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" alt="<?php echo get_theme_mod( 'adventures_logoalt_setting' ); ?>">
									<img src="<?php echo $get_hp_logo; ?>" alt="<?php echo get_theme_mod( 'adventures_logoalt_setting' ); ?>" />
								</a>
							</div>
						<?php 
							}
						} 
						?>

					<!-- Main Navigation Left --> 
					<?php if(has_nav_menu('main-menu-right')) {
						get_template_part('template-parts/navigation/navigation', 'right');
					} ?>
					<!-- End Main Navigation -->
					</div>
					
				</div>
			</div>
		</div>
		<!-- SlideShow -->
		<?php if (is_front_page() || is_home() || ('yes' === get_theme_mod('adventures_header_allpages_settings', 'no')) || ($template == $template_homepage))  {
			?>
			<?php if ( ('slider' === get_theme_mod('adventures_header_activate_settings', 'slider')) || ('static' === get_theme_mod('adventures_header_activate_settings', 'slider')) ) { ?>
				<?php 
				$static_image_title = get_theme_mod( 'adventures_static_image_title', 'Static Image Title' );
				$static_image_desc = get_theme_mod( 'adventures_static_image_desc', 'Static Image Caption' );
				?>
			<div id="contentheader">
				<div id="slideadv" class="slideadv header_slider">
					<div id="contain-slider-fullscreen" class="cnt-slider">           
						<div class="slidmodule">
							<div id="slider">
								<?php if('static' === get_theme_mod('adventures_header_activate_settings', 'slider')) { ?>
								<div id="imgstatic">
									<div id="imgheader" style="background-image:url(<?php echo header_image(); ?>);">
										<div class="imgstatic-text">
											<h2 class="imgstatic-title animated fadeInDownBig">
												<?php 
												if ( function_exists( 'pll__' ) ) {
													echo pll__( $static_image_title ); // If Polylang exist use its pll function
												} else {
													echo $static_image_title;
												} ?>
											</h2>
											<div class="imgstatic-desc animated fadeInUpBig">
												<?php 
												if ( function_exists( 'pll__' ) ) {
													echo pll__( $static_image_desc ); // If Polylang exist use its pll function
												} else {
													echo $static_image_desc;
												} ?>
											</div>
										</div>
									</div>
								</div>
								<?php }?>
								<?php if('slider' === get_theme_mod('adventures_header_activate_settings', 'slider')) { ?>
								<div id="imgslider">
									<?php adventures_featured_image_slider(); ?>
								</div>
								<?php } ?>
							</div>
							<?php if('yes' === get_theme_mod('adventures_header_scrol_sett', 'no')) { ?>
								<?php if('arrow' === get_theme_mod('adventures_header_scrol_type_sett', 'arrow')) { ?>
								<div class="scroll-icon-arrow">
									<i class="fa fa-chevron-down"></i>
								</div>
								<?php } ?>
								<?php if('mouse' === get_theme_mod('adventures_header_scrol_type_sett', 'arrow')) { ?>
								<div class="scroll-icon-mouse"></div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>

					<?php if ( is_active_sidebar( 'header-inner' ) ) { ?>
					<div class="bottomsearch h-search md-search">
						<a class="vehiculele_noastre" id="vehiculele_noastre"></a>
						<div class="grid-block">
							<div class="h-search-inner">
								<?php dynamic_sidebar( 'header-inner' ); ?>
							</div>
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
			<?php } ?>
		<?php } ?>

		<?php
		// Start the loop.
		while (have_posts()) : the_post(); 
			if($template != $template_homepage) { ?>

			<?php if(!empty($featured_img) && is_page()) { ?>
				<div id="contentheader" class="contentheader-nofix">
					<div id="slideadv" class="slideadv header_slider">
						<div id="contain-slider-fullscreen" class="cnt-slider">
							<div class="slidmodule">
								<div id="slider">
									<div id="imgslider">
										<div class="featured-container full-featured">
											<?php 
											//the_post_thumbnail( 'featured-big', array('class' => 'img-thumbnail') );
										 	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'background-pages');
											?>
										 	<div class="featured-container-img" style="background-image: url(<?php echo $featured_img_url; ?>);">
										 		<div class="entry-header">
													<?php the_title( '<h1 class="entry-title animated fadeInUpBig">', '</h1>' ); ?>
												</div>
												<div class="featured-container-mask"></div>		
										 	</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

		<?php }
		 // End the loop.
		endwhile;
		?>
		<!-- End SlideShow -->
	</header>
	<style type="text/css">
		a.vehiculele_noastre {
		    display: block;
		    position: relative;
		    top: -100px;
		    visibility: hidden;
		}
		@media screen and (max-width: 600px) {
			a.vehiculele_noastre {
			    display: block;
			    position: relative;
			    top: 0px;
			    visibility: hidden;
			}
			.vrc-showprc-prices-inner .vrc-showprc-price-row.vrc-showprc-price-selected {
			    flex-wrap: initial;
			}
			.vrc-oconfirm-summary-car-wrapper > div > div, 
			.vrc-oconfirm-summary-total-wrapper > div > div {
			    justify-content: space-between!important;
			}
			#mod_vikrentcar_cars-3 {
				padding: 0!important;
			}
			#mod_vikrentcar_cars-3 .widget-inner {
				padding: 0!important;
			}
			#post-2489 .vrcmodcarsgridcontainer {
				padding: 0!important;
			}
			#post-2489 .vrcmodcarsgridcont-item {
				padding-top: 5!important;
				padding-bottom: 5!important;
				padding-left: 0!important;
				padding-right: 0!important;
			}

			#post-2548 .vrcmodcarsgridcontainer {
				padding: 0!important;
			}
			#post-2548 .vrcmodcarsgridcont-item {
				padding-top: 5!important;
				padding-bottom: 5!important;
				padding-left: 0!important;
				padding-right: 0!important;
			}
		}
		.vrc-order-details-info-val-upload-docs,
		.vrcprintdiv,
		.vrcdownloadpdf,
		.vrcordcancbox {
			display: none;
		}
		.vrc-rental-summary-title,
		.post-2395 .entry-title {
			font-size: 24px;
		}
		.post-2395 .vrc-summary-car-img {
			text-align: center;
		}
		.post-2395 .vrc-summary-car-img img {
			width: 50%;
			float: none;
		}
		#post-2395 .vrc-main-title {
			display: none;
		}
		.vrc-enterpin-block {
			display: none;
		}
		.vrc-coupon-outer {
			text-align: center;
		}
		.vrc-order-details-car-photo {
			text-align: center;
		}
		.extra-14-fonts {
			font-size: 14px;
		}
		.vrc-oconfirm-summary-total-wrapper {
			display: none;
		}
		.vrcrentalfor .vrcrentalforone {
		    font-size: 14px;
		}
		.car_result .extra-car-name-ft a {
			font-size: 15px;
		}
		.vrc-alert-container-confirm {
			z-index: 2001;
		}
		.vrcdialog-overlay-close-inside:hover {
			cursor: pointer;
		}
		.vrcdialog-overlay-close-inside {
			padding: 25px;
		}
		.vrc-oconfirm-summary-car-wrapper > div > div, .vrc-oconfirm-summary-total-wrapper > div > div {
		    display: flex;
		    justify-content: center;
		    align-items: center;
		}
		.post-2548 .vrcmodcarsgrid-item-btm,
        .post-2489 .vrcmodcarsgrid-item-btm {
            display: none;
        }
        
        .post-2548 

	</style>
<?php } ?>