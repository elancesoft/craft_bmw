<?php
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path . 'wp-load.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

switch ($action) {
  case 'addnew-process':
    $name = isset($_REQUEST['participant_name']) ? stripslashes_deep($_REQUEST['participant_name']) : "";
    $phone = isset($_REQUEST['participant_phone']) ? stripslashes_deep($_REQUEST['participant_phone']) : "";
    $gender = isset($_REQUEST['participant_gender']) ? $_REQUEST['participant_gender'] : "";

    if (!empty($name) && !empty($phone) && !empty($gender)) {
      $tablename = $wpdb->prefix . 'participants';
      $data = array(
        'name' => $name,
        'phone' => $phone,
        'gender' => $gender
      );
      $wpdb->insert($tablename, $data);
    }

    wp_redirect(admin_url('admin.php?page=participant'));

    break;

  case 'edit-process':
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
    $name = isset($_REQUEST['participant_name']) ? stripslashes_deep($_REQUEST['participant_name']) : "";
    $phone = isset($_REQUEST['participant_phone']) ? stripslashes_deep($_REQUEST['participant_phone']) : "";
    $gender = isset($_REQUEST['participant_gender']) ? $_REQUEST['participant_gender'] : "";

    if (!empty($name) && !empty($phone) && !empty($gender)) {
      $wpdb->update(
        $wpdb->prefix . 'participants',
        array(
          'name' => $name,
          'phone' => $phone,
          'gender' => $gender
        ),
        array('id' => $id),
        array('%s')
      );
    }

    wp_redirect(admin_url('admin.php?page=participant'));
    break;

  case 'delete':
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";

    if (!empty($id)) {
      $wpdb->delete($wpdb->prefix . 'participants', array('id' => $id));
    }

    wp_redirect(admin_url('admin.php?page=participant'));

    break;

  case 'image-process':
    $media = isset($_REQUEST['media']) ? $_REQUEST['media'] : null;

    if (sizeof($media) > 0) {
      $uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : "";
      $media = array_unique($media);

      $str_media = implode(',', $media);

      $wpdb->update(
        $wpdb->prefix . 'participants',
        array(
          'media_ids' => $str_media
        ),
        array('id' => $uid),
        array('%s')
      );
    }

    wp_redirect(admin_url('admin.php?page=participant'));
    break;

  default:
}
