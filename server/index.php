<?php

require_once 'AppController.php';

$app = new AppController($_SERVER);
$response = $app->handle();

echo json_encode($response);