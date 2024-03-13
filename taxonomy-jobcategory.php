<?php
/*
Template Name: Job Taxonomy Page
*/

get_header();


?>
<?php echo do_shortcode('[travelers-map current_query_markers=true]'); ?>
<?php
// Get the current URL
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Parse the URL
$path = parse_url($url, PHP_URL_PATH);

// Get the last part of the path
$last_part = basename($path);


?>


  <section class="m-y-section">
    <div class="section-header p-x-page m-x-auto">
        <!-- h2 class="section-title text-red inline">What's new?</h2-->
        <!-- span class="decorative-title-strip inline-block border-5 border-light-gray"></span -->
        <!-- h3 class="section-subtitle text-light-gray inline relative">Stay updated and embrace the location-independent lifestyle with these valuable resources</h3 -->
    </div>
    <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">
        <?php
        $args = array(
            'post_type' => 'job', // Change post type if needed
            'posts_per_page' => -1, // Number of posts to display
            'order' => 'DESC', // Order of posts (DESC for latest first)
			//'category_name' => $last_part,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <a href="<?php the_permalink(); ?>" class="contents">
                    <div class="item-card nomad-corners">
                        <div class="item-card-image nomad-corners image-cover ratio-4-3">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/images/squareimgplaceholder.png" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="item-card-content">
                            <div class="flex-row flex-between text-light-gray uppercase" style="margin-top: 1rem">
                                <small><?php echo get_the_category_list(', '); ?></small>
                                <small><?php echo get_the_date(); ?></small>
                            </div>
                            <h3 class="text-red text-dense-lines"><?php the_title(); ?></h3>
                            <p class="text-justify"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        </div>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <button class="primary size-large">Read more</button>
                            </a>
                        </div>
                    </div>
                </a>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo 'No posts found';
        endif;
        ?>
    </div>
    <div class="flex-row flex-center width-100">
        <a class="contents" href="<?php echo $select_post_type_link['url']; ?>">
            <!--button class="loadmore primary-inverse size-huge">See more</button-->
        </a>
    </div>
</section>






<?php
// get_sidebar();
get_footer();