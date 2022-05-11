<?php

/**
 * Template Name: Competition Information (대회 정보)
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

  <!-- Competition data -->
  <div>
    <?php
    $competition_data = get_field('competition_data');

    if ($competition_data) {

      echo '
        <div class="mb-7 mt-2 px-4 py-1 border border-white border-opacity-20 rounded-lg">
        <table class="table-auto w-full">
        ';

      foreach ($competition_data as $row) {
        echo '
          <tr>
            <td class="py-3 w-[140px] text-16 font-medium align-top">' . $row['competition_label'] . '</td>
            <td class="py-3 text-right align-top">' . $row['competition_value'] . '</td>
          </tr>
          ';
      }
      echo '
        </table>
        </div>
        ';
    }
    ?>
  </div>

  <!-- Participant Information -->
  <div class="mt-6">
    <?php $participant = $_SESSION['participant']; ?>
    <h3 class="text-20 font-bold">참가자 정보</h3>

    <div class="mb-7 mt-2 px-4 py-1 border border-white border-opacity-20 rounded-lg">
      <table class="table-auto w-full">
        <tr>
          <td class="py-3 text-16 font-medium">참가자</td>
          <td class="py-3 text-right"><?php echo $participant->name; ?></td>
        </tr>
        <tr>
          <td class="py-3 text-16 font-medium">티 오프 시간</td>
          <td class="py-3 text-right"><?php echo $participant->tee_time; ?></td>
        </tr>
        <tr>
          <td class="py-3 text-16 font-medium">출발 홀</td>
          <td class="py-3 text-right"><?php echo $participant->hole; ?></td>
        </tr>
        <tr>
          <td class="py-3 text-16 font-medium">참가부문</td>
          <td class="py-3 text-right"><?php echo $participant->competition; ?></td>
        </tr>
      </table>
    </div>
  </div>

  <!-- Notice -->
  <div class="mt-6">
    <h3 class="text-20 font-bold">유의사항</h3>
    <div class="mb-7 mt-2 p-4 border border-white border-opacity-20 rounded-lg">
      <?php
      $competition_notice = get_field('competition_notice');
      echo $competition_notice;
      ?>
    </div>

    <ul class="list-disc m-4 hidden">
      <li>티 오프 시간 10분 전 출발 홀에 위치한 스코어 카드 배부처에서 스코어 카드 수령과 대회 규정에 대한 안내를 받으시기 바랍니다.</li>
      <li>유의사항 1.</li>
      <li>유의사항2.</li>
    </ul>
  </div>
</main><!-- #main -->

<?php
get_footer();
