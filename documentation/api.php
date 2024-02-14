<?php
require('../vendor/autoload.php');
$openapi = \OpenApi\scan('../class');
header('Content-Type: application/json');
echo $openapi->toJSON();