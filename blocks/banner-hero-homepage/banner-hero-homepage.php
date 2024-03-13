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
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$button_link = get_field('button_link');
?>

<!-- main homepage page static hero banner, used only here -->
<div class="main-banner bg-black width-full flex-col flex-align-center flex-center">
    <h1 class="nomad-tribe-title text-red"><?php echo esc_html($hero_title); ?></h1>
    <h3 class="nomad-tribe-subtitle text-light-gray"><?php echo esc_html($hero_subtitle); ?></h3>
    <a href="<?php echo esc_url($button_link); ?>" class="contents"><button class="primary rounded-small size-huge" style="margin: .5rem">Learn more</button></a>
</div>



