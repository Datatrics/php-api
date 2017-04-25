<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Apikey extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/apikey");
    }

    /**
     * Get all apikeys
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($args = array("limit" => 50))
    {
        return $this->getClient()->Get($this->GetUrl(), $args);
    }

    /**
     * Create a new apikey
     * @param object Containing all values of the apikey
     * @return object Result of the request
     */
    public function Create($apikey)
    {
        return $this->getClient()->Post($this->GetUrl(), $apikey);
    }
}
