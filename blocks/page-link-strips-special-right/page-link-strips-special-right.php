<?php
/**
 * page-link-strips-special-right Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$service_category_title = get_field('service_category_title');
$service_category_link = get_field('service_category_link');
$service_category_image = get_field('service_category_image');
$service_category_post = get_field('service_category_post');
// Build a valid style attribute for background and text colors.

?>

<section class="flex-col relative m-y-section p-y-section bg-darkest-black" style="gap: var(--item-gap-small)">
		
			<div class="page-link-strip bg-black grid-fr-col-2 default-gap p-x-page">
				<div class="page-link-strip-item height-100 flex-col nomad-corners border-dark-gray border-2">
					<div class="item-card-content">
						<h2 class="text-light-gray"><?php echo get_the_title($service_category_post);?></h4>
						<p class="text-justify"><?php echo get_the_excerpt($service_category_post);?></p>
					</div>
					<div>
						<a href="<?php echo get_the_permalink($service_category_post);?>" class="contents">
							<button class="secondary size-large">Read more</button>
						</a>
					</div>
				</div>
				<div class="page-link-strip-category flex-col flex-center flex-align-start relative height-100 ratio-16-9">
					<h2 class="text-white text-start"><?php echo $service_category_title; ?></h2>
					<a href="<?php echo $service_category_link['url']; ?>" class="contents">
						<button class="primary size-large"><?php echo $service_category_link['title']; ?></button>
					</a>
					<div class="page-link-strip-image left-0 top-0 image-cover height-100 width-100">
						<img src="<?php echo wp_get_attachment_image_url($service_category_image);?>" alt="">
					</div>
				</div>
			</div>
		</section>
