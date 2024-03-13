<?php
/**
 * page-title-special Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

// Build a valid style attribute for background and text colors.

?>

		<!-- page title -->
<section class="bg-nomad-black_ bg-light-gray flex-col flex-align-center p-x-page relative p-y-section">
    <?php
        // Retrieve ACF values
        $accommodation_title = get_field('accomodation_title');
        $accomodation_description = get_field('accomodation_description');
        $link = get_field('accomodation_link');
    
    
    ?>
    <h1 class="text-red text-center" style="font-weight: 900; font-size: 10vw;"><?php echo esc_html($accommodation_title); ?></h1>
    <p class="text-light-gray_ text-black text-center"><?php echo esc_html($accomodation_description); ?></p>
    <?php if ($link):?>
    <a id="openDialogButton" class="contents" href="<?php echo $link;?>"><button class="primary size-huge m-t-section-small">Add your listing</button></a>
    <?php endif; ?>
	
	
	
</section>
    <dialog id="addJobListingDialog">
            <p>Post your job listing</p>
			
				
		
            <!-- <form method="dialog" id="dialogForm">
                <p>This only works with a form that has method="dialog" </p>
                <button type="submit">Close dialog on form submit</button>
            </form> -->
            <button id="closeDialogButton" class="primary button-default">Close dialog without submitting</button>
        </dialog>