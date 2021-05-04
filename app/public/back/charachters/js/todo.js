jQuery(document).ready(function() {

  // create functionality
  jQuery('.todo-list-add-btn').on("click", function(event) {
    event.preventDefault();
    var todoListItem = jQuery('.todo-list'); //UNORDERED LIST
    var todoListInput = jQuery('.todo-list-input');
    var endtimeListInput = jQuery('.end-time-input');
    var releasetimeListInput = jQuery('.release-time-input');
    var valueListInput = jQuery('.value-input');
    var peachListInput = jQuery('.peach-input');
    var incomeListInput = jQuery('.income-input');
    var daysListInput = jQuery('.days-input');
    var charInputElement = jQuery('.char-file-input');
    var charCycleInput = jQuery('.char-cycle');

    var formData = new FormData(document.querySelector('#char-form'));
    formData.append("action", "create");
    // formData.append("item", todoListInput.val());
    // formData.append("userfile", charInputElement.files[0]);
    // formData.append("end_time", endtimeListInput.val());
    // formData.append("release_time", releasetimeListInput.val());
    // formData.append("value", valueListInput.val());
    // formData.append("peach", peachListInput.val());
    // formData.append("income", incomeListInput.val());
    // formData.append("days", daysListInput.val());

    var item = todoListInput.val();
    var end_time = endtimeListInput.val();
    var release_time = releasetimeListInput.val();
    var value = valueListInput.val();
    var peach = peachListInput.val();
    var income = incomeListInput.val();
    var days = daysListInput.val();
    var char_cycle = charCycleInput.val();
    var s = char_cycle.split("/");
    // var char_cycle_timestamp = new Date(Date.UTC(s[2],s[0],s[1],0,0,0)).getTime()/1000.0;
    var char_cycle_timestamp = new Date(s[2] + "-" + s[0] + "-" + s[1]).getTime() / 1000;
    console.log(char_cycle_timestamp, s);
    formData.append("char_cycle_timestamp", char_cycle_timestamp);
    var bindHTML = '';

    var s = char_cycle.split("/");

    for (var pair of formData.entries()) {
      console.log(pair[0] + ', ' + pair[1]);
    }

    jQuery.ajax({
      type: 'POST',
      url: 'action.php',
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function(json) {
        console.log(json);
        if (item) {
          location.reload();
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  // update functionality
  $('.edit-charachter').click(function() {
    var action = 'update';
    var task_id = jQuery(this).data('dtaskid');
    var modal_char_cycle_value = $('#modal-char-cycle-' + task_id).val();
    var modal_char_cycle_value_array = modal_char_cycle_value.split("/");

    var modal_end_time_1 = $('#modal-end-time-1-' + task_id).data('val') + ":00";
    var modal_end_time_2 = $('#modal-end-time-2-' + task_id).data('val') + ":00";
    var modal_release_time_1 = $('#modal-release-time-1-' + task_id).data('val') + ":00";
    var modal_release_time_2 = $('#modal-release-time-2-' + task_id).data('val') + ":00";
    console.log("TIME: ", modal_end_time_1);
    income_growth();

    var picker_1 = $('#modal-end-time-1-' + task_id).timepicker({
      value: modal_end_time_1
    });
    var picker_2 = $('#modal-end-time-2-' + task_id).timepicker({
      value: modal_end_time_2
    });
    var picker_3 = $('#modal-release-time-1-' + task_id).timepicker({
      value: modal_release_time_1
    });
    var picker_4 = $('#modal-release-time-2-' + task_id).timepicker({
      value: modal_release_time_2
    });
    console.log(modal_char_cycle_value);
    var picker_5 = $('#modal-char-cycle-' + task_id).datepicker({
      value: modal_char_cycle_value,
      format: 'dd/mm/yyyy'
    });

    $('.income-input-' + task_id).change(income_growth);
    $('.days-input-' + task_id).change(income_growth);

    function income_growth() {
      var growth_per_day = $('.income-input-' + task_id).val();
      var validity = $('.days-input-' + task_id).val();

      $('.income-growth-input-' + task_id).val((growth_per_day * validity) + "%");

      console.log(growth_per_day * validity);
    }

    // document.body.on('click', '#save-changes-' + task_id, function() {
    $('#save-changes-' + task_id).click(function() {
      var item = jQuery('.todo-list-input-' + task_id);
      var char_name = jQuery('#edit-char-name-' + task_id);
      var end_time_1 = jQuery('.end-time-1-input-' + task_id);
      var end_time_2 = jQuery('.end-time-2-input-' + task_id);
      var release_time_1 = jQuery('.release-time-1-input-' + task_id);
      var release_time_2 = jQuery('.release-time-2-input-' + task_id);
      var value = jQuery('.value-input-' + task_id);
      var peach = jQuery('.peach-input-' + task_id);
      var income = jQuery('.income-input-' + task_id);
      var days = jQuery('.days-input-' + task_id);
      var char_cycle = jQuery('.char-cycle-input-' + task_id).val();
      var s = char_cycle.split("/");

      var status = 1;

      let editformData = new FormData(document.querySelector('#edit-char-form-' + task_id));
      editformData.append("action", action);
      editformData.append("task_id", task_id);
      editformData.append('char-name', char_name.val());
      editformData.append("status", status);
      editformData.append("item", item.val());
      editformData.append("end_time_1", picker_1.val().split(":")[0]);
      editformData.append("end_time_2", picker_2.val().split(":")[0]);
      editformData.append("release_time_1", picker_3.val().split(":")[0]);
      editformData.append("release_time_2", picker_4.val().split(":")[0]);
      editformData.append("value", value.val());
      editformData.append("peach", peach.val());
      editformData.append("income", income.val());
      editformData.append("days", days.val());
      editformData.append("char_cycle_timestamp_arr", s);

      // for (var pair of editformData.entries()) {
      //     console.log(pair[0]+ ', ' + pair[1]);
      //   }

      // console.log(item.val(), end_time_1.val(), end_time_2.val(), release_time_1.val(), release_time_2.val(), value.val(), peach.val(), income.val(), days.val());
      jQuery.ajax({
        type: 'POST',
        url: 'action.php',
        data: editformData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(json) {
          console.log(json);
          $('#save-changes-' + task_id).text("Saved");
            location.reload();
          return true;
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    });
  });

  // delete functionality
  jQuery('.todo-list').on('click', '.remove', function() {
    var action = 'delete';
    var task_id = jQuery(this).data('dtaskid');
    jQuery.ajax({
      type: 'POST',
      url: 'action.php',
      data: {
        action: action,
        task_id: task_id
      },
      dataType: 'json',
      success: function(json) {
        return true;
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
    jQuery(this).parent().parent().remove();
  });
});

//FILE INPUT CHOOSER
(function() {

  'use strict';

  $('.input-file').each(function() {
    let $input = $(this),
      $label = $input.next('.js-labelFile'),
      labelVal = $label.html();

    $input.on('change', function(element) {
      let fileName = '';
      if (element.target.value) fileName = element.target.value.split('\\').pop();
      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
    });
  });

})();
