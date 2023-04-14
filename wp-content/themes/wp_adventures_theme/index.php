<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 *
 * @package Adventures
 * @since 1.0
 * @version 1.0
 *
 * 
 */

defined('ABSPATH') or die('No script kiddies please!');

// start the buffer to include the HTML body content
$document = VikWpDocument::getInstance();

// call WP header file
$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';
$categories = get_the_category();
$cat = get_query_var( 'cat' );
$category_name = $categories[0]->name;

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$newsposts = new WP_Query(array(
	'post_type' => 'post',
	'post_status' => 'publish',
    'cat' => $cat,
	'paged'=> $paged
));

get_header();
?>
<?php if($show_page_name) { ?>
<div class="alert-danger"><?php echo "index.php"; ?></div>
<?php } ?>

<main id="main-inner">
	<div id="cnt-container">
		<div id="main-box" class="main-box grid-block <?php echo ( is_active_sidebar( 'sidebar-right' ) || is_active_sidebar( 'sidebarleft' )) ? 'mainbox-sidebarson' : '';?>">
			<?php 
			if (have_posts()) { ?>
				<div id="main">
					<div class="blog">

						<div class="entry-header page-header category-title">
							<h2 class="entry-title">
								<?php echo $category_name; ?>
							</h2>
						</div>
				
						<?php while ( $newsposts->have_posts() ) {  
							$newsposts->the_post();
							get_template_part( 'template-parts/content', 'blog' ) ;
						} 
						
						/* @since 1.2.0
							* Removed old Pagination function and replaced with the following code with also the '$paged' variable above.
							* The problem was that the pagination was displaying the same posts in all the pages.
							*/
						?>

						<div class="paginationsec">
							<nav class="navigation pagination show">
								<div class="nav-links">
								<?php 
									$pagenum_link = html_entity_decode( get_pagenum_link() );
									echo paginate_links( array(
										'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
										'total'        => $newsposts->max_num_pages,
										'current'      => $paged,
										'format'	   => '/page/%#%',
										'show_all'     => false,
										'type'         => 'plain',
										'end_size'     => 1,
										'mid_size'     => 2,
										'prev_next'    => true,
										'prev_text'    =>__( '<i class="fa fa-angle-double-left"></i> Prev', 'vikwp_adventures' ),
										'next_text'    => __( 'Next <i class="fa fa-angle-double-right"></i>', 'vikwp_adventures' ),
										'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'vikwp_adventures' ) . ' </span>',
										'add_args'     => false,
										'add_fragment' => '',
									) );
								?>
								</div>
							</nav>
						</div>
				
					</div>
					
				</div>
			<?php
				wp_reset_postdata();
			} else { ?>
				<?php
					get_template_part( 'template-parts/content', 'none') ;
				?>
			<?php }	?>

			<?php if ( is_active_sidebar( 'sidebar-topcontent' ) ) { ?>
			<!-- Sidebar Left -->
				<?php get_template_part( 'template-parts/modules/sidebar', 'topcontent' ); ?>
			<?php } ?>
		</div>
	</div>
</main>

<?php
// call WP footer file
get_footer();

// stop the buffer for the HTML body content
echo $document->display();
