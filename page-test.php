<?php
/*
Template Name: PageTestTemplate
*/
get_header(); 
?>
<?php if (is_user_logged_in() === TRUE): ?>
    <?php
    // Display the ACF form
acf_form(array(
    'post_id'       => 'new_post',
    'new_post'      => array(
        'post_type'     => 'post',
        'post_status'   => 'publish'
    ),
    'submit_value'  => 'Create Post',
    'field_groups'  => array(123), // Replace 123 with the ID of your ACF field group
    'return'        => add_query_arg('post_created', 'true', get_permalink()), // Redirect after submission
    'html_submit_button' => '<input type="submit" class="acf-button button button-primary button-large" value="%s" />', // Custom submit button HTML
    'form'          => true,
    'fields'        => array(
        'post_title',
        'post_content',
        // You can add more ACF fields here if needed
    )
));
?>

<?php get_footer(); ?>
<?php else: ?>
    Go away!
<?php endif; ?>