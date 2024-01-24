<?php

// Get the user input from the POST request
$userInput = $_POST['userInput'];

// Call a function to interact with ChatGPT and get the response
$chatbotResponse = interactWithChatGPT($userInput);

// Return the response to the JavaScript code
echo $chatbotResponse;

// Function to interact with ChatGPT
function interactWithChatGPT($userInput) {
    // Replace 'YOUR_API_KEY' with your actual OpenAI GPT-3 API key
    $apiKey = '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';

    // Set the API endpoint
    $endpoint = 'https://api.openai.com/v1/engines/davinci-codex/completions';

    // Prepare the data for the API request
    $data = [
        'prompt' => $userInput,
        'max_tokens' => 50, // Adjust max_tokens as needed
    ];

    // Make the API request
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Extract the generated text from the response
    $generatedText = $responseData['choices'][0]['text'];

    return $generatedText;
}
?>
