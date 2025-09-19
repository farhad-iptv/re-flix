<?php
// api/proxy.php

// Your target stream URL
$targetUrl = "http://xott.live:8080/live/Fahad/1234/380932.m3u8";

// Optional headers (add referer, user-agent if needed)
$headers = [
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
    "Referer: http://xott.live/"
];

// Initialize cURL
$ch = curl_init($targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Fetch content
$response = curl_exec($ch);

// Handle errors
if ($response === false) {
    http_response_code(500);
    echo "Error fetching stream.";
    exit;
}

$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

// Forward content type
if ($contentType) {
    header("Content-Type: $contentType");
} else {
 
}

// Output the m3u8 content
echo $response;
