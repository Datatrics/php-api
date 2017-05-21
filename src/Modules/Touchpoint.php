<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Touchpoint extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/touchpoint");
    }

    /**
     * Get one or multiple touchpoints
     * @param string touchpoint id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($touchpointId = null, $args = array("limit" => 50))
    {
        if (is_null($touchpointId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$touchpointId, $args);
    }

    /**
     * Create new touchpoint
     * @param object Containing all the information of a touchpoint
     * @return object Result of the request
     */
    public function Create($touchpoint)
    {
        return $this->GetClient()->Post($this->GetUrl(), $touchpoint);
    }

    /**
     * Update a touchpoint
     * @param id of the touchpoint
     * @param object Containing all the information of a touchpoint
     * @return object Result of the request
     */
    public function Update($touchpoint)
    {
        if (!isset($touchpoint['touchpointid'])) {
            throw new \Exception('touchpoint must contain touchpointid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$touchpoint['touchpointid'], $touchpoint);
    }

    /**
     * Delete a touchpoint object by touchpoint id
     * @param string Id of the touchpoint
     * @return object Result of the request
     */
    public function Delete($touchpointId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$touchpointId);
    }

    /**
     * Retrieve stats a touchpoint object by touchpoint id
     * @param string Id of the touchpoint
     * @return object Result of the request
     */
    public function Stats($touchpointId, $args = [])
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$touchpointId."/stats", $args);
    }

    /**
     * Retrieve content of a touchpoint object by touchpoint id
     * @param string Id of the touchpoint
     * @return object Result of the request
     */
    public function Content($touchpointId, $args = [])
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$touchpointId."/content", $args);
    }
}
