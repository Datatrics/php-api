<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Base
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var Client
     */
    public $client;

    /**
     * Base constructor.
     * @param Client $client
     */
    public function __construct($client)
    {
        $this->SetClient($client);
    }

    /**
     * @return string
     */
    public function GetUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Base
     */
    public function SetUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return Client
     */
    public function GetClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return Base
     */
    public function SetClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param $method
     * @param string $url
     * @param array $payload
     * @return mixed
     */
    public function request($method, $url = "", $payload = array())
    {
        if (empty($url)) {
            $url = $this->GetUrl();
        }
        return $this->GetClient()->SendRequest($method, $url, $payload);
    }
}
