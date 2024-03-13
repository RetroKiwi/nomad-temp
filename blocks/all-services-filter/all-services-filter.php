<?php
/**
 * all-services-filter Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
// $site_wide_banner = get_field('buy-rent-form-filter', 'options');
// Build a valid style attribute for background and text colors.



$available_for_key = 'service-location';
$available_for_display_name = 'Available for';
$available_for = get_terms(array(
    'taxonomy' => $available_for_key,
    'hide_empty' => false,
));

$amenities_key = 'service-type';
$amenities_display_name = 'Amenities';
$amenities = get_terms(array(
    'taxonomy' => $amenities_key,
    'hide_empty' => false,
));
?>
    


<!-- filter components -->
<section id="taxonomy_filter" class="flex-col m-t-section-small">
    <div class="section-header width-full m-x-auto" style="padding: 5rem var(--padding-page)">
        <div class="width-full flex-col flex-align-center flex-align-center p-x-page">
            <div class="flex-row flex-center" style="margin-bottom: 1rem; width: 100%">
                <h4><?php echo $available_for_display_name ?></h4>
            </div>
            <div class="available-for width-full flex-row flex-center" style="gap: 0rem">
                <fieldset class="contents">
                    <?php foreach ($available_for as $term) : ?>
                        <label class="rent-buy-filter-option">
                            <input type="radio" class="taxonomy2-checkbox" name="taxonomy2-checkbox" value="<?php echo $term->slug; ?>">
                            <?php echo $term->name; ?>
                        </label>
                        <br>
                    <?php endforeach; ?>
                </fieldset>
            </div>
            <button id="openFilterDialogButton" class="primary size-huge m-t-section-small m-x-auto">
                Additional filters
            </button>
            
            <dialog id="filterDialog" class="filter-dialog">
                <div class="dialog-header">
                    <h3 class="text-center">Filters</h3>
                    <button id="closeFilterDialogButton" class="primary size-normal">Close and Apply</button>
                </div>
                <div class="dialog-content">
     
                   
                    <div class="flex-row flex-center" style="margin-bottom: 1rem; width: 100%; border-bottom: solid 2px var(--gray)">
                        <h4><?php echo $amenities_display_name ?></h4>
                    </div>
                    <div class="width-full flex-row flex-center flex-wrap" style="gap: 2px; margin-bottom: 3rem">
                        <fieldset class="contents">
                            <?php foreach ($amenities as $term) : ?>
                                <label class="amenities-filter-option">
                                    <i class="fa-regular fa-square"></i>
                                    <i class="fa-solid fa-square-check"></i>
                                    <input type="checkbox" class="taxonomy1-checkbox" name="taxonomy1-checkbox" value="<?php echo $term->slug; ?>">
                                    <?php echo $term->name; ?>
                                </label>
                                <br>
                            <?php endforeach; ?>
                        </fieldset>
                    </div>
                </div>
            </dialog>

        </div>
    </div>
</section>



<!-- item card list and grid with switch component -->
<section class="m-b-section relative">
    <!-- this is the switch component -->
    <div class="item-card-layout-switch-track">
        <div class="item-card-layout-switch">
            <span class="label label-top">Layout</span>
            <button class="grid"><i class="fa-solid fa-grip"></i></button>
            <button class="list"><i class="fa-solid fa-grip-lines"></i></button>
            <span class="label label-bottom">Layout</span>
        </div>
    </div>
    <!-- this is the list / grid itself -->
    <div id="filtered-posts" class="item-card-grid p-x-page m-x-auto m-y-section-small">
        <!-- AJAX results will be inserted here -->
        Select "Rent" or "Buy" to get started
    </div>
</section>



<script>

// ajax calls and event binding for filters

jQuery(document).ready(function($) {

    // quick fix for request race condition in the request response order: 
    // pushes latest request status to the stack, updates when the response is received,
    // and responses that arrive later than more recent requests will be ignored.
    // TODO: the filter DOM can still show incorrect filters applied when a response package is lost
    const hasRequestResolvedStack = [];

    $('.taxonomy1-checkbox, .taxonomy2-checkbox').change(function() {
        // TODO: rewrite to use multidimensional arrays, making the code generalized with no need of rewriting
        // for different filters (aka. complete reuse through jobs, events, blog, accommodations, etc.)
        // IMPORTANT - the above rewrite requires some additional PHP or PHP refactoring as well
        let taxonomy1 = '<?php echo $amenities_key ?>';
        let taxonomy2 = '<?php echo $available_for_key ?>';
        let terms1 = [];
        let terms2 = [];
        let requestID = hasRequestResolvedStack.length;
        // push resolved=false to stack
        hasRequestResolvedStack.push(false);

        // Collect checked terms for Taxonomy 1
        $('.taxonomy1-checkbox:checked').each(function() {
            terms1.push($(this).val());
        });

        // Collect checked terms for Taxonomy 2
        $('.taxonomy2-checkbox:checked').each(function() {
            terms2.push($(this).val());
        });

        let data = {
            action: 'custom_filter',
            nonce: '<?php echo wp_create_nonce("ajax-filter-nonce"); ?>',
            taxonomy1: taxonomy1,
            terms1: terms1,
            taxonomy2: taxonomy2,
            terms2: terms2
        };
        $('#filtered-posts').html('Refreshing...');
        
        $.post('<?php echo admin_url("admin-ajax.php"); ?>', data, function(response) {
            // check if any of the later requests have been resolved
            let hasLaterRequestResolved = hasRequestResolvedStack.slice(requestID).reduce((a, b) => a || b, false);
            // update request status
            hasRequestResolvedStack[requestID] = true;
            // don't overwrite the DOM if the latest request had already written to it
            if (hasLaterRequestResolved) {
                return;
            }
            // write the response to the dom
            $('#filtered-posts').html(response);
        });
    });
});

// switch item card grid & list layout

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
function initItemCardLayoutSwitch(switchElement) {
	
	// find all relevant elements
	let itemCardContainer =
		switchElement.parentElement.parentElement.querySelector(".item-card-grid") ||
		switchElement.parentElement.parentElement.querySelector(".item-card-list");
	let gridButton = switchElement.querySelector("button.grid");
	let listButton = switchElement.querySelector("button.list");

	// set currently active layout...
	let active = itemCardContainer.classList.contains("item-card-grid") ? "grid" : "list";
	setSwitchElementButtonsClass(gridButton, listButton, active);
	// ... and currently active layout
	setItemCardContainerClass(itemCardContainer, active);
	
	// add event listeners to buttons
	gridButton.addEventListener('click', function() {
		setSwitchElementButtonsClass(gridButton, listButton, 'grid');
		setItemCardContainerClass(itemCardContainer, 'grid');
	})
	listButton.addEventListener('click', function() {
		setSwitchElementButtonsClass(gridButton, listButton, 'list');
		setItemCardContainerClass(itemCardContainer, 'list');
	})
}

function setSwitchElementButtonsClass(gridButton, listButton, activeClass) {
	setClass(gridButton, "active", activeClass == "grid");
	setClass(listButton, "active", activeClass == "list");
}
function setItemCardContainerClass(itemCardContainer, activeClass) {
	setClass(itemCardContainer, "item-card-grid", activeClass == "grid");
	setClass(itemCardContainer, "item-card-list", activeClass == "list");
}

function initItemCardLayoutSwitches() {
	document.querySelectorAll('.item-card-layout-switch').forEach(initItemCardLayoutSwitch);
}

window.addEventListener('load', initItemCardLayoutSwitches);

function openDialog(id) {
	// showModal() doesn't work on dialog[open], do not include that attribute on the element
	document.getElementById(id)?.showModal();
}
function closeDialog(id) {
	document.getElementById(id)?.close();
}

function initFilterDialog() {
	document
		.getElementById("closeFilterDialogButton")
		?.addEventListener("click", () => closeDialog("filterDialog"));
	document
		.getElementById("openFilterDialogButton")
		?.addEventListener("click", () => openDialog("filterDialog"));
}

window.addEventListener("load", initFilterDialog);
</script>