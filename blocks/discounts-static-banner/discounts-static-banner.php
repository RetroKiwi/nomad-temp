<?php
/**
 * discounts-static-banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$discount_textarea = get_field('discount_text_area');
$discount_link = get_field('discount_button');
// Build a valid style attribute for background and text colors.

?>

<section class="bg-darker-red m-y-section p-x-page relative p-y-section">
			<div class="bg-darker-red absolute width-100 height-100 left-0 top-0" style="z-index: -1; clip-path: polygon(50% 0, 100% 0, 100% 100%, 0% 100%)"></div>
			<div class="grid-fr-col-2 default-gap">
				<h1 class="text-light-gray" style="font-size: 10vw;">Best<br>discounts<br>& services</h1>
				
				<div class="height-100 flex flex-align-center">
					<div class="height-fit border-2 border-light-gray nomad-corners" style="padding: 3rem">
						<p class="text-justify text-white"><?php echo $discount_textarea;?></p>
						<a href="<?php echo $discount_link['url']; ?>" class="contents">
							<button class="secondary size-large"><?php echo $discount_link['title']; ?></button>
						</a>
					</div>
				</div>
			</div>
		</section>
