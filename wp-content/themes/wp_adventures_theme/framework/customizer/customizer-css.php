<?php
/**
 * Adventures functions and definitions
 *
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Customize css
 */ 

function adventures_customizer_css() {

    ?>
    <style type="text/css">

    	/** Colors Font **/
        a { color: <?php echo get_theme_mod('adventures_main_color', '#555555'); ?>; }
        h1, h2, h3, h4, h5, h1 > a, h2 > a, h3 > a, h4 > a, h5 > a, h6 > a { color: <?php echo "#".get_header_textcolor(); ?>; }

        /** 
		 *	Font Choice 
		 *	@since 1.1.16
		 *	Added custom Google Fonts link.
		 *	If the Google Fonts area is empy, print the pre-selected Google Font, otherwise, print the Google Font custom added in the textarea.
		**/
		<?php if(empty(get_theme_mod('adventures_titlecustomfam_header', ''))) { ?>
       		.title-font, h1, h2, h3, h4 { font-family: "<?php echo esc_html(get_theme_mod('adventures_fonts_header', 'Lato')) ?>"; }
       		body { font-family: "<?php echo esc_html(get_theme_mod('adventures_bodyfonts_header', 'Lato')) ?>"; }
		<?php } else { ?>
			.title-font, h1, h2, h3, h4 { font-family: "<?php echo esc_html(get_theme_mod('adventures_titlecustom_namfam_header', '')) ?>"; }
       		body { font-family: "<?php echo esc_html(get_theme_mod('adventures_titlecustom_namfam_header', '')) ?>"; }
		<?php } ?> 
       	/** Font Size **/

       	body { font-size: <?php echo get_theme_mod('adventures_fontsize_body', '16'); ?>px; }
       	h1 { font-size: <?php echo get_theme_mod('adventures_fontsize_h1', '52'); ?>px; }
       	h2 { font-size: <?php echo get_theme_mod('adventures_fontsize_h2', '42'); ?>px; }
       	h3 { font-size: <?php echo get_theme_mod('adventures_fontsize_h3', '32'); ?>px; }
       	h4 { font-size: <?php echo get_theme_mod('adventures_fontsize_h4', '25'); ?>px; }
       	h5 { font-size: <?php echo get_theme_mod('adventures_fontsize_h5', '20'); ?>px; }
       	h6 { font-size: <?php echo get_theme_mod('adventures_fontsize_h6', '18'); ?>px; }
		.mainmenu .l-inline > div > ul > li { font-size: <?php echo get_theme_mod('adventures_fontsize_menu', '14'); ?>px; }
		
		/* 
       	 * If it has been setup the header above and not over the slider, take the color text from the customizer parameter. 
       	 */
		.slider-above .moduletable_menu .logo-align-cnt > ul > li > div > *, .slider-above .mainmenu .moduletable .logo-align-cnt > ul > li > div > *, 
		.slider-above .mainmenu .moduletable_menu .logo-align-cnt > ul > li > div > span, .slider-above .mainmenu .moduletable h3, .slider-above #tbar-upmenu .upmenu-content, 
		.fx-menu-slide .mainmenu .moduletable_menu .logo-align-cnt > ul > li > div > span, .fx-menu-slide .moduletable_menu .logo-align-cnt > ul > li > div > *,
		.fx-menu-slide .mainmenu .moduletable .logo-align-cnt > ul > li > div > * {
			color: <?php echo get_theme_mod('adventures_menu_color', ''); ?> !important;
		}
		.head-top-part #menumob-btn-ico span {
			background: <?php echo get_theme_mod('adventures_resp_ico_color', ''); ?>;
		}
		.slider-above .mainmenu .menu > .parent > .nav-child,
		.slider-above .modopen > div, .fx-menu-slide, .slider-above .mainmenu .nav > li > .nav-child {
			background: <?php echo get_theme_mod('adventures_header_bg', ''); ?>;
			border: 0;
		}
		.slider-above .mainmenu .nav-child li a, .slider-above .mainmenu .nav-child li span {
    		color: <?php echo get_theme_mod('adventures_menu_color', ''); ?>;
		}
		
		#tbar-upmenu .widget_mod_vikrentcar_currencyconverter select {
			background-color: transparent !important;
			color: <?php echo get_theme_mod('adventures_menu_color', ''); ?> !important;
		}
		#tbar-upmenu .widget_mod_vikrentcar_currencyconverter select {
			background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23666666' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") !important;
		}

     	/* Frontpage Section */
        <?php if('no' === get_theme_mod('adventures_settings_header', 'yes')) { ?>
		    .hp-page .entry-header .entry-title { display: none; }
		<?php } ?>

		 <?php if('0' === get_theme_mod('adventures_sett_show_fpage', 'yes')) { ?>
		    #main-inner.hp-page { display: none; }
		<?php } ?>
		
		/*** Header Image display type **/
		<?php if('cover' === get_theme_mod('adventures_header_img_settings', 'cover')) { ?>
			#imgheader { 
				background-size: cover; 
				background-attachment: fixed;
			}
		<?php } else { ?>
			#imgheader { 
				background-size: 100% auto; 
			}
    	<?php } ?>

		<?php 
			/* @since v1.1.19 
			 * Changed the slider full screen parameter. Remove the YES/NO select and check just if the fixed height has been filled. 
			 * If yes, the height will be applied by forcing the CSS.
			 */
		if(!empty(get_theme_mod('adventures_slider_image_height', ''))) {
				$slider_image_height = get_theme_mod('adventures_slider_image_height', '');
		?>
			.vikcs-slider-cstsld {
				height: <?php echo $slider_image_height; ?> !important;
			}
		<?php } ?>
		.vikcs-img-bckground-cstsld { 
			background-size: <?php echo get_theme_mod('adventures_image_bg_type', 'cover'); ?> !important; 
		}

		

    </style>
    <?php
}
add_action('wp_head', 'adventures_customizer_css');

