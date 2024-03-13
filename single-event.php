<?php
/*
Template Name: EventTemplate
*/
get_header();
$event_listing_taxonomy = get_field('event_listing_taxonomy');
$event_location = get_field('event_location');
$event_start_date = get_field('event_start_date');
$event_end_date = get_field('event_end_date');
$event_ticket_link = get_field('event_ticket_link');
$event_short_description = get_field('event_short_description');
$event_ticket_price = get_field('event_ticket_price');
$event_provider_url = get_field('event_provider_url');
$event_image = get_field('event_image');

?>







<!-- Banner -->
<section class="width-full bg-darkest-black" style="height: 500px">
    <div class="width-full flex-row height-full flex-align-center">
        <h1 class="text-center" style="margin: auto;">Banner type 1 placeholder</h1>
    </div>
</section>

<!-- Blog Content -->

		<!-- item listing main heading -->
		<section class="flex-col flex-align-center bg-black p-x-page p-y-page relative">
			<div class="image-cover left-0 top-0 height-100 width-100 opacity-25" style="position: absolute !important">
				<img src="/assets/media/images/bannerplaceholdersmall.jpg" alt="">
			</div>
			<div class="flex-col flex-align-center relative width-full">
				<div class="text-dark-gray bg-light-gray uppercase" style="padding: .5rem 1rem">
					<small>Event</small>
				</div>
				<div class="bg-dark-gray text-light-gray uppercase" style="padding: .5rem 1rem; font-size: 65%">
					<small><?php echo get_term($event_listing_taxonomy) -> name;?></small>
					<!-- <small>Nomad Tribe event</small> -->
				</div>
				<h1 class="text-center text-light-gray" style="margin-top: 3rem; font-size: 6rem;"><?php the_title(); ?></h1>

				<div class="flex-row flex-align-start flex-center text-light-gray" style="padding: 3rem 0; gap: 1rem">
					<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem;" title="Location">
						<button style="padding: 0 .5rem">
							<i class="fa-solid fa-location-dot"></i>
						</button>
						<span><?php echo get_term($event_location) -> name;?></span>
					</small>
					<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem" title="Event start">
						<button style="padding: 0 .5rem">
							<i class="fa-regular fa-calendar"></i>
						</button>
						<span>Start: <?php echo $event_start_date; ?></span>
					</small>
					<!-- for events that span multiple days 👇 -->
					<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem" title="Event end">
						<button style="padding: 0 .5rem">
							<i class="fa-regular fa-calendar"></i>
						</button>
						<span>End: <?php echo $event_end_date; ?></span>
					</small>
				</div>
				<a href="<?php echo $event_ticket_link; ?>" class="contents">
					<button class="primary size-large">Reserve tickets</button>
				</a>
			</div>
		</section>



		<!-- item listing sub-heading -->
		<section class="flex-col flex-align-center bg-black p-x-page relative" style="padding: 3rem">
			<div class="flex-col flex-align-start relative width-blog text-light-gray">
				<?php echo $event_short_description; ?>
				<p class="item-listing-extra-info"><big><b>Ticket price: </b><?php echo $event_ticket_price; ?></big></p>
				<a href="<?php echo $event_provider_url; ?>" class="contents">
					<button class="primary-inverse size-default" style="margin: 2rem 0">About Us</button>
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
            'post_type' => 'event', // Change post type if needed
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
