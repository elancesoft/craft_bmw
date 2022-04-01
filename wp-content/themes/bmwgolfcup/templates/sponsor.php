<?php

/**
 * Template Name: Sponsor (대회 스폰서)
 */
get_header();
?>

<main id="primary" class="mt-[34px]">
  <?php
  while (have_posts()) :
    the_post();
    the_title('<h1 class="text-20 font-bold mt-[24px] px-4">', '</h1>');
  // the_content();
  endwhile; // End of the loop.
  ?>

  <div class="grid grid-cols-2 mt-[24px]">
    <?php
    $sponsors = get_field('sponsor_list');
    foreach($sponsors as $item) {
      echo '<div class="flex items-center justify-center p-8 border border-b-0 border-l odd:border-l-0 border-r-0 border-white border-opacity-10"><a href="' . $item['sponsor_url'] . '" target="_blank"><img src="' . $item['sponsor_image'] . '" alt="" /></a></div>';
    }
    ?>
  </div>
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
