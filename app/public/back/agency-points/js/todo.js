jQuery(document).ready(function() {
// Update Peach Requests Functionality
$('#transfer-peaches-btn').click(function(e) {
  e.preventDefault();
  var action = 'update';
  var username = jQuery('#username');
  var peach = jQuery('#peaches');
  console.log(username.val(), peach.val());
  var status = 1;
  jQuery.ajax({
    type: 'POST',
    url: 'assets/agency-points/action.php',
    data: {
      action: action,
      username: username.val(),
      peach: peach.val()
    },
    dataType: 'json',
    success: function(json) {
      if(json.msg == "failed") {
        alert("There is some error in your entered values. Kindly check those values.");
      } else if(json.msg == "success") {
        location.reload();
      }
      console.log(json);
      return true;
    },
    error: function(xhr, ajaxOptions, thrownError) {
      alert("There is some error in your entered values. Kindly check those values.");
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// Approve Peach Requests Functionality
$('.approve-btn').click(function() {
  console.log("Clicked Approve Button");
  event.stopPropagation();
  event.stopImmediatePropagation();

  let action = 'approve-peach-request';
  let username = jQuery(this).data('user-name');
  let request_id = jQuery(this).data('request-id');
  let peach_amount = jQuery(this).data('peach-amount');
  console.log(username, request_id);

  if (confirm("Are you sure you want to approve " + username + "'s Modaks Request.")) {
    jQuery.ajax({
      type: 'POST',
      url: 'assets/agency-points/action.php',
      data: {
        action: action,
        username: username,
        request_id: request_id,
        peach_amount: peach_amount
      },
      dataType: 'json',
      success: function(json) {
        console.log(json);
        location.reload();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  } else {}
});

// Reject Peach Requests Functionality
$('.reject-btn').click(function() {
  console.log("Clicked Reject Button");
  event.stopPropagation();
  event.stopImmediatePropagation();

  let action = 'reject-peach-request';
  let username = jQuery(this).data('user-name');
  let request_id = jQuery(this).data('request-id');
  let peach_amount = jQuery(this).data('peach-amount');

  console.log(username, request_id);

  if (confirm("Are you sure you want to reject " + username + "'s Modak Request.")) {
    jQuery.ajax({
      type: 'POST',
      url: 'assets/agency-points/action.php',
      data: {
        action: action,
        username: username,
        request_id: request_id,
        peach_amount: peach_amount
      },
      dataType: 'json',
      success: function(json) {
        console.log(json);
        location.reload();
      },
      error: function(xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  } else {}
});

});
