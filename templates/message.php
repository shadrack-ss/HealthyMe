<?php
// API credentials
$apiKey = "4742ae36275e0457ece457b824b52933-f79941c7-e714-4162-a40e-2b847c8e9143"; // your Infobip API Key
$baseUrl = "https://8kz999.api.infobip.com"; //your Infobip API base URL

// Message details
$sender = "447491163443"; //  your sender ID
$recipient = "+256709382921"; //  recipient's phone number 
$messageText = "Hello, this is a test message from Infobip!";

// API endpoint
$url = $baseUrl . "/sms/2/text/advanced";

// Message payload
$data = [
    "messages" => [
        [
            "from" => $sender,
            "destinations" => [
                ["to" => $recipient]
            ],
            "text" => $messageText
        ]
    ]
];

// Initialize cURL session
$ch = curl_init();

// Configure cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: App $apiKey",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute request and fetch response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    $decodedResponse = json_decode($response, true);
    echo "<pre>";
    print_r($decodedResponse); // Output full response
    echo "</pre>";
}

// Close cURL session
curl_close($ch);
?>
