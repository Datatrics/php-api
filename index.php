<?php
require_once("Modules/Base.php");
require_once("Modules/Profile.php");
require_once("Modules/Apikey.php");
require_once("Api.php");

echo "<pre>";

$api = new Datatrics\API\Client("6105a95b2908e14c6a0a0627ec0db235", "255062");

var_dump( $api->Apikey->Get(array("limit" => 10)));
echo "</pre>";