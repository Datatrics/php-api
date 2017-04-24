<?php
namespace Datatrics\API;

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

    /**
     * @var Apikey
     */
    public $Apikey;

    /**
     * @var Behavior
     */
    public $Behavior;

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
        $this->Apikey = new Apikey($this->api_key);
        $this->Behavior = new Behavior($this->api_key, $this->projectId);
        $this->Box = new Box($this->api_key, $this->projectId);
        $this->Bucket = new Bucket($this->api_key, $this->projectId);
        $this->Campaign = new Campaign($this->api_key, $this->projectId);
        $this->Card = new Card($this->api_key, $this->projectId);
        $this->Channel = new Channel($this->api_key, $this->projectId);
        $this->Content = new Content($this->api_key, $this->projectId);
        $this->Geo = new Geo($this->api_key);
        $this->Goal = new Goal($this->api_key, $this->projectId);
        $this->Interaction = new Interaction($this->api_key, $this->projectId);
        $this->Journey = new Journey($this->api_key, $this->projectId);
        $this->Link = new Link($this->api_key, $this->projectId);
        $this->NextBestAction = new NextBestAction($this->api_key, $this->projectId);
        $this->Profile = new Profile($this->api_key, $this->projectId);
        $this->Project = new Project($this->api_key);
        $this->Sale = new Sale($this->api_key, $this->projectId);
        $this->Scorecard = new Scorecard($this->api_key, $this->projectId);
        $this->Segment = new Segment($this->api_key, $this->projectId);
        $this->Template = new Template($this->api_key, $this->projectId);
        $this->Theme = new Theme($this->api_key, $this->projectId);
        $this->Touchpoint = new Touchpoint($this->api_key, $this->projectId);
        $this->Tracker = new Tracker($this->api_key, $this->projectId);
        $this->Tric = new Tric($this->api_key, $this->projectId);
        $this->Trigger = new Trigger($this->api_key, $this->projectId);
        $this->User = new User($this->api_key, $this->projectId);
        $this->Webhook = new Webhook($this->api_key, $this->projectId);
    }
}
