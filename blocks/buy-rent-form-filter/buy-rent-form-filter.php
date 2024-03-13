<?php
/**
 * buy-rent-form-filter Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
// $site_wide_banner = get_field('buy-rent-form-filter', 'options');
// Build a valid style attribute for background and text colors.

?>
<!-- HTML for buy-rent form filter -->
<!-- Form -->
<section class="m-y-section">
    <div class="section-header p-x-page m-x-auto">
        <div class="width-full flex-col flex-align-center flex-align-center p-x-page">
            <div class="available-for width-fit flex-row m-t-section-small">
                <button class="contents" onclick="updateAvailableFor('Rent')">
                    <span id="rentBuyFilterVisualAvailableForRent" class="available-for-button">Rent</span>
                </button>
                <button class="contents" onclick="updateAvailableFor('Buy')">
                    <span id="rentBuyFilterVisualAvailableForBuy" class="available-for-button">Buy</span>
                </button>
            </div>
            <div class="width-fit flex-row m-y-section-small" style="gap: 3rem">
                <button class="contents">
                    <button class="contents" onclick="updatePropertyType('House')">
                        <div id="rentBuyFilterVisualPropertyTypeHouse" class="property-type-button flex-col flex-align-center flex-end">
                            <span>House</span>
                        </div>
                    </button>
                    <button class="contents" onclick="updatePropertyType('Apartment')">
                        <div id="rentBuyFilterVisualPropertyTypeApartment" class="property-type-button flex-col flex-align-center flex-end">
                            <span>Apartment</span>
                        </div>
                    </button>
                    <button class="contents" onclick="updatePropertyType('Room')">
                        <div id="rentBuyFilterVisualPropertyTypeRoom" class="property-type-button flex-col flex-align-center flex-end">
                            <span>Room</span>
                        </div>
                    </button>
                </button>
            </div>
        </div>
        <form id="rentBuyFilterForm" style="display: _none;" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <fieldset style="display: none">
                <label><input id="rentBuyFilterAvailableForRent" type="radio" name="category[]" value="Rent" <?php echo (isset($_GET['category']) && in_array('Rent', $_GET['category'])) ? 'checked' : ''; ?>> Rent</label>
                <label><input id="rentBuyFilterAvailableForBuy" type="radio" name="category[]" value="Buy" <?php echo (isset($_GET['category']) && in_array('Buy', $_GET['category'])) ? 'checked' : ''; ?>> Buy</label>
            </fieldset>
            <fieldset style="display: none">
                <label><input id="rentBuyFilterPropertyTypeHouse" type="checkbox" name="category[]" value="House" <?php echo (isset($_GET['category']) && in_array('House', $_GET['category'])) ? 'checked' : ''; ?>> House</label>
                <label><input id="rentBuyFilterPropertyTypeApartment" type="checkbox" name="category[]" value="Apartment" <?php echo (isset($_GET['category']) && in_array('Apartment', $_GET['category'])) ? 'checked' : ''; ?>> Apartment</label>
                <label><input id="rentBuyFilterPropertyTypeRoom" type="checkbox" name="category[]" value="Room" <?php echo (isset($_GET['category']) && in_array('Room', $_GET['category'])) ? 'checked' : ''; ?>> Room</label>
            </fieldset>
            
            <div class="width-full flex-row flex-between flex-align-center" style="gap: 3rem">

                <div class="width-fit flex-row flex-align-center relative" style="gap: 3rem">
                    <label for="child_categories">Location</label>
                    <!-- Select field for child categories of category with ID 34 -->
                    <!-- <label for="child_categories">Child Categories:</label> -->
                    <select id="showOnMapSelect" name="child_category" style="min-width: fit-content; width: 250px">
                        <?php
                    // Get child categories of category with ID 34
                    $child_categories = get_terms( array(
                        'taxonomy' => 'category',
                        'child_of' => 34, // Change 34 to the actual category ID
                        ) );
                        
                        // Loop through child categories and display as options
                        foreach ( $child_categories as $category ) {
                            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                        }
                        ?>
                    </select>
                    <i class="fa-solid fa-caret-down absolute" style="right: 1.5rem; pointer-events: none;"></i>
                </div>
                <button class="primary button-default text-nowrap" onclick="showOnMapRedirect(event)">Show on map</button>
				<div class="price-range-input width-fit relative flex-row flex-align-center flex-nowrap">
					<button class="min absolute rounded-full text-nowrap text-center flex-row flex-center flex-align-center"><span>1 €</span></button>
					<button class="max absolute rounded-full text-nowrap text-center flex-row flex-center flex-align-center"><span>99,999 €</span></button>
					<div class="border-gray" style="border-top-width: 5px; width: 300px"></div>
				</div>
                <div class="width-full"></div>
                <button onclick="passClickToRentBuyFilter()" class="primary-inverse button-default">Filter</button>
            </div>
            <div class="divider-x-border" style="margin-top: 3rem"></div>

            <input id="rentBuyFilterSubmit" type="submit" value="Filter" style="display: none">
        </form>
    </div>
</section>
<!-- <button onclick="passClickToRentBuyFilter()" class="primary-inverse button-default">Filter</button> -->
<script>
    function showOnMapRedirect(event) {
        console.log(event);
        event.preventDefault();
        let place = document.getElementById('showOnMapSelect').value;
        window.open(window.location.pathname + '/category/place/' + place + '/', '_blank')
    }
    function passClickToRentBuyFilter() {
        document.getElementById('rentBuyFilterSubmit').click();
    }
    function updatePropertyType(type) {
        toggleClass(rentBuyFilterVisualElements['propertyType' + type], 'active');
	    rentBuyFilter.updateFormPropertyType();
    }
    function updateAvailableFor(type) {
        setClass(rentBuyFilterVisualElements.availableForRent, 'active', type == 'Rent');
        setClass(rentBuyFilterVisualElements.availableForBuy, 'active', type == 'Buy');
        rentBuyFilter.updateFormAvailableFor();
    }

    const rentBuyFilterFormElements = {
        availableForRent: document.getElementById("rentBuyFilterAvailableForRent"),
        availableForBuy: document.getElementById("rentBuyFilterAvailableForBuy"),
        propertyTypeHouse: document.getElementById(
            "rentBuyFilterPropertyTypeHouse"
        ),
        propertyTypeApartment: document.getElementById(
            "rentBuyFilterPropertyTypeApartment"
        ),
        propertyTypeRoom: document.getElementById("rentBuyFilterPropertyTypeRoom")
    };
    const rentBuyFilterVisualElements = {
        availableForRent: document.getElementById(
            "rentBuyFilterVisualAvailableForRent"
        ),
        availableForBuy: document.getElementById(
            "rentBuyFilterVisualAvailableForBuy"
        ),
        propertyTypeHouse: document.getElementById(
            "rentBuyFilterVisualPropertyTypeHouse"
        ),
        propertyTypeApartment: document.getElementById(
            "rentBuyFilterVisualPropertyTypeApartment"
        ),
        propertyTypeRoom: document.getElementById(
            "rentBuyFilterVisualPropertyTypeRoom"
        )
    };
    const rentBuyFilter = {
        updateVisuals: function () {
            let formValues = {
                availableForRent:
                    rentBuyFilterFormElements.availableForRent?.checked,
                availableForBuy: rentBuyFilterFormElements.availableForBuy?.checked,
                propertyTypeHouse:
                    rentBuyFilterFormElements.propertyTypeHouse?.checked,
                propertyTypeApartment:
                    rentBuyFilterFormElements.propertyTypeApartment?.checked,
                propertyTypeRoom:
                    rentBuyFilterFormElements.propertyTypeRoom?.checked
            };
            setClass(
                rentBuyFilterVisualElements.availableForRent,
                "active",
                formValues.availableForRent
            );
            setClass(
                rentBuyFilterVisualElements.availableForBuy,
                "active",
                formValues.availableForBuy
            );
            setClass(
                rentBuyFilterVisualElements.propertyTypeHouse,
                "active",
                formValues.propertyTypeHouse
            );
            setClass(
                rentBuyFilterVisualElements.propertyTypeApartment,
                "active",
                formValues.propertyTypeApartment
            );
            setClass(
                rentBuyFilterVisualElements.propertyTypeRoom,
                "active",
                formValues.propertyTypeRoom
            );
        },
        updateFormAvailableFor: function () {
            let visualValues = {
                availableForRent:
                    rentBuyFilterVisualElements.availableForRent?.classList.contains(
                        "active"
                    ),
                availableForBuy:
                    rentBuyFilterVisualElements.availableForBuy?.classList.contains(
                        "active"
                    )
                // propertyTypeHouse: rentBuyFilterVisualElements.propertyTypeHouse?.classList.contains('active'),
                // propertyTypeApartment: rentBuyFilterVisualElements.propertyTypeApartment?.classList.contains('active'),
                // propertyTypeRoom: rentBuyFilterVisualElements.propertyTypeRoom?.classList.contains('active')
            };
            // because radio buttons "checked=true" are mutually exclusive but can also all be unchecked
            if (visualValues.availableForRent) {
                setChecked(rentBuyFilterFormElements.availableForRent, true);
            }
            else if (visualValues.availableForBuy) {
                setChecked(rentBuyFilterFormElements.availableForBuy, true);
            }
        },
        updateFormPropertyType: function () {
            let visualValues = {
                propertyTypeHouse: rentBuyFilterVisualElements.propertyTypeHouse?.classList.contains('active'),
                propertyTypeApartment: rentBuyFilterVisualElements.propertyTypeApartment?.classList.contains('active'),
                propertyTypeRoom: rentBuyFilterVisualElements.propertyTypeRoom?.classList.contains('active')
            };
            setChecked(rentBuyFilterFormElements.propertyTypeHouse, visualValues.propertyTypeHouse);
            setChecked(rentBuyFilterFormElements.propertyTypeApartment, visualValues.propertyTypeApartment);
            setChecked(rentBuyFilterFormElements.propertyTypeRoom, visualValues.propertyTypeRoom);
        }
    };

    function setClass(element, className, value) {
        element.classList[value ? "add" : "remove"](className);
    }
    function toggleClass(element, className) {
        let hasClass = element.classList.contains(className);
        setClass(element, className, !hasClass);
    }
    function setChecked(element, value) {
        element.checked = value;
    }

    window.addEventListener('load', rentBuyFilter.updateVisuals);
</script>

<!-- Display Filtered Posts -->
<?php
// Handle form submission

if ( isset( $_GET['category'] ) ) {
    $categories = $_GET['category'];
    
    // Construct tax query to include posts that belong to all selected categories
    $tax_query = array(
        'relation' => 'AND', // Require posts to satisfy all category criteria
    );
    foreach ($categories as $category) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $category,
        );
    }

    $args = array(
        'post_type' => 'Location',
        'tax_query' => $tax_query,
    );
} else {
    // If no categories selected, retrieve all posts
    $args = array(
        'post_type' => 'Location',
    );
}


// Query posts
$query = new WP_Query( $args );

// Display posts
if ( $query->have_posts() ) : ?>

<section class="m-y-section">
    <!-- <div class="section-header p-x-page m-x-auto">
        <h2 class="section-title text-red inline">What's new?</h2>
        <span class="decorative-title-strip inline-block border-5 border-light-gray"></span>
        <h3 class="section-subtitle text-light-gray inline relative">Stay updated and embrace the location-independent lifestyle with these valuable resources</h3>
    </div> -->
    <div class="slider grid-fr-col-3 p-x-page m-x-auto m-y-section-small">
    <?php while ( $query->have_posts() ) : $query->the_post();
        // Display post content here
        ?>
        <!-- <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p> -->
        
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
                    <a href="<?php the_permalink(); ?>" class="contents">
                        <button class="primary size-large">Read more</button>
                    </a>
                </div>
            </div>
        </a>


        <?php
    endwhile;?>
    </div>
</section>
    <?php wp_reset_postdata();
else :
    echo 'No posts found';
endif;
?>