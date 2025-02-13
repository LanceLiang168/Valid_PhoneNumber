<?php

function isValidPhoneNumber($phone_number) {
    // Telesign API credentials
    $customer_id = 'your_customer_id'; // Replace with your actual Customer ID
    $api_key = 'your_api_key'; // Replace with your actual API Key

    // Telesign API endpoint
    $api_url = "https://rest-ww.telesign.com/v1/phoneid/{$phone_number}";

    // Generate the current date in RFC 7231 format
    $date = gmdate('D, d M Y H:i:s T');

    // Construct the string to sign
    $string_to_sign = "GET /v1/phoneid/{$phone_number}\n$date";

    // Compute the HMAC signature
    $signature = base64_encode(hash_hmac('sha256', $string_to_sign, base64_decode($api_key), true));

    // Construct the Authorization header
    $authorization = "TSA {$customer_id}:{$signature}";

    // Initialize cURL session
    $ch = curl_init($api_url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: {$authorization}",
        "Date: {$date}"
    ]);

    // Execute the API request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        curl_close($ch);
        return false;
    }

    // Close the cURL session
    curl_close($ch);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if 'phone_type' is present in the response
    if (!isset($data['phone_type']['description'])) {
        echo 'Error: phone_type description not found in the response.';
        return false;
    }

    // Extract the phone type description
    $phone_type = $data['phone_type']['description'];

    // Define valid phone types
    $valid_types = ['Fixed Line', 'Mobile'];

    // Return true if the phone type is valid, false otherwise
    return in_array($phone_type, $valid_types);
}

// Example usage
$phone_number = '15555551234'; // Replace with the phone number you want to check
if (isValidPhoneNumber($phone_number)) {
    echo 'The phone number is valid.';
} else {
    echo 'The phone number is not valid.';
}

?>
