<?php
get_header();
?>

<?php echo do_shortcode('[travelers-map current_query_markers=true]'); ?>
   <main id="main" class="content-wrapper">
      <div class="posts-section">
         <?php if ( have_posts() ) { ?>
            <div class="archived-posts">
               <?php while ( have_posts() ) {
                  the_post(); ?>
                  <div class="archive-item">
                     <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
                        <div class="top-section">
                           <div class="movie-thumbnail">
                              <a href="<?php the_permalink(); ?>">
                                 <?php the_post_thumbnail( 'large' ); ?>
                              </a>
                           </div>
                        </div>
                     <?php } ?>
                     <div class="bottom-section">
                        <div class="movie-title">
                           <a href="<?php the_permalink(); ?>">
                              <h3><?php the_title(); ?></h3>
                           </a>
                        </div>
                        <?php
                        $excerpt       = get_the_excerpt();
                        $excerpt       = _substr( $excerpt, 0, 100 );
                        $short_excerpt = _substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
                        if ( ! empty( $short_excerpt ) ) { ?>
                           <div class="movie-excerpt">
                              <p itemprop="description" class="qodef-e-excerpt">
                                 <?php echo esc_html( $short_excerpt ); ?>&hellip;</p>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               <?php } ?>
            </div>
            <?php wp_reset_postdata();
         } else { ?>
            <div class="archived-posts"><?php echo esc_html__( 'No posts matching the query were found.', 'your-translate-domain' ); ?></div>
         <?php } ?>
      </div>
   </main>
<?php
get_footer(); ?>