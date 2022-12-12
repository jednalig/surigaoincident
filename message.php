<?php
require_once 'vendor/autoload.php';
$MessageBird = new \MessageBird\Client('ZKBiElDAq19dwTrjDfZY3ry89');
  $Message = new \MessageBird\Objects\Message();
  $Message->originator ='+639207493641';
  $Message->recipients = ['+639108129351'];
  $Message->body = 'Get well soon mrs.queen';
  $response = $MessageBird->messages->create($Message);
  print_r(json_encode($response));
?>