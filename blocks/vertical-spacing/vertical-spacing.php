<?php
/**
 * vertical-spacing Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$spacing = get_field('vertical-spacing')['value'];
$color = get_field('background-color')['value'];
// Build a valid style attribute for background and text colors.

?>

<div class="width-full" style="height: <?php echo $spacing; ?>; background: var(--<?php echo $color; ?>)"></div>


