<?php
/**
 * section-title-with-description Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$block_variables = get_field('section-title-with-description');

$title = $block_variables['title'];
$description = $block_variables['description'];
$color = $block_variables['background_color']['value'];

?>


<section style="background: var(--<?php echo $color; ?>)">
    <div class="section-header p-x-page m-x-auto">
        <h2 class="section-title text-red inline"><?php echo $title; ?></h2>
        <span class="decorative-title-strip inline-block border-5 border-light-gray"></span>
        <h3 class="section-subtitle text-light-gray inline relative"><?php echo $description; ?></h3>
    </div>
</section>