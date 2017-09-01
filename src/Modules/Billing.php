<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Billing extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/billing");
    }

    /**
     * Get the billing details
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get()
    {
        return $this->getClient()->Get($this->GetUrl());
    }

    /**
     * Update the billing details.
     * @param object Containing all values of the apikey
     * @return object Result of the request
     */
    public function Update($billing)
    {
        return $this->getClient()->Post($this->GetUrl(), $billing);
    }
}
