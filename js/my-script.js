function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
	    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }


  jQuery(document).ready(function($) {
    $('#searchform').on('keyup', 'input[name="s"]', function(e){
        var keyword = $(this).val();
        if (keyword.length >= 3) {
            $.ajax({
                type: 'POST',
                url: ajax_params.ajax_url,
                data: {
                    action: 'custom_search',
                    keyword: keyword,
                },
                success: function(response) {
                    $('#search-results').html(response);
                }
            });
        } else if (keyword.length === 0) {
            $('#search-results').empty(); // Clear the results if the search input is empty
        }
    });
});


// scrolling-text-stripe ACF block

function initScrollingTextStripes() {
    [...document.querySelectorAll(".scrolling-text-stripe")].forEach(
        registerScrollingTextStripe
    );
}

function registerScrollingTextStripe(element) {
    // get inner element
    let childText = element.querySelector("span");
    let iWantThisManyExtraElementsToBeCreatedPlease = 10;
    // calculate minimum number of elements for given screen size
    let targetNumberOfChildren =
        Math.ceil(window.innerWidth / childText.clientWidth) +
        iWantThisManyExtraElementsToBeCreatedPlease; /* extra for padding, put any positive integer here */
    let windowScale = window.innerWidth / 1920; /* scale - do not modify */
    // screen-width-independent scrolling speed
    let animationDuration =
        (windowScale * 100) /* higher number = slower */ /
        targetNumberOfChildren;
    // set scroll speed on initial element
    childText.style.animationDuration = animationDuration + "s";
    while (targetNumberOfChildren > 0) {
        targetNumberOfChildren--;
        // create new clone
        let clone = childText.cloneNode(true);
        // set scroll speed on clone
        clone.style.animationDuration = animationDuration + "s";
        element.append(clone);
    }
}

window.addEventListener("load", function () {
    initScrollingTextStripes();
});


	
/* test kod */

jQuery(document).ready(function($) {
    var page = 2; // Initialize page counter for AJAX requests

    $('#load-more').on('click', function() {
        $.ajax({
            url: 'https://nomadtribecroatia.com/wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'load_more_posts',
                page: page,
            },
            success: function(response) {
                $('#posts-container-special').append(response);
                page++;
            }
        });
    });
});

/*kraj test koda*/
// switch item card grid & list layout

/*
	these rely on the previous setClass() function
	I know jQuery has it out of the box, but I'm not including jQuery locally
	just to use the 5 functions I actually need
*/
function setClass(element, className, value) {
	element.classList[value ? "add" : "remove"](className);
}
function toggleClass(element, className) {
	let hasClass = element.classList.contains(className);
	setClass(element, className, !hasClass);
}
function setChecked(element, value) {
	element.checked = value;
}
function initItemCardLayoutSwitch(switchElement) {
	
	// find all relevant elements
	let itemCardContainer =
		switchElement.parentElement.parentElement.querySelector(".item-card-grid") ||
		switchElement.parentElement.parentElement.querySelector(".item-card-list");
	let gridButton = switchElement.querySelector("button.grid");
	let listButton = switchElement.querySelector("button.list");

	// set currently active layout...
	// let active = gridButton.classList.contains("active") ? "grid" : "list";
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