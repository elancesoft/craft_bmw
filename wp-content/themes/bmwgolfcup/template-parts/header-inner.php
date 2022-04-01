<header id="masthead" class="mt-[15px]">
  <div class="relative max-w-md mx-auto justify-between items-center px-1">
    <?php
    $custom_logo_id = get_theme_mod('custom_logo');
    $image_logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    $img_menu = get_template_directory_uri() . '/images/ic_menu.png';
    ?>
    <div class="site-branding flex justify-between">
      <div class="flex items-center">
        <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $image_logo[0]; ?>" class="h-[36px] w-auto" alt="Logo" /></a>
      </div>

      <div class="flex items-center">
        <img src="<?php echo $img_menu; ?>" class="cursor-pointer menu" onclick="els_menu(this)" />
      </div>
    </div><!-- .site-branding -->

    <nav id="site-navigation" class="main-navigation">
      <?php
        $menu_items = wp_get_nav_menu_items('Main Menu');

        echo '<ul id="primary-menu" class="py-3 absolute bg-site bg-right-bottom w-full top-[50px] left-0 right-0 transition-all ease-linear duration-700 close">';

        foreach ($menu_items as $item) {
          $menu_icon = get_field('menu_icon', $item->ID);
          echo '<li class="px-5 py-2 opacity-60 hover:opacity-100 hover:font-bold transition-all duration-500"><a href="' . $item->url . '" class="flex gap-x-3 items-center"><img src="' . $menu_icon . '" class="h-[20px] w-auto" /><span>' . $item->title  . '</span></a></li>';
        }

        echo '</ul>';



      // wp_nav_menu(
      //   array(
      //     'container'      => '',
      //     'theme_location' => 'menu-1',
      //     'menu_id'        => 'primary-menu',
      //     'menu_class'     => 'py-3 absolute bg-blue-00 w-full top-[50px] left-0 transition-all ease-linear duration-700 close',
      //     // 'add_li_class'  => 'flex items-center py-2 md:py-0 px-3 md:px-0'
      //   )
      // );
      ?>
    </nav><!-- #site-navigation -->
  </div>
</header><!-- #masthead -->