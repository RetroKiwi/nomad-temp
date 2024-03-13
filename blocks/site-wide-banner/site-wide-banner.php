<?php
/**
 * site-wide-banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$site_wide_banner = get_field('site-wide-banner', 'options');
// Build a valid style attribute for background and text colors.

?>

<?php
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : false;
$post_id = (int)$post_id; // Convert to integer

// Render form for editing existing post or creating new post
acf_form(array(
    'post_id' => $post_id,
    'post_title' => true,
    'post_content' => true,
    'field_groups' => array('group_123'), // Replace 'group_123' with your field group key
    'submit_value' => 'Submit Post'
));
?>
