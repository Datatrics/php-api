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

class ModuleApikeyTest extends \PHPUnit\Framework\TestCase
{
    public function testGetExceptionMessage()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionMessage('An authentication exception occurred.');
        var_dump($Client->Apikey->Get());
    }

    public function testGetExceptioncode()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(403);
        var_dump($Client->Apikey->Get());
    }

    public function testCreateExceptionMessage()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionMessage('An authentication exception occurred.');
        $ApiKey = [];
        var_dump($Client->Apikey->Create($ApiKey));
    }

    public function testCreateExceptioncode()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(403);
        $ApiKey = [];
        var_dump($Client->Apikey->Create($ApiKey));
    }
}
