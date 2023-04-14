<?php

/*
* Function used to display the image slider
*/

defined('ABSPATH') or die('No script kiddies please!');

function adventures_featured_image_slider() {
	global $post;
	//TODO: Get structure from widgets
	$arrslide = [];

	$getfont = get_theme_mod('adventures_slider_font',0);

	$slider_fullscreen = get_theme_mod( 'adventures_slider_fullscreen', 'no' );
	$get_maskopacity = get_theme_mod( 'adventures_slider_maskopacity', 0.5 );
	$autoplay = get_theme_mod( 'adventures_slider_autoplay', 'true' );
	$interval = get_theme_mod( 'adventures_slider_interval', 4000 );
	$get_readmore_target = get_theme_mod( 'adventures_slider_linktarget', '_self' );

	$get_align = get_theme_mod( 'adventures_slider_textalign','center' );
	$dotsnav = get_theme_mod( 'adventures_slider_dotsnav', 'yes' );
	$navigation = get_theme_mod( 'adventures_slider_navigation', 'yes' );

	$navenable = intval($navigation) == 1 ? true : false;
	$height = get_theme_mod( 'adventures_slider_height' );
	$viksliderid = rand(1, 17);

	switch ($getfont) {
		case 0:
			echo '';
		break;
		case 1:
			echo '<link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Lato:400,700,30" type="text/css" media="all"/>';
			$slidefont = "Lato";
		break;
		case 2:
			echo '<link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Roboto:400,500,300" type="text/css" media="all"/>';
			$slidefont = "Roboto";
		break;
		case 3:
			echo '<link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Oswald:400,300,700" type="text/css" media="all"/>';
			$slidefont = "Oswald";
		break;
		case 4:
			echo '<link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Convergence" type="text/css" media="all"/>';
			$slidefont = "Convergence";
		break;
	}

	if ($getfont > 0) {
		$css_style = "";
		$css_style .=".vikcs-container-cstld h2, .vikcs-container-cstld .slide-text {font-family:\"" . $slidefont . "\";}";
		echo "<style>" . $css_style . "</style>";
	}
	
	$wnext = "";
	$wprev = "";
	$first_read = true;
	
	if (empty($height)) {
		$height = 0;
	}

	$number_of_slides = 5;

	for ($i = 0; $i <= $number_of_slides; $i++) {

		$adventures_slider_image = get_theme_mod('adventures_slider_' . $i . '_image');
		if (empty($adventures_slider_image)) {
			continue;
		}
		
		/* @since v1.1.5 
		 * Replaced the native code of WordPres 'get_theme_mod('adventures_slider_' . $i . '_image')' with the following one.
		 * This custom function 'get_theme_mod_img' will avoid problems with img url protocol with some SERVERS.
		 */
		$imgabpath = get_theme_mod_img('adventures_slider_' . $i . '_image');
		$adventures_slider_title = get_theme_mod('adventures_slider_' . $i . '_title');
		$slider_title_tag = get_theme_mod('adventures_slider_' . $i . '_title_tag');

		$slider_entry = '<div class="slide-item carousel-item item' . ($first_read ? ' active' : '') . ' vikcs-container-cstld">';
			if (get_theme_mod('adventures_slider_fullscreen', 'no') == 'yes') {
				$slider_entry .= '<div class="slide-image vikcs-img-bckground vikcs-img-bckground-cstsld" style="background-image: url(' . $imgabpath . ');">'; //Start - Div vikcs-img-bckground
			} else {
				$slider_entry .= '<div>';
					$slider_entry .= '<img class="slide-image vikcs-img-bckground-cstsld vikcs-img-bckground-tagimg" src="' . $imgabpath . '" alt="' . $adventures_slider_title . '"/>';
			}
					$slider_entry .= '<div class="bs-slider-overlay" style="opacity: '. $get_maskopacity .';"></div>';			
			$slider_entry .= '</div>'; //End - Div vikcs-img-bckground
			$slider_entry .= '<img class="slide-image vikcs-img-bckground-cstsld vikcs-img-bckground-tagimg" src="' . $imgabpath . '" alt="' . $adventures_slider_title . '"/>';
			$slider_entry .= '<div class="img-bs-slider-overlay" style="opacity: '. $get_maskopacity .';"></div>';
			
			$slider_entry .= '<div class="container">'; //Start - Container
				$slider_entry .= '<div class="row">'; //Start - Row
					$slider_entry .= '<div class="slide-text slide_style_' . $get_align . '">'; //Start - slide-text

						// Title
						$adventures_slider_title = get_theme_mod('adventures_slider_' . $i . '_title');
						/* 
						* @since version 1.2.1
						* Define the H on the Theme Customizer.
						* Now a user can decide which type of heading for each slide.
						*/
						if ( !empty( $adventures_slider_title ) ) {
							$slider_entry .= '	<h1'.$slider_title_tag.' class="animated '.get_theme_mod( 'adventures_slider_teffect','fadeInLeft' ).'">';
								if ( function_exists( 'pll__' ) ) {
									$slider_entry .= pll__( $adventures_slider_title ); // If Polylang exist use its pll function
								} else if ( function_exists( 'icl_t' ) ) { // If WPML exist use its icl_t function
									$slider_entry .= icl_t( 'wp_adventures_theme', 'Slider Title ' . $i, $adventures_slider_title );
								} else { 
									$slider_entry .= apply_filters( 'wpml_translate_string', $adventures_slider_title, 'Slider Title ' . $i, array(
										'kind' => 'Theme Theme', 
										'name' => 'slider-title-' . $i, 
									) ); // If WPML exist use its icl_t function
								}
							$slider_entry .= '</h1'.$slider_title_tag.'>';
						}
						

						// Description
						$adventures_slider_description = get_theme_mod( 'adventures_slider_' . $i . '_description' );
						if ( !empty( $adventures_slider_description ) ) {
							$slider_entry .= '<p class="animated '.get_theme_mod('adventures_slider_ceffect','fadeInRight').'">';
								$slider_entry .= '<span class="vikcs-desc">';
								if ( function_exists( 'pll__' ) ) {
									$slider_entry .= pll__($adventures_slider_description); // If Polylang exist use its pll function
								} else if ( function_exists('icl_t') ) { // If WPML exist use its icl_t function
									$slider_entry .= icl_t('wp_adventures_theme', 'Slider Description ' . $i, $adventures_slider_description); 
								} else {
									$slider_entry .= apply_filters( 'wpml_translate_string', $adventures_slider_description, 'Slider Description ' . $i, array(
										'kind' => 'Theme Theme', 
										'name' => 'slider-description-' . $i, 
									) ); // If WPML exist use its icl_t function
								}								
								$slider_entry .= '</span>';
							$slider_entry .= '</p>';
						}

						// Read More
						$readmtext = get_theme_mod('adventures_slider_' . $i . '_readmore');
						$adventures_slider_readmorelink = get_theme_mod('adventures_slider_' . $i . '_readmorelink');
						if ( !empty($adventures_slider_readmorelink ) ) {
							$slider_entry .= '<a class="btn btn-default animated '.get_theme_mod( 'adventures_slider_reffect', 'fadeInUpBig' ).'" 
							target="'.( $get_readmore_target == '_blank' ? '_blank' : '_self' ).'" 
							href="';							
							//Link ReadMore creation
							if ( function_exists( 'pll__' ) ) {
								$slider_entry .= pll__($adventures_slider_readmorelink);
							} else if ( function_exists('icl_t') ) { // If WPML exist use its icl_t function
									$slider_entry .= icl_t('wp_adventures_theme', 'Read More Link ' . $i, $adventures_slider_readmorelink); 
							} else {
								$slider_entry .= apply_filters( 'wpml_translate_string', $adventures_slider_readmorelink, 'Slider Read More Link ' . $i, array(
									'kind' => 'Theme Theme', 
									'name' => 'slider-readmore-link-' . $i, 
								) ); // If WPML exist use its icl_t function
							}
							$slider_entry .= '">';

							if ( function_exists( 'pll__' ) ) {
								$slider_entry .= pll__($readmtext);
							} else if ( function_exists( 'icl_t' ) ) { // If WPML exist use its icl_t function
									$slider_entry .= icl_t('wp_adventures_theme', 'Read More Text ' . $i, $readmtext); 
							} else {
								$slider_entry .= apply_filters( 'wpml_translate_string', $readmtext, 'Slider Read More ' . $i, array(
									'kind' => 'Theme Theme', 
									'name' => 'slider-readmore-' . $i, 
								) ); // If WPML exist use its icl_t function
							}
							$slider_entry .= '</a>';
						}
						$slider_entry .= '<span class="endtext"></span></div>'; //End - slide-text
				$slider_entry .= '</div>'; //End - Row
			$slider_entry .= '</div>'; //End - Container
		$slider_entry .= '</div>';
		$first_read = false;
		$arrslide[] = $slider_entry;
	}

	echo '<div id="vikcstsld-slider" class="carousel slide carousel-fade vikcs-slider '.( get_theme_mod( 'adventures_slider_fullscreen', 'no' ) == 'yes' ? 'slider-fullwidth' : '' ).'" data-ride="carousel" data-interval="'.$interval.'" data-keyboard="true">';
?>
    <!-- Wrapper For Slides -->
    <div class="carousel-inner vikcs-slider vikcs-slider-cstsld" role="listbox">
	    <?php
	    if (is_array($arrslide)) {
			foreach($arrslide as $vsl) {
				echo $vsl;
			}
		}
		?>
	</div><span id="endcontainer"></span>

	<!-- Left Control -->
	<?php if ( get_theme_mod( 'adventures_slider_navigation', 'yes' ) == 'yes' ) { ?>
	    <a class="carousel-control-prev carousel-control" href="#vikcstsld-slider" role="button" data-slide="prev">
	        <img class="vikcstsld-arrow" src="<?php echo get_template_directory_uri() . '/assets/images/angle-left-solid.svg'; ?>" aria-hidden="true" />
	        <span class="sr-only">Previous</span>
	    </a>

	    <!-- Right Control -->
	    <a class="carousel-control-next carousel-control" href="#vikcstsld-slider" role="button" data-slide="next">
	        <img class="vikcstsld-arrow" src="<?php echo get_template_directory_uri() . '/assets/images/angle-right-solid.svg'; ?>" aria-hidden="true" />
	        <span class="sr-only">Next</span>
	    </a>
	<?php } ?>
</div> <!-- End bootstrap-touch-slider -->
	
	<script>
	jQuery.noConflict();
	<?php $slider_image_height = get_theme_mod( 'adventures_slider_image_height', '' ); ?>
	jQuery(document).ready(function(){		
		/* Text */
	var slider_box = jQuery('.slide-item');
	setTimeout(function() {
		var text_end = 0;
		if (jQuery('.slide-item.active').find('.endtext').length) {
			text_end = jQuery('.slide-item.active').find('.endtext').offset().top;
		}
		var general_end = jQuery('#endcontainer').offset().top;
		var text_box = jQuery('.slide-text');
		var distance = general_end - text_end;
		if(distance <= 100) {
			if(distance <= 20) {
				slider_box.addClass('slide-text-pos-hid-btn');
				text_box.addClass('slide-text-position-10');
			} else {
				text_box.addClass('slide-text-position-10');
			}				
		}
	}, 1000);	

	<?php if ( $slider_fullscreen == 'yes') { ?>
		jQuery('#contentheader').addClass('contentheader-topfix');
		jQuery('#head-top-part').addClass('headt-part');
		jQuery('.vikcs-container-cstld').each(function(){
			var menu_above = jQuery('.slider-above');
			var menu_above_check = menu_above.length;
			var larghezza = jQuery(window).width();
			
			if(jQuery('.bottomsearch').length) {
				var searchbar = jQuery('.bottomsearch').height();
			} else {
				var searchbar = 0;
			}

			searchbar = (searchbar / 2) + 40;
			var altezza = jQuery(window).height() - searchbar;

			if(menu_above_check > 0) {
				var menu_above_height = menu_above.height();
				altezza = altezza - menu_above_height;
			}

			if(larghezza <= 1024) {
				var altezza_plusbox = altezza;
			} else {
				var altezza_plusbox = altezza - 90;
			}
			if( altezza > 0 ) {				
				jQuery('.vikcs-slider-cstsld').css('height', altezza);
			}

			// for SAFARI reload action
			jQuery('.vikcs-container-cstld').first().on('load', function(e){
				if(jQuery('.bottomsearch').length) {
					var searchbar = jQuery('.bottomsearch').height();
				} else {
					var searchbar = 0;
				}
				searchbar = (searchbar / 2) + 40;
				var altezza = jQuery(window).height() - searchbar;
				var larghezza = jQuery(window).width();
				var menu_above = jQuery('.slider-above');
				var menu_above_check = menu_above.length;

				if(menu_above_check > 0) {
					var menu_above_height = menu_above.height();
					altezza = altezza - menu_above_height;
				}

				jQuery('.vikcs-slider-cstsld').css('height', altezza);				
			});

			var TRIGGER_RESIZE = true;
			var TRIGGER_TIMER = null;

			jQuery(window).resize(function() {
				/* Text */
				var text_end = 0;
				if (jQuery('.slide-item.active').find('.endtext').length) {
					text_end = jQuery('.slide-item.active').find('.endtext').offset().top;
				}
				var general_end = jQuery('#endcontainer').offset().top;
				var distance = general_end - text_end;
				var text_box = jQuery('.slide-text');
				var slider_box = jQuery('.slide-item');
				setTimeout(function() {
					if(distance <= 100) {
						if(distance <= 20) {
							slider_box.addClass('slide-text-pos-hid-btn');
							text_box.addClass('slide-text-position-10');
						} else {
							text_box.addClass('slide-text-position-10');
						}				
					} else if(distance > 100) {
						text_box.removeClass('slide-text-position-10');
						slider_box.removeClass('slide-text-pos-hid-btn');
					}
				}, 100);


				if(jQuery('.bottomsearch').length) {
					var searchbar = jQuery('.bottomsearch').height();
				} else {
					var searchbar = 0;
				}
				searchbar = (searchbar / 2) + 40;
				var altezza = jQuery(window).height() - searchbar;
				var larghezza = jQuery(window).width();
				
				if(larghezza <= 1024) {
					var altezza_plusbox = altezza;
				} else {
					var altezza_plusbox = altezza - 90;
				}
				
				jQuery('.vikcs-slider-cstsld').css('height', altezza);

				if( TRIGGER_TIMER !== null ) {
					clearTimeout(TRIGGER_TIMER);
				}

				TRIGGER_TIMER = setTimeout(function(){
						if( TRIGGER_RESIZE ) {
							jQuery(window).trigger('resize');
							TRIGGER_RESIZE = false;
						} else {
							TRIGGER_RESIZE = true;
						}
					}, 128);
				});
			});

			jQuery('.carousel').carousel();
		<?php } else { ?>
				var altezza = "<?php echo ( !empty( $slider_image_height ) ) ? $slider_image_height : ""; ?>";
				var searchbar = jQuery('.bottomsearch').height();
				searchbar = (searchbar / 2) + 40;
				var altezza = altezza - searchbar;
				var larghezza = jQuery(window).width();
				var menu_above = jQuery('.slider-above');
				var menu_above_check = menu_above.length;

				jQuery('.vikcs-img-bckground-tagimg').css('height', altezza);

			jQuery('.carousel').carousel();
		<?php } ?>

		// SVG
		jQuery('img[src$=".svg"]').each(function() {
	        var $img = jQuery(this);
	        var imgURL = $img.attr('src');
	        var attributes = $img.prop("attributes");

	        jQuery.get(imgURL, function(data) {
	            // Get the SVG tag, ignore the rest
	            var $svg = jQuery(data).find('svg');

	            // Remove any invalid XML tags
	            $svg = $svg.removeAttr('xmlns:a');

	            // Loop through IMG attributes and apply on SVG
	            jQuery.each(attributes, function() {
	                $svg.attr(this.name, this.value);
	            });

	            // Replace IMG with SVG
	            $img.replaceWith($svg);
	        }, 'xml');
	    });
	});
	</script>
<?php
}
