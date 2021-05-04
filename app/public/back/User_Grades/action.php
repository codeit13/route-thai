<?php
include_once '../../../auth/config.php';
$post = $_POST;
$json = array();

// Add Level Functionality
if (!empty($post['action']) && $post['action']=="add_level") {
  $levelname = $post['level_name'];
  $leveldata = $post['level_data'];

  $sql = "INSERT into user_levels (level_name, level_data) VALUES ('$levelname', '$leveldata')";
  if ($stmt = mysqli_prepare($link, $sql)) {
    $json['prepare'] = 'prepared';
      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        $json['msg'] = 'success';
      } else {
          $json['msg'] = 'failed';
      }
      // Close statement
      mysqli_stmt_close($stmt);
  }

    header('Content-Type: application/json');
    echo json_encode($json);
}

// Delete Level Functionality
if (!empty($post['action']) && $post['action']=="remove_level") {
  $level_id = $post['level_id'];

  $sql = "DELETE FROM user_levels WHERE id = $level_id";
  mysqli_query($link, $sql);

    header('Content-Type: application/json');
    echo json_encode($json);
}


mysqli_close($link);
