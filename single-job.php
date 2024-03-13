<?php
/*
Template Name: jobsTemplate
*/
get_header();
$enter_salary = get_field('enter_salary');
$select_location_type = get_field('select_location_type');
$job_languages = get_field('job_languages');
$job_title = get_field('job_title');
$job_application_link = get_field('job_application_link');
$job_short_description = get_field('job_short_description');
$job_company_website = get_field('job_company_website');
$job_company_name = get_field ('job_company_name');
$job_listing_image = get_field ('job_listing_image');
$job_type = get_field('job_type');
?>

<!-- item listing main heading -->
<section class="flex-col flex-align-center bg-black p-x-page p-y-page relative">
	<div class="image-cover left-0 top-0 height-100 width-100 opacity-25" style="position: absolute !important">
		<img src="<?php echo $job_listing_image;?>" alt="">
	</div>
	<div class="flex-col flex-align-center relative width-full">
		<div class="text-dark-gray bg-light-gray uppercase" style="padding: .5rem 1rem">
			<small><?php echo get_term( $job_type)->name; ?></small>
		</div>
		<div class="bg-dark-gray text-light-gray uppercase" style="padding: .5rem 1rem; font-size: 65%">
			<small>Sub-category name</small>
		</div>
		<h1 class="text-center text-light-gray" style="margin-top: 3rem; font-size: 6rem;"><?php the_title(); ?></h1>

		<div class="flex-row flex-align-start flex-center text-light-gray" style="padding: 3rem 0; gap: 1rem">
			<?php if (get_term( $select_location_type )->name):?>
				<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem; cursor: pointer" title="Location">
					<button style="padding: 0 .5rem">
						<i class="fa-solid fa-map-location-dot"></i>
					</button>
					<span>
						<?php echo get_term( $select_location_type )->name; ?>
					</span>
				</small>
			<?php endif; ?>
			<?php if ($job_languages):?>
				<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem;" title="Languages">
					<button style="padding: 0 .5rem">
						<i class="fa-solid fa-comment"></i>
					</button>
				<span>
					<?php foreach ($job_languages as $index => $language): ?>
						<?php echo get_term($language)->name; ?>
						<?php if ($index < count($job_languages) - 1): ?>
							, 
						<?php endif; ?>
					<?php endforeach; ?>
				</span>
			</small>
			<?php endif; ?>
			<?php if ($job_title):?>
				<small class="uppercase transition-all text-hover-red bg-hover-light-gray" style="padding: .5rem 1rem;" title="Job Position">
					<button style="padding: 0 .5rem">
						<i class="fa-solid fa-briefcase"></i>
					</button>
					<span>
						<?php echo $job_title;?>
					</span>
				</small>
			<?php endif; ?>
		</div>
		<a href="<?php echo $job_application_link; ?>" class="contents">
			<button class="primary size-large">Apply for work</button>
		</a>
	</div>
</section>

<!-- item listing sub-heading -->
<section class="flex-col flex-align-center bg-black p-x-page relative" style="padding: 3rem">
	<div class="flex-col flex-align-start relative width-blog text-light-gray">
		<?php if ($job_company_name):?>
			<p><big><b><?php echo $job_company_name; ?> offers:</b></big></p>
		<?php endif; ?>
		<p><?php echo $job_short_description;?></p>
		<?php if ($enter_salary):?>
			<p><big><b>Wage: </b><?php echo $enter_salary;?></big></p>
		<?php endif;?>
		<?php if ($job_company_website): ?>
		<a href="<?php echo $job_company_website; ?>" class="contents">
			<button class="primary-inverse size-default" style="margin: 2rem 0"><?php echo $job_company_name; ?></button>
		</a>
		<?php endif; ?>
	</div>
</section>

<!-- blog stuff -->
<section class="width-full flex-col flex-align-center">
	<div class="blog-page flex-col flex-align-center width-blog m-y-section-small">
		<!-- blog content -->
		<div class="blog-content bg-white p-y-page nomad-corners">
			<?php
				// Start the loop
				if (have_posts()) :
					while (have_posts()) : the_post();
						the_content();
					endwhile;
				endif;
			?>
		</div>
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
				'post_type' => 'job', // Change post type if needed
				'posts_per_page' => 3, // Number of posts to display
				'order' => 'DESC', // Order of posts (DESC for latest first)
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) :
				while ($query->have_posts()) : $query->the_post(); ?>
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
                                <small>New Job</small>
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
