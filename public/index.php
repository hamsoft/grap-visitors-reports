<?php

/** @var \Framework\App $app */
$app = require '../Framework/boot_app.php';

$app->handleRequest()->send();
