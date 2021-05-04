<?php
include_once 'class/Task.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/components/lang_code.php';
$post = $_POST;
$json = array();

$hostName = $_SERVER['HTTP_HOST'];

$url = "https://" . $hostName . "/profile/test.php";

// Update Peach Requests Functionality
if(!empty($post['action']) && $post['action']=="update") {
	$task = new Task();
	$already_present_peaches = $task->getPeachData($post['username']);
	$final_peach_amount = (int)$already_present_peaches + (int)$post['peach'];
	$status = $task->updatePeaches($post['username'], $final_peach_amount);
	if(!empty($status)){
		$json['msg'] = "success";
	} else {
		$json['msg'] = 'failed';
	}
	header('Content-Type: application/json');
	echo json_encode($json);
}

// Approve Peach Requests Functionality
if(!empty($post['action']) && $post['action']=="approve-peach-request") {
	$username = $post['username'];
	$request_id = $post['request_id'];
	$peach_amount = $post['peach_amount'];

	require '../../auth/config.php';

	$sql = "UPDATE peach_requests SET status = 'approved' WHERE username = '$username' AND id = '$request_id'";
	if ($stmt = mysqli_prepare($link, $sql)) {
			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				$json['msg'] = "updated";
				$task = new Task();

				$already_present_peaches = $task->getPeachData($username);
				$final_peach_amount = (int)$already_present_peaches + (int)$peach_amount;
				$status = $task->updatePeaches($username, $final_peach_amount);
				if(!empty($status)){
					$json['msg'] = "success";

					$sendMessage = explode('xx', $lang_tool[$language][383]);
					$sendMessage = $sendMessage[0] . (int)$peach_amount .  $sendMessage[1] . $final_peach_amount . $sendMessage[2];

					$postdata = http_build_query(
							array(
									'message' => $sendMessage,
									'username' => $username
							)
					);

					$opts = array('http' =>
							array(
									'method'  => 'POST',
									'header'  => 'Content-Type: application/x-www-form-urlencoded',
									'content' => $postdata
							)
					);

					$context  = stream_context_create($opts);

					$result = file_get_contents($url, false, $context);

					$json['result'] = $result;
					$json['url'] = $url;
					$json['opts'] = $opts;

				} else {
					$json['msg'] = 'failed';
				}


			} else {
					echo "Something went wrong. Please try again later.";
			}
			// Close statement
			mysqli_stmt_close($stmt);
	}
	mysqli_close($link);

	header('Content-Type: application/json');
	echo json_encode($json);
}

// Reject Peach Requests Functionality
if(!empty($post['action']) && $post['action']=="reject-peach-request") {
	$username = $post['username'];
	$request_id = $post['request_id'];
	$peach_amount = $post['peach_amount'];

	require '../../auth/config.php';

	$sql = "UPDATE peach_requests SET status = 'rejected' WHERE username = '$username' AND id = '$request_id'";
	if ($stmt = mysqli_prepare($link, $sql)) {
			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				$json['msg'] = "rejected";

				$sendMessage = $lang_tool[$language][384];

				$postdata = http_build_query(
						array(
								'message' => $sendMessage,
								'username' => $username
						)
				);

				$opts = array('http' =>
						array(
								'method'  => 'POST',
								'header'  => 'Content-Type: application/x-www-form-urlencoded',
								'content' => $postdata
						)
				);

				$context  = stream_context_create($opts);

				$result = file_get_contents($url, false, $context);

				$json['result'] = $result;
				$json['url'] = $url;
				$json['opts'] = $opts;

			} else {
					echo "Something went wrong. Please try again later.";
			}
			// Close statement
			mysqli_stmt_close($stmt);
	}
	mysqli_close($link);

	header('Content-Type: application/json');
	echo json_encode($json);
}
?>
