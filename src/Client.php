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
     * @var \Datatrics\API\Modules\Apikey
     */
    public $Apikey;

    /**
     * @var \Datatrics\API\Modules\Behavior
     */
    public $Behavior;

    /**
     * @var \Datatrics\API\Modules\Box
     */
    public $Box;

    /**
     * @var \Datatrics\API\Modules\Bucket
     */
    public $Bucket;

    /**
     * @var \Datatrics\API\Modules\Campaign
     */
    public $Campaign;

    /**
     * @var \Datatrics\API\Modules\Card
     */
    public $Card;

    /**
     * @var \Datatrics\API\Modules\Channel
     */
    public $Channel;

    /**
     * @var \Datatrics\API\Modules\Content
     */
    public $Content;

    /**
     * @var \Datatrics\API\Modules\Geo
     */
    public $Geo;

    /**
     * @var \Datatrics\API\Modules\Goal
     */
    public $Goal;

    /**
     * @var \Datatrics\API\Modules\Interaction
     */
    public $Interaction;

    /**
     * @var \Datatrics\API\Modules\Journey
     */
    public $Journey;

    /**
     * @var \Datatrics\API\Modules\Link
     */
    public $Link;

    /**
     * @var \Datatrics\API\Modules\NextBestAction
     */
    public $NextBestAction;

    /**
     * @var \Datatrics\API\Modules\Profile
     */
    public $Profile;

    /**
     * @var \Datatrics\API\Modules\Project
     */
    public $Project;

    /**
     * @var \Datatrics\API\Modules\Sale
     */
    public $Sale;

    /**
     * @var \Datatrics\API\Modules\Scorecard
     */
    public $Scorecard;

    /**
     * @var \Datatrics\API\Modules\Segment
     */
    public $Segment;

    /**
     * @var \Datatrics\API\Modules\Template
     */
    public $Template;

    /**
     * @var \Datatrics\API\Modules\Theme
     */
    public $Theme;

    /**
     * @var \Datatrics\API\Modules\Touchpoint
     */
    public $Touchpoint;

    /**
     * @var \Datatrics\API\Modules\Tracker
     */
    public $Tracker;

    /**
     * @var \Datatrics\API\Modules\Tric
     */
    public $Tric;

    /**
     * @var \Datatrics\API\Modules\Trigger
     */
    public $Trigger;

    /**
     * @var \Datatrics\API\Modules\User
     */
    public $User;

    /**
     * @var \Datatrics\API\Modules\Webhook
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
     * @return string $api_key
     */
    public function GetApiKey()
    {
        return $this->api_key;
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
        $this->Apikey = new \Datatrics\API\Modules\Apikey($this->api_key);
        $this->Behavior = new \Datatrics\API\Modules\Behavior($this->api_key, $this->projectId);
        $this->Box = new \Datatrics\API\Modules\Box($this->api_key, $this->projectId);
        $this->Bucket = new \Datatrics\API\Modules\Bucket($this->api_key, $this->projectId);
        $this->Campaign = new \Datatrics\API\Modules\Campaign($this->api_key, $this->projectId);
        $this->Card = new \Datatrics\API\Modules\Card($this->api_key, $this->projectId);
        $this->Channel = new \Datatrics\API\Modules\Channel($this->api_key, $this->projectId);
        $this->Content = new \Datatrics\API\Modules\Content($this->api_key, $this->projectId);
        $this->Geo = new \Datatrics\API\Modules\Geo($this->api_key);
        $this->Goal = new \Datatrics\API\Modules\Goal($this->api_key, $this->projectId);
        $this->Interaction = new \Datatrics\API\Modules\Interaction($this->api_key, $this->projectId);
        $this->Journey = new \Datatrics\API\Modules\Journey($this->api_key, $this->projectId);
        $this->Link = new \Datatrics\API\Modules\Link($this->api_key, $this->projectId);
        $this->NextBestAction = new \Datatrics\API\Modules\NextBestAction($this->api_key, $this->projectId);
        $this->Profile = new \Datatrics\API\Modules\Profile($this->api_key, $this->projectId);
        $this->Project = new \Datatrics\API\Modules\Project($this->api_key);
        $this->Sale = new \Datatrics\API\Modules\Sale($this->api_key, $this->projectId);
        $this->Scorecard = new \Datatrics\API\Modules\Scorecard($this->api_key, $this->projectId);
        $this->Segment = new \Datatrics\API\Modules\Segment($this->api_key, $this->projectId);
        $this->Template = new \Datatrics\API\Modules\Template($this->api_key, $this->projectId);
        $this->Theme = new \Datatrics\API\Modules\Theme($this->api_key, $this->projectId);
        $this->Touchpoint = new \Datatrics\API\Modules\Touchpoint($this->api_key, $this->projectId);
        $this->Tracker = new \Datatrics\API\Modules\Tracker($this->api_key, $this->projectId);
        $this->Tric = new \Datatrics\API\Modules\Tric($this->api_key, $this->projectId);
        $this->Trigger = new \Datatrics\API\Modules\Trigger($this->api_key, $this->projectId);
        $this->User = new \Datatrics\API\Modules\User($this->api_key, $this->projectId);
        $this->Webhook = new \Datatrics\API\Modules\Webhook($this->api_key, $this->projectId);
    }
}
