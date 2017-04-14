<?php
namespace Datatrics\API;
/**
 * Class Client.
 */
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
     * @var Modules\Profile
     */
    public $Profile;
    /**
     * @var Modules\Apikey
     */
    public $Apikey;

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

    private function registerModules()
    {
        $this->Profile = new Modules\Profile($this->api_key, $this->projectId);
        $this->Apikey = new Modules\Apikey($this->api_key);
    }
}