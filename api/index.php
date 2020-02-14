<?php
require_once 'bootstrap.php';

$urls = ['http://theverge.com'];

header('Content-type:application/json');
echo json_encode(getAPI($urls));