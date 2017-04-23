<?php

require_once("vendor/autoload.php");

$api = new Datatrics\API\Client("1", "2");
echo "<pre>";
print_r($api->Project->Get(2));
echo "</pre>";
