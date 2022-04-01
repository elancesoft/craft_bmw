<?php
/**
 * Template Name: Time Notice (티 오프 시간 확인)
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
  // $competition_fields = get_field('hot_brand_settings');
  ?>

  <div class="grid grid-flow-row">
    <div class="flex py-2 items-center justify-between">
      <div class="text-16 font-bold">참가자명</div>
      <div class="text-right"><?php echo get_field('participant_name'); ?></div>
    </div>
    <div class="flex py-2 items-center justify-between">
      <div class="text-16 font-bold">대회일</div>
      <div class="text-right"><?php echo get_field('competition_day'); ?></div>
    </div>
    <div class="flex py-2 items-start justify-between">
      <div class="text-16 font-bold">티 오프 시간</div>
      <div class="text-right"><?php echo get_field('tee_off_time'); ?></div>
    </div>
    <div class="flex flex-col py-2">
      <div class="text-16 font-bold">대회 방식</div>
      <div class="text-left mt-2 leading-6"><?php echo get_field('time_notice'); ?></div>
    </div>
  </div>
</div>
</main><!-- #main -->

<?php
get_footer();