<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_encode([
    "first_name" => $_POST["first_name"],
    "last_name"  => $_POST["last_name"],
    "email"      => $_POST["email"],
    "subject"    => $_POST["subject"],
    "message"    => $_POST["message"]
  ]);

  $url = "https://docs.google.com/spreadsheets/d/1PgN5fT172hu5wN34tamp4AqyX8gh5X4mezE3CxCcVY0/edit?gid=657631832#gid=657631832";

  $options = [
    "http" => [
      "header"  => "Content-type: application/json",
      "method"  => "POST",
      "content" => $data
    ]
  ];

  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  echo $result === FALSE ? "Error sending data." : "Thank you! Your message was sent.";
}
?>