<?php

/*
* Function used to initialize the theme data
*/

defined('ABSPATH') or die('No script kiddies please!');

function adventures_content_init() {

	/* @since march 2021 - v.1.1.6
	 * Increase timeout limit in order to avoid problems during the installation process of the Sample Data 
	 */
	set_time_limit(300); 
	ini_set('max_execution_time', '300');

	// make sure VRC is installed, or return false by printing an error message
	if (!class_exists('JLoader')) {
		$url = admin_url();
		echo '<div style="background: #f6f6f6; border: 2px solid #c00; padding: 25px; font-family: Arial, Tahoma, sans-serif;">
		Vik Rent Car is not installed. Unable to install sample data. <br />
		<h4>What to do now?</h4>
		<ol>
			<li>Click on the "Back to the site" link</li>
			<li>Install or enable Vik Rent Car first</li>
			<li>Switch off the Theme with a different one, an example the standard Twenty Nineteen, and switch on our theme again.</li>
			<li>Now you can click on the button "Install Our Sample Data". Everything will work correctly.</li>
		</ol>
		<a style="font-weight: 400; margin-left: 0; margin-top: 3px; background: #0086be; color: #fff; display: inline-block; padding: 4px 8px; border-radius: 4px; text-decoration: none;" href=" '. $url .'/customize.php">Back to the site</a>
		</div>';

		exit;
	}

	/**
	 * ALWAYS MOVE OVERRIDES
	 * 
	 * IMPORTANT * - There is a similar block in the file function.php. Any modification needs to be done in both the files.
	 */

	// get the array information of the upload dir
	$upload_dir = wp_upload_dir();
	if (!is_array($upload_dir) || empty($upload_dir['basedir'])) {
		return false;
	}

	// load dependencies
	JLoader::import('adapter.filesystem.folder');

	// read the content of the overrides folder in the Theme's root dir
	$folders = JFolder::folders(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'overrides', $filter = '.', $recurse = false, $full = true);

	$base_dest = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'vikrentcar' . DIRECTORY_SEPARATOR . 'overrides' . DIRECTORY_SEPARATOR;

	foreach ($folders as $override_folder) {
		JFolder::copy($override_folder, $base_dest . basename($override_folder));
	}

	/**
	 * END
	 */

	require_once(ABSPATH . 'wp-admin/includes/image.php');

	check_admin_referer('e4jadventures.initialize');

	//@Page - Homepage as static front page

	$postarr = array(
		"post_title"	=> __("Homepage", "vikwp_adventures"),
		"post_content"	=> __("", "vikwp_adventures"),
		"post_status"	=> "publish",
		"post_type"		=> "page",
		"page_template"	=> "page-templates/page-homepage.php",
	);

	$postid = wp_insert_post($postarr, true);

	update_option( 'page_on_front', $postid );
	update_option( 'show_on_front', 'page' );

	/* -- */

	/* @hp - Testimonials posts and category */
	$categories["testimonials"] = array(add_category(
		"testimonials",
		__("Testimonials", "vikwp_adventures"),
		__("This is an example category created by Adventures Theme.", "vikwp_adventures")
	));

	add_post (
		__("Mark", "vikwp_adventures"),
		__("<p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>", "vikwp_adventures"),
		__("", "vikwp_adventures"),
		$categories["testimonials"],
		"https://vikwp.com/demo/themes/sample-data/general/testimonials/testimonial-01.jpg"
	);

	add_post (
		__("Francine", "vikwp_adventures"),
		__("<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>", "vikwp_adventures"),
		__("", "vikwp_adventures"),
		$categories["testimonials"],
		"https://vikwp.com/demo/themes/sample-data/general/testimonials/testimonial-02.jpg"
	);

	add_post (
		__("Joseph", "vikwp_adventures"),
		__("<p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>", "vikwp_adventures"),
		__("", "vikwp_adventures"),
		$categories["testimonials"],
		"https://vikwp.com/demo/themes/sample-data/general/testimonials/testimonial-03.jpg"
	);

	/* @hp - Who We Are - Category and Post */
	$categories["about"] = array(add_category(
		"about",
		__("About", "vikwp_adventures"),
		__("This is an example category created by Adventures Theme.", "vikwp_adventures")
	));

	add_post (
		__("Who We Are", "vikwp_adventures"),
		__("<!-- wp:paragraph -->
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eu arcu enim. Nunc turpis est, placerat a porta rutrum, aliquam a magna. Phasellus ac molestie urna. Fusce blandit quis nulla vel gravida. Donec quis mauris ut nisi pulvinar efficitur. </p>
		<!-- /wp:paragraph -->

		<!-- wp:more -->
		<!--more-->
		<!-- /wp:more -->

		<!-- wp:paragraph -->
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eu arcu enim. Nunc turpis est, placerat a porta rutrum, aliquam a magna. Phasellus ac molestie urna. Fusce blandit quis nulla vel gravida. Donec quis mauris ut nisi pulvinar efficitur. </p>
		<!-- /wp:paragraph -->", "vikwp_adventures"),
		__("", "vikwp_adventures"),
		$categories["about"],
		"https://vikwp.com/demo/themes/sample-data/vrc/adventures/who-we-are.jpg"
	);

	/* @aboutus - page */
	$int_post_one = array(
		"post_title"	=> __("About Us", "vikwp_adventures"),
		"post_content"	=> __("
		<!-- wp:image {\"id\":106,\"align\":\"right\",\"className\":\"img-thumb\"} -->
		<div class=\"wp-block-image img-thumb\"><figure class=\"alignright\"><img src=\"https://vikwp.com/demo/themes/sample-data/vrc/adventures/about-us-team.jpeg\" alt=\"\" class=\"wp-image-106\"/></figure></div>
		<!-- /wp:image -->

		<!-- wp:heading {\"className\":\"text-border-left text-color-inherit\"} -->
		<h2 class=\"text-border-left text-color-inherit\">What We Do</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph -->
		<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at ligula ac odio eleifend tincidunt ut vitae lorem.</strong></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph -->
		<p>Mauris et ultrices elit. Ut non quam ut nisi blandit condimentum  vehicula vel eros. Aenean rutrum tincidunt eros, vel pellentesque lorem  imperdiet eu. Nullam iaculis vestibulum urna, non tempor elit. Nullam  ornare tempus urna, a ornare ante porta eu. Integer euismod urna eu  porta hendrerit. Nullam  ornare tempus urna, a ornare ante porta eu. Integer euismod urna eu  porta hendrerit.</p>
		<!-- /wp:paragraph -->

		<!-- wp:quote -->
		<blockquote class=\"wp-block-quote\"><p>Integer at neque mi. Curabitur rutrum, magna eget commodo venenatis, ligula urna convallis enim, sit amet mattis risus nibh a ipsum. Maecenas tempor ornare nisi et vulputate.</p></blockquote>
		<!-- /wp:quote -->", "vikwp_adventures"),
		"post_status"	=> "publish",
		"post_type"		=> "page",
		"page_template"	=> "page-templates/page-about.php",
	);

	$int_post_one_id = wp_insert_post($int_post_one, true);

	generate_featured_image("https://vikwp.com/demo/themes/sample-data/vrc/adventures/about-us-keys.jpeg", $int_post_one_id);

	/* @fleet - page */
	$int_post_two = array(
		"post_title" 	=> __("Fleet", "vikwp_adventures"),
		"post_content"	=> __('', 'vikwp_adventures'),
		"post_status"	=> "publish",
		"post_type"		=> "page",
		"page_template"	=> "page-templates/page-sidebars.php",
	);

	$int_post_two_id = wp_insert_post($int_post_two, true);

	generate_featured_image("https://vikwp.com/demo/themes/sample-data/vrc/adventures/fleet.jpeg", $int_post_two_id);

	/* @blog - category and posts */
	$categories["blog"] = array(add_category(
		"blog",
		__("Blog", "vikwp_adventures"),
		__("This is an example category created by Adventures Theme.", "vikwp_adventures")
	));

	add_post (
		__("Top weekend destinations", "vikwp_adventures"),
		__("<!-- wp:paragraph -->
			<p>Nulla placerat feugiat aliquam. Quisque sapien mauris, malesuada eu  vulputate ac, venenatis ut ligula. Sed quis faucibus urna. Nulla in lorem quis nunc ultricies elementum. Donec ultrices velit at arcu 
			ultricies efficitur consequat non nulla. Donec mollis dapibus mauris sit amet blandit.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Cras vulputate nibh mi, vel ornare tortor sagittis id.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Quisque hendrerit sapien ac lacinia faucibus. Nunc iaculis, lacus 
			quis tempus pharetra, eros ligula suscipit odio, at mattis eros risus nec mi. In elementum rhoncus sapien, a volutpat erat dapibus at. Morbi nibh sapien, convallis vitae volutpat non, venenatis sit amet purus. 
			Suspendisse malesuada vehicula lorem semper feugiat. Donec eget justo ullamcorper, elementum lorem a, blandit neque. Sed pellentesque orci at eros porta, eu viverra arcu blandit.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Nam porttitor posuere purus, vitae semper lacus consequat eget. Fusce vel porta nisi, ac laoreet tortor. Sed a pretium sem. Etiam tempor convallis nulla et bibendum. Suspendisse urna sem, lacinia in auctor vitae, tincidunt sit amet nisl. Pellentesque nec felis diam. Nullam euismod nulla ut mi efficitur, eget efficitur velit semper. Cras volutpat faucibus tincidunt. Curabitur eget magna sollicitudin, 
			ultricies ipsum ut, tempor turpis. Maecenas ultrices elementum libero, euismod placerat ante accumsan ac. Mauris pretium lectus quis odio dapibus, vitae viverra purus semper. Pellentesque nisl sem, vestibulum quis est eget, fringilla posuere felis. Pellentesque et mollis erat, sit  amet tempus lorem. Fusce convallis et dui sit amet fringilla.</p>
			<!-- /wp:paragraph -->", "vikwp_adventures"),
		__("Nulla placerat feugiat aliquam. Quisque sapien mauris, malesuada eu vulputate ac, venenatis ut ligula. Sed quis faucibus urna.  Quisque hendrerit sapien ac lacinia faucibus. Nunc iaculis, lacus quis tempus pharetra, eros ligula suscipit odio, at mattis eros risus. Suspendisse urna sem, lacinia in auctor vitae, tincidunt sit amet nisl. Pellentesque nec felis diam. Nullam euismod nulla ut mi efficitur, eget efficitur velit semper.", "vikwp_adventures"),
		$categories["blog"],
		"https://vikwp.com/demo/themes/sample-data/vrc/adventures/blog-03.jpg"
	);
	
	add_post (
		__("Top 10 Dangerous Roads", "vikwp_adventures"),
		__("<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus 
			quis efficitur dolor. Vivamus varius interdum tortor vel egestas. Ut 
			elementum neque nec massa tincidunt, eu imperdiet lacus ultrices. 
			Suspendisse quis vestibulum leo, eget hendrerit felis. Nunc pellentesque volutpat elementum.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Aenean at sapien ut augue consectetur commodo nec eget felis. Nunc maximus sem mollis lorem sagittis, nec lacinia ligula dapibus. 
			Suspendisse finibus luctus justo, vitae pharetra velit consectetur 
			sagittis. Quisque lacus enim, pretium bibendum rhoncus id, placerat in nulla.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Vestibulum tempor tempor vulputate. Fusce mollis porta dapibus. Ut faucibus sem quam, quis lacinia urna sollicitudin fringilla. In a eros nec justo sollicitudin condimentum id ultricies augue. Curabitur vitae ullamcorper lectus. Duis ullamcorper, lorem eu sagittis sollicitudin, justo dolor posuere purus, sit amet scelerisque nisl enim in dui. Nullam lacinia magna id orci rhoncus accumsan. Etiam laoreet tempor felis, ut auctor lectus molestie nec. Donec vel nisl luctus, faucibus arcu at, vulputate nulla. Duis sit amet malesuada metus, sit amet accumsan libero. Interdum et malesuada fames ac ante ipsum primis in faucibus. 
			Cras tincidunt, nisi ac tristique vestibulum, diam dolor cursus lectus, eget sollicitudin nisi mi a quam. Morbi scelerisque dignissim nisl placerat finibus.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Nulla placerat feugiat aliquam. Quisque sapien mauris, malesuada eu vulputate ac, venenatis ut ligula. Sed quis faucibus urna. Nulla in lorem quis nunc ultricies elementum. Donec ultrices velit at arcu 
			ultricies efficitur consequat non nulla. Donec mollis dapibus mauris sit  amet blandit. Cras vulputate nibh mi, vel ornare tortor agittis id.</p>
			<!-- /wp:paragraph -->", "vikwp_adventures"),
		__("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis efficitur dolor. Vivamus varius interdum tortor vel egestas. Ut elementum neque nec massa tincidunt, eu imperdiet lacus ultrices. Suspendisse quis vestibulum leo, eget hendrerit felis. Nunc pellentesque volutpat elementum.", "vikwp_adventures"),
		$categories["blog"],
		"https://vikwp.com/demo/themes/sample-data/vrc/adventures/blog-02.jpeg"
	);

	add_post (
		__("Know your Fuel Policies", "vikwp_adventures"),
		__("<!-- wp:paragraph -->
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus 
			quis efficitur dolor. Vivamus varius interdum tortor vel egestas. Ut 
			elementum neque nec massa tincidunt, eu imperdiet lacus ultrices. 
			Suspendisse quis vestibulum leo, eget hendrerit felis. Nunc pellentesque  volutpat elementum. Aenean at sapien ut augue consectetur commodo nec eget felis.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Nunc maximus sem mollis lorem sagittis, nec lacinia ligula dapibus. 
			Suspendisse finibus luctus justo, vitae pharetra velit consectetur 
			sagittis. Quisque lacus enim, pretium bibendum rhoncus id, placerat in nulla.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Vestibulum tempor tempor vulputate. Fusce mollis porta dapibus. Ut faucibus sem quam, quis lacinia urna sollicitudin fringilla. In a eros nec justo sollicitudin condimentum id ultricies augue. Curabitur vitae ullamcorper lectus. Duis ullamcorper, lorem eu sagittis sollicitudin, justo dolor posuere purus, sit amet scelerisque nisl enim in dui. Nullam lacinia magna id orci rhoncus accumsan. Etiam laoreet tempor felis, ut auctor lectus molestie nec. Donec vel nisl luctus, faucibus arcu at, vulputate nulla. Duis sit amet malesuada metus, sit amet accumsan libero. Interdum et malesuada fames ac ante ipsum primis in faucibus. 
			Cras tincidunt, nisi ac tristique vestibulum, diam dolor cursus lectus, eget sollicitudin nisi mi a quam. Morbi scelerisque dignissim nisl placerat finibus.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Nulla placerat feugiat aliquam. Quisque sapien mauris, malesuada eu vulputate ac, venenatis ut ligula. Sed quis faucibus urna. Nulla in lorem quis nunc ultricies elementum. Donec ultrices velit at arcu 
			ultricies efficitur consequat non nulla. Donec mollis dapibus mauris sit amet blandit. Cras vulputate nibh mi, vel ornare tortor sagittis id.</p>
			<!-- /wp:paragraph -->", "vikwp_adventures"),
		__("Nulla placerat feugiat aliquam. Quisque sapien mauris, malesuada eu vulputate ac, venenatis ut ligula. Sed quis faucibus urna. Nulla in lorem quis nunc ultricies elementum. Donec ultrices velit at arcu ultricies efficitur consequat non nulla. Donec mollis dapibus mauris sit amet blandit.", "vikwp_adventures"),
		$categories["blog"],
		"https://vikwp.com/demo/themes/sample-data/vrc/adventures/blog-01.jpeg"
	);

	/* @contactus - page */
	$int_post_three = array(
		"post_title" 	=> __("Contact Us", "vikwp_adventures"),
		"post_content"	=> __('<!-- wp:paragraph {"align":"center"} -->
		<p style="text-align:center">Lorem ipsum dolor sit amet, consectetur
		 adipiscing elit. Pellentesque eu arcu enim. Nunc turpis est, placerat a porta rutrum, aliquam a magna. Phasellus ac molestie urna. Fusce blandit quis nulla vel gravida. Donec quis mauris ut nisi pulvinar efficitur. Curabitur in imperdiet orci, quis sollicitudin dolor. Sed nulla metus, varius ac aliquet vitae, hendrerit eu arcu. Curabitur diam libero, iaculis at auctor quis, porta efficitur justo.</p>
		<!-- /wp:paragraph -->', 'vikwp_adventures'),
		"post_status"	=> "publish",
		"post_type"		=> "page",
		"page_template"	=> "page-templates/page-contactus.php",
	);

	$int_post_three_id = wp_insert_post($int_post_three, true);

	generate_featured_image("https://vikwp.com/demo/themes/sample-data/vrc/adventures/contact-page.jpg", $int_post_three_id);

	/* @Search - page */
	$int_post_four = array(
		"post_title" 	=> __("Search", "vikwp_adventures"),
		"post_content"	=> __('', 'vikwp_adventures'),
		"post_status"	=> "publish",
		"post_type"		=> "page",
	);

	$int_post_four_id = wp_insert_post($int_post_four, true);

	generate_featured_image("https://vikwp.com/demo/themes/sample-data/vrc/adventures/car-sun.jpg", $int_post_four_id);

	/* @YourOrders - page */
	$int_post_five = array(
		"post_title" 	=> __("Your Orders", "vikwp_adventures"),
		"post_content"	=> __('', 'vikwp_adventures'),
		"post_status"	=> "publish",
		"post_type"		=> "page",
	);

	$int_post_five_id = wp_insert_post($int_post_five, true);

	/* @Locations - page */
	$int_post_six = array(
		"post_title" 	=> __("Locations", "vikwp_adventures"),
		"post_content"	=> __('', 'vikwp_adventures'),
		"post_status"	=> "publish",
		"post_type"		=> "page",
	);

	$int_post_six_id = wp_insert_post($int_post_six, true);

	/* @Promotions - page */
	$int_post_seven = array(
		"post_title" 	=> __("Promotions", "vikwp_adventures"),
		"post_content"	=> __('', 'vikwp_adventures'),
		"post_status"	=> "publish",
		"post_type"		=> "page",
	);

	$int_post_seven_id = wp_insert_post($int_post_seven, true);

	generate_featured_image("https://vikwp.com/demo/themes/sample-data/vrc/adventures/who-we-are.jpg", $int_post_seven_id);


	/* @menu - Create Menu and add a post as a link and pick it's location */
	// Check if the menu exists
	$mainmenu_name = __("Main Menu - Sample VikWP", "vikwp_adventures");
	$rightmenu_name = __("Main Menu Right - Sample VikWP", "vikwp_adventures");
	$footermenu_name = __("Footer - Sample VikWP", "vikwp_adventures");
	$mainmenu_exists = wp_get_nav_menu_object( $mainmenu_name );
	$rightmenu_exists = wp_get_nav_menu_object( $rightmenu_name );
	$footermenu_exists = wp_get_nav_menu_object( $footermenu_name );

	// @menu - Main Menu
	if( !$mainmenu_exists ){
		$menu_id = wp_create_nav_menu($mainmenu_name);
		$nav_menu_locations = get_theme_mod( 'nav_menu_locations' );
		$nav_menu_locations['main-menu'] = $menu_id;

		set_theme_mod( 'nav_menu_locations', $nav_menu_locations);

		$page = get_post($postid);
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' 	=>  __('Home', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-status'	=> 'publish'
	    ));

		$page = get_post($int_post_one_id);
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' 	=>  __('About Us', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-status'	=> 'publish'
	    ));

	    $page = get_post($int_post_two_id);
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' 	=>  __('Fleet', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-status'	=> 'publish'
	    ));

	    $category_id = get_cat_ID('Blog');
	    wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title' 	=>  __('Blog', "vikwp_adventures"),
			'menu-item-object-id' => $category_id,
			'menu-item-db-id'	=> 0,
			'menu-item-object'	=> 'category',
			'menu-item-parent-id'	=> $parent_item,
			'menu-item-type'	=> 'taxonomy',
			'menu-item-url'		=> get_category_link($category_id),
			'menu-item-status'	=> 'publish'
		));
	}

	// @menu - Right Menu
	if( !$rightmenu_exists ){
		$rightmenu_id = wp_create_nav_menu($rightmenu_name);
		$nav_menu_locations = get_theme_mod( 'nav_menu_locations' );
		$nav_menu_locations['main-menu-right'] = $rightmenu_id;

		set_theme_mod( 'nav_menu_locations', $nav_menu_locations);

	    $page = get_post($int_post_three_id);
	    wp_update_nav_menu_item($rightmenu_id, 0, array(
	        'menu-item-title' 	=>  __('Contact Us', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-status'	=> 'publish'
	    ));

	    $parent_item = wp_update_nav_menu_item($rightmenu_id, 0, array(
			'menu-item-title' 	=>  __('Views', "vikwp_adventures"),
			'menu-item-url' => '/',
			'menu-item-type'	=> 'custom',
			'menu-item-status'	=> 'publish'
	    ));

	    	$page = get_post($int_post_seven_id);
			wp_update_nav_menu_item($rightmenu_id, 0, array(
				'menu-item-title' 	=>  __('Promotions', "vikwp_adventures"),
				'menu-item-object-id' => $page->ID,
				'menu-item-object'	=> 'page',
				'menu-item-parent-id'	=> $parent_item,
				'menu-item-type'	=> 'post_type',
				'menu-item-status'	=> 'publish'
		    ));

		    $page = get_post($int_post_five_id);
			wp_update_nav_menu_item($rightmenu_id, 0, array(
				'menu-item-title' 	=>  __('Your Orders', "vikwp_adventures"),
				'menu-item-object-id' => $page->ID,
				'menu-item-object'	=> 'page',
				'menu-item-parent-id'	=> $parent_item,
				'menu-item-type'	=> 'post_type',
				'menu-item-status'	=> 'publish'
		    ));

		    $page = get_post($int_post_six_id);
			wp_update_nav_menu_item($rightmenu_id, 0, array(
				'menu-item-title' 	=>  __('Locations', "vikwp_adventures"),
				'menu-item-object-id' => $page->ID,
				'menu-item-object'	=> 'page',
				'menu-item-parent-id'	=> $parent_item,
				'menu-item-type'	=> 'post_type',
				'menu-item-status'	=> 'publish'
		    ));

		$page = get_post($int_post_four_id);
	    wp_update_nav_menu_item($rightmenu_id, 0, array(
	        'menu-item-title' 	=>  __('Book Now', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-classes'	=> 'linkmenu-alt',
	        'menu-item-status'	=> 'publish'
	    ));
	}

	// @menu - Footer
	if( !$footermenu_exists ){
		$footermenu_id = wp_create_nav_menu($footermenu_name);

		$page = get_post($int_post_one_id);
	    wp_update_nav_menu_item($footermenu_id, 0, array(
	        'menu-item-title' 	=>  __('About Us', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-status'	=> 'publish'
	    ));

	    $page = get_post($int_post_three_id);
	    wp_update_nav_menu_item($footermenu_id, 0, array(
	        'menu-item-title' 	=>  __('Contact Us', "vikwp_adventures"),
	        'menu-item-object-id' => $page->ID,
	        'menu-item-object'	=> 'page',
	        'menu-item-type'	=> 'post_type',
	        'menu-item-status'	=> 'publish'
	    ));

	    wp_update_nav_menu_item($footermenu_id, 0, array(
			'menu-item-title' 	=>  __('Terms and Conditions', "vikwp_adventures"),
			'menu-item-url'		=> '#',
			'menu-item-status'	=> 'publish'
		));

		wp_update_nav_menu_item($footermenu_id, 0, array(
			'menu-item-title' 	=>  __('FAQ', "vikwp_adventures"),
			'menu-item-url'		=> '#',
			'menu-item-status'	=> 'publish'
		));
	}

	// Homepage Enable Title
	set_theme_mod("adventures_settings_header", "no");

	// Header Position - Homepage
	set_theme_mod("adventures_headset_hp", "over-slider");

	// Header Position - Internal Page
	set_theme_mod("adventures_headset_ip", "over-slider");

	//Setup Meta info
	set_theme_mod("adventures_settings_postmeta_general", "no");

	// @slider - Changing slider images
	set_theme_mod("adventures_header_activate_settings", "slider");
	set_theme_mod("adventures_slider_fullscreen", "yes");
	set_theme_mod("adventures_slider_dotsnav", "no");
	set_theme_mod("adventures_slider_maskopacity", 0.6);

	// @slider - Inserting slide 1
	$image_url = "https://vikwp.com/demo/themes/sample-data/vrc/adventures/adventures_slider_01.jpg";
	$upload_dir = wp_upload_dir();
	$filename = basename($image_url);
	$image_data = file_get_contents($image_url);

	if (wp_mkdir_p($upload_dir['path'])) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents($file, $image_data);

	$wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file);
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	set_theme_mod("adventures_slider_1_image", wp_get_attachment_url($attach_id));
	set_theme_mod("adventures_slider_1_title", "Ready for a ride?");
	set_theme_mod("adventures_slider_1_description", "Enjoy your travel");
	set_theme_mod("adventures_slider_1_readmore", "Read More");
	set_theme_mod("adventures_slider_1_readmorelink", "#");
	set_theme_mod("adventures_slider_1_title_tag", 1);

	// @slider - Inserting slide 2
	$image_url = "https://vikwp.com/demo/themes/sample-data/vrc/adventures/adventures_slider_03.jpeg";
	$filename = basename($image_url);
	$image_data = file_get_contents($image_url);

	if (wp_mkdir_p($upload_dir['path'])) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents($file, $image_data);

	$wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file);
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	set_theme_mod("adventures_slider_2_image", wp_get_attachment_url($attach_id));
	set_theme_mod("adventures_slider_2_title", "Rent our Cars");
	set_theme_mod("adventures_slider_2_description", "The best for your holidays");
	set_theme_mod("adventures_slider_2_readmore", "Read More");
	set_theme_mod("adventures_slider_2_readmorelink", "#");
	set_theme_mod("adventures_slider_2_title_tag", 2);

	// @slider - Inserting slide 3
	$image_url = "https://vikwp.com/demo/themes/sample-data/vrc/adventures/adventures_slider_02.jpeg";
	$filename = basename($image_url);
	$image_data = file_get_contents($image_url);

	if (wp_mkdir_p($upload_dir['path'])) {
		$file = $upload_dir['path'] . '/' . $filename;
	} else {
		$file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents($file, $image_data);

	$wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file);
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	set_theme_mod("adventures_slider_3_image", wp_get_attachment_url($attach_id));
	set_theme_mod("adventures_slider_3_title", "Ready to the adventures");
	set_theme_mod("adventures_slider_3_description", "Discover our fleet");
	set_theme_mod("adventures_slider_3_readmore", "Read More");
	set_theme_mod("adventures_slider_3_readmorelink", "#");
	set_theme_mod("adventures_slider_3_title_tag", 3);

	/* Widget page layout - Setup the new wp 6 page */
	set_theme_mod("adventures_classic_widgets", "no");

	//Saving test data insertion
	update_option('adventures_test_data',1);

	// now install the widgets
	$active_widgets = get_option( 'sidebars_widgets' );
	$canWrite = get_option('vikwp_adventures_write_widgets', true);
	$counter = 1;

	// @VRC - Creation Shortcode and association to the relative page ID
	if (defined('VIKRENTCAR_SOFTWARE_VERSION')) {
		$model = JModel::getInstance('vikrentcar', 'shortcode', 'admin');

		// Fleet - @shortcode
		$shortobj = new stdClass;
		$shortobj->id = 0;
		$shortobj->title = "COM_VIKRENTCAR_CARSLIST_VIEW_DEFAULT_TITLE";
		$shortobj->name = "Cars List";
		$shortobj->type = "carslist";
		$shortobj->createdon = JDate::getInstance()->toSql();
		$shortobj->json = array(
			'category_id' => '',
			'orderby'	=>	'price',
			'ordertype'	=> 'asc',
			'lim'	=>	20
		);
		$shortobj->shortcode = JFilterOutput::shortcode('vikrentcar', array_merge($shortobj->json, array('view' => $shortobj->type)));
		$shortobj->json = json_encode($shortobj->json);
		$shortobj->post_id = $int_post_two_id;
		
		$model->save($shortobj);

		$tmp = get_post($int_post_two_id);
		$tmp->post_content = $shortobj->shortcode;
		wp_update_post($tmp);

		// Your Orders - @shortcode
		$shortobj = new stdClass;
		$shortobj->id = 0;
		$shortobj->title = "COM_VIKRENTCAR_USERORDERS_VIEW_DEFAULT_TITLE";
		$shortobj->name = "User Orders";
		$shortobj->type = "userorders";
		$shortobj->createdon = JDate::getInstance()->toSql();
		$shortobj->json = array(
			'searchorder' => ''
		);
		$shortobj->shortcode = JFilterOutput::shortcode('vikrentcar', array_merge($shortobj->json, array('view' => $shortobj->type)));
		$shortobj->json = json_encode($shortobj->json);
		$shortobj->post_id = $int_post_five_id;
		
		$model->save($shortobj);

		$tmp = get_post($int_post_five_id);
		$tmp->post_content = $shortobj->shortcode;
		wp_update_post($tmp);

		// Locations - @shortcode
		$shortobj = new stdClass;
		$shortobj->id = 0;
		$shortobj->title = "COM_VIKRENTCAR_LOCATIONSLIST_VIEW_DEFAULT_TITLE";
		$shortobj->name = "Locations List";
		$shortobj->type = "locationslist";
		$shortobj->createdon = JDate::getInstance()->toSql();
		$shortobj->json = array();
		$shortobj->shortcode = JFilterOutput::shortcode('vikrentcar', array_merge($shortobj->json, array('view' => $shortobj->type)));
		$shortobj->json = json_encode($shortobj->json);
		$shortobj->post_id = $int_post_six_id;
		
		$model->save($shortobj);

		$tmp = get_post($int_post_six_id);
		$tmp->post_content = $shortobj->shortcode;
		wp_update_post($tmp);

		// Promotions - @shortcode
		$shortobj = new stdClass;
		$shortobj->id = 0;
		$shortobj->title = "COM_VIKRENTCAR_PROMOTIONS_VIEW_DEFAULT_TITLE";
		$shortobj->name = "Promotions";
		$shortobj->type = "promotions";
		$shortobj->createdon = JDate::getInstance()->toSql();
		$shortobj->json = array(
			'showcars' => '',
			'maxdate'	=> '',
			'lim'	=> ''
		);
		$shortobj->shortcode = JFilterOutput::shortcode('vikrentcar', array_merge($shortobj->json, array('view' => $shortobj->type)));
		$shortobj->json = json_encode($shortobj->json);
		$shortobj->post_id = $int_post_seven_id;
		
		$model->save($shortobj);

		$tmp = get_post($int_post_seven_id);
		$tmp->post_content = $shortobj->shortcode;
		wp_update_post($tmp);

		// Search - @shortcode
		$shortobj = new stdClass;
		$shortobj->id = 0;
		$shortobj->title = "COM_VIKRENTCAR_VIKRENTCAR_VIEW_DEFAULT_TITLE";
		$shortobj->name = "Search";
		$shortobj->type = "vikrentcar";
		$shortobj->createdon = JDate::getInstance()->toSql();
		$shortobj->json = array();
		$shortobj->shortcode = JFilterOutput::shortcode('vikrentcar', array_merge($shortobj->json, array('view' => $shortobj->type)));
		$shortobj->json = json_encode($shortobj->json);
		$shortobj->post_id = $int_post_four_id;
		
		$model->save($shortobj);

		$tmp = get_post($int_post_four_id);
		$tmp->post_content = $shortobj->shortcode;
		wp_update_post($tmp);
	}

	// VikWidgetLoader
	if ($canWrite && is_plugin_active('vikwidgetsloader/vikwidgetsloader.php')) {

		/* SCRIVI QUI

		Passi per aggiungere una widget:

			1. Leggi i nomi ed i parametri degli widget di VikWidgetsLoader aggiungendo '&check_widgets' in fondo all'URL del Customizer
			2. Definisci i parametri del nuovo widget in un array $parameters esempio:

				$parameters = array(
					['title'] => "New Title",
					['category_id'] => 7
				);

			3. Chiama la funzione 'adventures_add_new_widget'. Puoi vedere il nome delle sidebar nell'array $sidebars presente sopra.

				adventures_add_new_widget($active_widgets, '<nome_della_sidebar>', '<nome_del_widget>', $counter, $parameters);

		*/

		// @VRC - Widgets
		// VikRentCar Currency Converter
		$parameters = array(
			'title'			=> "",
			'vrconly'		=> 0,
			'currencies'	=> 'EUR: Euro',
			'currencynameformat'	=> 3
		);
		adventures_add_new_widget($active_widgets, 'topbar', 'mod_vikrentcar_currencyconverter', $counter, $parameters);

		// VikRentCar Search
		$parameters = array(
			'title'			=> "Cauta-ti vehiculul",
			'orientation'	=> 'horizontal',
			'srchbtntext'	=> '<i class="fas fa-search"></i>',
			'itemid'		=> $int_post_four_id
		);
		adventures_add_new_widget($active_widgets, 'header-inner', 'mod_vikrentcar_search', $counter, $parameters);

		// VikRentCar Cars
		$parameters = array(
			'title'			=> "OUR FLEET",
			'numb_carrow'	=> 3,
			'pagination'	=> 0,
			'navigation'	=> 1,
			'itemid'		=> $int_post_four_id
		);
		adventures_add_new_widget($active_widgets, 'module-box-01', 'mod_vikrentcar_cars', $counter, $parameters);

		// @home - Widgets
		//vikwp_icons - Top Bar Left
		$parameters = array(
			'title' => "",
			'icons_displayed' => 3,
			'icon_size' => 18,
			'icon_style' => "default",
			'container_size' => 1,
			'content_alignment' => 1,
			'icon_alignment' => "top",
			'icon_padding' => 1,
			'icon_0_type' => 'fab',
			'icon_0_selected' => "facebook",
			'icon_0_readmore' => "#",
			'icon_1_type' => 'fab',
			'icon_1_selected' => "twitter",
			'icon_1_readmore' => '#',
			'icon_2_type' => 'fab',
			'icon_2_selected' => "tripadvisor",
			'icon_2_readmore' => "#"
		);
		adventures_add_new_widget($active_widgets, 'topbar-left', 'vikwp_icons', $counter, $parameters);

		//vikwp_icons - Extra Service Section
		$parameters = array(
			'title' => "EXTRA SERVICE",
			'icons_displayed' => 6,
			'icon_size' => 24,
			'icon_style' => "default",
			'container_size' => 0,
			'content_alignment' => 1,
			'icon_alignment' => "left",
			'icon_padding' => 4,
			'icon_0_type' => 'fa',
			'icon_0_selected' => "bus",
			'icon_0_title' => "Airport Shuttle",
			'icon_0_description' => "There are many variations of passages of Lorem Ipsum available.",
			'icon_1_type' => 'fa',
			'icon_1_selected' => "phone",
			'icon_1_title' => "Support H24",
			'icon_1_description' => "By injected humour, or randomised words which don't look even slightly.",
			'icon_2_type' => 'fa',
			'icon_2_selected' => "award",
			'icon_2_title' => "Premium Quality",
			'icon_2_description' => "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
			'icon_3_type' => 'fa',
			'icon_3_selected' => "map-marker-alt",
			'icon_3_title' => "Go Anywhere",
			'icon_3_description' => "Contrary to popular belief, Lorem Ipsum is not simply random text. The point of using Lorem Ipsum.",
			'icon_4_type' => 'fa',
			'icon_4_selected' => "fa-shield-alt",
			'icon_4_title' => "Damage Covered",
			'icon_4_description' => "It was popularised in the 1960s with the release of Letraset sheets containing Lorem.",
			'icon_5_type' => 'fa',
			'icon_5_selected' => "thumbs-up",
			'icon_5_title' => "No hidden prices",
			'icon_5_description' => "It is a long established fact that a reader will be distracted by the readable content of a page.",
			'class_suffix' => "mod-services text-center"
		);
		adventures_add_new_widget($active_widgets, 'module-box-02', 'vikwp_icons', $counter, $parameters);

		//vikwp_textslide - Testimonials
		$term_textslide = term_exists( __("Testimonials", "vikwp_adventures"), 'category' );
		if ( $term_textslide !== 0 && $term_textslide !== null && is_array($term_textslide) ) {
			$term_textslide = $term_textslide['term_id'];
		} else {
			$term_textslide = 1;
		}

		$parameters = array(
			'title' => "",
			'class_suffix' => "",
			'image'	=>	'https://vikwp.com/demo/themes/sample-data/vrc/adventures/car-sun.jpg',
			'textarea'	=> "",
			'enable_mask' => 1,
			'opacity_mask'	=> 0.6,
			'testimonial_box_height' => 200,
			'title_effect' => "none",
			'desc_effect' => "none",
			'testimonials' => 1,
			'ts_category_id' => $term_textslide,
			'quotes' => 1,
			'testimonial_box_width' => "100%",
			'testimonials_layout' 	=> 1,
			'testimonials_xrow'		=> 1,
			'testimonials_img_pos'	=> 'up',
			'testimonial_time_delay' => 2000,
			'testimonial_time_fadein' => 1000,
			'testimonial_time_fadeout' => 500,
			'testimonial_post_title' => 1,
			'testimonials_arrows'	=> 0,
			'testimonials_dots'		=> 1			
		);
		adventures_add_new_widget($active_widgets, 'module-box-03', 'vikwp_textslide', $counter, $parameters);

		//vikwp_gridcontent - Who we are
		$term_textslide = term_exists( __("About", "vikwp_adventures"), 'category' );
		if ( $term_textslide !== 0 && $term_textslide !== null && is_array($term_textslide) ) {
			$term_textslide = $term_textslide['term_id'];
		} else {
			$term_textslide = 1;
		}

		$parameters = array(
			'title' => "",
			'class_suffix' => "",
			'bg_image'	=> '',
			'gridcont_category_id' => $term_textslide,
			'gridcont_numb_limit' => 1,
			'gridcont_readmore' => 0,
			'gridcont_number_of_rows' => 1,
			'gridcont_show_allposts' => 0
		);
		adventures_add_new_widget($active_widgets, 'module-box-04', 'vikwp_gridcontent', $counter, $parameters);

		//vikwp_googlemaps
		$parameters = array(
			'title' => "",
			'width' => "100%",
			'height' => "400px",
			'apikey' => "yourapikey",
			'shadowpoint_left' => 16,
			'shadowpoint_right' => 34,
			'map_style' => 0,
			'map_zoom' => 8,
			'center_lat' => 44.5958448,
			'center_lng' => 11.0627082,
			'markers_amount' => 2,
			'contact_enabled' => 0,
			'viktitle_1' => "Florence Airport",
			'viktext_1' => "",
			'vikshape_1' => "",
			'vikshadow_1' => "",
			'viklat_1' => 43.8086534,
			'viklng_1' => 11.2012247,
			'viktitle_2' => "Bologna Airport",
			'viktext_2' => "",
			'vikshape_2' => "",
			'vikshadow_2' => "",
			'viklat_2' => 44.5345254,
			'viklng_2' => 11.2856706
		);
		adventures_add_new_widget($active_widgets, 'module-box-05', 'vikwp_googlemaps', $counter, $parameters);

		//vikwp_icons - Upfooter
		$parameters = array(
			'title' => "",
			'icons_displayed' => 3,
			'icon_size' => 24,
			'icon_style' => "default",
			'container_size' => 0,
			'content_alignment' => 1,
			'icon_alignment' => "left",
			'icon_padding' => 4,
			'icon_0_type' => 'fa',
			'icon_0_selected' => "map-marker-alt",
			'icon_0_title' => "LOCATION",
			'icon_0_description' => "4642 Auerbach Ave",
			'icon_1_type' => 'fa',
			'icon_1_selected' => "phone",
			'icon_1_title' => "TELEPHONE",
			'icon_1_description' => "(804)-213-5959",
			'icon_2_type' => 'fa',
			'icon_2_selected' => "envelope",
			'icon_2_title' => "CONTACT US",
			'icon_2_description' => "customers.service@website.com",
			'class_suffix' => "icons-style2 black-bg"
		);
		adventures_add_new_widget($active_widgets, 'upfooter', 'vikwp_icons', $counter, $parameters);

		/* @footer - widgets */
		// Company Info - widget_text
		$parameters = array(
			'title' => "ADVENTURES THEME",
			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eu arcu enim. Nunc turpis est, placerat a porta rutrum, aliquam a magna. Phasellus ac molestie urna."
		);
		adventures_add_new_widget($active_widgets, 'sidebar-footer', 'custom_html', $counter, $parameters);

		// Navigation Menu - widget_nav_menu
		$parameters = array(
			'title' => "INFORMATION",
			'nav_menu' => $footermenu_id
		);
		adventures_add_new_widget($active_widgets, 'sidebar-footer', 'nav_menu', $counter, $parameters);

		// Company Info - widget_text
		$parameters = array(
			'title' => "OPENING TIME",
			'content' => "<p>Monday - Friday: 08:30 - 21:00</p>
						<p>Saturday - Sunday: 08:30 - 22:00</p>"
		);
		adventures_add_new_widget($active_widgets, 'sidebar-footer', 'custom_html', $counter, $parameters);

		/* @aboutus - widgets */
		// vikwp_counter
		$parameters = array(
			'title' 	=> "TRUST TO OUR NUMBERS",
			'counter_displayed'	=> 4,
			'counter_padding'	=> 3,

			'counter_0_type' => 'fas',
			'counter_0_selected'	=> 'smile',
			'counter_0_value'	=> 650,
			'counter_0_title'	=> 'CUSTOMERS',

			'counter_1_type' => 'fas',
			'counter_1_selected'	=> 'car',
			'counter_1_value'	=> 40,
			'counter_1_title'	=> 'VEHICLES',

			'counter_2_type' => 'far',
			'counter_2_selected'	=> 'certificate',
			'counter_2_value'	=> 15,
			'counter_2_title'	=> 'YEARS OF EXPERIENCE',

			'counter_3_type' => 'far',
			'counter_3_selected'	=> 'map-marked-alt',
			'counter_3_value'	=> 4,
			'counter_3_title'	=> 'LOCATIONS',
			'class_suffix'	=> 'bg-grey'
		);
		adventures_add_new_widget($active_widgets, 'aboutus-bottom', 'vikwp_counter', $counter, $parameters);

		// vikwp_speakers
		$parameters = array(
			'title' 	=> "OUR STAFF",
			'number_of_speakers'	=> 3,
			'number_of_rows'	=> 1,
			'textarea_above'	=> '<h3 class="text-color">OUR STAFF</h3>
									Nullam ornare tempus urna, a ornare ante porta eu. Integer euismod urna eu porta hendrerit. Curabitur rutrum, magna eget commodo venenatis, ligula urna convallis enim, sit amet mattis risus nibh a ipsum.',
			'spkr_1_image'	=>	'https://vikwp.com/demo/themes/sample-data/general/staff/speaker-02.jpg',
			'spkr_1_nominative'	=> 'Ramona Grant',
			'spkr_1_role'	=> 'CEO Adventures',
			'spkr_1_description'	=> 'Nullam iaculis vestibulum urna, non tempor elit.',

			'spkr_2_image'	=>	'https://vikwp.com/demo/themes/sample-data/general/staff/speaker-01.jpg',
			'spkr_2_nominative'	=> 'Jeremy Rodriquez',
			'spkr_2_role'	=> 'Customers Relationship',
			'spkr_2_description'	=> 'Nullam iaculis vestibulum urna, non tempor elit.',

			'spkr_3_image'	=>	'https://vikwp.com/demo/themes/sample-data/general/staff/speaker-03.jpg',
			'spkr_3_nominative'	=> 'Mike Smith',
			'spkr_3_role'	=> 'Marketing Manager',
			'spkr_3_description'	=> 'Nullam iaculis vestibulum urna, non tempor elit.'
		);
		adventures_add_new_widget($active_widgets, 'aboutus-bottom', 'vikwp_speakers', $counter, $parameters);

		/* @contactus - widgets */
		// Contact Form shortcode - widget_text
		$parameters = array(
			'title' => "",
			'content' => "Here the shortcode.<br />
			In our demo website we used the external free plugin Contact Form 7. You can download from this link: <a href=\"https://it.wordpress.org/plugins/contact-form-7/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>Contact Form 7</strong></a>."
		);
		adventures_add_new_widget($active_widgets, 'modulebox-contact', 'text', $counter, $parameters);

		//vikwp_icons
		$parameters = array(
			'title' => "HOW TO FIND US",
			'icons_displayed' => 5,
			'icon_size' => 24,
			'icon_style' => "default",
			'container_size' => 1,
			'content_alignment' => 0,
			'icon_alignment' => "left",
			'icon_padding' => 12,

			'icon_0_type' => 'fa',
			'icon_0_selected' => "phone",
			'icon_0_title' => "TELEPHONE",
			'icon_0_description' => "(804)-213-5959",

			'icon_1_type' => 'fa',
			'icon_1_selected' => "map-marker-alt",
			'icon_1_title' => "LEGAL LOCATION",
			'icon_1_description' => "4642 Auerbach Ave",

			'icon_2_type' => 'fa',
			'icon_2_selected' => "envelope",
			'icon_2_title' => "EMAIL",
			'icon_2_description' => "customers.service@website.com",

			'icon_3_type' => 'fab',
			'icon_3_selected' => "facebook",
			'icon_3_title' => "CAR-RENTAL-FB",
			'icon_3_description' => "",
			'class_suffix'	=> ""
		);
		adventures_add_new_widget($active_widgets, 'modulebox-contact', 'vikwp_icons', $counter, $parameters);

		update_option('vikwp_adventures_write_widgets', false);

		update_option( 'sidebars_widgets', $active_widgets );
	}
}

function adventures_add_new_widget(&$active_widgets, $sidebar_id, $widget_name, &$counter, $parameters) {
	$widget_content = get_option('widget_' . $widget_name);
	$active_widgets[ $sidebar_id ][] = $widget_name . '-' . $counter;
	$widget_content[ $counter ] = $parameters;
	update_option( 'widget_' . $widget_name, $widget_content );
	$counter++;
}

if (isset($_POST['vikwptestdatainstall'])) {
	/**
	 * when the button to install the sample data is clicked,
	 * we fire the function to install the sample data.
	 */

	adventures_content_init();
}

function add_category($index, $title, $description) {
	if (!term_exists($title)) {
		$cat = wp_insert_term(
			$title,
			'category',
			array(
			  'description'	=> $description,
			  'slug' 		=> $index
			)
		);
		return $cat["term_id"];
	} else {
		return get_cat_ID(__($title, "vikwp_adventures"));
	}
}

function add_post($post_title, $post_content, $post_excerpt, $post_category, $post_featured = "") {
	$postarr = array(
		"post_title"	=> $post_title,
		"post_content"	=> $post_content,
		"post_excerpt"	=> $post_excerpt,
		"post_status"	=> "publish",
		"post_category" => $post_category
	);

	$postid = wp_insert_post($postarr, true);

	if (!empty($post_featured)) {
		generate_featured_image($post_featured, $postid);
	}

	return $postid;
}

function generate_featured_image ($image_url, $post_id) {
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);

    if (wp_mkdir_p($upload_dir['path'])) {
    	$file = $upload_dir['path'] . '/' . $filename;
    } else {
    	$file = $upload_dir['basedir'] . '/' . $filename;
    }

    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1 = wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2 = set_post_thumbnail( $post_id, $attach_id );
    return $file;
}

/* Remove widgets from Sidebar Left
 *
 * @since 1.1.11 
 * Removed this function because was creating problems with WP 5.8
 * 
	function my_theme_sidebars_widgets( $sidebars_widgets ) {
		$sidebars_widgets['sidebar-left'] = null;
		return $sidebars_widgets;
	}
	add_filter( 'sidebars_widgets', 'my_theme_sidebars_widgets' );
*/