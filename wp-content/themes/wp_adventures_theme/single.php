<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

// start the buffer to include the HTML body content
$document = VikWpDocument::getInstance();

// call WP header file
get_header(); 
$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';

if($show_page_name) { ?>
<div class="alert-danger"><?php echo "single.php"; ?></div>
<?php } ?>

<main id="main-inner">
    <div id="cnt-container" class="content-area" role="main">
        <div id="main-box" class="main-box grid-block <?php echo ( is_active_sidebar( 'sidebar-right' ) || is_active_sidebar( 'sidebarleft' )) ? 'mainbox-sidebarson' : '';?>">
            <?php 
            if ( have_posts() ) : 
                // Start the Loop.
                while ( have_posts() ) : the_post();
         
                    get_template_part( 'template-parts/content', 'blogpage' );
                             
                endwhile; 
            ?>
                <?php 

                the_posts_pagination( array(
                    'prev_text' => '<i class="fas fa-chevron-left"></i> '. '<span class="screen-reader-text">' . __( 'Previous page', 'vikwp_adventures' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'vikwp_adventures' ) . '</span>',
                    'before_page_number' => '<i class="fas fa-chevron-right"></i> <span class="meta-nav screen-reader-text">' . __( 'Page', 'vikwp_adventures' ) . ' </span>',
                ) );

                ?>
            
         
            <?php 
            else :
                get_template_part( 'template-parts/content', 'none' );
            endif; 
            ?>
        </div>
    </div>
</main>
<?php 

// call WP footer file
get_footer();

// stop the buffer for the HTML body content
echo $document->display();
