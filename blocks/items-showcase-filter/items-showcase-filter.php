<?php
/**
 * items-showcase-filter Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

// Build a valid style attribute for background and text colors.

?>

<?php
// Retrieve ACF fields
$showcase_items = get_field('showcase_items');
?>

<div class="tab flex-row flex-center flex-align-center width-full">
  <button class="tablinks text-hover-red bg-hover-light-gray" onclick="openCity(event, 'guidesTab')">Guides</button>
  <button class="tablinks text-hover-red bg-hover-light-gray" onclick="openCity(event, 'articlesTab')">Articles</button>
  <button class="tablinks text-hover-red bg-hover-light-gray" onclick="openCity(event, 'recipesTab')">Recipes</button>
</div>

<div id="guidesTab" class="tabcontent">
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
                            <!-- <a href="<?php the_permalink(); ?>" class="primary size-large">Read more</a> -->
                            <button class="primary size-large">Read more</button>
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
    <a class="contents load-more" href="#">
        <button class="primary-inverse size-huge">Load more</button>
    </a>
</div>

    </section>

</div>


<div id="articlesTab" class="tabcontent">
    <section class="m-y-section">
        <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">
            <?php
            $args = array(
                'post_type' => 'event', // Change post type if needed
                'posts_per_page' => -1, // Number of posts to display
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
        <div class="flex-row flex-center width-100">
            <a class="contents" href="">
                <button class="primary-inverse size-huge">Load more</button>
            </a>
        </div>
    </section>
</div>


<div id="recipesTab" class="tabcontent">
    <section class="m-y-section">
        <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">
            <?php
            $args = array(
                'post_type' => 'post', // Change post type if needed
                'posts_per_page' => -1, // Number of posts to display
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
        <div class="flex-row flex-center width-100">
            <a class="contents" href="">
                <button class="primary-inverse size-huge">Load more</button>
            </a>
        </div>
    </section>
</div>



<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="tabs">
            <ul class="tab-links">
                <li><a href="#tab1" class="active">Tab 1</a></li>
                <li><a href="#tab2">Tab 2</a></li>
                <li><a href="#tab3">Tab 3</a></li>
            </ul>

            <div class="tab-content">
                <div id="tab1" class="tab active">
                    <?php
                    $args = array(
                        'post_type' => 'post', // Replace 'post_type_1' with your custom post type slug
                        'posts_per_page' => 6 // Show 6 posts initially
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            // Display post content here
                            the_title('<h2>', '</h2>');
                            the_content();
                        endwhile;
                    endif;
                    ?>
                    <button id="loadMore1" class="load-more">Load More</button>
                </div>

                <div id="tab2" class="tab">
                    <?php
                    // Query for second post type
                    ?>
                    <button id="loadMore2" class="load-more">Load More</button>
                </div>

                <div id="tab3" class="tab">
                    <?php
                    // Query for third post type
                    ?>
                    <button id="loadMore3" class="load-more">Load More</button>
                </div>
            </div>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<script>

</script>