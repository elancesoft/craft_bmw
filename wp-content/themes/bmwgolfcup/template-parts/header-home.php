<header id="masthead">
  <div class="relative max-w-md mx-auto justify-between items-center">
    <?php
    $custom_logo_id = get_theme_mod('custom_logo');
    $image_logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    $img_menu = get_template_directory_uri() . '/images/ic_menu.png';
    ?>
    <div class="flex justify-center">
      <div class="flex items-center mt-[15px]">
        <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $image_logo[0]; ?>" class="h-[46px] w-auto" alt="Logo" /></a>
      </div>
    </div><!-- .site-branding -->
  </div>
</header><!-- #masthead -->