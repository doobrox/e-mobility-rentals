<?php 

/** --- Thumbnails configuration **/

defined('ABSPATH') or die('No script kiddies please!');

function add_custom_sizes() {
	add_theme_support('post-thumbnails', array('post', 'page', 'custom-post-type-name'));

	// Featured size 
	add_image_size( 'featured-big', 9999, 400, true ); // width, height, crop
	add_image_size( 'featured-small', 420, 147, true );

	// Medium size - Add other useful image sizes for use through Add Media modal
	add_image_size( 'medium-width', 480 );
	add_image_size( 'medium-height', 9999, 480 );
	add_image_size( 'medium-square', 480, 480, true );

	// Small size
	add_image_size( 'small-width', 250 );
	add_image_size( 'small-height', 9999, 250 );
	add_image_size( 'small-square', 150, 150 );

	// Featured Background Page title
	add_image_size( 'background-pages', 9999, 9999 ); // width, height, crop

	// Blog Featured image size
	add_image_size( 'blog-thumb', 605, 403 ); // width, height, crop


}
add_action('after_setup_theme','add_custom_sizes');

// Register the three useful image sizes for use in Add Media modal
add_filter( 'image_size_names_choose', 'adventures_custom_sizes' );
function adventures_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'medium-width' => __( 'Medium Width' ),
        'medium-height' => __( 'Medium Height' ),
        'medium-something' => __( 'Medium Square' ),
    ) );
}

if ( ! function_exists( 'adventures_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own adventures_excerpt() function to override in a child theme.
	 *
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function adventures_excerpt( $class = 'excerpt-cnt' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;

/** 
 *
 * Read More link construction
 *
 */

function adventures_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( '<span class="screen-reader-text"> prova "%s"</span>', 'vikwp_adventures' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'adventures_excerpt_more' );

/** 
 *
 * Read More Customization
 *
 */

function modify_read_more_link() {
    return '<div class="more-link-cnt"><a class="btn more-link" href="' . get_permalink() . '">'. __('Read More', 'vikwp_adventures').'</a></div>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own adventures_entry_meta() function to override in a child theme.
 *
 */
if ( ! function_exists( 'adventures_entry_meta' ) ) {
	function adventures_entry_meta() {
		echo "<div class=\"entry-meta\">";
		if ( 'post' === get_post_type() ) {
			$author_avatar_size = apply_filters( 'adventures_author_avatar_size', 49 );
				//printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', With Avatar
				printf( '<span class="byline"><span class="author vcard"> <span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>', // Without Avatar
				get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
				_x( 'Author', 'Used before post author name.', 'vikwp_adventures' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			adventures_entry_date();
		}

		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
				sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'vikwp_adventures' ) ),
				esc_url( get_post_format_link( $format ) ),
				get_post_format_string( $format )
			);
		}

		if ( 'post' === get_post_type() ) {
			adventures_entry_taxonomies();
		}

		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fa fa-comment"></i> ';
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'vikwp_adventures' ), get_the_title() ) );
			echo '</span>';
		}
		echo "</div>";
	}
}

/**
 * Prints HTML with date information for current post.
 *
 * Create your own adventures_entry_date() function to override in a child theme.
 *
 */
if ( ! function_exists( 'adventures_entry_date' ) ) {
	function adventures_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><i class="fas fa-calendar-alt"></i> <span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'vikwp_adventures' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
}
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own adventures_entry_taxonomies() function to override in a child theme. 
 */
if ( ! function_exists( 'adventures_entry_taxonomies' ) ) {
	function adventures_entry_taxonomies() {
		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'vikwp_adventures' ) );
		if ( $categories_list && adventures_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'vikwp_adventures' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'vikwp_adventures' ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf( '<span class="tags-links"><i class="fas fa-tag"></i> <span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'vikwp_adventures' ),
				$tags_list
			);
		}
	}
}

/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own adventures_categorized_blog() function to override in a child theme.
 *
 */
if ( ! function_exists( 'adventures_categorized_blog' ) ) {
	function adventures_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'adventures_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'adventures_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 || is_preview() ) {
			// This blog has more than 1 category so adventures_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so adventures_categorized_blog should return false.
			return false;
		}
	}
}

/* Pagination */
if ( ! function_exists( 'adventures_the_posts_navigation' ) ) :
	/**
	 * Documentation for function.
	 */
	function adventures_the_posts_navigation() {
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => '<span class="nav-prev-text">'. __( 'Prev', 'vikwp_adventures' ) .'</span>',
				'next_text' => '<span class="nav-next-text">'. __( 'Next', 'vikwp_adventures' ) .'</span>'
			)
		);
	}
endif;

/* Menu structure customization */
class Nav_Walker_Nav_Menu extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		/* @since 1.1.20
		 * Removed the menu-item-id IDs to avoid duplicated IDs between main menu desktop and resposnive.
		 * Old code:
		 * $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		 */
		$output .= $indent . '<li' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		$item_output = $args->before;
		$item_output .= '<div><a'. $attributes .'>';
		$item_output .=$args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $description.$args->link_after;
		$item_output .= '</a></div>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	//start of the sub menu wrap
	function start_lvl(&$output, $depth = 0, $args = array()) {
	    $output .= '<ul class="nav-child">
	                    <div>';
	}
	
	//end of the sub menu wrap
	function end_lvl(&$output, $depth = 0, $args = array()) {
	    $output .= '</div>
			</ul>';
	}
}
