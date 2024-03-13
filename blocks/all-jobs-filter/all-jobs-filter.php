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
$available_for_display_name = 'Location';
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
<div class="relative width-full m-t-section-small">
    <section id="taxonomy_filter" class="sticky bg-darkest-black" style="top: calc(80px - 3rem); z-index: 200">
        <div class="width-full bg-darkest-black" style="height: 3rem"></div>
        <div class="section-header width-full m-x-auto" style="padding: 2rem 0; box-shadow: 0 0px 50px var(--nomad-darkest-black)">
            <div class="width-full flex-row flex-between flex-align-center p-x-page">
                <div class="flex-row flex-center" style="gap: 3rem">
                    <h4><?php echo $available_for_display_name ?></h4>
                    <div class="custom-select">
                        <!-- <select class="taxonomy2-select" name="taxonomy2-select"> -->
                        <select class="<?php echo $available_for_key; ?>-taxonomy" name="taxonomy2-select">
                            <option selected disabled value="">Select a location...</option>
                            <?php foreach ($available_for as $term) : ?>
                                <option value="<?php echo $term->slug; ?>">
                                    <?php echo $term->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <i class="fa-solid fa-caret-down dropdown-icon"></i>
                    </div>
                </div>
            
                <button id="openFilterDialogButton" class="primary size-large">
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
                                        <!-- <input type="checkbox" class="taxonomy1-checkbox" name="taxonomy1-checkbox" value="<?php echo $term->slug; ?>"> -->
                                        <input type="checkbox" class="<?php echo $amenities_key; ?>-taxonomy" name="taxonomy1-checkbox" value="<?php echo $term->slug; ?>">
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
                                        <!-- <input type="checkbox" class="taxonomy3-checkbox" name="taxonomy3-checkbox" value="<?php echo $job_term->slug; ?>"> -->
                                        <input type="checkbox" class="<?php echo $jobs_type_key; ?>-taxonomy" name="taxonomy3-checkbox" value="<?php echo $job_term->slug; ?>">
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
    <div class="width-full bg-darkest-black" style="height: 3rem"></div>



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
</div>



<script>

// ajax calls and event binding for filters

// TODO: just remove jQuery and replace with builtin JS methods,
// we're not saving ourselves any work with this and we're not gaining anything either
jQuery(document).ready(function($) {

    // quick fix for request race condition in the request response order: 
    // pushes latest request status to the stack, updates when the response is received,
    // and responses that arrive later than more recent requests will be ignored.
    // TODO: the filter DOM can still show incorrect filters applied when a response package is lost
    const hasRequestResolvedStack = [];

    // store taxonomy strings
    const taxonomies = [
        '<?php echo $amenities_key ?>',
        '<?php echo $available_for_key ?>',
        '<?php echo $jobs_type_key ?>',
    ];

    // stores all the info needed to retrieve the state of each filter
    let taxonomyTermsData = [];

    taxonomies.forEach(function (taxonomy, taxonomyIndex) {
        let elementSelector = '.' + taxonomy + '-taxonomy';
        let elements = $(elementSelector);
        if (elements.length == 0) {
            console.warn(`Query returned 0 elements with ".${elementSelector}" class.`);
            return;
        }
        let elementTag = elements[0].tagName;
        let termsData = {
            taxonomy,
            taxonomyIndex,
            elementTag,
            elementSelector,
            getTermsFunction: null,
        };
        switch (elementTag) {
            case 'INPUT':
                termsData.getTermsFunction = () => getCheckboxTerms(elementSelector);
                break;
            case 'SELECT':
                termsData.getTermsFunction = () => getSelectElementTerms(elementSelector);
                break;
            default:
                console.warn(`Element tag not supported: <${elementTag}>.`);
                // TODO: handle this case
                return;
        }

        taxonomyTermsData.push(termsData);

        for(let element of elements) {
            $(element).change(function () {
                updateFilteredPosts();
            })
        }
    })

    function getCheckboxTerms(selector) {
		let data = [...document.querySelectorAll(selector + ':checked')].map(x => x.value);
		return data.length ? data : undefined;
    }

    function getSelectElementTerms(selector) {
        return document.querySelector(selector).value;
    }

    function updateFilteredPosts() {
        let requestID = hasRequestResolvedStack.length;
        // push initial request state to stack: resolved=false
        hasRequestResolvedStack.push(false);

        let data = Object.assign(getTaxonomyFilters(), {
            action: 'custom_filter',
            nonce: '<?php echo wp_create_nonce("ajax-filter-nonce"); ?>',
        });

        console.log('DATA:')
        console.log(data);
        
        triggerFilteredPostsRefreshingState();
        
        $.post('<?php echo admin_url("admin-ajax.php"); ?>', data, function(response) {
            // check if any of the later requests have been resolved
            let hasLaterRequestResolved = hasRequestResolvedStack.slice(requestID).reduce((a, b) => a || b, false);
            // update request state
            hasRequestResolvedStack[requestID] = true;
            // don't overwrite the DOM if the latest request had already written to it
            if (hasLaterRequestResolved) {
                return;
            }
            // write the response to the dom
            $('#filtered-posts').html(response);
        });
    }

    function getTaxonomyFilters() {
        let data = {};

        // constructs the following object:
        // {
        //		taxonomy1: taxonomy1,
        //		terms1: terms1,
        //		taxonomy2: taxonomy2,
        //		terms2: terms2,
        //		...
        // }
        taxonomyTermsData.forEach(function ({taxonomy, taxonomyIndex, elementSelector, elementTag, getTermsFunction}) {
            let index = taxonomyIndex + 1;
            let terms = getTermsFunction();
			if (!terms) {
				return;
			}
            data['taxonomy' + index] = taxonomy;
			data['terms' + index] = terms;
        })

        return data;
    }

    // TODO: could set timer here for timed out requests that can restore filters to
    // match the last valid response's filters, need to save filters state then
    function triggerFilteredPostsRefreshingState() {
        // show that the list is refreshing
        $('#filtered-posts').html('Refreshing...');
    }
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