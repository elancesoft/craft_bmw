<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BMW_Golf_Cup
 */

?>

<footer id="colophon" class="mt-10 border-t-2 border-t-white hidden">
	<div class="container mx-auto">
		<div class="flex py-10 items-center justify-center ">
			<a href="<?php echo esc_url(__('https://wordpress.org/', 'bmwgolfcup')); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf(esc_html__('Proudly powered by %s', 'bmwgolfcup'), 'WordPress');
				?>
			</a>
			<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf(esc_html__('Theme: %1$s by %2$s.', 'bmwgolfcup'), 'bmwgolfcup', '<a href="https://elancefoxvn.com">eLanceFoxVN</a>');
			?>
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
	function els_menu(e) {
		let list = document.querySelector('ul#primary-menu');

		list.classList.contains('close') ? (
			list.classList.remove('close'),
			list.classList.add('open')
		) : (
			list.classList.remove('open'),
			list.classList.add('close')
		);

		e.classList.contains('menu') ? (
			e.classList.remove('menu'),
			e.classList.add('close')
		) : (
			e.classList.remove('close'),
			e.classList.add('menu')
		);

		
	}
</script>
</body>

</html>