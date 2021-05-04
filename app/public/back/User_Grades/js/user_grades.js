$(document).on('click', '.add-char-btn', function(event) {

  var add_char_html_content = $('#level-add-input').html();

  $('#add_new_level_id').append(add_char_html_content);

  $(this).next().remove();
  $(this).remove();

});

$(document).on('click', '.add-char-btn_modal', function(event) {

  var add_char_html_content = $('#level-add-input').html();

  $('#add_new_level_id_modal').append(add_char_html_content);

  $(this).next().remove();
  $(this).remove();

});


$(document).on('click', '.insert_this_level', function(event) {

  var select_inputs = $('.add_character_name_select_input');
  var quantity_inputs = $('.add_character_quantity_input');
  var level_name = "Level " + (jQuery('#present_level_count').data('current-level-count') + 1);

  console.log(select_inputs.length);
  console.log(quantity_inputs.length);
  console.log(level_name);

  var select_values = {};
  var select_quantities = {};

  $('.add_character_quantity_input').each(function(key, val) {
    var char_quantity = $(this).val();

    select_quantities[key] = char_quantity;
  });

  console.log(select_quantities);

  $('.add_character_name_select_input').each(function(key, val) {
    console.log("Key: ", key, char_quantity);
    var char_name = $(this).val();
    console.log(select_quantities);
    var char_quantity = select_quantities[key];

    select_values[char_name] = char_quantity;
  });

  console.log(select_values);
  if (confirm("Are you Sure?")) {
    var level_data = JSON.stringify(select_values);
    var action = "add_level";
    jQuery.ajax({
      type: 'POST',
      url: 'assets/User_Grades/actions/action.php',
      data: {
        action: action,
        level_name: level_name,
        level_data: level_data
      },
      success: function(res) {
        console.log(res);
        location.href = "http://daytrade.supremeganesh.com/new-admin/user-level.php";
        setTimeout(function() {
          location.reload();
        }, 500);
        return true;
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
});



$(document).on('click', '.update_this_level', function(event) {

  var select_inputs = $('.edit_character_name_select_input');
  var quantity_inputs = $('.edit_character_quantity_input');
  var level_id = $('.level_id').val();

  console.log(select_inputs.length);
  console.log(quantity_inputs.length);

  var select_values = {};
  var select_quantities = {};

  $('.edit_character_quantity_input').each(function(key, val) {
    var char_quantity = $(this).val();

    select_quantities[key] = char_quantity;
  });

  console.log(select_quantities);

  $('.edit_character_name_select_input').each(function(key, val) {
    console.log("Key: ", key, char_quantity);
    var char_name = $(this).val();
    console.log(select_quantities);
    var char_quantity = select_quantities[key];

    select_values[char_name] = char_quantity;
  });

  console.log(select_values);
  if (confirm("Are you Sure?")) {
    var level_data = JSON.stringify(select_values);
    var action = "update_my_level";
    jQuery.ajax({
      type: 'POST',
      url: 'assets/User_Grades/actions/action.php',
      data: {
        action: action,
        level_id: level_id,
        level_data: level_data
      },
      success: function(res) {
        console.log(res);
        location.href = "http://daytrade.supremeganesh.com/new-admin/user-level.php";
        setTimeout(function() {
          location.reload();
        }, 500);
        return true;
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }
});



$(document).on('click', '.remove-level', function(event) {
  event.stopPropagation();
  event.stopImmediatePropagation();
  if (confirm("Are you Sure?")) {
    var level_id = jQuery(this).data('dtaskid');
    var action = "remove_level";
    jQuery.ajax({
      type: 'POST',
      url: 'assets/User_Grades/actions/action.php',
      data: {
        action: action,
        level_id: level_id
      },
      dataType: 'json',
      success: function(res) {
        console.log(res);
        setTimeout(function() {
          location.reload();
        }, 500);
        return true;
      },
      error: function(xhr,
        ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  } else {}
});
$(document).on('click', '.edit-level', function(event) {
  event.stopPropagation();
  event.stopImmediatePropagation();

  let dtaskid = $(this).data('dtaskid');
  $('#edit_level').modal('show');
  document.querySelector('#save-changes-level').setAttribute('data-level', dtaskid);
  console.log(dtaskid);

  $(document).on('click', '#save-changes-level', function(event) {
    event.stopPropagation();
    event.stopImmediatePropagation();

    var level_id = jQuery(this).data('dtaskid');
    var action = "edit_level";

    jQuery.ajax({
      type: 'POST',
      url: 'assets/User_Grades/actions/action.php',
      data: {
        action: action,
        level_id: level_id,
        level_data: level_data
      },
      dataType: 'json',
      success: function(res) {
        console.log(res);
        return true;
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
});
