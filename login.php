<?php
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path . '/' . 'wp-load.php');

if (isset($_POST['txtPhone'])) {
  global $wpdb;

  $txtPhone = trim($_POST['txtPhone']);
  $msg = '';

  // Check login, after login ok then redirect to home page
  if (!empty($txtPhone)) {

    $participant = $wpdb->get_row(
      'SELECT * FROM ' . $wpdb->prefix . 'participants' .
        ' WHERE phone="' . $txtPhone . '"'
    );

    $rowcount = $wpdb->num_rows;

    if (empty($rowcount)) {
      $msg = '올바르지 않은 전화번호입니다.';
    } else {
      $_SESSION["bmwgolfcup_user_id"] = $participant->id;
      $_SESSION['participant'] = $participant;
      wp_safe_redirect(home_url(), 302);
      exit;
    }
  } else {
    $msg = '올바르지 않은 전화번호입니다.';
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri() . '?v=' . time(); ?>">
  <title>Login</title>
</head>

<body class="h-screen w-full text-14 font-light text-white bg-site bg-fixed bg-cover bg-right-bottom">
  <div class="max-w-md mx-auto px-4 h-screen w-full">
    <div class="h-screen w-full flex items-center justify-center">
      <div class="justtify-center mb-[80px]">
        <div class="flex items-center mb-[35px]"><?php the_custom_logo(); ?></div>

        <?php
        if (strlen($msg) > 0) {
          echo '<div class="text-red text-20">' . $msg . '</div>';
        }
        ?>

        <form action="" method="POST">
          <h1 class="mt-[35px]">참가자 휴대전화 번호 입력</h1>
          <p class="mt-[10px]">
            <input type="tel" name="txtPhone" value="" onInput="this.value = phoneFormat(this.value)" placeholder="010-0000-0000" class="w-full h-[48px] border border-white bg-transparent rounded-lg focus:outline-none" required />
          </p>
          <p class="mt-[8px]">
            <button type="submit" class="bg-blue-18 py-[13px] w-full rounded-lg">입력 완료</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  <script>
    function phoneFormat(input) { //returns ###-####-####
      input = input.replace(/\D/g, '').substring(0, 11);
      var size = input.length;
      if (size > 0) {
        input = "" + input
      }
      if (size > 2) {
        input = input.slice(0, 3) + "-" + input.slice(3)
      }
      if (size > 7) {
        input = input.slice(0, 8) + "-" + input.slice(8)
      }
      return input;
    }
  </script>
</body>

</html>