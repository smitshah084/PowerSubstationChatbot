<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
use HuggingFace\Transformers\Tokenizer;
use HuggingFace\Transformers\Auto\AutoModelForCausalLM;

// Initialize $client as a global variable
$client = new Client([
    'base_uri' => 'https://api.openai.com/v1/',
    'headers' => [
        'Authorization' => 'Bearer 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',
    ],
]);

function chatbotResponse($userInput, $client) {
    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $userInput],
        ],
        'max_tokens' => 1024,
        'temperature' => 0.7,
    ];

    $response = $client->post('chat/completions', ['json' => $data]);
    $responseData = json_decode($response->getBody()->getContents(), true);

    $botResponse = $responseData['choices'][0]['message']['content'];
    return $botResponse;
}

function huggingFaceChatbotResponse($userInput) {
    // Load the pre-trained model and tokenizer
    $model = AutoModelForCausalLM::fromPretrained('openai/gpt-3.5-turbo');
    $tokenizer = Tokenizer::fromPretrained('openai/gpt-3.5-turbo');

    // Tokenize the user input
    $inputIds = $tokenizer->encode($userInput, true, true)['input_ids'];

    // Generate a response
    $output = $model->generate($inputIds, [
        'max_length' => 1024,
        'temperature' => 0.7,
    ]);

    // Decode the generated response
    $botResponse = $tokenizer->decode($output[0], true);
    return $botResponse;
}

// Example usage with OpenAI API
echo chatbotResponse("what is currency of japan?", $client);

// Example usage with Hugging Face model
// echo huggingFaceChatbotResponse("Hello");
?>
