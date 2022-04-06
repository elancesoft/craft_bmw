<?php

/**
 * Template Name: Award (시상식)
 */

get_header();

$award_video_1 = get_field('award_video_1');
$award_video_2 = get_field('award_video_2');
?>

<main id="primary" class="site-content mt-[34px] pb-[45px] px-4">
  <?php
  // Show the title & content
  while (have_posts()) :
    the_post();
    the_title('<h1 class="text-20 font-bold mt-[24px]">', '</h1>');
  // the_content();
  endwhile; // End of the loop.
  ?>

  <div class="mt-[24px]">
    <?php
    if ((strlen($award_video_1) <= 0) && (strlen($award_video_2) <= 0)) {
      $msg_before_live = get_field('message_before_live', 'options');

      echo '<div class="text-center text-16 mt-[200px] flex items-center justify-center">' . $msg_before_live . '</div>';
    } else {
      // VIDEO 1
      $award_video_1_html = '';
      if (strlen($award_video_1) > 0) {
        $video_thumbnail = get_field('video_thumbnail', 'options');
        $award_video_1_html = '
      <h3 class="text-16 font-bold">환송사 영상</h3>
      <video id="video" width="100%" height="160" controls class="video hover:cursor-pointer rounded-lg mt-4" poster="' . $video_thumbnail . '">
        <source src="' . $award_video_1 . '" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
      </video>
      ';
      }
      echo $award_video_1_html;


      // Video 2
      $award_video_2_html = '';
      if (strlen($award_video_2) > 0) {
        $video_thumbnail = get_field('video_thumbnail', 'options');
        $award_video_2_html = '
      <h3 class="text-16 font-bold mt-[40px]">시상식 영상</h3>
      <video id="video_1" width="100%" height="160" controls class="video hover:cursor-pointer rounded-lg mt-4" poster="' . $video_thumbnail . '">
        <source src="' . $award_video_2 . '" type="video/mp4">
        <source src="movie.ogg" type="video/ogg">
        Your browser does not support the video tag.
      </video>
      ';
      }
      echo $award_video_2_html;
    }
    ?>
  </div>
</main><!-- #main -->

<?php
get_footer();
