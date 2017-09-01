<?php
namespace Datatrics\API;

use GuzzleHttp\Client as HttpClient;
use Datatrics\API\Modules\Apikey;
use Datatrics\API\Modules\Behavior;
use Datatrics\API\Modules\Billing;
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
use Datatrics\API\Modules\Subscription;
use Datatrics\API\Modules\Template;
use Datatrics\API\Modules\Theme;
use Datatrics\API\Modules\Touchpoint;
use Datatrics\API\Modules\Tracker;
use Datatrics\API\Modules\Tric;
use Datatrics\API\Modules\Trigger;
use Datatrics\API\Modules\User;
use Datatrics\API\Modules\Webhook;
use GuzzleHttp\Psr7\Request;

class Client
{
    /**
     * @const Version of our client.
     */
    const CLIENT_VERSION = '2.0';

    /**
     * @const HTTP Method GET
     */
    const HTTP_GET = 'GET';

    /**
     * @const HTTP Method POST
     */
    const HTTP_POST = 'POST';

    /**
     * @const HTTP Method PUT
     */
    const HTTP_PUT = 'PUT';

    /**
     * @const HTTP Method DELETE
     */
    const HTTP_DELETE = 'DELETE';

    /**
     * Version of the remote API.
     *
     * @var string
     */
    private $_api_version = '2.0';

    /**
     * @var string
     */
    private $_api_endpoint = 'https://api.datatrics.com';

    /**
     * @var string
     */
    private $_api_key;

    /**
     * @var HttpClient
     */
    private $_http_client;

    /**
     * @var string
     */
    private $_projectId;

    /**
     * @var Apikey
     */
    public $Apikey;

    /**
     * @var Behavior
     */
    public $Behavior;

    /**
     * @var Billing
     */
    public $Billing;

    /**
     * @var Box
     */
    public $Box;

    /**
     * @var Bucket
     */
    public $Bucket;

    /**
     * @var Campaign
     */
    public $Campaign;

    /**
     * @var Card
     */
    public $Card;

    /**
     * @var Channel
     */
    public $Channel;

    /**
     * @var Content
     */
    public $Content;

    /**
     * @var Geo
     */
    public $Geo;

    /**
     * @var Goal
     */
    public $Goal;

    /**
     * @var Interaction
     */
    public $Interaction;

    /**
     * @var Journey
     */
    public $Journey;

    /**
     * @var Link
     */
    public $Link;

    /**
     * @var NextBestAction
     */
    public $NextBestAction;

    /**
     * @var Profile
     */
    public $Profile;

    /**
     * @var Project
     */
    public $Project;

    /**
     * @var Sale
     */
    public $Sale;

    /**
     * @var Scorecard
     */
    public $Scorecard;

    /**
     * @var Segment
     */
    public $Segment;

    /**
     * @var Segment
     */
    public $Subscription;

    /**
     * @var Template
     */
    public $Template;

    /**
     * @var Theme
     */
    public $Theme;

    /**
     * @var Touchpoint
     */
    public $Touchpoint;

    /**
     * @var Tracker
     */
    public $Tracker;

    /**
     * @var Tric
     */
    public $Tric;

    /**
     * @var Trigger
     */
    public $Trigger;

    /**
     * @var User
     */
    public $User;

    /**
     * @var Webhook
     */
    public $Webhook;

    /**
     * Create a new API instance
     *
     * @param string $apiKey    The API key
     * @param string $projectId The Project id
     */
    public function __construct($apiKey, $projectId = null)
    {
        $this->SetApiKey($apiKey);
        $this->SetProjectId($projectId);
        $this->SetHttpClient();
        $this->_RegisterModules();
    }

    /**
     * Get the current API version
     *
     * @return string $api_version
     */
    public function GetApiVersion()
    {
        return $this->_api_version;
    }

    /**
     * Get the API endpoint
     *
     * @return string
     */
    public function GetApiEndpoint()
    {
        return $this->_api_endpoint;
    }

    /**
     * Set the API endpoint
     *
     * @param string $api_endpoint
     * @return  Client
     */
    public function SetApiEndpoint($api_endpoint)
    {
        $this->_api_endpoint = $api_endpoint;
        $this->SetHttpClient();
        $this->_RegisterModules();
        return $this;
    }

    /**
     * Get the API key
     *
     * @return string $api_key
     */
    public function GetApiKey()
    {
        return $this->_api_key;
    }

    /**
     * Get the API key
     *
     * @param string $api_key
     * @return Client
     */
    public function SetApiKey($api_key)
    {
        $this->_api_key = $api_key;
        $this->SetHttpClient();
        $this->_RegisterModules();
        return $this;
    }

    /**
     * Get the API project id
     *
     * @return string $projectId
     */
    public function GetProjectId()
    {
        return $this->_projectId;
    }

    /**
     * Set the API project id
     *
     * @param string $projectId
     * @return Client
     */
    public function SetProjectId($projectId)
    {
        $this->_projectId = $projectId;
        $this->SetHttpClient();
        $this->_RegisterModules();
        return $this;
    }

