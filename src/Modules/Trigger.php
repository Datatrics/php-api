<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Trigger extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/trigger");
    }

    /**
     * Get one or multiple triggers
     * @param string trigger id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($triggerId = null, $args = array("limit" => 50))
    {
        if (is_null($triggerId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$triggerId, $args);
    }

    /**
     * Delete a trigger object by trigger id
     * @param string Id of the trigger
     * @return object Result of the request
     */
    public function Delete($triggerId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$triggerId);
    }

    /**
     * Activate a trigger
     * @param object Containing all the information of a trigger
     * @return object Result of the request
     */
    public function Activate($triggerId)
    {
        return $this->GetClient()->Put($this->GetUrl()."/".$triggerId."/activate");
    }

    /**
     * Deactivate a trigger
     * @param id of the trigger
     * @return object Result of the request
     */
    public function Deactivate($triggerId)
    {
        return $this->GetClient()->Put($this->GetUrl()."/".$triggerId."/deactivate");
    }
}
