<?php
/**
 * page-link-strips-special-right Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$category_highlight = get_field('category_highlight');

// Build a valid style attribute for background and text colors.

?>
<?php foreach ($category_highlight as $key => $value):?>
	<section class="flex-col relative m-y-section p-y-section bg-darkest-black" style="gap: var(--item-gap-small)">
				<div class="page-link-strip bg-black grid-fr-col-2 default-gap p-x-page">
					<div class="page-link-strip-item height-100 flex-col nomad-corners border-dark-gray border-2">
						<div class="item-card-content">
							<h2 class="text-light-gray"><?php echo get_the_title($value);?></h4>
							<p class="text-justify"><?php echo get_the_excerpt($value);?></p>
						</div>
						<div>
							<a href="<?php echo get_the_permalink($value);?>" class="contents">
								<button class="secondary size-large">Read more</button>
							</a>
						</div>
					</div>
					<div class="page-link-strip-category flex-col flex-center flex-align-start relative height-100 ratio-16-9">
						<h2 class="text-white text-start"><?php echo $value['service_category_title']; ?></h2>
						<a href="<?php echo $value['service_category_link']['url']; ?>" class="contents">
							<button class="primary size-large"><?php echo $value['service_category_link']['title']; ?></button>
						</a>
						<div class="page-link-strip-image left-0 top-0 image-cover height-100 width-100">
							<img src="<?php echo wp_get_attachment_image_url($value['service_category_image']);?>" alt="">
						</div>
					</div>
				</div>
			</section>
<?php endforeach; ?>