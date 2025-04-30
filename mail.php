<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {	

	// Collecting data from POST request
	$full_name = $_POST['full_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$course = $_POST['course'];
	$state = $_POST['state'];
	$source = $_POST['source'];
	$sub_source = $_POST['sub_source'];
	$utm_source = $_POST['utm_source'];
	$utm_campaign = $_POST['utm_campaign'];
	$utm_medium = $_POST['utm_medium'];
	$utm_term = $_POST['utm_term'];
	$page_url = $_POST['page_url'];

	// ---------------------------------------------------------
	// First API Integration - CRM API
	// ---------------------------------------------------------
	$url = 'https://api.crm.mysode.com/api/lead/apicreated';
	$data = array(
		'name' => $full_name,
		'email' => $email,
		'phone' => $phone,
		'course' => $course,
		'state' => $state,
		'dob' => $dob, // Make sure this variable is defined if needed
		'source' => $source,
		'sub_source' => $sub_source,
		'utm_source' => $utm_source,
		'utm_campaign' => $utm_campaign,
		'utm_medium' => $utm_medium,
		'utm_term' => $utm_term,
	);

	// API Auth Tokens
	$token = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';
	$api_key = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';

	// Initialize cURL for CRM API
	$postvars = http_build_query($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		"Authorization: Bearer $token",
		"x-api-key: $api_key",
		'Content-Type: application/x-www-form-urlencoded'
	));

	$response = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);

	// ---------------------------------------------------------
	// Second API Integration - Google Sheets via Apps Script
	// ---------------------------------------------------------
	$url = 'https://script.google.com/macros/s/AKfycbx_P7CmSro0OmDNuIVwcGzUbCU_QG-zzL-6Lv60HkbOuGXFG6uH4gx2-Z7-nqcS5vvIHQ/exec';
	$data = array(
		'full_name' => $full_name,
		'email' => $email,
		'phone' => $phone,
		'course' => $course,
		'state' => $state,
		'source' => $source,
		'sub_source' => $sub_source,
		'utm_source' => $utm_source,
		'utm_campaign' => $utm_campaign,
		'utm_medium' => $utm_medium,
		'utm_term' => $utm_term,
		'page_url' => $page_url,
		'website' => 'OPJINDAL DES' // Identifier to differentiate sources
	);

	$postvars = http_build_query($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	$response = curl_exec($ch);

	// ---------------------------------------------------------
	// Third API Integration - Pabbly (for Brevo/Gallabox)
	// ---------------------------------------------------------
	$url = 'https://connect.pabbly.com/workflow/sendwebhookdata/IjU3NjUwNTZhMDYzNDA0MzI1MjY4NTUzMzUxMzAi_pc';
	$data = array(
		'full_name' => $full_name,
		'email' => $email,
		'phone' => $phone,
		'course' => $course,
		'state' => $state,
		'source' => $source,
		'sub_source' => $sub_source,
		'utm_source' => $utm_source,
		'utm_campaign' => $utm_campaign,
		'utm_medium' => $utm_medium,
		'utm_term' => $utm_term
	);

	$postvars = http_build_query($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	$response = curl_exec($ch);

	// ---------------------------------------------------------
	// Email Section - Commented Out (can be enabled later)
	// ---------------------------------------------------------
	/*
	if(isset($response) && $response) {
		$to = "seema@edgetechnosoft.com, prince@edgetechnosoft.com, tushar@edgetechnosoft.com";
		$subject = "Enquiry From OPJINDAL";
		$message = 
			"Name: ".$full_name."\n".
			"Phone: ".$phone."\n".
			"Email: ".$email."\n".
			"Course: ".$course."\n".
			"State: ".$state."\n".
			"source: ".$source."\n".
			"sub_source: ".$sub_source."\n".
			"utm_source: ".$utm_source."\n".
			"utm_campaign: ".$utm_campaign."\n".
			"utm_medium: ".$utm_medium."\n".
			"utm_term: ".$utm_term."\n".
			"page_url: ".$page_url;
		$headers = "From: support@onlinedegreecourses.co.in";

		if(mail($to, $subject, $message, $headers)) {
			header('Location:thank-you.php');
			exit();
		} else {
			echo "Email sending failed";
			exit();
		}
	} else {
		echo "Response failed";
		exit();
	}
	*/

	// Redirect to thank you page directly since mail is disabled
	header('Location:thank-you.php');
	exit();

} else {
	// If request is not POST, return error in JSON
	$response = array(
		'response' => 'error',
		'message' => 'POST is required to use this function'
	);
	echo json_encode($response);
	exit();
}
?>
