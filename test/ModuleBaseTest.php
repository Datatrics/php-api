<?php

namespace Datatrics\API;

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

class ModuleBaseTest extends \PHPUnit\Framework\TestCase
{
    public function testRequestExceptionCode()
    {
        $Base = new Base(1, "/base");
        $this->expectExceptionCode(404);
        $Base->request("GET", "/get", []);
    }

    public function testRequestExceptionMessage()
    {
        $Base = new Base(1, "/base");
        $this->expectExceptionMessage('Not Found');
        $Base->request("GET", "/get", []);
    }

    public function testRequestEmptyApiKey()
    {
        $Base = new Base("", "/base");
        $this->expectExceptionMessage('You have not set an api key. Please use setApiKey() to set the API key.');
        $Base->request("GET", "/get", []);
    }

    public function testCheckApiKeyEmpty()
    {
        $Base = new Base("", "/base");
        $this->expectExceptionMessage('You have not set an api key. Please use setApiKey() to set the API key.');
        $Base->checkApiKey();
    }

    public function testCheckApiKeyNotEmpty()
    {
        $Base = new Base("1", "/base");
        $this->assertNull($Base->checkApiKey());
    }
}
