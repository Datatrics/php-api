<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Geo extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/geo");
    }

    /**
     * Get addres based on ip addres
     * @param string ip
     * @return object Result of the request
     */
    public function Get($ip)
    {
        $args = ['ip' => $ip];
        return $this->GetClient()->Get($this->GetUrl(), $args);
    }
}
