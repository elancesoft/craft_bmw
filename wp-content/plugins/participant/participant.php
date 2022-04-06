<?php
/*
Plugin Name: Participant
Plugin URI: https://elancefoxvn.com/
Description: Plugin for BMW project.
Version: 1.0
Author: Tuan Pham
Author URI: https://elancefoxvn.com/
License: GPLv2 or later
Text Domain: participant
*/

function participant_menu()
{
  add_menu_page('Participant', 'Participant', 'manage_options', 'participant', 'participant', 'dashicons-edit-page', 4);
  add_submenu_page('participant', 'Import Manager', 'Import', 'manage_options', 'participant-import', 'participant_import');
  // add_submenu_page('participant', 'Images', 'Images', 'manage_options', 'participant-image', 'participant_image');
}
add_action('admin_menu', 'participant_menu');

/* PARTICIPANT
-------------------------------------------------------------------- */
function participant()
{
  $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

  $content = '';
  global $wpdb;

  switch ($action) {
    case 'addnew': /* --------- ADD NEW ----------*/
      $content .= '
      <div class="wrap">
        <h1 class="wp-heading-inline">참가자 추가</h1>
        <form method="post" name="frmAddnew" action="' . plugin_dir_url(__FILE__) . 'process/participant.php" id="frmAddnew">
          <table class="form-table" role="presentation">
            <tr class="form-field form-required">
              <th scope="row"><label for="participant_name">이름 <span class="description">*</span></label></th>
              <td><input name="participant_name" type="text" id="participant_name" value="" aria-required="true" autocapitalize="none" autocorrect="off" /></td>
            </tr>
            <tr class="form-field form-required">
              <th scope="row"><label for="participant_phone">전화번호 <span class="description">*</span></label></th>
              <td><input name="participant_phone" type="text" id="participant_phone" value="" aria-required="true" autocapitalize="none" autocorrect="off" style="width: 300px;" /></td>
            </tr>
            <tr>
              <th scope="row"><label for="participant_gender">성별 <span class="description">*</span></label></th>
              <td>
                <select name="participant_gender">
                  <option value="1">남</option>
                  <option value="2">여</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
                <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="저장" style="padding: 3px 40px;">
                <input type="button" name="btnCancel" id="btnCancel" class="button button-secondafy" value="취소" onclick="history.back()" style="padding: 3px 40px;">
                <input type="hidden" name="action" value="addnew-process">
              </td>
            </tr>
          </table>
        </form>
      </div>
    ';
      break;

    case 'edit':/* --------- EDIT ----------*/
      $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : "";
      $participant = $wpdb->get_row(
        'SELECT * FROM ' . $wpdb->prefix . 'participants' .
          ' WHERE id=' . $id
      );

      // Gender options
      $male_selected = '';
      $female_selected = '';

      if ($participant->gender == 1) {
        $male_selected = 'selected';
      } else {
        $female_selected = 'selected';
      }

      // Build Content HTML
      $content .= '
      <div class="wrap">
        <h1 class="wp-heading-inline">Edit Participant</h1>
        <form method="post" name="frmEdit" action="' . plugin_dir_url(__FILE__) . 'process/participant.php" id="frmEdit" class="validate" novalidate="novalidate">
          <table class="form-table" role="presentation">
            <tr class="form-field form-required">
              <th scope="row"><label for="participant_name">이름 <span class="description">*</span></label></th>
              <td><input name="participant_name" type="text" id="participant_name" value="' . $participant->name . '" aria-required="true" autocapitalize="none" autocorrect="off" /></td>
            </tr>
            <tr class="form-field form-required">
              <th scope="row"><label for="participant_phone">전화번호 <span class="description">*</span></label></th>
              <td><input name="participant_phone" type="text" id="participant_phone" value="' . $participant->phone . '" aria-required="true" autocapitalize="none" autocorrect="off" style="width: 300px;" /></td>
            </tr>
            <tr>
              <th scope="row"><label for="participant_gender">성별 <span class="description">*</span></label></th>
              <td>
                <select name="participant_gender">
                  <option value="1" ' . $male_selected . '>남</option>
                  <option value="2" ' . $female_selected . '>여</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>
                <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="저장" style="padding: 3px 40px;">
                <input type="button" name="btnCancel" id="btnCancel" class="button button-secondafy" value="취소" onclick="history.back()" style="padding: 3px 40px;">
                <input type="hidden" name="action" value="edit-process">
                <input type="hidden" name="id" value="' . $id . '">
              </td>
            </tr>
          </table>
        </form>
      </div>
    ';
      break;

    case 'image':/* --------- ADD/EDIT/DELETE IMAGES ----------*/

      $uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : "";

      $participant = null; // store user object
      $uid_hidden = '';
      $label = 'Browse images for';
      $html_current_media = '';

      if (!empty($uid)) {
        $participant = $wpdb->get_row(
          'SELECT * FROM ' . $wpdb->prefix . 'participants' .
            ' WHERE id=' . $uid
        );

        $uid_hidden = '<input type="hidden" name="uid" value="' . $uid . '">';

        // Get current media of the participant
        if (!empty($participant)) {
          $label .= ' ' . $participant->name;
          $str_media_ids = $participant->media_ids;
          if (strlen(trim($str_media_ids)) > 0) {
            $media_ids = explode(',', $str_media_ids);
            foreach ($media_ids as $media_id) {
              $attached = wp_get_attachment_image_src($media_id);
              $html_current_media .= '
              <div class="participant-image-wrap" style="position: relative;">
                <img style="height: 100px; width: auto; border: 1px solid #333;" src="' . $attached[0] . '">
                <input type="hidden" name="media[]" value="' . $media_id . '" />
                <button type="button" class="btn-remove-img" style="position: absolute; right: 3px; top: 3px; color: red; cursor: pointer;font-size: 16px;">x</button>
              </div>
              ';
            }
          }
        }
      } else {
        // Get all participant
        $participants = $wpdb->get_results(
          'SELECT * FROM ' . $wpdb->prefix . 'participants ORDER BY id DESC'
        );
        $html_select_user = '<div style="margin-top: 25px;"><select name="uid">';
        $html_select_user .= '<option>Select Participant</option>';

        foreach ($participants as $participant) {
          $html_select_user .= '<option value="' . $participant->id . '">' . $participant->name . ' (' . $participant->phone . ')</option>';
        }

        $html_select_user .= '</select></div>';
      }

      $content .= '
      <div class="wrap">
        <h1 class="wp-heading-inline">' . $label . '</h1>
        <form class="" name="frmImport" method="POST" action="' . plugin_dir_url(__FILE__) . 'process/participant.php">
        ' . $html_select_user . '
          <div style="margin-top: 25px;">
            <div id="obal" style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 25px;">' . $html_current_media . '</div>
            <div style="display: flex;">
              <button id="upload_image_button" type="button" style="padding: 10px 20px;">Browse Image</button>
              <input type="submit" value="저장" name="import" class="page-title-action" style="padding: 11px 20px; top: 0 !important;" />
              <input type="button" name="btnCancel" id="btnCancel" class="button button-secondafy" value="취소" onclick="history.back()" style="padding: 3px 40px;">
              <input type="hidden" name="action" value="image-process">
              ' . $uid_hidden . '
            </div>
          </div>
        </form>
      
      </div>
      ';
      break;

    default: /* --------- LIST ----------*/
      $participants = $wpdb->get_results(
        'SELECT * FROM ' . $wpdb->prefix . 'participants ORDER BY id ASC'
      );

      $content .= '
      <div class="wrap">
        <h1 class="wp-heading-inline">Participants</h1>
        <a href="admin.php?page=participant&action=addnew" class="page-title-action" style="display: none;">Add New</a>
      ';

      if ($participants) {
        $content .= '
        <table class="wp-list-table widefat fixed striped table-view-list questions">
        <thead>
        <tr>
          <th width="50" style="text-align: center;"><strong>순위</strong></th>
          <th><strong>카테고리</strong></th>
          <th><strong>이름</strong></th>
          <th width="102"><strong>전화번호</strong></th>
          <th width="50" style="text-align: center;"><strong>성별</strong></th>
          <th width="70" style="text-align: center;"><strong>참가부문</strong></th>
          <th width="75" style="text-align: center;"><strong>티 오프 시간</strong></th>
          <th width="75" style="text-align: center;"><strong>출발 홀</strong></th>
          <th style="text-align: center;"><strong>스테이블포드 포인트</strong></th>
          <th style="text-align: center;"><strong>신페리오 점수</strong></th>
          <th style="text-align: center;"><strong>스트로크 점수</strong></th>
          <th style="text-align: center;"><strong>BACK 9</strong></th>
          <th style="text-align: center;"><strong>BACK 6</strong></th>
          <th style="text-align: center;"><strong>BACK 3</strong></th>
          <th width="50" style="text-align: center;"><strong>Image</strong></th>
          <th width="100" style="text-align: center; display: none;"><strong>Action</strong></th>
        </tr>
        </thead>
        <tbody>
        ';

        foreach ($participants as $post) {
          $media_ids = array();

          $str_media_id = $post->media_ids;

          $rank = !empty($post->rank) ? $post->rank : '-';
          $category = !empty($post->category) ? $post->category : '-';
          $stableford = !empty($post->stableford) ? $post->stableford : '-';
          $new_perio = !empty($post->new_perio) ? $post->new_perio : '-';
          $stroke = !empty($post->stroke) ? $post->stroke : '-';
          $back_9 = !empty($post->back_9) ? $post->back_9 : '-';
          $back_6 = !empty($post->back_6) ? $post->back_6 : '-';
          $back_3 = !empty($post->back_3) ? $post->back_3 : '-';

          if (strlen(trim($str_media_id)) > 0) $media_ids = explode(',', $post->media_ids);

          $content .= ' 
          <tr>
            <td style="vertical-align:middle; text-align: center;">' . $rank . '</td>
            <td style="vertical-align:middle;">' . $category . '</td>
            <td style="vertical-align:middle;">
              <strong style="display: none;"><a href="admin.php?page=participant&action=edit&id=' . $post->id . '">' . $post->name . '</a></strong>
              <strong>' . $post->name . '</strong>
            </td>
            <td style="vertical-align:middle;">' . $post->phone . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $post->gender . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $post->competition . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $post->tee_time . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $post->hole . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $stableford . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $new_perio . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $stroke . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $back_9 . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $back_6 . '</td>
            <td style="vertical-align:middle; text-align: center;">' . $back_3 . '</td>
            <td style="vertical-align:middle; text-align: center"><a href="admin.php?page=participant&action=image&uid=' . $post->id . '">' . sizeof($media_ids) . '</a></td>
            <td style="vertical-align:middle; text-align: center; display: none;">
              <a href="admin.php?page=participant&action=edit&id=' . $post->id . '">편집하다</a> | 
              <a href="' . plugin_dir_url(__FILE__) . 'process/participant.php?action=delete&id=' . $post->id . '" onclick="return confirm(\'삭제하시겠습니까?\')">삭제</a>
            </td>
          </tr>
          ';
        }

        $content .= '
        </tbody>
      </table>
      </div>
    ';
      }
  }

  echo $content;
}

