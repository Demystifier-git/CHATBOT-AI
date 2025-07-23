<?php
require "utilities.php";

$apiKey = "AIzaSyBjiGQtv0LRzizs4tYAvHbmDJ3Nxwc2wUM"; // Replace with your Gemini API key
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

// Request data (JSON payload)
$data = [
	"contents" => [
		"parts" => [
			["text" => "Explain quantum computing in simple terms."]
		]
	]
];

$headers = [
	'Content-Type: application/json',
	"X-goog-api-key: $apiKey"
];

$response = fetch("POST", $url, $headers, json_encode($data));
$result = json_decode($response, true);
$generatedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? "No response.";

$log_file = "gemini_usage.log";
file_put_contents($log_file, "Request at: " . date("Y-m-d H:i:s") . PHP_EOL, FILE_APPEND);

echo $generatedText;
