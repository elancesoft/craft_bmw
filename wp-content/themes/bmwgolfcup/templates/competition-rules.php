<?php

/**
 * Template Name: Competition Rules (대회 규정)
 */

get_header();
?>

<main id="primary" class="mt-[34px] pb-[45px] px-4">
  <?php
  while (have_posts()) :
    the_post();
    the_title('<h1 class="text-20 font-bold mt-[24px]">', '</h1>');
  // the_content();
  endwhile; // End of the loop.
  ?>

  <div class="mt-[24px]">
    <?php
    $rule_items = get_field('rule_items');

    foreach ($rule_items as $item) {
      echo '
      <div class="">
        <h3 class="text-16 font-bold">' . $item['rule_label'] . '</h3>
        <div class="mb-7 mt-2 p-4 border border-white border-opacity-20 rounded-lg">' . $item['rule_value'] . '</div>
      </div>
      ';

    }
    ?>
  </div>
</main><!-- #main -->

<?php
get_footer();
