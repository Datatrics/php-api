<?php

require_once(__DIR__."/../vendor/autoload.php");

$apiKey = 'cda6147aecdd40a7ba413db94fbf2742';
$projectId = '255418';

$api = new Datatrics\API\Client($apiKey, $projectId);
$project = $api->Project->Get('255418');
#foreach($projects['items'] as $project) {
    echo "<pre>";
    print_r($project);
    echo "</pre>";
    if ($project['projectid']) {
        #$api->SetProjectId($project['projectid']);
        $items = $api->Content->Get();
        foreach ($items['items'] as $item) {
            echo "<pre>";
            print_r($item);
            echo "</pre>";
        }
    }
    exit;
#}
