<?php
/**
 * restaurants-nearby Block template.
 *
 * @param array $block The block settings and attributes.
 */
$restaurants_nearby_image = get_field('restaurants_nearby_image');
$restaurants_nearby_text = get_field('restaurants_nearby_text');
// Load values and assign defaults.

// Build a valid style attribute for background and text colors.
$restaurants_nearby = get_field('restaurants_nearby');
?>

<section class="bg-dark-red bg-black m-y-section p-x-page relative" style="padding-top: 5rem; padding-bottom: 5rem">
			<div class="image-cover left-0 top-0 height-100 width-100 opacity-50" style="position: absolute !important">
				<?php if ($restaurants_nearby_image): ?>
				<img src="<?php echo $restaurants_nearby_image; ?>" alt="">
				<?php endif; ?>
			</div>
			<div class="height-100 flex-col flex-align-start relative" style="max-width: 900px">
				<h2 class="text-light-gray">Restaurants nearby</h2>
				<p class="text-justify text-white"><?php echo $restaurants_nearby_text;?></p>
				<div class="flex-row" style="gap: 1rem; margin-top: 1rem">
				
				<?php foreach ($restaurants_nearby as $key => $value):?>
				
					<a href="<?php echo get_category_link($value['restaurants_nearby_categories'][0]); ?>" class="contents">
						<button class="secondary rounded-full size-large"><?php echo get_cat_name($value['restaurants_nearby_categories'][0]); ?></button>
					</a>
				<?php endforeach; ?>
					<a href="<?php echo get_category_link(37); ?>" class="contents">
						<button class="primary-inverse rounded-full size-large">And More...</button>
					</a>
				</div>
			</div>
		</section>
