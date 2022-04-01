<?php
/*
* Template Name: Login Page
*/
?>
<div class=”wp_login_form”>
  <div class=”form_heading”> Login Form </div>

  <?php
  $args = array(
    'redirect' => home_url(),
    'id_username' => 'user',
    'id_password' => 'pass',
  ); ?>

  <?php wp_login_form($args); ?>

</div>