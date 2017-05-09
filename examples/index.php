<?php

require_once(__DIR__."/../vendor/autoload.php");

$apiKey = '';
$projectId = '';

$api = new Datatrics\API\Client($apiKey, $projectId);
$profileCreate = array(
    "projectid" => $projectId,
    "profileid" => "1",
    "source" => "Datatrics",
    "profile" => [
        "firstname" => "N",
        "lastname" => "B",
        "zip" => "1234AB",
        "city" => "Plaats"
    ]
);
$profileCreate = $api->Profile->Create($profileCreate);
echo "<pre>";
print_r($profileCreate);
echo "</pre>";
$contentCreate = array(
    "projectid" => $projectId,
    "itemid" => "1",
    "source" => "Datatrics",
    "type" => 'item',
    'itemtype' => 'custom',
    "item" => [
        "name" => "N",
        "description" => "B",
        "url" => "https://www.datatrics.com",
        "image" => "https://www.datatrics.com/image.png"
    ]
);
$contentCreate = $api->Content->Create($contentCreate);
echo "<pre>";
print_r($contentCreate);
echo "</pre>";
exit;
