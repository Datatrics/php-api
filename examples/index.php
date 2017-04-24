<?php

require_once(__DIR__."/../vendor/autoload.php");

$apiKey = '';
$projectId = '';

$api = new Datatrics\API\Client($apiKey, $projectId);
$projects = $api->Project->Get();
foreach ($projects as $project) {
    echo "<pre>";
    print_r($project);
    echo "</pre>";
    $api->SetProjectId($project->projectid);
    $channels = $api->Channel->Get();
    foreach ($channels as $channel) {
        echo "<pre>";
        print_r($channel);
        echo "</pre>";
    }
    $trics = $api->Tric->Get();
    foreach ($trics as $tric) {
        echo "<pre>";
        print_r($tric);
        echo "</pre>";
    }
}