    /**
     * Register Modules
     *
     * @return void
     */
    private function _RegisterModules()
    {
        $this->Apikey = new Apikey($this);
        $this->Behavior = new Behavior($this);
        $this->Billing = new Billing($this);
        $this->Box = new Box($this);
        $this->Bucket = new Bucket($this);
        $this->Campaign = new Campaign($this);
        $this->Card = new Card($this);
        $this->Channel = new Channel($this);
        $this->Content = new Content($this);
        $this->Geo = new Geo($this);
        $this->Goal = new Goal($this);
        $this->Interaction = new Interaction($this);
        $this->Journey = new Journey($this);
        $this->Link = new Link($this);
        $this->NextBestAction = new NextBestAction($this);
        $this->Profile = new Profile($this);
        $this->Project = new Project($this);
        $this->Sale = new Sale($this);
        $this->Scorecard = new Scorecard($this);
        $this->Segment = new Segment($this);
        $this->Subscription = new Subscription($this);
        $this->Template = new Template($this);
        $this->Theme = new Theme($this);
        $this->Touchpoint = new Touchpoint($this);
        $this->Tracker = new Tracker($this);
        $this->Tric = new Tric($this);
        $this->Trigger = new Trigger($this);
        $this->User = new User($this);
        $this->Webhook = new Webhook($this);
    }

    /**
     * Setup the HTTP Client
     *
     * @return Client
     */
    private function SetHttpClient()
    {
        $config = [
            'base-uri' => $this->GetApiEndpoint(),
            'headers' => $this->_GetHttpClientHeaders()
        ];
        $this->_http_client = new HttpClient($config);
        return $this;
    }

    /**
     * @return HttpClient
     */
    private function GetHttpClient()
    {
        return $this->_http_client;
    }

    /**
     * Define the HTTP headers
     *
     * @return array
     */
    private function _GetHttpClientHeaders()
    {
        $user_agent = 'Datatrics/API '.self::CLIENT_VERSION;
        return [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'user-agent' => $user_agent,
            'x-apikey' => $this->GetApiKey(),
            'x-client-name' => $user_agent,
            'x-datatrics-client-info' => php_uname()
        ];
    }

    /**
     * @throws \Exception
     * @return boolean
     */
    public function CheckApiKey()
    {
        if (empty($this->GetApiKey())) {
            throw new \Exception('You have not set an api key. Please use setApiKey() to set the API key.');
        }
        return true;
    }

    /**
     * @param $url
     * @param null|array $payload
     * @return string
     */
    public function GetUrl($url, $payload = [])
    {
        $url = $this->GetApiEndpoint()."/".$this->GetApiVersion().$url;
        if (count($payload)) {
            $url .= "?".http_build_query($payload);
        }
        return $url;
    }

    /**
     * @param string $method    HTTP Method
     * @param string $url       The url
     * @param array $payload    The Payload
     * @return Request
     */
    public function BuildRequest($method, $url, $payload = [])
    {
        $body = null;
        if ($method == self::HTTP_GET) {
            $url = $this->GetUrl($url, $payload);
        } elseif ($method == self::HTTP_DELETE) {
            $url = $this->GetUrl($url, $payload);
        } else {
            $url = $this->GetUrl($url);
            if (count($payload)) {
                $body = json_encode($payload);
            }
        }
        return new Request($method, $url, $this->_GetHttpClientHeaders(), $body);
    }

    /**
     * @param string $method    HTTP Method
     * @param string $url       The url
     * @param array $payload    The Payload
     * @return mixed
     * @throws \Exception
     */
    public function SendRequest($method, $url, $payload = [])
    {
        $this->CheckApiKey();
        $request = $this->BuildRequest($method, $url, $payload);
        try {
            $response = $this->GetHttpClient()->send($request);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                $body = json_decode($e->getResponse()->getBody(), true);
                if (isset($body['error']['message'])) {
                    throw new \Exception($body['error']['message'], $e->getResponse()->getStatusCode());
                }
                throw new \Exception($body['message'], $e->getResponse()->getStatusCode());
            }
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }
        $body = json_decode($response->getBody(), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(json_last_error_msg());
        }
        return $body;
    }

    /**
     * @param string $url
     * @param array $payload
     * @return mixed
     */
    public function Post($url, $payload = [])
    {
        return $this->SendRequest(self::HTTP_POST, $url, $payload);
    }

    /**
     * @param string $url
     * @param array $payload
     * @return mixed
     */
    public function Get($url, $payload = [])
    {
        return $this->SendRequest(self::HTTP_GET, $url, $payload);
    }

    /**
     * @param string $url
     * @param array $payload
     * @return mixed
     */
    public function Put($url, $payload = [])
    {
        return $this->SendRequest(self::HTTP_PUT, $url, $payload);
    }

    /**
     * @param string $url
     * @param array $payload
     * @return mixed
     */
    public function Delete($url, $payload = [])
    {
        return $this->SendRequest(self::HTTP_DELETE, $url, $payload);
    }
}
