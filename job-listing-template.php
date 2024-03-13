<?php /* Template Name: Job listing */ ?>

<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php
// Get the current user ID
$user_id = get_current_user_id();

// Get all orders for the current user
$customer_orders = wc_get_orders( array(
    'customer' => $user_id,
    //'status'   => array( 'completed' ) // Assuming you want to check completed orders
) );

// Define the product ID you want to check
$product_id = 1577;

// Initialize a flag to indicate if the user has bought the product
$user_has_bought_product = false;

// Loop through each order and check if it contains the product
foreach ( $customer_orders as $order ) {
    // Get all items in the order
    $items = $order->get_items();

    // Check each item in the order
    foreach ( $items as $item ) {
        // If the product ID matches, set the flag and break out of the loop
        if ( $item->get_product_id() === $product_id ) {
            $user_has_bought_product = true;
            break 2; // Break out of both loops
        }
    }
}

// Now $user_has_bought_product variable will indicate if the user has bought the product
if ( $user_has_bought_product ) : ?>
  
    <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
    <?php acf_form(array(
        'post_id'       => 'new_post',
        'post_title'    => true,
        
        'new_post'      => array(
            'post_type'     => 'job',
            'post_status'   => 'draft'
        ),
        'fields'        => array('job_company_name','enter_salary','select_location_type','job_languages','job_type','job_title', 'job_application_link', 'job_short_description','job_company_website', 'job_listing_image', 'job_adress', ),
		'post_content'  => true,
        'submit_value'  => 'Create new Job Listing',
		'return'        => 'https://nomadtribecroatia.com/thank-you-page/', 
    )); ?>
    <?php endwhile; ?>
    </div><!-- #content -->
</div><!-- #primary -->
<?php else:?> 
  
   User has not bought the product."
<?php endif;?>






<?php get_footer(); ?>

