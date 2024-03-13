<?php
/**
 * item-row-list Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$item_row_list = get_field('item_row_list');
// Build a valid style attribute for background and text colors.

?>

	<!-- item row list, alternate form of grid list -->
    <section class="m-y-section">
    <div class="item-list flex-col p-x-page m-x-auto m-y-section-small" style="gap: 3rem">
        <?php
        foreach ($item_row_list as $key => $value):
        ?>
		<?php foreach ($value as $key => $new_value): ?>
			<?php $job_category_id = $new_value[0];?>
                <a href="<?php echo get_category_link($job_category_id);?>" class="contents">
                    <div class="item-list-card flex-row flex-nowrap width-100 nomad-corners border-2 border-dark-gray" style="gap: var(--item-gap-small)">
                        <div class="image-cover" style="width: 20vw; flex-shrink: 0;">
                            
                                <?php $category_image = get_field('category_image', 'category_' . $job_category_id);?>
                         		
                                <img src="<?php echo $category_image;?>" alt="">
                          
                        </div>
                        <div class="item-card-content relative" style="padding: 3rem 0 3rem 5rem;">
                            <div class="absolute left-0 bottom-50 text-dark-gray bg-light-gray text-nowrap uppercase" style="padding: .5rem 1rem; transform: translate(calc(-50% - 5rem), 50%)">
                                <small><?php echo get_the_category_by_ID($job_category_id); ?></small>
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
            endforeach;

        ?>
		<?php endforeach;?>
    </div>
    <div class="flex-row flex-center width-100">
        <a class="contents" href="">
            <button class="primary-inverse size-huge load-more">Load more</button>
        </a>
    </div>
</section>


