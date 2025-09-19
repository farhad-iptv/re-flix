<?php
// api/proxy.php

// Your target stream URL
$targetUrl = "http://xott.live:8080/live/Fahad/1234/380932.m3u8";

// Headers if needed
$headers = [
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
    "Referer: http://xott.live/"
];

// Use cURL to fetch content
$ch = curl_init($targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);

if ($response === false) {
    http_response_code(500);
    echo "Error fetching stream.";
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

// Forward HTTP status code
http_response_code($httpCode);

// Ensure correct content type for .m3u8
if ($contentType) {
    header("Content-Type: $contentType");
} else {
    header("Content-Type: application/vnd.apple.mpegurl");
}

// Output the content
echo $response;
