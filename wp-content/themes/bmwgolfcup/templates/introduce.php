<?php

/**
 * Template Name: Introduce (BMW GOLF CUP 소개)
 */

get_header();

$introduce_banner = get_field('introduce_banner'); // image
$introduce_world_final = get_field('introduce_world_final'); // video
$introduce_tournament_process = get_field('introduce_tournament_process'); // image
?>

<main id="primary" class="site-content mt-[34px] pb-[45px] px-4">
  <?php
  // Generate banner image html
  $introduce_banner_img_html = '';
  if (strlen($introduce_banner) > 0) {
    $introduce_banner_img_html = '<div class="mt-6 mb-4 rounded-lg border border-white border-opacity-20 overflow-hidden"><img src="' . $introduce_banner . '" class="h-[148px] w-full object-cover" /></div>';
  }

  // Show the title & content
  while (have_posts()) :
    the_post();
    the_title('<h1 class="text-20 font-bold mt-[24px]">', '</h1>');
    echo $introduce_banner_img_html;
    the_content();
  endwhile; // End of the loop.
  ?>

  <div class="mt-[24px]">
    <?php
    // WORLD FINAL
    $introduce_world_final_html = '';
    if (strlen($introduce_world_final) > 0) {
      $video_thumbnail = get_field('video_thumbnail', 'options');
      $introduce_world_final_html = '
      <h3 class="text-14 font-bold">BMW GOLF CUP</h3>
      <video id="video" width="100%" height="160" controls class="video hover:cursor-pointer rounded-lg mt-4" poster="' . $video_thumbnail . '">
        <source src="' . $introduce_world_final . '" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
      </video>
      ';
    }
    echo $introduce_world_final_html;


    // TOURNAMENT PROCESS
    $introduce_tournament_process_html = '';
    if (strlen($introduce_tournament_process) > 0) {
      $introduce_tournament_process_html = '
      <h3 class="text-14 font-bold mt-6">TOURNAMENT PROCESS</h3>
      <img src="' . $introduce_tournament_process . '" class="mt-4 object-cover h-full w-full rounded-lg" />
      ';
    }
    echo $introduce_tournament_process_html;
    ?>
  </div>
</main><!-- #main -->

<?php
get_footer();
