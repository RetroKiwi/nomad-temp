<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NomadTribe
 */
$main_menu_items = get_field('main_menu_items' , 'option');
$main_menu_logo = get_field('main_menu_logo' , 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href=" <?php echo get_stylesheet_uri(); ?> ">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Saira+Extra+Condensed:wght@100;200;300;400;500;600;700;800;900&family=Sofia+Sans+Condensed:ital,wght@0,1..1000;1,1..1000&family=Sofia+Sans+Extra+Condensed:ital,wght@0,1..1000;1,1..1000&family=Sofia+Sans+Semi+Condensed:ital,wght@0,1..1000;1,1..1000&family=Sofia+Sans:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nomadtribe' ); ?></a>

	<div class="header-shadow width-screen fixed top-0 left-0"></div>
	<header class="bg-black text-white flex-row flex-align-end width-full sticky bottom-0">
		<a href="/" class="contents">
			<div class="header-logo fixed">
					<img src="<?php echo $main_menu_logo; ?>" alt="">
				</div>
			</a>
            <ul class="header-menu-main height-100 flex-align-stretch uppercase list-none width-full flex-row flex-end bg-black">
				<?php foreach ($main_menu_items as $item_key => $item_value):?>
				
						<ul class="list-none header-menu-item flex flex-align-end">
							 <a href="<?php echo $item_value['main_menu_item']['url'];?>" class="flex flex-align-end"><span><?php echo $item_value['main_menu_item']['title'];?></span></a>
						
							<ul class="header-menu-submenu list-none bg-red flex-col">
							<?php if ($item_value['submenu_items_repeater']):?>
								<?php foreach ($item_value['submenu_items_repeater'] as $submenu_key => $submenu_value):?>		
									<li class="header-menu-item">
										<a href="<?php echo $submenu_value['item_submenu']['url']; ?>" class="width-full"><span><?php echo $submenu_value['item_submenu']['title']; ?></span></a>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
							</ul>
						</ul>
				
				<?php endforeach; ?>

            </ul>
        </header>


