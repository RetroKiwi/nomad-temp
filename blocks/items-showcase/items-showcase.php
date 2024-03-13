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
// $showcase_items = get_field('showcase_items');
// get category here from ACF
$acf_data =  get_field('item_showcase');
$post_type =  $acf_data['post_type'];
$button_link = $acf_data['button_link'];
$background_color = $acf_data['background_color'];
$background_color = $background_color ? $background_color['value'] : 'transparent';
$use_list = $acf_data['use_list'];
?>


<section class="m-b-section relative" style="padding: 3rem 0; background: var(--<?php echo $background_color; ?>);">
    <div class="<?php echo $use_list ? 'item-card-list' : 'item-card-grid'; ?> p-x-page m-x-auto m-b-section-small">
        <?php
            $args = array(
                'post_type' => $post_type, // Change post type if needed
                'posts_per_page' => 3, // Number of posts to display
                'order' => 'DESC', // Order of posts (DESC for latest first)
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    echo_item_card_html();
                }
                wp_reset_postdata();
            } else {
                echo 'No posts found';
            }

            // if ($query->have_posts()) :
            //     while ($query->have_posts()) : $query->the_post();
            //         echo_item_card_html();
            //     endwhile;
            //     wp_reset_postdata();
            // else :
            //     echo 'No posts found';
            // endif;
        ?>
    </div>
    <?php if (isset($button_link)) : ?>
        <div class="flex-row flex-center width-100">
            <a class="contents" href="<?php echo esc_url( $button_link['url'] ); ?>">
                <button class="primary-inverse size-huge"><?php echo esc_html( $button_link['title'] ); ?></button>
            </a>
        </div>
    <?php endif; ?>
</section>


<script>

    // load more posts on button click

    // jQuery(function($){
    //     var page = 1;
    //     var loading = false;
    //     var $loadmore = $('.loadmore');

    //     $loadmore.on('click', function(e){
    //         e.preventDefault();
    //         if( ! loading ) {
    //             loading = true;
    //             var data = {
    //                 action: 'load_more_posts',
    //                 query: <?php echo json_encode($args); ?>,
    //                 page: page
    //             };
    //             $.ajax({
    //                 url: '<?php echo admin_url('admin-ajax.php'); ?>',
    //                 data: data,
    //                 type: 'POST',
    //                 success: function(response){
    //                     if( response ) {
    //                         $('.slider').append(response);
    //                         page++;
    //                         loading = false;
    //                     } else {
    //                         $loadmore.hide(); // If no more posts, hide the load more button
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });
</script>
