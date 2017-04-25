<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Tracker extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/tracker");
    }

    /**
     * Get the tracker stats
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Stats($args = [])
    {
        $this->GetClient()->Get($this->GetUrl()."/stats", $args);
    }
}
