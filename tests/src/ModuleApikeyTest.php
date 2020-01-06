<?php

declare(strict_types=1);

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
use PHPUnit\Framework\TestCase;

final class ModuleApikeyTest extends TestCase
{
    public function testGetExceptionCode()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(403);
        var_dump($Client->Apikey->Get());
    }

    public function testCreateExceptionCode()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(403);
        $ApiKey = ['test'=>1];
        var_dump($Client->Apikey->Create($ApiKey));
    }
}
