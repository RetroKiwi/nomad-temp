<?php
/*
Template Name: Blog Template
*/
get_header();
global $post;
?>

<!-- Banner -->
<section class="width-full bg-darkest-black" style="height: 500px">
    <div class="width-full flex-row height-full flex-align-center">
        <h1 class="text-center" style="margin: auto;">Banner type 1 placeholder</h1>
    </div>
</section>

<!-- Blog Content -->
<section class="flex-col flex-align-center" style="aspect-ratio: 5 / 2;">
	<div class="image-cover height-100 width-100">
        <!-- TODO: partial parallax effect -->
		<img class="right-50 bottom-50" style="position: absolute !important; translate: 50% 50%" src="<?php echo get_the_post_thumbnail_url( $post, 'full' );?>" alt="">
	</div>
</section>
<section class="width-full flex-col flex-align-center">
    <div class="blog-page flex-col flex-align-center width-blog m-y-section-small">
    <!-- <?php the_post_thumbnail(); ?> -->
        <!-- Blog Title -->
        <h1 class="text-center m-b-section-small text-red"><?php the_title(); ?></h1>

        <!-- Blog Content -->
        <div class="blog-content bg-white p-y-page nomad-corners">
            <?php
            // Start the loop
            if (have_posts()) :
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>













<?php
// Retrieve ACF fields
$showcase_items = get_field('showcase_items');
// get category here from ACF
// $custom_post_type =  get_field('select_post_type');
$custom_post_type =  'post';
// $select_post_type_link = get_field('select_post_type_link');
$select_post_type_link = array(
    'url'=>'https://www.google.com/',
    'title'=>'Google test link'
);
// $background_color = get_field('background_color')['value'];
$background_color = 'transparent';

?>


<section class="m-b-section relative" style="padding: 3rem 0; background: var(--<?php echo $background_color; ?>);">
    <div class="item-card-grid p-x-page m-x-auto m-b-section-small">
        <?php
            $args = array(
                'post_type' => $custom_post_type, // Change post type if needed
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
        ?>
    </div>
    <?php if (isset($select_post_type_link)) : ?>
        <div class="flex-row flex-center width-100">
            <a class="contents" href="<?php echo esc_url( $select_post_type_link['url'] ); ?>">
                <button class="primary-inverse size-huge"><?php echo esc_html( $select_post_type_link['title'] ); ?></button>
            </a>
        </div>
    <?php endif; ?>
</section>




<?php get_footer(); ?>
