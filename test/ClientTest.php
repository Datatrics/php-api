<?php

namespace Datatrics\API;

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

class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function testGetApiKey()
    {
        $Client = new Client(1, 2);
        $this->assertEquals(
            '1',
            $Client->GetApiKey()
        );
    }

    public function testGetProjectId()
    {
        $Client = new Client(1, 2);
        $this->assertEquals(
            '2',
            $Client->GetProjectId()
        );
    }

    public function testSetApiKey()
    {
        $Client = new Client(1, 2);
        $Client->SetApiKey(3);
        $this->assertEquals(
            '3',
            $Client->getApiKey()
        );
    }

    public function testSetProjectId()
    {
        $Client = new Client(1, 2);
        $Client->SetProjectId(4);
        $this->assertEquals(
            '4',
            $Client->GetProjectId()
        );
    }

    public function testGetApiVersion()
    {
        $Client = new Client(1, 2);
        $this->assertEquals(
            '2.0',
            $Client->GetApiVersion()
        );
    }

    public function testSetApiEndpoint()
    {
        $Client = new Client(1, 2);
        $Client->SetApiEndpoint('http://api.datatrics.com');
        $this->assertEquals(
            'http://api.datatrics.com',
            $Client->GetApiEndpoint()
        );
    }

    public function testGetApiEndpoint()
    {
        $Client = new Client(1, 2);
        $this->assertEquals(
            'https://api.datatrics.com',
            $Client->GetApiEndpoint()
        );
    }

    public function testBuildRequest()
    {
        $Client = new Client(1, 2);
        $request = $Client->BuildRequest('GET', '/test', []);
        $this->assertEquals(
            'https://api.datatrics.com/2.0/test',
            $request[CURLOPT_URL]
        );
        $this->assertEquals(
            'GET',
            $request[CURLOPT_CUSTOMREQUEST]
        );
        $this->assertEquals(
            '1',
            $request[CURLOPT_HTTPHEADER]['x-apikey']
        );
    }

    public function testSendRequest()
    {
        $Client = new Client(1, 2);
        #$this->expectExceptionMessage('Not Found');
        $this->expectExceptionCode(404);
        $Client->SendRequest('GET', '/test', []);
    }

    public function testGetUrl()
    {
        $Client = new Client(1, 2);
        $this->assertEquals(
            'https://api.datatrics.com/2.0/test',
            $Client->GetUrl('/test')
        );
    }

    public function testPostException()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(404);
        $Client->Post("/base", ['test'=>1]);
    }

    public function testGetException()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(404);
        $Client->Get("/base", ['test'=>1]);
    }

    public function testPutException()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(404);
        $Client->Put("/base", ['test'=>1]);
    }

    public function testDeleteException()
    {
        $Client = new Client(1, 2);
        $this->expectExceptionCode(404);
        $Client->Delete("/base", []);
    }
}