/* IMPORT
-------------------------------------------------------------------- */
function participant_import()
{
  $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

  $content = '';
  global $wpdb;

  switch ($action) {
    case 'process': /* --------- PROCESS ----------*/
      if (isset($_POST["import"])) {

        $fileName = $_FILES["participant_data"]["tmp_name"];

        if ($_FILES["participant_data"]["size"] > 0) {
          $file = fopen($fileName, "r");

          fgetcsv($file); // remove the first line fo the CSV file
          $count = 0;

          // TRUNCATE the table first
          $wpdb->query('TRUNCATE TABLE ' . $wpdb->prefix . 'participants');

          // Insert new data
          while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $rank = isset($column[0]) ? $column[0] : "";
            $category = isset($column[1]) ? $column[1] : "";
            $name = isset($column[2]) ? $column[2] : "";
            $phone = isset($column[3]) ? $column[3] : "";
            $gender = isset($column[4]) ? $column[4] : "";
            $competition = isset($column[5]) ? $column[5] : "";
            $tee_time = isset($column[6]) ? $column[6] : "";
            $hole = isset($column[7]) ? $column[7] : "";
            $stableford = isset($column[8]) ? $column[8] : "";
            $new_perio = isset($column[9]) ? $column[9] : "";
            $stroke = isset($column[10]) ? $column[10] : "";
            $back_9 = isset($column[11]) ? $column[11] : "";
            $back_6 = isset($column[12]) ? $column[12] : "";
            $back_3 = isset($column[13]) ? $column[13] : "";


            $tablename = $wpdb->prefix . 'participants';
            $data = array(
              'rank' => $rank,
              'category' => $category,
              'name' => $name,
              'phone' => $phone,
              'gender' => $gender,
              'competition' => $competition,
              'tee_time' => $tee_time,
              'hole' => $hole,
              'stableford' => $stableford,
              'new_perio' => $new_perio,
              'stroke' => $stroke,
              'back_9' => $back_9,
              'back_6' => $back_6,
              'back_3' => $back_3
            );

            $wpdb->insert($tablename, $data);

            if (!empty($wpdb->insert_id)) {
              $count++;
            }
          }

          fclose($file);
        }
      }

      $content .= '
      <div class="wrap">
        <h1 class="wp-heading-inline">Import Participants</h1>
        <form class="" name="frmImport" method="POST" action="" enctype="multipart/form-data">
          <div style="margin-top: 25px;">
            <label for="participant_data">Upload .CSV file</label>
            <input type="file" id="participant_data" name="participant_data" />
          </div>
          <div style="margin-top: 25px;">
            <input type="submit" value="Submit" name="import" class="page-title-action" />
            <input type="hidden" name="action" value="process">
          </div>

          <div style="margin-top: 15px; color: blue; font-size: 18px;">Imported ' . $count . ' participants to database!!!</div>

        </form>
      
      </div>
      ';

      break;

    default: /* --------- LIST ----------*/
      $content .= '
      <div class="wrap">
        <h1 class="wp-heading-inline">Import Participants</h1>
        <form class="" name="frmImport" method="POST" action="" enctype="multipart/form-data">
          <div style="margin-top: 25px;">
            <label for="participant_data">Upload .CSV file</label>
            <input type="file" id="participant_data" name="participant_data" />
          </div>
          <div style="margin-top: 25px;">
            <input type="submit" value="Submit" name="import" class="page-title-action" />
            <input type="hidden" name="action" value="process">
          </div>

        </form>
      
      </div>
      ';
  }

  echo $content;
}
