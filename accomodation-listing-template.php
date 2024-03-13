<?php /* Template Name: Accomodation listing */ ?>

<?php acf_form_head(); ?>
<?php get_header(); ?>


    <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php acf_form(array(
        'post_id'       => 'new_post',
        'post_title'    => true,
        
        'new_post'      => array(
            'post_type'     => 'location',
            'post_status'   => 'draft'
        ),
        'fields'        => array(),
		'post_content'  => true,
        'submit_value'  => 'Create new Accomodation Listing',
		//'return'        => 'https://nomadtribecroatia.com/thank-you-page/', 
    )); ?>
    <?php endwhile; ?>
    </div><!-- #content -->
</div><!-- #primary -->





<?php get_footer(); ?>

