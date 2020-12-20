<?php

require_once __DIR__ . '/vendor/autoload.php';

use OzonParser\OzonParser;

$ozon = new OzonParser();
echo($ozon->run());