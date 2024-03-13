<?php
/**
 * banner-hero-homepage Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

// Build a valid style attribute for background and text colors.

?>

		<!-- main homepage page static hero banner, used only here -->
        <?php 
// Retrieve ACF field values
$content = get_field('scrolling_text_stripe_content');
$text = $content['scrolling_text'];
?>

<!-- main homepage page static hero banner, used only here -->
<div class="scrolling-text-stripe width-full flex-row flex-nowrap flex-center">
    <span><?php echo $text; ?></span>
</div>



