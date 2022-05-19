<?php

/**
 * Template Name: Image (대회 사진)
 */

get_header();

$mediaObj = $wpdb->get_row(
  'SELECT `media_ids` FROM ' . $wpdb->prefix . 'participants WHERE id = ' . $_SESSION['participant']->id
);

$media_ids = array();
$str_media_id = $mediaObj->media_ids;
if (strlen(trim($str_media_id)) > 0) $media_ids = explode(',', $mediaObj->media_ids);

$video_thumbnail = get_field('video_thumbnail', 'options');
?>
<main id="primary" class="mt-[34px] pb-[45px]">
  <?php
  while (have_posts()) :
    the_post();
    the_title('<h1 class="text-20 font-bold mt-[24px] px-4">', '</h1>');
  // the_content();
  endwhile; // End of the loop.
  ?>

  <?php if (sizeof($media_ids) > 0) : ?>

    <div x-data="{
    selected: 0,
    open: false
}" x-init="
$watch('open', value => {
    const body = document.body;
    if(!open) {
       body.classList.remove('h-screen');
       return body.classList.remove('overflow-hidden');
    } else {
        body.classList.add('h-screen');
        return body.classList.add('overflow-hidden');
    }
});">

      <!-- Make sure to add the requisite CSS for x-cloak: https://github.com/alpinejs/alpine#x-cloak -->

      <div x-cloak x-ref="modal" x-show.transition.opacity="open" class="fixed z-20 top-0 left-0 w-screen h-screen bg-black bg-opacity-60 flex items-center justify-center" role="dialog" aria-modal="true">

        <div @mousedown.away="open = false" @keydown.window.escape="open = false" class="w-full max-w-md rounded shadow-xl flex flex-col absolute divide-y divide-gray-200">
          <div class="m-4 bg-white rounded-lg text-black">

            <div class="max-w-screen-sm" x-data="
          {
            images: [
              <?php
              foreach ($media_ids as $index => $media) {
                // $attached = wp_get_attachment_image_src($media, 'full');
                $attachedURL = wp_get_attachment_url($media);
                $type = wp_attachment_is('video', $media) ? "video" : "image";

                echo "
                {
                  type: '" . $type . "',
                  src: '" . $attachedURL . "',
                  alt: 'Media " . $index . "'
                },
                ";
              }
              ?>
            ]
          }">
              <template x-for="(image, index) in images">
                <figure class="relative overflow-hidden" x-show="selected === index">
                  <!-- Header -->
                  <div class="relative flex items-center justify-center">
                    <p class="p-2">크게보기</p>
                    <button @click="open = false" class="absolute right-4 top-3">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>

                  <!-- Video -->
                  <template x-if="image.type == 'video'">
                  <video :id="video_index" width="100%" height="150" class="video" controls poster="<?php echo $video_thumbnail; ?>">
                    <source :src="image.src" type="video/mp4">
                  </video>
                  </template>

                  <!-- Image -->
                  <template x-if="image.type == 'image'">
                    <img :key="index" class="h-64 w-full object-cover object-center" :src="image.src" :alt="image.alt">
                  </template>

                  <!-- Footer -->
                  <div class="bg-blue-00 text-white flex items-center justify-center p-3 rounded-bl-lg rounded-br-lg">
                    <a :href="image.src" download>다운로드</a>
                  </div>

                  <!-- Button Next & Previous -->
                  <button aria-label="Previous Image" class="absolute left-0 text-white p-1 top-[44%] focus:outline-none focus:shadow-outline rounded" :class="{ 'opacity-30' : selected === 0 }" @click="selected > 0 ? selected-- : null">
                    <svg class="w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                  </button>
                  <button aria-label="Next Image" class="absolute right-0 text-white top-[44%] p-1 focus:outline-none focus:shadow-outline rounded" :class="{ 'opacity-30' : selected === (images.length - 1) }" @click="selected < (images.length - 1) ? selected ++ : null">
                    <svg class="w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    </svg>
                  </button>
                </figure>
              </template>
            </div>
          </div>
        </div>
      </div>

      <!-- Image List -->
      <div class="grid grid-cols-2 gap-[1px] mt-[24px] bg-white p-[1px]">
        <?php
        foreach ($media_ids as $index => $media) {
          $attachedURL = wp_get_attachment_url($media);

          if (wp_attachment_is('video', $media)) {
            // Process for Video
            echo '<div class="overflow-hidden bg-black"><video id="video_' . $index . '" @click="open = true; selected = ' . $index . '" class="cursor-pointer w-full h-[150px]" controls poster="' . $video_thumbnail . '"><source src="' . $attachedURL . '" type="video/mp4"></video></div>';
          } else if (wp_attachment_is('image', $media)) {
            // Process for Image
            // $attached = wp_get_attachment_image_src($media, 'full');
            echo '<div class="overflow-hidden"><img @click="open = true; selected = ' . $index . '" src="' . $attachedURL . '" class="cursor-pointer w-full h-[150px] object-cover hover:scale-150 transition-all duration-700" /></div>';
          } else {
          }
        }
        ?>
      </div>
    </div>
  <?php else : ?>
    <?php $msg_before_live = get_field('message_before_live', 'options'); ?>
    <div class="text-center text-16 mt-[200px] flex items-center justify-center"><?php echo $msg_before_live; ?></div>
  <?php endif; ?>
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
