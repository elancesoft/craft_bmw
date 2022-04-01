// jQuery(function() {

//   var media_properties = ['id', 'title', 'filename', 'url', 'link', 'alt', 'author', 'description', 'caption', 'name', 'status', 'uploadedTo', 'date', 'modified', 'menuOrder', 'mime', 'type', 'subtype', 'icon', 'dateFormatted', 'nonces', 'editLink', 'sizes', 'height', 'width', 'orientation', 'compat'];

//   jQuery('.media-remove').on('click', function(e) {
//     e.preventDefault();

//     if (jQuery(this).attr('data-browse-button')) var $browse = jQuery(jQuery(this).attr('data-browse-button'));
//     else var $browse = jQuery(this).siblings('.media-browse');

//     if (!$browse.length) {
//       alert('No sibling browse button found, or the data-browse-button attribute had no matching elements');
//       return false;
//     }

//     $browse.data('attachment', false).trigger('attachment-removed');

//     // Trigger the update for the browse button's fields
//     for (i = 0; i < media_properties.length; i++) {
//       var media_key = media_properties[i];
//       var selector = $browse.attr('data-media-' + media_key); // data-media-url, data-media-link, data-media-height

//       if (selector) {
//         var $target = jQuery(selector);

//         if ($target.length) {
//           $target.val('').trigger('media-updated').trigger('change');
//         }
//       }
//     }

//     return false;
//   });

//   var file_frame;
//   jQuery('.media-browse').on('click', function(e) {
//     e.preventDefault();

//     var $this = jQuery(this);

//     if (!wp || !wp.media) {
//       alert('The media gallery is not available. You must admin_enqueue this function: wp_enqueue_media()');
//       return;
//     }

//     // If the media frame already exists, reopen it.
//     if (file_frame) {
//       file_frame.open();
//       return;
//     }

//     // Create the media frame.
//     file_frame = wp.media.frames.file_frame = wp.media({
//       title: $this.attr('data-media-title') || 'Browsing Media',
//       button: {
//         text: $this.attr('data-media-text') || 'Select',
//       },
//       multiple: true // Set to true to allow multiple files to be selected
//     });

//     // When an image is selected, run a callback.
//     file_frame.on('select', function() {
//       // We set multiple to false so only get one image from the uploader
//       attachment = file_frame.state().get('selection').first().toJSON();

//       // Extend this plugin yourself by binding the "attachment-selected" event to the button.
//       $this.data('attachment', attachment).trigger('attachment-selected');

//       // Allow each file property to be assigned to a field. Fields are referenced by the button's data attrbiutes
//       // All methods support a data attribute.
//       // data-media-{index}
//       // Example:
//       // attachment.url is assigned to the element matching the value of the "data-media-url" attribute (if available)
//       for (i = 0; i < media_properties.length; i++) {
//         var media_key = media_properties[i];
//         var selector = $this.attr('data-media-' + media_key); // data-media-url, data-media-link, data-media-height

//         if (selector) {
//           var $target = jQuery(selector);

//           if (!$target.length) {
//             if (console && console.log) {
//               console.log('Selector contains zero matched elements:', selector, 'Value expected:', attachment[media_key]);
//               continue;
//             }
//           }

//           // Assign the target field the given value, and trigger two events for developers to check for
//           $target.val(attachment[media_key]).trigger('media-updated').trigger('change');
//         }
//       }
//     });

//     // Finally, open the modal
//     file_frame.open();
//   });

// });



jQuery(document).ready(function ($) {
  var custom_uploader;

  $('#upload_image_button').click(function (e) {
    e.preventDefault();
    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
      custom_uploader.open();
      return;
    }
    //Extend the wp.media object
    custom_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
        text: 'Choose Image'
      },
      multiple: true
    });
    custom_uploader.on('select', function () {
      var selection = custom_uploader.state().get('selection');
      selection.map(function (attachment) {
        attachment = attachment.toJSON();

        $("#obal").append("<div class='participant-image-wrap' style='position: relative;'><img style='height: 100px; width: auto; border: 1px solid #333;' src=" + attachment.url + "><input type='hidden' name='media[]' value='" + attachment.id + "' /><button type='button' class='btn-remove-img' style='position: absolute; right: 3px; top: 3px; color: red; cursor: pointer;font-size: 16px;'>x</button></div>");
      });
    });
    custom_uploader.open();
  });


  // Remove participant's image
  $(document).on('click', '.btn-remove-img', function () {
    $(this).parent('div').remove();
  });
});
