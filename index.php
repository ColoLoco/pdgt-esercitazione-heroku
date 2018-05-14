<?php
$content = file_get_contents("php://input");

if (!$content)
  exit();

$update = json_decode($content, false);
$message = $update->message;

$message_id = $message->message_id;
$text = $message->text;

error_log("Message ID {$message_id}: {$text}\n");
