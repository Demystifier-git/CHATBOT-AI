<?php

require '../lib/utilities.php';

// Build prompt
$prompt = <<<END
INSTRUCTIONS:
- Return plain text
- Use <br> to separate content
- Use <ol> for lists
- use <a> for links put the link in href attribute use an arbitrary content for the inner HTML

PROMPT:
{$_POST['prompt']}
END;

// Prepare API request
$api_key = 'AIzaSyBLMdPro8hYwTFPMsBB77wpH-C6Du0uBzw';
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

$headers = [
	'Content-Type: application/json',
	"X-goog-api-key: $api_key"
];

$data = [
	"contents" => [
		"parts" => [
			["text" => $prompt]
		]
	]
];

// Make request
$response = fetch("POST", $url, $headers, json_encode($data));
$result = json_decode($response, true);

// Extract response
$generatedText = $result['candidates'][0]['content']['parts'][0]['text'] ?? "No response.";

// Log usage
$log_file = "../gemini_usage.log";
$ip = $_SERVER["HTTP_X_REAL_IP"] ?? $_SERVER["REMOTE_ADDR"];
$timestamp = date("Y-m-d H:i:s");
if (file_put_contents($log_file, "[$ip] Request at: $timestamp" . PHP_EOL, FILE_APPEND) === false) {
	die("Logging failed");
}

// Save chat 
require "../lib/connect_to_db.php";
$sql = "INSERT INTO chats (ip, prompt, response) VALUES (?, ?, ?)";
queryDB($mysqli, $sql, "sss", $ip, $_POST['prompt'], $generatedText);
$mysqli->close();

// Output response
echo $generatedText;