function adventures_customizer_save_settings ($wp_customize) {

	$mainColor 		= $wp_customize->get_setting('adventures_main_color')->value();
	$secondColor 	= $wp_customize->get_setting('adventures_maindark_color')->value();
	$textColor 		= $wp_customize->get_setting("adventures_bodycol_color")->value();
	
	$COmainColor 	= ltrim($mainColor, '#');
	$COsecondColor 	= ltrim($secondColor, '#');
	$COtextColor 	= ltrim($textColor, '#');

	$inputFile 		= fopen(get_template_directory() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'theme-colors-template.css', 'r');
	$cssTemplate 	= fread($inputFile, filesize(get_template_directory() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'theme-colors-template.css'));

	$mainColorCount = substr_count($cssTemplate, 'COMAINCOLOR');
	$scndColorCount	= substr_count($cssTemplate, 'COSCNDCOLOR');
	$textColorCount	= substr_count($cssTemplate, 'COTEXTCOLOR');

	$cssTemplate 	= str_replace('COMAINCOLOR', $COmainColor, $cssTemplate, $mainColorCount);
	$cssTemplate 	= str_replace('COSCNDCOLOR', $COsecondColor, $cssTemplate, $scndColorCount);
	$cssTemplate 	= str_replace('COTEXTCOLOR', $COtextColor, $cssTemplate, $textColorCount);

	$mainColorCount = substr_count($cssTemplate, 'MAINCOLOR');
	$scndColorCount = substr_count($cssTemplate, 'SCNDCOLOR');
	$textColorCount = substr_count($cssTemplate, 'TEXTCOLOR');

	$cssTemplate	= str_replace('MAINCOLOR', $mainColor, $cssTemplate, $mainColorCount);
	$cssTemplate 	= str_replace('SCNDCOLOR', $secondColor, $cssTemplate, $scndColorCount);
	$cssTemplate 	= str_replace('TEXTCOLOR', $textColor, $cssTemplate, $textColorCount);	

	$outputFile = fopen(get_template_directory() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'theme-colors.css', 'w+');
	fwrite($outputFile, $cssTemplate);

	fclose($inputFile);
	fclose($outputFile);
}
add_action('customize_preview_init', 'adventures_customizer_save_settings');


