<?php

include_once 'vendor/autoload.php';

$log = new \Monolog\Logger('myLogger');
$log->err('error here');