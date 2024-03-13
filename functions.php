<?php
/**
 * NomadTribe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NomadTribe
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nomadtribe_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on NomadTribe, use a find and replace
		* to change 'nomadtribe' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nomadtribe', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nomadtribe' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nomadtribe_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nomadtribe_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nomadtribe_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nomadtribe_content_width', 640 );
}
add_action( 'after_setup_theme', 'nomadtribe_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nomadtribe_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nomadtribe' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nomadtribe' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nomadtribe_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nomadtribe_scripts() {
	wp_enqueue_style( 'nomadtribe-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'nomadtribe-style', 'rtl', 'replace' );

	wp_enqueue_script( 'nomadtribe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nomadtribe_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		 'page_title' => 'Banner Options',
		 'menu_title' => 'Banner Options',
		 'menu_slug' => 'banner-options',
		 'capability' => 'edit_posts',
		 'redirect' => true
	  ));
   }
   if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		 'page_title' => 'Menu Options',
		 'menu_title' => 'Menu Options',
		 'menu_slug' => 'menu-options',
		 'capability' => 'edit_posts',
		 'redirect' => true
	  ));
   }
   if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		 'page_title' => 'Footer Options',
		 'menu_title' => 'Footer Options',
		 'menu_slug' => 'footer-options',
		 'capability' => 'edit_posts',
		 'redirect' => true
	  ));
   }

   add_action( 'init', 'register_acf_blocks' );
   function register_acf_blocks() {
	   register_block_type( __DIR__ . '/blocks/site-wide-banner' );
	   register_block_type( __DIR__ . '/blocks/banner-hero-homepage' );
	   register_block_type( __DIR__ . '/blocks/items-showcase' );
	   register_block_type( __DIR__ . '/blocks/item-row-list' );
	   register_block_type( __DIR__ . '/blocks/single-blog-items' );
	   register_block_type( __DIR__ . '/blocks/discounts-static-banner' );
	   register_block_type( __DIR__ . '/blocks/page-title-special' );
	   register_block_type( __DIR__ . '/blocks/page-link-strips-special-left' );
	   register_block_type( __DIR__ . '/blocks/page-link-strips-special-right' );
	   register_block_type( __DIR__ . '/blocks/restaurants-nearby' );
	   register_block_type( __DIR__ . '/blocks/place-to-stay-grid' );
	   register_block_type( __DIR__ . '/blocks/find-a-restaurant' );
	   register_block_type( __DIR__ . '/blocks/items-showcase-filter' );
	   register_block_type( __DIR__ . '/blocks/category-filter' );
	   register_block_type( __DIR__ . '/blocks/scrolling-text-stripe' );
	   register_block_type( __DIR__ . '/blocks/buy-rent-form-filter' );
	   register_block_type( __DIR__ . '/blocks/general-filter' );
	   register_block_type( __DIR__ . '/blocks/test-block-nomadtribe' );
	   register_block_type( __DIR__ . '/blocks/all-services-filter' );
	   register_block_type( __DIR__ . '/blocks/all-jobs-filter' );
   }


   function enqueue_my_script() {
    // Register the script
    wp_register_script('my-script', get_template_directory_uri() . '/js/my-script.js', array('jquery'), '1.0', true);

    // Enqueue the script
    wp_enqueue_script('my-script');
}
add_action('wp_enqueue_scripts', 'enqueue_my_script');





// Function to filter posts by category and tag
function filter_posts_by_category_and_tag() {
    $category = $_GET['category'];
    $tag = $_GET['tag'];
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1,
    );
    if ($category != 'all') {
        $args['category_name'] = $category;
    }
    if ($tag != 'all') {
        $args['tag'] = $tag;
    }
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Output post content here
            echo '<h2>' . get_the_title() . '</h2>';
			echo '<img width="500" height="500" src="' . get_the_post_thumbnail_url() . '">';
        endwhile;
    else :
        echo 'No posts found';
    endif;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_filter_posts', 'filter_posts_by_category_and_tag');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts_by_category_and_tag'); // For non-logged-in users

add_filter( 'woocommerce_add_to_cart_redirect', 'bbloomer_redirect_checkout_add_cart' );
 
function bbloomer_redirect_checkout_add_cart() {
   return wc_get_checkout_url();
}


add_action('acf/submit_form', 'my_create_new_post_form', 20);

function my_create_new_post_form($post_id) {

  // Replace with your actual form name
  if ('your_form_name' !== $_POST['_post_id']) {
    return;
  }

  // Sanitize and validate data
  $title = sanitize_text_field($_POST['your_title_field']);
  $content = wp_kses_post($_POST['your_content_field']);
  $custom_field_value = sanitize_text_field($_POST['your_custom_field']);

  // Create new post
  $new_post = wp_insert_post(array(
    'post_type' => 'your_post_type', // Replace with your actual post type
    'post_title' => $title,
    'post_content' => $content,
    'post_status' => 'draft', // Adjust as needed (e.g., 'publish')
  ));

  // Update custom field (replace with your actual field name and ID)
  update_field('your_custom_field_name', $custom_field_value, $new_post);

  // Redirect on success (optional)
  if ($new_post) {
    wp_redirect(get_permalink($new_post));
    exit;
  } else {
    // Handle error (e.g., display error message)
    wp_die('There was an error creating your post. Please try again.');
  }

}


add_shortcode( 'asearch', 'asearch_func' );
function asearch_func( $atts ) {
    $atts = shortcode_atts( array(
        'source' => 'page,post,product,job,event',
        'image' => 'true'
    ), $atts, 'asearch' );
static $asearch_first_call = 1;
$source = $atts["source"];
$image = $atts["image"];
$sForam = '<div class="search_bar">
    <form class="asearch" id="asearch'.$asearch_first_call.'" action="/" method="get" autocomplete="off">
        <input type="text" name="s" placeholder="Search ..." id="keyword" class="input_search" onkeyup="searchFetch(this)"><button id="mybtn">🔍</button>
    </form><div class="search_result" id="datafetch" style="display: none;">
        <ul>
            <li>Please wait..</li>
        </ul>
    </div></div>';
$java = '<script>
function searchFetch(e) {
var datafetch = e.parentElement.nextSibling
if (e.value.trim().length > 0) { datafetch.style.display = "block"; } else { datafetch.style.display = "none"; }
const searchForm = e.parentElement;	
e.nextSibling.value = "Please wait..."
var formdata'.$asearch_first_call.' = new FormData(searchForm);
formdata'.$asearch_first_call.'.append("source", "'.$source.'") 
formdata'.$asearch_first_call.'.append("image", "'.$image.'") 
formdata'.$asearch_first_call.'.append("action", "asearch") 
AjaxAsearch(formdata'.$asearch_first_call.',e) 
}
async function AjaxAsearch(formdata,e) {
  const url = "'.admin_url("admin-ajax.php").'?action=asearch";
  const response = await fetch(url, {
      method: "POST",
      body: formdata,
  });
  const data = await response.text();
if (data){	e.parentElement.nextSibling.innerHTML = data}else  {
e.parentElement.nextSibling.innerHTML = `<ul><a href="#"><li>Sorry, nothing found</li></a></ul>`
}}	
document.addEventListener("click", function(e) { if (document.activeElement.classList.contains("input_search") == false ) { [...document.querySelectorAll("div.search_result")].forEach(e => e.style.display = "none") } else {if  (e.target.value.trim().length > 0) { e.target.parentElement.nextSibling.style.display = "block"}} })
</script>';
$css = '<style>form.asearch {display: flex;flex-wrap: nowrap;border: 1px solid #d6d6d6;border-radius: 5px;padding: 3px 5px;}
form.asearch button#mybtn {padding: 5px;cursor: pointer;background: none;}
form.asearch input#keyword {border: none;}
div#datafetch {
    background: white;
    z-index: 10;
    position: absolute;
    max-height: 425px;
    overflow: auto;
    box-shadow: 0px 15px 15px #00000036;
    right: 0;
    left: 0;
    top: 50px;
}
div.search_bar {
    width: 600px!important;
    max-width: 90%!important;
    position: relative;
}

div.search_result ul a li {
    margin: 0px;
    padding: 5px 0px;
    padding-inline-start: 18px;
    color: #3f3f3f;
    font-weight: bold;
}
div.search_result li {
    margin-inline-start: 20px;
}
div.search_result ul {
    padding: 13px 0px 0px 0px;
    list-style: none;
    margin: auto;
}

div.search_result ul a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}
div.search_result ul a:hover {
    background-color: #f3f3f3;
}
.asearch input#keyword {
    width: 100%;
}
</style>';
if ( $asearch_first_call == 1 ){	
	 $asearch_first_call++;
	 return "{$sForam}{$java}{$css}"; } elseif  ( $asearch_first_call > 1 ) {
		$asearch_first_call++;
		return "{$sForam}"; }}

add_action('wp_ajax_asearch' , 'asearch');
add_action('wp_ajax_nopriv_asearch','asearch');
function asearch(){
    $the_query = new WP_Query( array( 'posts_per_page' => 10, 's' => esc_attr( $_POST['s'] ), 'post_type' =>  explode(",", esc_attr( $_POST['source'] )))  );
    if( $the_query->have_posts() ) :
        echo '<ul>';
        while( $the_query->have_posts() ): $the_query->the_post(); ?>
            <a href="<?php echo esc_url( post_permalink() ); ?>"><li><?php the_title();?></li>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );?>                               
<?php if ( $image[0] && trim(esc_attr( $_POST['image'] )) == "true" ) {  ?>  <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" style="height: 60px;padding: 0px 5px;"> <?php }  ?> </a>
        <?php endwhile;
       echo '</ul>';
        wp_reset_postdata();  
    endif;
    die();
}




function get_template_for_category( $template ) {

    if ( basename( $template ) === 'category.php' ) { // No custom template for this specific term, let's find it's parent
        // get the current term, e.g. red
        $term = get_queried_object();

        // check for template file for the page category
        $slug_template = locate_template( "category-{$term->slug}.php" );
        if ( $slug_template ) return $slug_template;

        // if the page category doesn't have a template, then start checking back through the parent levels to find a template for a parent slug
        $term_to_check = $term;
        while ( $term_to_check ->parent ) {
            // get the parent of the this level's parent
            $term_to_check = get_category( $term_to_check->parent );

            if ( ! $term_to_check || is_wp_error( $term_to_check ) )
                break; // No valid parent found

            // Use locate_template to check if a template exists for this categories slug
            $slug_template = locate_template( "category-{$term_to_check->slug}.php" );
            // if we find a template then return it. Otherwise the loop will check for this level's parent
            if ( $slug_template ) return $slug_template;
        }
    }

    return $template;
}
add_filter( 'category_template', 'get_template_for_category' );


add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts() {
    $page = $_POST['page'];

    $query = new WP_Query(array(
		'post_type' => array('post', 'restaurant'),
        'posts_per_page' => 6,
        'paged' => $page,
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
           <a href="<?php the_permalink(); ?>" class="contents">
                    <div class="item-card nomad-corners">
                        <div class="item-card-image nomad-corners image-cover ratio-4-3">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/images/squareimgplaceholder.png" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="item-card-content">
                            <div class="flex-row flex-between text-light-gray uppercase" style="margin-top: 1rem">
                                <small><?php echo get_the_category_list(', '); ?></small>
                                <small><?php echo get_the_date(); ?></small>
                            </div>
                            <h3 class="text-red text-dense-lines"><?php the_title(); ?></h3>
                            <p class="text-justify"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        </div>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <button class="primary size-large">Read more</button>
                            </a>
                        </div>
                    </div>
                </a>
<?php
        endwhile;
    endif;

    wp_die();
}


function custom_ajax_filter() {
    check_ajax_referer('ajax-filter-nonce', 'nonce');

    $taxonomy1 = $_POST['taxonomy1'];
    $terms1 = $_POST['terms1'];

    $taxonomy2 = $_POST['taxonomy2'];
    $terms2 = $_POST['terms2'];

    $taxonomy3 = $_POST['taxonomy3'];
    $terms3 = $_POST['terms3'];

    $taxonomy4 = $_POST['taxonomy4'];
    $terms4 = $_POST['terms4'];

    // Check if any terms are selected
    if (empty($terms1) && empty($terms2) && empty($terms3) && empty($terms4)) {
        echo 'No posts found';
        wp_die();
    }

    $tax_queries = array('relation' => 'AND');

    if (!empty($terms1)) {
        $tax_queries[] = array(
            'taxonomy' => $taxonomy1,
            'field' => 'slug',
            'terms' => $terms1,
        );
    }

    if (!empty($terms2)) {
        $tax_queries[] = array(
            'taxonomy' => $taxonomy2,
            'field' => 'slug',
            'terms' => $terms2,
        );
    }

    if (!empty($terms3)) {
        $tax_queries[] = array(
            'taxonomy' => $taxonomy3,
            'field' => 'slug',
            'terms' => $terms3,
        );
    }

    if (!empty($terms4)) {
        $tax_queries[] = array(
            'taxonomy' => $taxonomy4,
            'field' => 'slug',
            'terms' => $terms4,
        );
    }

    $args = array(
        'post_type' => 'any', // Search all post types
        'posts_per_page' => -1,
        'tax_query' => $tax_queries,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Output your posts here using the_content(), the_title(), etc.?>
          <a href="<?php the_permalink(); ?>" class="contents">
                    <div class="item-card nomad-corners">
                        <div class="item-card-image nomad-corners image-cover ratio-4-3">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/media/images/squareimgplaceholder.png" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="item-card-content">
                            <div class="flex-row flex-between text-light-gray uppercase" style="margin-top: 1rem">
                                <small><?php // echo get_the_trems(); ?></small>
                                <small><?php echo get_the_date(); ?></small>
                            </div>
                            <h3 class="text-red text-dense-lines"><?php the_title(); ?></h3>
                            <p class="text-justify"><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                        </div>
                        <div>
                            <a href="<?php the_permalink(); ?>">
                                <button class="primary size-large">Read more</button>
                            </a>
                        </div>
                    </div>
                </a>
<?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    die();
}
add_action('wp_ajax_custom_filter', 'custom_ajax_filter');
add_action('wp_ajax_nopriv_custom_filter', 'custom_ajax_filter');






 
function acf_set_featured_image( $value, $post_id, $field  ){
    
    if($value != ''){
		
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=job_listing_image', 'acf_set_featured_image', 10, 3);
 

function acf_set_featured_image_accomodation( $value, $post_id, $field  ){
    
    if($value != ''){
		
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=accommodation_image', 'acf_set_featured_image_accomodation', 10, 3);

function acf_set_featured_image_event( $value, $post_id, $field  ){
    
    if($value != ''){
		
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=event_image', 'acf_set_featured_image_event', 10, 3);


function acf_set_featured_image_service( $value, $post_id, $field  ){
    
    if($value != ''){
		
	    //Add the value which is the image ID to the _thumbnail_id meta data for the current post
	    add_post_meta($post_id, '_thumbnail_id', $value);
    }
 
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=service_image', 'acf_set_featured_image_service', 10, 3);

?>


