<?php
/**
 * find-a-restaurant Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$main_cards = get_field('main_cards');
$main_cards_small = get_field('main_cards_small');
// TODO: small cards should be all child categories of a main category, automatically fetch all children
// For example: for Restaurants category, fetch sush, arabic, local food, italian, etc.

$category_term = get_cat_name(38);
$category_image = get_field ('category_image', $category_term);

?>
<?php
// Check if ACF function exists and category image field is set
 
?>



<!-- find a restaurant category showcase -->
<section class="p-x-page p-y-section flex-col flex-align-center">
	<h2 class="text-red text-center">Find a restaurant</h2>
	<div class="slider category-showcase-big width-full grid-fr-col-4 m-x-auto m-t-section-small" style="margin-bottom: 5rem">
	<?php foreach ($main_cards as $key => $value):?>
		<?php $new_value = $value['main_item_find_a_restaurant']; ?>
			<?php foreach ($new_value as $value): ?>
				<a href="<?php echo get_category_link($value);?>" class="contents">
					<div class="item-card overflow-visible nomad-corners relative">
						<div class="item-card-image nomad-corners image-cover ratio-3-4">
							<?php $category_image = get_field('category_image', 'category_' . $value);?>
							<img src="<?php echo esc_url($category_image); ?>" alt="">
						</div>
						<div class="absolute right-50 bottom-0 text-dark-gray bg-light-gray uppercase text-center" style="height: min-content; width: min-content; max-width: 80%; line-height: 1rem; padding: 1rem 1rem; transform: translate(50%, 50%); z-index: 10">
							<small><?php echo get_the_category_by_ID($value); ?></small>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
	<div class="flex-row flex-end width-full">
		<button class="tertiary-on-dark" style="margin-bottom: 1rem;"><i class="fa-solid fa-expand" style="margin-right: 1rem"></i>expand all categories</button>
	</div>
	<div class="slider width-full category-showcase-all row grid m-x-auto">
	<?php foreach ($main_cards_small as $new_card):?>
		<?php $brand_new_value = $new_card['main_item_find_a_restaurant_small']; ?>
		<?php foreach ($brand_new_value as $new_value): ?>
			<a href="<?php echo get_the_post_thumbnail_url($new_value); ?>" class="contents">
				<div class="item-card overflow-visible nomad-corners relative">
					<div class="item-card-image nomad-corners image-cover ratio-4-3">
						<img src="<?php echo get_the_post_thumbnail_url($new_value); ?>" alt="">
					</div>
					<div class="text-light-gray _bg-light-gray text-center uppercase" style="padding: 1rem 0rem; line-height: 1rem; max-width: 100%">
						<small><?php echo get_the_title($new_value); ?></small>
					</div>
				</div>
			</a>
		<?php endforeach; ?>
		
	<?php endforeach; ?>
	
	</div>
	<div class="flex-col height-fit m-t-section-small" style="gap: 1rem">
		<input class="primary-inverse" style="min-width: 25vw" type="text" maxlength="200" name="" id="searchRestaurants" placeholder="Search restaurants..."/>
	</div>
</section>