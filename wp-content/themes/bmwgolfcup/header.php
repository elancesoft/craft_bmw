<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BMW_Golf_Cup
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap" rel="stylesheet">

	<script defer src="https://unpkg.com/alpinejs@3.9.1/dist/cdn.min.js"></script>

	<?php wp_head(); ?>
	</head>

<?php
$featured_imgage = get_the_post_thumbnail_url(get_the_ID());
$bg_page = '';
if (strlen($featured_imgage) > 0) {
	$bg_page = 'style="background: url(' . $featured_imgage . ') no-repeat top left; background-size: cover; background-attachment: fixed;"' ;
}
?>

<body <?php body_class('h-screen w-full text-14 font-light text-white bg-site bg-fixed bg-cover bg-right-bottom'); ?> <?php echo $bg_page; ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="h-screen max-w-md mx-auto font-bmwkr leading-7">
		<?php
		$header = 'inner';

		if (is_front_page()) :
			$header = 'home';
		endif;

		get_template_part('template-parts/header', $header);
		?>