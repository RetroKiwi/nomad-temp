<?php
/**
 * place-to-stay-grid Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$place_to_stay_1 = get_field('place_to_stay_1');
$place_to_stay_2 = get_field('place_to_stay_2');
$place_to_stay_3 = get_field('place_to_stay_3');
$place_to_stay_4 = get_field('place_to_stay_4');
$place_to_stay_5 = get_field('place_to_stay_5');
$place_to_stay_6 = get_field('place_to_stay_6');
$place_to_stay_7 = get_field('place_to_stay_7');
$place_to_stay_8 = get_field('place_to_stay_8');
$place_to_stay_link_1 = get_field('place_to_stay_link_1');
$place_to_stay_link_2 = get_field('place_to_stay_link_2');
$place_to_stay_link_3 = get_field('place_to_stay_link_3');
$place_to_stay_link_4 = get_field('place_to_stay_link_4');
$place_to_stay_link_5 = get_field('place_to_stay_link_5');
$place_to_stay_link_6 = get_field('place_to_stay_link_6');
$place_to_stay_link_7 = get_field('place_to_stay_link_7');
$place_to_stay_link_8 = get_field('place_to_stay_link_8');

// Build a valid style attribute for background and text colors.

?>

<!-- "find a place to stay" grid -->
<section class="flex-col flex-align-center bg-darkest-black m-y-section-small p-x-page relative p-y-section">
			<!-- <h2 class="text-center text-red m-b-section-small">Find a place to stay</h2> -->
			<div class="grid bento-grid-showcase grid-fr-col-4">
				<a href="<?php echo $place_to_stay_link_1['url']; ?>" class="contents">
					<div class="image-cover bg-white grid-big">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_1);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_1['title']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_2['url']; ?>" class="contents">
					<div class="image-cover bg-white">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_2);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_2['title']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_3['url']; ?>" class="contents">
					<div class="and-more image-cover bg-dark-gray">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_3);?>" alt="">
						<h2 class="text-white text-center absolute right-50 bottom-50 m-none" style="transform: translate(50%, 50%)">And<br>more</h2>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_4['url']; ?>" class="contents">
					<div class="image-cover bg-white">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_4);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_4['title']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_5['url']; ?>" class="contents">
					<div class="image-cover bg-white grid-tall">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_5);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_5['title']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_6['url']; ?>" class="contents">
					<div class="image-cover bg-white">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_6);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_6['title']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_7['url']; ?>" class="contents">
					<div class="image-cover bg-white">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_7);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_7['title']; ?></h4>
					</div>
				</a>
				<a href="<?php echo $place_to_stay_link_8['url']; ?>" class="contents">
					<div class="image-cover bg-white">
						<img src="<?php echo wp_get_attachment_image_url($place_to_stay_8);?>" alt="">
						<h4 class="text-white absolute m-none bento-grid-title"><?php echo $place_to_stay_link_8['title']; ?></h4>
					</div>
				</a>
			</div>
		</section>