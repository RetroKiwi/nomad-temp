<?php
/**
 * all-jobs-filter Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
// $site_wide_banner = get_field('buy-rent-form-filter', 'options');
// Build a valid style attribute for background and text colors.



$available_for_key = 'jobcategory';
$available_for_display_name = 'Available for';
$available_for = get_terms(array(
    'taxonomy' => $available_for_key,
    'hide_empty' => false,
));

$amenities_key = 'jobslanguage';
$amenities_display_name = 'Languages';
$amenities = get_terms(array(
    'taxonomy' => $amenities_key,
    'hide_empty' => false,
));

$jobs_type_key = 'jobstype';
$job_display_name = 'Types of Work';
$job_types = get_terms(array(
    'taxonomy' => $jobs_type_key,
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
			<div class="custom-select">
                <select class="taxonomy2-select" name="taxonomy2-select">
                    <?php foreach ($available_for as $term) : ?>
                        <option value="<?php echo $term->slug; ?>">
                            <?php echo $term->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-caret-down dropdown-icon"></i>
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
                            <?php endforeach; ?>
                        </fieldset>
                    </div>
					
					                  <div class="flex-row flex-center" style="margin-bottom: 1rem; width: 100%; border-bottom: solid 2px var(--gray)">
                        <h4><?php echo $job_display_name ?></h4>
                    </div>
                    <div class="width-full flex-row flex-center flex-wrap" style="gap: 2px; margin-bottom: 3rem">
                        <fieldset class="contents">
                            <?php foreach ($job_types as $job_term) : ?>
                                <label class="amenities-filter-option">
                                    <i class="fa-regular fa-square"></i>
                                    <i class="fa-solid fa-square-check"></i>
                                    <input type="checkbox" class="taxonomy3-checkbox" name="taxonomy3-checkbox" value="<?php echo $job_term->slug; ?>">
                                    <?php echo $job_term->name; ?>
                                </label>
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
        Select a job location to get started
    </div>
</section>



<script>

// ajax calls and event binding for filters

jQuery(document).ready(function($) {

    window.$ = $;

    // quick fix for request race condition in the request response order: 
    // pushes latest request status to the stack, updates when the response is received,
    // and responses that arrive later than more recent requests will be ignored.
    // TODO: the filter DOM can still show incorrect filters applied when a response package is lost
    const hasRequestResolvedStack = [];

    $('.taxonomy1-checkbox, .taxonomy2-select, .taxonomy3-select').change(function() {
        let taxonomy1 = '<?php echo $amenities_key ?>';
        let taxonomy2 = '<?php echo $available_for_key ?>';
        let taxonomy3 = '<?php echo $jobs_type_key ?>'; // Adjust with your new taxonomy key
        let terms1 = [];
        let terms2 = $('.taxonomy2-select').val(); // Retrieve value from select dropdown
        let terms3 = $('.taxonomy3-select').val(); // Retrieve value from select dropdown
        let requestID = hasRequestResolvedStack.length;
        hasRequestResolvedStack.push(false);

        // Collect checked terms for Taxonomy 1
        $('.taxonomy1-checkbox:checked').each(function() {
            terms1.push($(this).val());
        });

        let data = {
            action: 'custom_filter',
            nonce: '<?php echo wp_create_nonce("ajax-filter-nonce"); ?>',
            taxonomy1: taxonomy1,
            terms1: terms1,
            taxonomy2: taxonomy2,
            terms2: terms2,
            taxonomy3: taxonomy3,
            terms3: terms3
        };
        $('#filtered-posts').html('Refreshing...');
        
        $.post('<?php echo admin_url("admin-ajax.php"); ?>', data, function(response) {
            let hasLaterRequestResolved = hasRequestResolvedStack.slice(requestID).reduce((a, b) => a || b, false);
            hasRequestResolvedStack[requestID] = true;
            if (hasLaterRequestResolved) {
                return;
            }
            $('#filtered-posts').html(response);
        });
    });

    // New change event listener for taxonomy1-select
    $('.taxonomy1-select').change(function() {
        let taxonomy1 = '<?php echo $amenities_key ?>';
        let taxonomy2 = '<?php echo $available_for_key ?>';
        let taxonomy3 = '<?php echo $jobs_type_key ?>'; // Adjust with your new taxonomy key
        let terms1 = $(this).val(); // Retrieve value from select dropdown
        let terms2 = $('.taxonomy2-select').val(); // Retrieve value from select dropdown
        let terms3 = $('.taxonomy3-select').val(); // Retrieve value from select dropdown
        let requestID = hasRequestResolvedStack.length;
        hasRequestResolvedStack.push(false);

        let data = {
            action: 'custom_filter',
            nonce: '<?php echo wp_create_nonce("ajax-filter-nonce"); ?>',
            taxonomy1: taxonomy1,
            terms1: terms1,
            taxonomy2: taxonomy2,
            terms2: terms2,
            taxonomy3: taxonomy3,
            terms3: terms3
        };
        $('#filtered-posts').html('Refreshing...');
        
        $.post('<?php echo admin_url("admin-ajax.php"); ?>', data, function(response) {
            let hasLaterRequestResolved = hasRequestResolvedStack.slice(requestID).reduce((a, b) => a || b, false);
            hasRequestResolvedStack[requestID] = true;
            if (hasLaterRequestResolved) {
                return;
            }
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