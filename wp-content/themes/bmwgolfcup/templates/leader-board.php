<?php

/**
 * Template Name: Leader Board (리더보드)
 */

get_header();
?>

<main id="primary" class="mt-[34px] pb-[45px]">
  <?php
  while (have_posts()) :
    the_post();
    the_title('<h1 class="text-20 font-bold mt-[24px] px-4">', '</h1>');
  // the_content();
  endwhile; // End of the loop.
  ?>

  <?php
  $participants = $wpdb->get_results(
    'SELECT * FROM ' . $wpdb->prefix . 'participants WHERE rank = 0 or rank = ""'
  );

  $count_rank_0 = $wpdb->num_rows;

  if ($count_rank_0 > 0) {
    $msg_before_live = get_field('message_before_live', 'options');
  ?>
    <div class="text-center text-16 mt-[200px] flex items-center justify-center"><?php echo $msg_before_live; ?></div>
  <?php
  } else {
  ?>
    <div x-data="{ 
            activeTab:1,
            activeClass: 'text-18 font-medium inline-block px-4 pb-3 border-b-2 border-b-white',
            inactiveClass : 'text-18 font-light inline-block px-4 pb-3 border-b-2 border-b-transparent'
         }" class="overflow-x-hidden mt-[52px]">
      <div class="overflow-x-scroll pb-3">
        <ul class="flex whitespace-nowrap items-center justify-start space-x-2 text-white">
          <li>
            <a href="#" x-on:click="activeTab = 1" :class="activeTab === 1 ? activeClass : inactiveClass">남자 A</a>
          </li>
          <li>
            <a href="#" x-on:click="activeTab = 2" :class="activeTab === 2 ? activeClass : inactiveClass">남자 B</a>
          </li>
          <li>
            <a href="#" x-on:click="activeTab = 3" :class="activeTab === 3 ? activeClass : inactiveClass">여자</a>
          </li>

          <li>
            <a href="#" x-on:click="activeTab = 4" :class="activeTab === 4 ? activeClass : inactiveClass">게스트(남)</a>
          </li>

          <li>
            <a href="#" x-on:click="activeTab = 5" :class="activeTab === 5 ? activeClass : inactiveClass">게스트(여)</a>
          </li>
        </ul>
      </div>

      <div class="mt-6">
        <!-- TAB CONTENT 1 -->
        <div x-show="activeTab === 1">

          <!-- Search form -->
          <div class="flex items-center justify-between mt-4 gap-x-2 px-4">
            <input type="text" name="txtKeyword" id="keyword_tab1" value="<?php echo $keyword; ?>" placeholder="참가자 명을 입력해 주세요." class="shrink w-full bg-transparent border-white rounded-lg placeholder:text-white placeholder:opacity-60 placeholder:font-light h-[48px]" />
            <button type="button" id="btn_leader_board_tab1" class="bg-blue-00 py-[10px] px-[20px] rounded-lg whitespace-nowrap">검색</button>
          </div>

          <!-- Result -->
          <div class="mt-6 overflow-x-auto">
            <?php
            $participants = $wpdb->get_results(
              'SELECT * FROM ' . $wpdb->prefix . 'participants WHERE category = "남자A" ORDER BY rank ASC'
            );

            if (sizeof($participants) > 0) :
            ?>
              <table id="leaderboard_tab1" class="table-fixed leading-10 whitespace-nowrap">
                <thead class="leading-5">
                  <tr class="border-b-2 border-b-white">
                    <th class="font-medium py-2 px-4">순위</th>
                    <th class="font-medium py-2 px-4">이름</th>
                    <th class="font-medium py-2 px-4">스테이블 포드 포인트</th>
                    <th class="font-medium py-2 px-4">스트로크 점수</th>
                    <th class="font-medium py-2 px-4">BACK 9</th>
                    <th class="font-medium py-2 px-4">BACK 6</th>
                    <th class="font-medium py-2 px-4">BACK 3</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($participants as $item) : ?>
                    <tr class="leaderboard-item">
                      <td class="text-center"><?php echo $item->rank; ?></td>
                      <td class="leaderboard-item-name px-1"><?php echo $item->name; ?></td>
                      <td class="text-center"><?php echo $item->stableford; ?></td>
                      <td class="text-center"><?php echo $item->stroke; ?></td>
                      <td class="text-center"><?php echo $item->back_9; ?></td>
                      <td class="text-center"><?php echo $item->back_6; ?></td>
                      <td class="text-center"><?php echo $item->back_3; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else : ?>
              <div class="text-center text-20">
                해당 정보는 대회 종료 날짜인<br>
                2022년 03월 21일 (월) 공개됩니다.
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- TAB CONTENT 2 -->
        <div x-show="activeTab === 2">
          <!-- Search form -->
          <div class="flex items-center justify-between mt-4 gap-x-2 px-4">
            <input type="text" name="txtKeyword" id="keyword_tab2" value="<?php echo $keyword; ?>" placeholder="참가자 명을 입력해 주세요." class="shrink w-full bg-transparent border-white rounded-lg placeholder:text-white placeholder:opacity-60 placeholder:font-light h-[48px]" />
            <button type="button" id="btn_leader_board_tab2" class="bg-blue-00 py-[10px] px-[20px] rounded-lg whitespace-nowrap">검색</button>
          </div>

          <!-- Result -->
          <div class="mt-6 overflow-x-auto">
            <?php
            $participants = $wpdb->get_results(
              'SELECT * FROM ' . $wpdb->prefix . 'participants WHERE category = "남자B" ORDER BY rank ASC'
            );

            if (sizeof($participants) > 0) :
            ?>
              <table id="leaderboard_tab2" class="table-fixed leading-10 whitespace-nowrap">
                <thead class="leading-5">
                  <tr class="border-b-2 border-b-white">
                    <th class="font-medium py-2 px-4">순위</th>
                    <th class="font-medium py-2 px-4">이름</th>
                    <th class="font-medium py-2 px-4">스테이블 포드 포인트</th>
                    <th class="font-medium py-2 px-4">스트로크 점수</th>
                    <th class="font-medium py-2 px-4">BACK 9</th>
                    <th class="font-medium py-2 px-4">BACK 6</th>
                    <th class="font-medium py-2 px-4">BACK 3</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($participants as $index => $item) : ?>
                    <tr class="leaderboard-item">
                      <td class="text-center"><?php echo $item->rank; ?></td>
                      <td class="leaderboard-item-name px-1"><?php echo $item->name; ?></td>
                      <td class="text-center"><?php echo $item->stableford; ?></td>
                      <td class="text-center"><?php echo $item->stroke; ?></td>
                      <td class="text-center"><?php echo $item->back_9; ?></td>
                      <td class="text-center"><?php echo $item->back_6; ?></td>
                      <td class="text-center"><?php echo $item->back_3; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else : ?>
              <div class="text-center text-20">
                해당 정보는 대회 종료 날짜인<br>
                2022년 03월 21일 (월) 공개됩니다.
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- TAB CONTENT 3 -->
        <div x-show="activeTab === 3">
          <!-- Search form -->
          <div class="flex items-center justify-between mt-4 gap-x-2 px-4">
            <input type="text" name="txtKeyword" id="keyword_tab3" value="<?php echo $keyword; ?>" placeholder="참가자 명을 입력해 주세요." class="shrink w-full bg-transparent border-white rounded-lg placeholder:text-white placeholder:opacity-60 placeholder:font-light h-[48px]" />
            <button type="button" id="btn_leader_board_tab3" class="bg-blue-00 py-[10px] px-[20px] rounded-lg whitespace-nowrap">검색</button>
          </div>

          <!-- Result -->
          <div class="mt-6 overflow-x-auto">
            <?php
            $participants = $wpdb->get_results(
              'SELECT * FROM ' . $wpdb->prefix . 'participants WHERE category = "여자" ORDER BY rank ASC'
            );

            if (sizeof($participants) > 0) :
            ?>
              <table id="leaderboard_tab3" class="table-fixed leading-10 whitespace-nowrap">
                <thead class="leading-5">
                  <tr class="border-b-2 border-b-white">
                    <th class="font-medium py-2 px-4">순위</th>
                    <th class="font-medium py-2 px-4">이름</th>
                    <th class="font-medium py-2 px-4">스테이블 포드 포인트</th>
                    <th class="font-medium py-2 px-4">스트로크 점수</th>
                    <th class="font-medium py-2 px-4">BACK 9</th>
                    <th class="font-medium py-2 px-4">BACK 6</th>
                    <th class="font-medium py-2 px-4">BACK 3</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($participants as $index => $item) : ?>
                    <tr class="leaderboard-item">
                      <td class="text-center"><?php echo $item->rank; ?></td>
                      <td class="leaderboard-item-name px-1"><?php echo $item->name; ?></td>
                      <td class="text-center"><?php echo $item->stableford; ?></td>
                      <td class="text-center"><?php echo $item->stroke; ?></td>
                      <td class="text-center"><?php echo $item->back_9; ?></td>
                      <td class="text-center"><?php echo $item->back_6; ?></td>
                      <td class="text-center"><?php echo $item->back_3; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else : ?>
              <div class="text-center text-16">
                해당 정보는 대회 종료 날짜인<br>
                2022년 03월 21일 (월) 공개됩니다.
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- TAB CONTENT 4 -->
        <div x-show="activeTab === 4">
          <!-- Search form -->
          <div class="flex items-center justify-between mt-4 gap-x-2 px-4">
            <input type="text" name="txtKeyword" id="keyword_tab4" value="<?php echo $keyword; ?>" placeholder="참가자 명을 입력해 주세요." class="shrink w-full bg-transparent border-white rounded-lg placeholder:text-white placeholder:opacity-60 placeholder:font-light h-[48px]" />
            <button type="button" id="btn_leader_board_tab4" class="bg-blue-00 py-[10px] px-[20px] rounded-lg whitespace-nowrap">검색</button>
          </div>

          <!-- Result -->
          <div class="mt-6 overflow-x-auto">
            <?php
            $participants = $wpdb->get_results(
              'SELECT * FROM ' . $wpdb->prefix . 'participants WHERE category = "게스트(남)" ORDER BY rank ASC'
            );

            if (sizeof($participants) > 0) :
            ?>
              <table id="leaderboard_tab4" class="table-fixed leading-10 whitespace-nowrap">
                <thead class="leading-5">
                  <tr class="border-b-2 border-b-white">
                    <th class="font-medium py-2 px-4">순위</th>
                    <th class="font-medium py-2 px-4">이름</th>
                    <th class="font-medium py-2 px-4">신페리오 점수</th>
                    <th class="font-medium py-2 px-4">스트로크 점수</th>
                    <th class="font-medium py-2 px-4">BACK 9</th>
                    <th class="font-medium py-2 px-4">BACK 6</th>
                    <th class="font-medium py-2 px-4">BACK 3</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($participants as $index => $item) : ?>
                    <tr class="leaderboard-item">
                      <td class="text-center"><?php echo $item->rank; ?></td>
                      <td class="leaderboard-item-name px-1"><?php echo $item->name; ?></td>
                      <td class="text-center"><?php echo $item->new_perio; ?></td>
                      <td class="text-center"><?php echo $item->stroke; ?></td>
                      <td class="text-center"><?php echo $item->back_9; ?></td>
                      <td class="text-center"><?php echo $item->back_6; ?></td>
                      <td class="text-center"><?php echo $item->back_3; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else : ?>
              <div class="text-center text-20">
                해당 정보는 대회 종료 날짜인<br>
                2022년 03월 21일 (월) 공개됩니다.
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- TAB CONTENT 5 -->
        <div x-show="activeTab === 5">
          <!-- Search form -->
          <div class="flex items-center justify-between mt-4 gap-x-2 px-4">
            <input type="text" name="txtKeyword" id="keyword_tab5" value="<?php echo $keyword; ?>" placeholder="참가자 명을 입력해 주세요." class="shrink w-full bg-transparent border-white rounded-lg placeholder:text-white placeholder:opacity-60 placeholder:font-light h-[48px]" />
            <button type="button" id="btn_leader_board_tab5" class="bg-blue-00 py-[10px] px-[20px] rounded-lg whitespace-nowrap">검색</button>
          </div>

          <!-- Result -->
          <div class="mt-6 overflow-x-auto">
            <?php
            $participants = $wpdb->get_results(
              'SELECT * FROM ' . $wpdb->prefix . 'participants WHERE category = "게스트(여)" ORDER BY rank ASC'
            );

            if (sizeof($participants) > 0) :
            ?>
              <table id="leaderboard_tab5" class="table-fixed leading-10 whitespace-nowrap">
                <thead class="leading-5">
                  <tr class="border-b-2 border-b-white">
                    <th class="font-medium py-2 px-4">순위</th>
                    <th class="font-medium py-2 px-4">이름</th>
                    <th class="font-medium py-2 px-4">신페리오 점수</th>
                    <th class="font-medium py-2 px-4">스트로크 점수</th>
                    <th class="font-medium py-2 px-4">BACK 9</th>
                    <th class="font-medium py-2 px-4">BACK 6</th>
                    <th class="font-medium py-2 px-4">BACK 3</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($participants as $index => $item) : ?>
                    <tr class="leaderboard-item">
                      <td class="text-center"><?php echo $item->rank; ?></td>
                      <td class="leaderboard-item-name px-1"><?php echo $item->name; ?></td>
                      <td class="text-center"><?php echo $item->new_perio; ?></td>
                      <td class="text-center"><?php echo $item->stroke; ?></td>
                      <td class="text-center"><?php echo $item->back_9; ?></td>
                      <td class="text-center"><?php echo $item->back_6; ?></td>
                      <td class="text-center"><?php echo $item->back_3; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else : ?>
              <div class="text-center text-20">
                해당 정보는 대회 종료 날짜인<br>
                2022년 03월 21일 (월) 공개됩니다.
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</main><!-- #main -->

<?php
get_footer();
