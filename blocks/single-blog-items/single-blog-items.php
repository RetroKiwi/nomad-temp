<?php
/**
 * single-blog-items Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

// Build a valid style attribute for background and text colors.

?>

	<!-- item row list, alternate form of grid list -->
    <section class="m-y-section">
    <div class="item-list flex-col p-x-page m-x-auto m-y-section-small" style="gap: 3rem">
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
                    <div class="item-list-card flex-row flex-nowrap width-100 nomad-corners border-2 border-dark-gray" style="gap: var(--item-gap-small)">
                        <div class="image-cover" style="width: 20vw; flex-shrink: 0;">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/images/squareimgplaceholder.png" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="item-card-content relative" style="padding: 3rem 0 3rem 5rem;">
                            <div class="absolute left-0 bottom-50 text-dark-gray bg-light-gray text-nowrap uppercase" style="padding: .5rem 1rem; transform: translate(calc(-50% - 5rem), 50%)">
                                <small><?php echo get_the_category_list(', '); ?></small>
                            </div>
                            <div class="flex-row flex-between text-light-gray uppercase">
                                <small><?php echo get_the_date(); ?></small>
                                <small>Subcategory name</small>
                            </div>
                            <h3 class="text-red text-dense-lines"><?php the_title(); ?></h3>
                            <p class="text-justify"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        </div>
                        <div class="flex flex-align-center" style="min-width: fit-content; padding-right: 3rem">
                            <button class="primary size-large"><a href="<?php the_permalink(); ?>">Read more</a></button>
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


