<?php
require_once __DIR__ . '/../includes/functions.php';

header('Content-Type: application/json');

// Input
$message = isset($_POST['message']) ? trim((string)$_POST['message']) : '';
if ($message === '') {
    echo json_encode(['message' => 'Please type a message to begin.']);
    exit;
}
// Soft limit to avoid abuse
if (strlen($message) > 2000) {
    $message = substr($message, 0, 2000);
}

// OpenRouter config
$apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
$apiKey = getenv('OPENROUTER_API_KEY');
if (!$apiKey || trim($apiKey) === '') {
    // Fallback to DB settings if available
    $apiKey = getSetting('OPENROUTER_API_KEY') ?: getSetting('openrouter_api_key');
}
if (!$apiKey || trim($apiKey) === '') {
    echo json_encode(['message' => 'Chat service is not configured yet. Please try again later.']);
    exit;
}

// System prompt and model
$systemPrompt = "You are the helpful, friendly assistant for Living 360 Interiors.\n- Understand user needs (services, budget, timelines).\n- Provide clear answers without fabricating company-specific details you don't know.\n- When user shows interest in quotes, budgets, consultations, or contacting, suggest filling a short enquiry form (name, email, phone, project type, brief message).\n- Be concise and professional.";
$model = 'deepseek/deepseek-chat';

// Compose request
$requestData = [
    'model' => $model,
    'messages' => [
        ['role' => 'system', 'content' => $systemPrompt],
        ['role' => 'user', 'content' => $message],
    ],
    'max_tokens' => 500,
    'temperature' => 0.7,
];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey,
    'HTTP-Referer: https://living360.in',
    'X-Title: Living 360 Interiors',
]);

$response = curl_exec($ch);
if ($response === false) {
    curl_close($ch);
    echo json_encode(['message' => 'Sorry, I could not reach the chat service. Please try again.']);
    exit;
}
curl_close($ch);

$responseData = json_decode($response, true);
$botMessage = $responseData['choices'][0]['message']['content'] ?? null;
if (!$botMessage) {
    echo json_encode(['message' => 'Sorry, I encountered an error while processing your request. Please try again later.']);
    exit;
}

// Lightweight intent detection to suggest an enquiry inline form on the frontend
$q = strtolower($message);
$options = [];
$suggestEnquiry = false;
if (strpos($q, 'service') !== false || strpos($q, 'what do you offer') !== false) {
    $options = [
        ['label' => 'Residential Design', 'value' => 'Tell me about residential design services'],
        ['label' => 'Commercial Design', 'value' => 'Tell me about commercial design services'],
        ['label' => 'Hospitality Design', 'value' => 'Tell me about hospitality design services'],
        ['label' => 'All Services', 'value' => 'Tell me about all your services'],
    ];
}
if (strpos($q, 'budget') !== false || strpos($q, 'quote') !== false || strpos($q, 'cost') !== false || strpos($q, 'price') !== false) {
    $suggestEnquiry = true;
}
if (strpos($q, 'consult') !== false || strpos($q, 'appointment') !== false || strpos($q, 'meet') !== false || strpos($q, 'contact') !== false) {
    $suggestEnquiry = true;
}

echo json_encode([
    'message' => $botMessage,
    'options' => $options,
    'suggest_enquiry' => $suggestEnquiry,
]);
?>