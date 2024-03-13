<?php
/**
 * invisible-anchor-tag Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$tag_id = get_field('tag-id');
$offset = get_field('offset');
// Build a valid style attribute for background and text colors.

?>

<div class="relative width-full">
	<div id="<?php echo $tag_id; ?>" class="absolute left-0 top-0" style="margin-top: <?php echo $offset; ?>rem"></div>
</div>


