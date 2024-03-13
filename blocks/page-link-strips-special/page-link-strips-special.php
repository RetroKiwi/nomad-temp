<?php
/**
 * page-link-strips-special Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$site_wide_banner = get_field('page-link-strips-special', 'options');
// Build a valid style attribute for background and text colors.

?>
<section class="flex-col relative m-y-section p-y-section bg-darkest-black" style="gap: var(--item-gap-small)">
			<div class="page-link-strip bg-black grid-fr-col-2 default-gap p-x-page">
				<div class="page-link-strip-category flex-col flex-center flex-align-end relative height-100 ratio-16-9">
					<h2 class="text-white text-end">Category name</h2>
					<a href="" class="contents">
						<button class="primary size-large">Browse all</button>
					</a>
					<div class="page-link-strip-image left-0 top-0 image-cover height-100 width-100">
						<img src="/assets/media/images/squareimgplaceholder.png" alt="">
					</div>
				</div>
				<div class="page-link-strip-item height-100 flex-col nomad-corners border-dark-gray border-2">
					<div class="item-card-content">
						<h2 class="text-light-gray">Some item title here</h4>
						<p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto earum, quas velit eius molestiae odio fuga voluptate consectetur dignissimos facere aut recusandae, vel quibusdam, laboriosam libero eaque aspernatur aliquam repellat.</p>
					</div>
					<div>
						<a href="" class="contents">
							<button class="secondary size-large">Read more</button>
						</a>
					</div>
				</div>
			</div>
			<div class="page-link-strip bg-black grid-fr-col-2 default-gap p-x-page">
				<div class="page-link-strip-item height-100 flex-col nomad-corners border-dark-gray border-2">
					<div class="item-card-content">
						<h2 class="text-light-gray">Some item title here</h4>
						<p class="text-justify">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto earum, quas velit eius molestiae odio fuga voluptate consectetur dignissimos facere aut recusandae, vel quibusdam, laboriosam libero eaque aspernatur aliquam repellat.</p>
					</div>
					<div>
						<a href="" class="contents">
							<button class="secondary size-large">Read more</button>
						</a>
					</div>
				</div>
				<div class="page-link-strip-category flex-col flex-center flex-align-start relative height-100 ratio-16-9">
					<h2 class="text-white text-start">Category name</h2>
					<a href="" class="contents">
						<button class="primary size-large">Browse all</button>
					</a>
					<div class="page-link-strip-image left-0 top-0 image-cover height-100 width-100">
						<img src="/assets/media/images/squareimgplaceholder.png" alt="">
					</div>
				</div>
			</div>
		</section>
