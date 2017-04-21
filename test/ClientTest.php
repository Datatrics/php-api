<?php

use Datatrics\API\Client;
use Datatrics\API\Modules\Apikey;
use Datatrics\API\Modules\Behavior;
use Datatrics\API\Modules\Box;
use Datatrics\API\Modules\Bucket;
use Datatrics\API\Modules\Campaign;
use Datatrics\API\Modules\Card;
use Datatrics\API\Modules\Channel;
use Datatrics\API\Modules\Content;
use Datatrics\API\Modules\Geo;
use Datatrics\API\Modules\Goal;
use Datatrics\API\Modules\Interaction;
use Datatrics\API\Modules\Journey;
use Datatrics\API\Modules\Link;
use Datatrics\API\Modules\NextBestAction;
use Datatrics\API\Modules\Profile;
use Datatrics\API\Modules\Project;
use Datatrics\API\Modules\Sale;
use Datatrics\API\Modules\Scorecard;
use Datatrics\API\Modules\Segment;
use Datatrics\API\Modules\Template;
use Datatrics\API\Modules\Theme;
use Datatrics\API\Modules\Touchpoint;
use Datatrics\API\Modules\Tracker;
use Datatrics\API\Modules\Tric;
use Datatrics\API\Modules\Trigger;
use Datatrics\API\Modules\User;
use Datatrics\API\Modules\Webhook;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testGetApiKey()
    {
        $client = new Client(1, 2);
        $this->assertEquals(
            '1',
            $client->GetApiKey()
        );
    }

    public function testGetProjectId()
    {
        $client = new Client(1, 2);
        $this->assertEquals(
            '2',
            $client->GetProjectId()
        );
    }

    public function testSetApiKey()
    {
        $client = new Client(1, 2);
        $client->SetApiKey(3);
        $this->assertEquals(
            '3',
            $client->getApiKey()
        );
    }

    public function testSetProjectId()
    {
        $client = new Client(1, 2);
        $client->SetProjectId(4);
        $this->assertEquals(
            '4',
            $client->GetProjectId()
        );
    }
}
