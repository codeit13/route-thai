jQuery(document).ready(function() {


  $('#datatables').DataTable();

  // Activate Functionality
  $('.activate-btn').click(function() {
    console.log("Clicked Activate BUTTON");
    event.stopPropagation();
    event.stopImmediatePropagation();

    let action = 'activate_profile';
    let username = jQuery(this).data('user-name');
    console.log(username);

    if (confirm("Are you sure you want to activate " + username + "'s Profile.")) {
      jQuery.ajax({
        type: 'POST',
        url: 'assets/activate_profile/actions/profile-actions.php',
        data: {
          action: action,
          username: username
        },
        dataType: 'json',
        success: function(json) {
          console.log(json);
          location.reload();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          location.reload();
        }
      });
    } else {}
  });

  // Activate Functionality
  $('.reject-btn').click(function() {
    console.log("Clicked Reject BUTTON");
    event.stopPropagation();
    event.stopImmediatePropagation();

    let action = 'reject_profile';
    let username = jQuery(this).data('user-name');
    console.log(username);

    if (confirm("Are you sure you want to reject " + username + "'s Profile activation request.")) {
      jQuery.ajax({
        type: 'POST',
        url: 'assets/activate_profile/actions/profile-actions.php',
        data: {
          action: action,
          username: username
        },
        dataType: 'json',
        success: function(json) {
          console.log(json);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    } else {}
  });

});
