<?php
$content = file_get_contents("php://input");

if (!$content)
  exit();

$update = json_decode($content, false);
$message = $update->message;

$message_id = $message->message_id;
$text = $message->text;

error_log("Message ID {$message_id}: {$text}\n");

$chat_id = $message->chat->id;
$token = getenv("BOTTOKEN");  // prendiamo il token del bot da "heroku tramite la funz. "getenv"

$url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text=" .
urlencode("Ciao, mi hai scritto: {$text}");

$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_POST, true);
$response = curl_exec($handle);

error_log("sendMessage: " . $response);
