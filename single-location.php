<?php
/*
Template Name: LocationTemplate
*/
get_header();
$accomodation_category = get_field('accomodation_category');
$accomodation_rent_duration = get_field('accomodation_rent_duration');
$accomodation_rent_or_buy = get_field('accomodation_rent_or_buy');
$accomodation_amenities = get_field('accomodation_amenities');
$accomodation_location = get_field('accomodation_location');
$accommodation_listing_link = get_field('accommodation_listing_link');
$accomodation_short_description = get_field('accomodation_short_description');
$accomodation_amenities = get_field('accomodation_amenities');
$accomodation_square_footage = get_field('accomodation_square_footage');
$accomodation_price = get_field('accomodation_price');
$accomodation_about_link = get_field('accomodation_about_link');
$accomodation_image = get_field('accommodation_image');

?>

		<!-- item listing main heading -->
		<section class="flex-col flex-align-center bg-black p-x-page p-y-page relative">
			<div class="image-cover left-0 top-0 height-100 width-100 opacity-25" style="position: absolute !important">
				<img src="<?php echo $accomodation_image;?>" alt="">
			</div>
			<div class="flex-col flex-align-center relative width-full">
		
				<div class="text-dark-gray bg-light-gray uppercase" style="padding: .5rem 1rem">
					<small><?php echo get_term($accomodation_category , 'accomodation-type') -> name ?></small>
				</div>
				<?php if ($accomodation_rent_duration): ?>
				<div class="bg-dark-gray text-light-gray uppercase" style="padding: .5rem 1rem; font-size: 65%">
			
					<small><?php $length = count($accomodation_rent_duration);
foreach ($accomodation_rent_duration as $key => $rent_duration):
    $term_name = get_term($rent_duration)->name;
    echo $term_name;
    if ($key < $length - 1) {
        echo ', ';
    }
endforeach; ?></small>
	
					<!-- <small>Long-term stay</small> -->
					<!-- <small>For purchase</small> -->
				</div>
				<?php endif; ?>
				<h1 class="text-center text-light-gray" style="margin-top: 3rem; font-size: 6rem;"><?php echo the_title(); ?></h1>

				<div class="flex-row flex-align-start flex-center text-light-gray" style="padding: 3rem 0; gap: 1rem">
					<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem" title="Available for">
						<button style="padding: 0 .5rem">
							<i class="fa-solid fa-hand-holding-dollar"></i>
						</button>
						<span>Available for: <?php echo get_term($accomodation_rent_or_buy) -> name ?></span>
					</small>
					<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem;" title="Property type">
						<button style="padding: 0 .5rem">
							<i class="fa-solid fa-house"></i>
						</button>
						<span><?php echo get_term($accomodation_category , 'accomodation-type') -> name ?></span>
					</small>
					<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem;" title="Location">
						<button style="padding: 0 .5rem">
							<i class="fa-solid fa-location-dot"></i>
						</button>
						<span><?php echo get_term($accomodation_location) -> name; ?></span>
					</small>
				</div>
				<a href="<?php echo $accommodation_listing_link; ?>" class="contents">
					<button class="primary size-large">Reserve accommodation</button>
				</a>
			</div>
		</section>



		<!-- item listing sub-heading -->
		<section class="flex-col flex-align-center bg-black p-x-page relative" style="padding: 3rem">
			<div class="flex-col flex-align-start relative width-blog text-light-gray">
				<?php echo $accomodation_short_description; ?>
				<p class="item-listing-extra-info"><big><b>Amenities: </b><?php $length = count($accomodation_amenities);
foreach ($accomodation_amenities as $key => $rent_amenities):
    $term_name = get_term($rent_amenities)->name;
    echo $term_name;
    if ($key < $length - 1) {
        echo ', ';
    }
endforeach; ?></big></p>
				<?php if ($accomodation_square_footage):?>
				<p class="item-listing-extra-info"><big><b>Square footage: </b><?php echo $accomodation_square_footage; ?></p>
				<?php endif; ?>
				<?php if ($accomodation_price):?>
				<p class="item-listing-extra-info"><big><b>Price: </b><?php echo $accomodation_price; ?></big></p>
				<?php endif; ?>
				<a href="<?php echo $accomodation_about_link; ?>" class="contents">
					<button class="primary-inverse size-default" style="margin: 2rem 0">About us</button>
				</a>
			</div>
		</section>



		<!-- blog stuff -->
		<section class="width-full flex-col flex-align-center">
			<div class="blog-page flex-col flex-align-center width-blog m-y-section-small">
				<!-- blog content -->
				<?php
if (have_posts()) : while (have_posts()) : the_post();
    the_content(); // Echoes the post content
endwhile; endif;
?>

			</div>
		</section>




<?php
// Retrieve ACF fields
$showcase_items = get_field('showcase_items');
?>

<section class="m-y-section">

    <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">
        <?php
        $args = array(
            'post_type' => 'location', // Change post type if needed
            'posts_per_page' => 3, // Number of posts to display
            'order' => 'DESC', // Order of posts (DESC for latest first)
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                <a href="<?php the_permalink(); ?>" class="contents">
                    <div class="item-card nomad-corners">
                        <div class="item-card-image nomad-corners image-cover ratio-4-3">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/images/squareimgplaceholder.png" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="item-card-content">
                            <div class="flex-row flex-between text-light-gray uppercase" style="margin-top: 1rem">
                                <small><?php echo get_the_category_list(', '); ?></small>
                                <small><?php echo get_the_date(); ?></small>
                            </div>
                            <h3 class="text-red text-dense-lines"><?php the_title(); ?></h3>
                            <p class="text-justify"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        </div>
                        <div>
                            <a href="<?php the_permalink(); ?>" class="primary size-large">Read more</a>
                        </div>
                    </div>
                </a>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo 'No posts found';
        endif;
        ?>
    </div>

</section>


<?php get_footer(); ?>
