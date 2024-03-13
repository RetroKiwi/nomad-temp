<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NomadTribe
 */


?>
<?php get_header(); ?>
<?php do_shortcode('[asearch  image="false" source="job, post, page"]')?>


<?php echo do_shortcode('[travelers-map current_query_markers=true]'); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'your-theme-textdomain' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        </header>

        <?php if ( have_posts() ) : ?>
            <div class="search-results-list">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </header>

                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_navigation(); ?>

        <?php else : ?>
            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'your-theme-textdomain' ); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </main>
</div>
<?php do_shortcode('[travelers-map current_query_markers=true]'); ?>

<?php get_footer(); ?>
