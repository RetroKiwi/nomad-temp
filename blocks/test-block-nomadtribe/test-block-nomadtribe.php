<?php
/**
 * test-block-nomadtribe Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$site_wide_banner = get_field('test-block-nomadtribe', 'options');
// Build a valid style attribute for background and text colors.

?>

<!-- item card list and grid with switch component -->
<section class="m-y-section relative">
	<!-- this is the switch component -->
	<div class="absolute right-0 height-full" style="padding: 3rem 0">
		<div class="item-card-layout-switch">
			<span class="label">Layout</span>
			<button class="grid"><i class="fa-solid fa-grip"></i></button>
			<button class="list"><i class="fa-solid fa-grip-lines"></i></button>
			<span class="label">Layout</span>
		</div>
	</div>
	<!-- this is the list / grid itself -->
	<div class="item-card-grid p-x-page m-x-auto m-y-section-small">
		<!--
			there are 9 examples here
			the first three are most important
			because they show different layout elements
			for different types of item card content
			-->

		<!-- blog post item card -->
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/bookstore.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Guide, Entertainment, Some really long category tag I need this for testing</small>
					<small class="text-gray-hover"><i class="fa-regular fa-calendar"></i>September 12, 2024</small>
				</div>
				<h3 class="text-white-hover">Split: a bookworm's guide to the best bookstores</h4>
				<p class="text-light-gray-hover">Nestled along the Dalmatian Coast, Split is a city steeped in history, culture, and a vibrant literary scene. Beyond its ancient ruins and stunning coastline, Split boasts a collection of delightful bookstores that cater to the tastes of every bibliophile. Whether you’re a traveler seeking a new read or a local in pursuit of literary […]</p>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">Read more</button>
			</div>
		</div>
		<!-- job listing item card -->
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/designer.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Job listing</small>
					<small class="text-gray-hover"><i class="fa-regular fa-calendar"></i>April 0, 2024</small>
				</div>
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-comment"></i>Croatian, English, German</small>
					<small class="text-gray-hover"><i class="fa-solid fa-location-dot"></i>On location / hybrid</small>
				</div>
				<h3 class="text-white-hover">Senior UX designer consultant</h4>
				<p class="text-light-gray-hover">Design Inc. is looking for a Design Specialist</p>
				<div class="item-card-brief">
					<big class="text-gray-hover"><i class="fa-solid fa-coins"></i>32 € hourly</big>
				</div>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">See details</button>
			</div>
		</div>
		<!-- accommodation item card -->
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/apartment.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Accommodation</small>
					<small class="text-gray-hover"><i class="fa-solid fa-location-dot"></i>Pula</small>
				</div>
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-hand-holding-dollar"></i>Available for: Rent</small>
					<small class="text-gray-hover"><i class="fa-solid fa-house"></i>Apartment</small>
				</div>
				<h3 class="text-white-hover">Luxury apartment in Pula</h4>
				<p class="text-light-gray-hover">A four-bedroom stay with a balcony and view toward the sea. Upper part of Pula, close to city center.</p>
				<div class="item-card-brief">
					<span class="text-gray-hover"><i class="fa-solid fa-wrench"></i>Wifi, Air conditioning, Pets allowed, Parking, Balcony/terrace</span>
				</div>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">See details</button>
			</div>
		</div>



		<!-- these are just to demonstrate functionality -->
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/designer.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Job listing</small>
					<small class="text-gray-hover"><i class="fa-regular fa-calendar"></i>April 0, 2024</small>
				</div>
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-comment"></i>Croatian, English, German</small>
					<small class="text-gray-hover"><i class="fa-solid fa-location-dot"></i>On location / hybrid</small>
				</div>
				<h3 class="text-white-hover">Senior UX designer consultant</h4>
				<p class="text-light-gray-hover">Design Inc. is looking for a Design Specialist</p>
				<div class="item-card-brief">
					<big class="text-gray-hover"><i class="fa-solid fa-coins"></i>32 € hourly</big>
				</div>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">See details</button>
			</div>
		</div>
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/bookstore.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Guide, Entertainment, Some really long category tag I need this for testing</small>
					<small class="text-gray-hover"><i class="fa-regular fa-calendar"></i>September 12, 2024</small>
				</div>
				<h3 class="text-white-hover">Split: a bookworm's guide to the best bookstores</h4>
				<p class="text-light-gray-hover">Nestled along the Dalmatian Coast, Split is a city steeped in history, culture, and a vibrant literary scene. Beyond its ancient ruins and stunning coastline, Split boasts a collection of delightful bookstores that cater to the tastes of every bibliophile. Whether you’re a traveler seeking a new read or a local in pursuit of literary […]</p>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">Read more</button>
			</div>
		</div>
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/apartment.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Accommodation</small>
					<small class="text-gray-hover"><i class="fa-solid fa-location-dot"></i>Pula</small>
				</div>
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-hand-holding-dollar"></i>Available for: Rent</small>
					<small class="text-gray-hover"><i class="fa-solid fa-house"></i>Apartment</small>
				</div>
				<h3 class="text-white-hover">Luxury apartment in Pula</h4>
				<p class="text-light-gray-hover">A four-bedroom stay with a balcony and view toward the sea. Upper part of Pula, close to city center.</p>
				<div class="item-card-brief">
					<span class="text-gray-hover"><i class="fa-solid fa-wrench"></i>Wifi, Air conditioning, Pets allowed, Parking, Balcony/terrace</span>
				</div>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">See details</button>
			</div>
		</div>
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/designer.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Job listing</small>
					<small class="text-gray-hover"><i class="fa-regular fa-calendar"></i>April 0, 2024</small>
				</div>
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-comment"></i>Croatian, English, German</small>
					<small class="text-gray-hover"><i class="fa-solid fa-location-dot"></i>On location / hybrid</small>
				</div>
				<h3 class="text-white-hover">Senior UX designer consultant</h4>
				<p class="text-light-gray-hover">Design Inc. is looking for a Design Specialist</p>
				<div class="item-card-brief">
					<big class="text-gray-hover"><i class="fa-solid fa-coins"></i>32 € hourly</big>
				</div>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">See details</button>
			</div>
		</div>
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/apartment.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Accommodation</small>
					<small class="text-gray-hover"><i class="fa-solid fa-location-dot"></i>Pula</small>
				</div>
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-hand-holding-dollar"></i>Available for: Rent</small>
					<small class="text-gray-hover"><i class="fa-solid fa-house"></i>Apartment</small>
				</div>
				<h3 class="text-white-hover">Luxury apartment in Pula</h4>
				<p class="text-light-gray-hover">A four-bedroom stay with a balcony and view toward the sea. Upper part of Pula, close to city center.</p>
				<div class="item-card-brief">
					<span class="text-gray-hover"><i class="fa-solid fa-wrench"></i>Wifi, Air conditioning, Pets allowed, Parking, Balcony/terrace</span>
				</div>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">See details</button>
			</div>
		</div>
		<div class="item-card">
			<div class="item-card-image">
				<img src="/assets/media/images/bookstore.jpg" alt="">
			</div>
			<div class="item-card-content">
				<div class="item-card-brief hide-hover">
					<small class="text-gray-hover"><i class="fa-solid fa-tag"></i>Guide, Entertainment, Some really long category tag I need this for testing</small>
					<small class="text-gray-hover"><i class="fa-regular fa-calendar"></i>September 12, 2024</small>
				</div>
				<h3 class="text-white-hover">Split: a bookworm's guide to the best bookstores</h4>
				<p class="text-light-gray-hover">Nestled along the Dalmatian Coast, Split is a city steeped in history, culture, and a vibrant literary scene. Beyond its ancient ruins and stunning coastline, Split boasts a collection of delightful bookstores that cater to the tastes of every bibliophile. Whether you’re a traveler seeking a new read or a local in pursuit of literary […]</p>
			</div>
			<div class="item-card-action-button">
				<button class="primary size-large">Read more</button>
			</div>
		</div>
	</div>

	<!-- The load more button at the end. We'll detect if there's more,
	then gray it out and make unclickable when we've loaded everything -->
	<div class="flex-row flex-center width-100">
		<a class="contents" href="#">
			<button class="primary-inverse size-huge">Load more</button>
		</a>
	</div>
</section>