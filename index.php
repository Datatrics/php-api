<?php

require_once("vendor/autoload.php");

$api = new Datatrics\API\Client("1", "2");
echo "<pre>";
print_r($api->Apikey->Get(array("limit" => 10)));
echo "</pre>";
