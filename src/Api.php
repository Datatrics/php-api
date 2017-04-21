<?php
namespace Datatrics\API;

class Client
{
    /**
     * Version of our client.
     */
    const CLIENT_VERSION = '2.0.0';
    /**
     * Version of the remote API.
     */
    protected $api_version = '2.0';
    /**
     * @var string
     */
    protected $api_key;
    /**
     * @var string
     */
    private $projectId;


    const HTTP_GET = 'GET';
    const HTTP_POST = 'POST';
    const HTTP_PUT = 'PUT';
    const HTTP_DELETE = 'DELETE';

    /**
     * @var Modules\Apikey
     */
    public $Apikey;

    /**
     * @var Modules\Behavior
     */
    public $Behavior;

    /**
     * @var Modules\Box
     */
    public $Box;

    /**
     * @var Modules\Bucket
     */
    public $Bucket;

    /**
     * @var Modules\Campaign
     */
    public $Campaign;

    /**
     * @var Modules\Card
     */
    public $Card;

    /**
     * @var Modules\Channel
     */
    public $Channel;

    /**
     * @var Modules\Content
     */
    public $Content;

    /**
     * @var Modules\Geo
     */
    public $Geo;

    /**
     * @var Modules\Goal
     */
    public $Goal;

    /**
     * @var Modules\Interaction
     */
    public $Interaction;

    /**
     * @var Modules\Journey
     */
    public $Journey;

    /**
     * @var Modules\Link
     */
    public $Link;

    /**
     * @var Modules\NextBestAction
     */
    public $NextBestAction;

    /**
     * @var Modules\Profile
     */
    public $Profile;

    /**
     * @var Modules\Project
     */
    public $Project;

    /**
     * @var Modules\Sale
     */
    public $Sale;

    /**
     * @var Modules\Scorecard
     */
    public $Scorecard;

    /**
     * @var Modules\Segment
     */
    public $Segment;

    /**
     * @var Modules\Template
     */
    public $Template;

    /**
     * @var Modules\Theme
     */
    public $Theme;

    /**
     * @var Modules\Touchpoint
     */
    public $Touchpoint;

    /**
     * @var Modules\Tracker
     */
    public $Tracker;

    /**
     * @var Modules\Tric
     */
    public $Tric;

    /**
     * @var Modules\Trigger
     */
    public $Trigger;

    /**
     * @var Modules\User
     */
    public $User;

    /**
     * @var Modules\Webook
     */
    public $Webhook;

    /**
     * Create a new API instance
     * @param string $apiKey
     * @param string $projectId
     */
    public function __construct($apiKey, $projectId)
    {
        $this->SetApiKey($apiKey);
        $this->SetProjectId($projectId);

        $this->registerModules();
    }

    /**
     * @return string $api_version
     */
    public function GetApiVersion()
    {
        return $this->api_version;
    }

    /**
     * @param string $api_key
     */
    public function SetApiKey($api_key)
    {
        $this->api_key = $api_key;

        $this->registerModules();
    }

    /**
     * @param string $api_key
     */
    public function GetApiKey()
    {
        return $this->api_key;
    }

    /**
     * @return string $projectId
     */
    public function GetProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param string $projectId
     */
    public function SetProjectId($projectId)
    {
        $this->projectId = $projectId;

        $this->registerModules();
    }

    /**
     * Register modules
     */
    private function registerModules()
    {
        $this->Apikey = new Modules\Apikey($this->api_key);
        $this->Behavior = new Modules\Behavior($this->api_key, $this->projectId);
        $this->Box = new Modules\Box($this->api_key, $this->projectId);
        $this->Bucket = new Modules\Bucket($this->api_key, $this->projectId);
        $this->Campaign = new Modules\Campaign($this->api_key, $this->projectId);
        $this->Card = new Modules\Card($this->api_key, $this->projectId);
        $this->Channel = new Modules\Channel($this->api_key, $this->projectId);
        $this->Content = new Modules\Content($this->api_key, $this->projectId);
        $this->Geo = new Modules\Geo($this->api_key);
        $this->Goal = new Modules\Goal($this->api_key, $this->projectId);
        $this->Interaction = new Modules\Interaction($this->api_key, $this->projectId);
        $this->Journey = new Modules\Journey($this->api_key, $this->projectId);
        $this->Link = new Modules\Link($this->api_key, $this->projectId);
        $this->NextBestAction = new Modules\NextBestAction($this->api_key, $this->projectId);
        $this->Profile = new Modules\Profile($this->api_key, $this->projectId);
        $this->Project = new Modules\Project($this->api_key);
        $this->Sale = new Modules\Sale($this->api_key, $this->projectId);
        $this->Scorecard = new Modules\Scorecard($this->api_key, $this->projectId);
        $this->Segment = new Modules\Segment($this->api_key, $this->projectId);
        $this->Template = new Modules\Template($this->api_key, $this->projectId);
        $this->Theme = new Modules\Theme($this->api_key, $this->projectId);
        $this->Touchpoint = new Modules\Touchpoint($this->api_key, $this->projectId);
        $this->Tracker = new Modules\Tracker($this->api_key, $this->projectId);
        $this->Tric = new Modules\Tric($this->api_key, $this->projectId);
        $this->Trigger = new Modules\Trigger($this->api_key, $this->projectId);
        $this->User = new Modules\User($this->api_key, $this->projectId);
        $this->Webhook = new Modules\Webhook($this->api_key, $this->projectId);
    }
}
