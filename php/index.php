<?php
require_once 'vendor/autoload.php';

use Orhanerday\OpenAi\OpenAi;

session_start();
$open_ai_key = getenv('OPENAI_API_KEY');
$open_ai = new OpenAi($open_ai_key);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_message = $_POST['message'] ?? '';
    
    if (!empty($user_message)) {
        try {
            $response = $open_ai->chat([
                [
                    "role" => "user",
                    "content" => $user_message
                ]
            ]);
            
            $data = json_decode($response);
            $assistant_message = $data->choices[0]->message->content ?? 'Error getting response';
            
            $_SESSION['messages'][] = [
                'role' => 'user',
                'content' => $user_message
            ];
            $_SESSION['messages'][] = [
                'role' => 'assistant',
                'content' => $assistant_message
            ];
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}

$messages = $_SESSION['messages'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperChatGPT - PHP</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .chat-container { border: 1px solid #ddd; border-radius: 8px; padding: 20px; }
        .message { margin: 10px 0; padding: 10px; border-radius: 4px; }
        .user { background: #e3f2fd; text-align: right; }
        .assistant { background: #f5f5f5; }
        input[type="text"] { width: 80%; padding: 10px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>SuperChatGPT - PHP Version</h1>
        
        <?php if (isset($error)): ?>
            <div style="color: red;">Error: <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <div class="messages">
            <?php foreach ($messages as $msg): ?>
                <div class="message <?= $msg['role'] ?>">
                    <strong><?= ucfirst($msg['role']) ?>:</strong> <?= htmlspecialchars($msg['content']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <form method="POST" style="margin-top: 20px;">
            <input type="text" name="message" placeholder="Ask something..." required>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
