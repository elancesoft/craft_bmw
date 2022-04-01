<?php

/**
 * Template Name: Home Page
 */

get_header();

// Menu item array (note: "Main Menu" is the name of menu)
$menu_items = wp_get_nav_menu_items('Main Menu');
?>

<main id="primary" class="mt-[34px] pb-[45px]">
  <div class="grid grid-cols-2 gap-2">
    <?php
    foreach ($menu_items as $menu) :
      $menu_icon = get_field('menu_icon', $menu->ID);
    ?>
      <div class="flex h-full w-full border border-white border-opacity-20 hover:border-opacity-100 rounded-lg transition-all duration-700">
        <a href="<?php echo $menu->url; ?>" class="group flex flex-col w-full h-full items-center justify-center py-8 opacity-40 hover:opacity-100">
          <img src="<?php echo $menu_icon; ?>" alt="<?php echo $menu->title; ?>" class="h-[31px] w-auto group-hover:scale-150 transition-all duration-700" />
          <span class="text-16 font-light mt-3 text-center group-hover:font-bold transition-all duration-700"><?php echo $menu->title; ?></span>
        </a>
      </div>
    <?php
    endforeach;
    ?>
  </div>
  <div class="hidden mb-4 my-4">&nbsp;</div>
</main><!-- #main -->

<?php
get_footer();
