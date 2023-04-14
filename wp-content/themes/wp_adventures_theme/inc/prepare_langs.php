<?php 
/*
 * String to translate of WPML and Polylang 
 */

defined('ABSPATH') or die('No script kiddies please!');

// Header Slider translated
$number_of_slides = 5;

for ($i = 0; $i <= $number_of_slides; $i++) {
	$adventures_slider_title = get_theme_mod('adventures_slider_' . $i . '_title');
	$adventures_slider_description = get_theme_mod('adventures_slider_' . $i . '_description');
	$readmtext = get_theme_mod('adventures_slider_' . $i . '_readmore');
	$adventures_slider_readmorelink = get_theme_mod('adventures_slider_' . $i . '_readmorelink');

	if($adventures_slider_title) {
		add_action('init', function() use ($adventures_slider_title, $i) {
			// POLYLANG
			if ( function_exists('pll_register_string') ) {
				pll_register_string('wp_adventures_theme', $adventures_slider_title);
			}

			// WPML
			if ( function_exists('icl_register_string') ) {
				icl_register_string( 'wp_adventures_theme', 'Slider Title ' . $i, $adventures_slider_title );
			}

			// WPML v2
			do_action( 'wpml_register_string', $adventures_slider_title, 'Slider Title ' . $i, array(
					'kind' 		=> 'Adventures Theme', 
					'name' 		=> 'slider-title-' . $i, 
					'title' 	=> 'Slider Title ' . $i,
					'edit_link' => '',
					'view_link' => ''
				),
				'Slider Title ' . $i,
				'LINE'
			);
		});
	}
	if($adventures_slider_description) {
		add_action('init', function() use ($adventures_slider_description, $i) {
			// POLYLANG
			if ( function_exists('pll_register_string') ) {
				pll_register_string('wp_adventures_theme', $adventures_slider_description);
			}

			// WPML
			if ( function_exists('icl_register_string') ) {
				icl_register_string( 'wp_adventures_theme', 'Slider Description ' . $i, $adventures_slider_description );
			}

			// WPML v2
			do_action( 'wpml_register_string', $adventures_slider_description, 'Slider Description ' . $i, array(
					'kind' 		=> 'Adventures Theme', 
					'name' 		=> 'slider-description-' . $i, 
					'title' 	=> 'Slider Description ' . $i,
					'edit_link' => '',
					'view_link' => ''
				),
				'Slider Description ' . $i,
				'AREA'
			);
		});
	}


	if($readmtext) {
		add_action('init', function() use ($readmtext, $i) {
			// POLYLANG
			if ( function_exists('pll_register_string') ) {
				pll_register_string('wp_adventures_theme', $readmtext);
			}

			// WPML
			if ( function_exists('icl_register_string') ) {
				icl_register_string( 'wp_adventures_theme', 'Read More Text ' . $i, $readmtext );
			}

			// WPML v2
			do_action( 'wpml_register_string', $readmtext, 'Slider Read More ' . $i, array(
					'kind' 		=> 'Adventures Theme', 
					'name' 		=> 'slider-readmore-' . $i, 
					'title' 	=> 'Slider Read More ' . $i,
					'edit_link' => '',
					'view_link' => ''
				),
				'Slider Read More ' . $i,
				'LINE'
			);

		});
	}
	if($adventures_slider_readmorelink) {
		add_action('init', function() use ($adventures_slider_readmorelink, $i) {
			// POLYLANG
			if ( function_exists('pll_register_string') ) {
				pll_register_string('wp_adventures_theme', $adventures_slider_readmorelink);
			}

			// WPML
			if ( function_exists('icl_register_string') ) {
				icl_register_string( 'wp_adventures_theme', 'Read More Link ' . $i, $adventures_slider_readmorelink );
			}

			// WPML v2
			do_action( 'wpml_register_string', $adventures_slider_readmorelink, 'Slider Read More Link ' . $i, array(
					'kind' 		=> 'Adventures Theme', 
					'name' 		=> 'slider-readmore-link-' . $i, 
					'title' 	=> 'Slider Read More Link ' . $i,
					'edit_link' => '',
					'view_link' => ''
				),
				'Slider Read More Link ' . $i,
				'AREA'
			);
		});
	}

}

// Static Header translated
$static_image_title = get_theme_mod('adventures_static_image_title', 'Static Image Title');

if($static_image_title) {

	add_action('init', function() use ($static_image_title, $i) {
		// POLYLANG
		if ( function_exists('pll_register_string') ) {
			pll_register_string('wp_adventures_theme', $static_image_title);
		}

		// WPML
		if ( function_exists('icl_register_string') ) {
			icl_register_string( 'wp_adventures_theme', 'Static Image Title', $static_image_title );
		}

		// WPML v2
		do_action( 'wpml_register_string', $static_image_title, 'Static Image Title', array(
				'kind' 		=> 'Adventures Theme', 
				'name' 		=> 'static-image-title', 
				'title' 	=> 'Static Image Title',
				'edit_link' => '',
				'view_link' => ''
			),
			'Static Image Title',
			'LINE'
		);
	});

}
$static_image_desc = get_theme_mod('adventures_static_image_desc', 'Static Image Caption' );

if($static_image_desc) {

	add_action('init', function() use ($static_image_desc, $i) {
		// POLYLANG
		if ( function_exists('pll_register_string') ) {
			pll_register_string('wp_adventures_theme', $static_image_desc);
		}

		// WPML
		if ( function_exists('icl_register_string') ) {
			icl_register_string( 'wp_adventures_theme', 'Static Image Description', $static_image_desc );
		}

		// WPML v2
		do_action( 'wpml_register_string', $static_image_desc, 'Static Image Description', array(
				'kind' 		=> 'Adventures Theme', 
				'name' 		=> 'static-image-desc', 
				'title' 	=> 'Static Image Description',
				'edit_link' => '',
				'view_link' => ''
			),
			'Static Image Description',
			'AREA'
		);

	});

}