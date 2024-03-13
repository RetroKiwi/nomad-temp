<?php
/**
 * find-a-restaurant Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$main_cards = get_field('main_cards');
$main_cards_small = get_field('main_cards_small');
// Build a valid style attribute for background and text colors.
$category_term = get_cat_name(38);
$category_image = get_field ('category_image', $category_term);
// get list of categories from an ACF field here
$category_list = get_field('select_post_type_to_filter');


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
										<div class="absolute right-50 bottom-0 text-dark-gray bg-light-gray uppercase" style="padding: .5rem 1rem; transform: translate(50%, 50%)">
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
				<a href="<?php echo get_category_link($new_value);?>" class="contents">
					<div class="item-card overflow-visible nomad-corners relative">
						<div class="item-card-image nomad-corners image-cover ratio-4-3">
							<?php $category_image = get_field('category_image', 'category_' . $new_value);?>
							<img src="<?php echo esc_url($category_image); ; ?>" alt="">
						</div>
						<div class="text-light-gray _bg-light-gray text-center uppercase" style="padding: .5rem 0rem">
							<small><?php echo get_the_category_by_ID($new_value); ?></small>
						</div>
					</div>
				</a>
				<?php endforeach; ?>
				
			<?php endforeach; ?>
			
			</div>
			<div class="flex-col height-fit m-t-section-small" style="gap: 1rem">
<section class="width-full flex-row flex-center">
    <?php echo do_shortcode('[asearch  image="true" source="' . $category_list . '"]')?>
</section>
<!-- HTML for category filter -->
<section style="display: none">
    <select id="category-filter">
        <option value="all">All Categories</option>
        <?php
        $categories = get_categories();
        foreach ($categories as $category) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
        }
        ?>
    </select>

    <!-- HTML for tag filter -->
    <select id="tag-filter">
        <option value="all">All Tags</option>
        <?php
        $tags = get_tags();
        foreach ($tags as $tag) {
            echo '<option value="' . $tag->slug . '">' . $tag->name . '</option>';
        }
        ?>
    </select>
</section>				
<!-- Container for filtered posts -->
<div id="filtered-posts"></div>
			</div>
		</section>
<script>
// JavaScript for filtering posts
document.getElementById('category-filter').addEventListener('change', filterPosts);
document.getElementById('tag-filter').addEventListener('change', filterPosts);

function filterPosts() {
    var category = document.getElementById('category-filter').value;
    var tag = document.getElementById('tag-filter').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo admin_url('admin-ajax.php'); ?>?action=filter_posts&category=' + category + '&tag=' + tag);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('filtered-posts').innerHTML = xhr.responseText;
        } else {
            console.log('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();
}
</script>