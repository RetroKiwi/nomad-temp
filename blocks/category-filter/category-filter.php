<?php
/**
 * category-filter Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$site_wide_banner = get_field('category-filter', 'options');
// Build a valid style attribute for background and text colors.

// get list of categories from an ACF field here
$category_list = get_field('select_post_type_to_filter');

?>
<section class="width-full flex-row flex-center">
    <?php echo do_shortcode('[asearch  image="true" source="' . $category_list . '"]')?>
</section>
<!-- HTML for category filter -->
<section style="display: none">
    <select id="category-filter">
        <option value="all">All Categories</option>
        <?php
        $categories = get_categories();
        foreach ($categories as $category) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
        }
        ?>
    </select>

    <!-- HTML for tag filter -->
    <select id="tag-filter">
        <option value="all">All Tags</option>
        <?php
        $tags = get_tags();
        foreach ($tags as $tag) {
            echo '<option value="' . $tag->slug . '">' . $tag->name . '</option>';
        }
        ?>
    </select>
</section>

<!-- Container for filtered posts -->
<div id="filtered-posts"></div>

<script>
// JavaScript for filtering posts
document.getElementById('category-filter').addEventListener('change', filterPosts);
document.getElementById('tag-filter').addEventListener('change', filterPosts);

function filterPosts() {
    var category = document.getElementById('category-filter').value;
    var tag = document.getElementById('tag-filter').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo admin_url('admin-ajax.php'); ?>?action=filter_posts&category=' + category + '&tag=' + tag);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('filtered-posts').innerHTML = xhr.responseText;
        } else {
            console.log('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();
}
</script>