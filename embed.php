<?php
$sentence = "I love cats";
$data = json_encode($sentence); // just raw string, not ["inputs" => ...]

$token = "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";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-inference.huggingface.co/models/sentence-transformers/all-MiniLM-L6-v2");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $token",
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
$err = curl_error($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $http_code\n";
if ($err) {
    echo "Curl Error: $err\n";
} else {
    echo "Response:\n$response\n";
}
?>
