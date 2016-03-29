<?php
// Takes in the response containing json data and returns the parsed response.
function to_json($data) {
	// To debug the data of the request.
	// error_log($data, 4);
	$url_decoded = urldecode($data);
	$json_data = json_decode($url_decoded);

	return $json_data;
}

// Takes in a message and coverts it to a json error message.
function showjson_error($message) {
	header('Content-type: application/json');
	echo json_encode( array("error" => $message) );
	exit();
}
?>
