<?php
/**
 * general-filter Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

// Build a valid style attribute for background and text colors.

?>

<section class="m-y-section">

    <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">

<div id="posts-container-special">
    <?php
    $query = new WP_Query(array(
        'posts_per_page' => 6,
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();?>
          
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
    endif;
    ?>
</div>


	</div>
   <div class="flex-row flex-center width-100">
     
            <button  id="load-more" class=" primary-inverse size-huge">See more</button>
      
    </div>
</section>
