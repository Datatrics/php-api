<?php

require_once(__DIR__."/../vendor/autoload.php");

$apiKey = 'cda6147aecdd40a7ba413db94fbf2742';
$projectId = '255522';

$api = new Datatrics\API\Client($apiKey, $projectId);
$project = $api->Project->Get('255522');
#foreach($projects['items'] as $project) {
    echo "<pre>";
    print_r($project);
    echo "</pre>";
    if ($project['projectid']) {
        #$api->SetProjectId($project['projectid']);
        $profile = array(

        );
        $profileCreate = array(
            "projectid" => $projectId,
            "profileid" => "995",
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
    }
    exit;
#}
