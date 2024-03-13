<?php
/*
Template Name: RestaurantTemplate
*/
get_header();
?>

<!-- Banner -->
<section class="width-full bg-darkest-black" style="height: 500px">
    <div class="width-full flex-row height-full flex-align-center">
        <h1 class="text-center" style="margin: auto;">Banner type 1 placeholder</h1>
    </div>
</section>

<!-- Blog Content -->
<section class="width-full flex-col flex-align-center">
    <div class="blog-page flex-col flex-align-center width-blog m-y-section-small">
    <?php the_post_thumbnail(); ?>
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
?>

<section class="m-y-section">

    <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">
        <?php
        $args = array(
            'post_type' => 'post', // Change post type if needed
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
                            <a href="<?php the_permalink(); ?>" class="primary size-large">Read more</a>
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

</section>


<?php get_footer(); ?>
