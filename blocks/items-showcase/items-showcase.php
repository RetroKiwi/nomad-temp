<?php
/**
 * items-showcase Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

// Build a valid style attribute for background and text colors.

?>

<?php
// Retrieve ACF fields
$showcase_items = get_field('showcase_items');
// get category here from ACF
$custom_post_type =  get_field('select_post_type');
$select_post_type_link = get_field('select_post_type_link');
// get category link here from ACF
$category_link = '#';

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
            'post_type' => $custom_post_type, // Change post type if needed
            'posts_per_page' => 3, // Number of posts to display
            'order' => 'DESC', // Order of posts (DESC for latest first)
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
            <button class="loadmore primary-inverse size-huge">See more</button>
        </a>
    </div>
</section>

<script>
    jQuery(function($){
        var page = 1;
        var loading = false;
        var $loadmore = $('.loadmore');

        $loadmore.on('click', function(e){
            e.preventDefault();
            if( ! loading ) {
                loading = true;
                var data = {
                    action: 'load_more_posts',
                    query: <?php echo json_encode($args); ?>,
                    page: page
                };
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: data,
                    type: 'POST',
                    success: function(response){
                        if( response ) {
                            $('.slider').append(response);
                            page++;
                            loading = false;
                        } else {
                            $loadmore.hide(); // If no more posts, hide the load more button
                        }
                    }
                });
            }
        });
    });
</script>
