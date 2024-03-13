<?php
/**
 * main-section-title Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$main_section_title = get_field('main_section_title');

$title = $main_section_title['title'];
$text_color = $main_section_title['text_color']['value'];
$background_color = $main_section_title['background_color']['value'];
$center_text = $main_section_title['center_text'];

?>

<section class="p-x-page p-y-section-small flex-col <?php echo $center_text ? 'flex-align-center' : ''; ?>" style="background: var(--<?php echo $background_color; ?>)">
	<h2 class="<?php echo $center_text ? 'text-center' : ''; ?>" style="color: var(--<?php echo $text_color; ?>)"><?php echo $title; ?></h2>
</section>