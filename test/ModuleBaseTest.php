<?php

use Datatrics\API\Client;
use Datatrics\API\Modules\Base;
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

class ModuleBaseTest extends \PHPUnit_Framework_TestCase
{
    public function testApiKey()
    {
        $Base = new Base(1, "/base");
        $this->assertEquals(
            1,
            $Base->getApiKey()
        );
    }

    public function testSetApiKey()
    {
        $Base = new Base(1,"/base");
        $Base->setApiKey(2);
        $this->assertEquals(
            2,
            $Base->getApiKey()
        );
    }

    public function testGetApiKey()
    {
        $Base = new Base(1,"/base");
        $Base->setApiKey(3);
        $this->assertEquals(
            3,
            $Base->getApiKey()
        );
    }

    public function testApiEndpoint()
    {
        $Base = new Base(1,"/base");
        $this->assertEquals(
            'https://api.datatrics.com/2.0/base',
            $Base->getApiEndpoint()
        );
    }

    public function testSetApiEndpoint()
    {
        $Base = new Base(1,"/base");
        $Base->setApiEndpoint("https://api.datatrics.com/2.0/set");
        $this->assertEquals(
            'https://api.datatrics.com/2.0/set',
            $Base->getApiEndpoint()
        );
    }

    public function testGetApiEndpoint()
    {
        $Base = new Base(1,"/base");
        $Base->setApiEndpoint("https://api.datatrics.com/2.0/get");
        $this->assertEquals(
            'https://api.datatrics.com/2.0/get',
            $Base->getApiEndpoint()
        );
    }

    public function testRequest()
    {
        /*
        $Base = new Base(1,"/base");
        $this->assertEquals(
            'https://api.datatrics.com/2.0/get',
            $Base->request("GET","/get", [])
        );*/
    }
}
