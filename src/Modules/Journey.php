<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Journey extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/journey");
    }

    /**
     * Get one or multiple journeys
     * @param string journey id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($journeyId = null, $args = array("limit" => 50))
    {
        if (is_null($journeyId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$journeyId, $args);
    }

    /**
     * Create new journey
     * @param object Containing all the information of a journey
     * @return object Result of the request
     */
    public function Create($journey)
    {
        return $this->GetClient()->Post($this->GetUrl(), $journey);
    }

    /**
     * Update a journey
     * @param object Containing all the information of a journey
     * @return object Result of the request
     */
    public function Update($journey)
    {
        if (!isset($journey['journeyid'])) {
            throw new \Exception('journey must contain journeyid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$journey['journeyid'], $journey);
    }

    /**
     * Delete a journey object by journey id
     * @param string Id of the journey
     * @return object Result of the request
     */
    public function Delete($journeyId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$journeyId);
    }

    /**
     * Retrieve stats of a journey by journey id
     * @param string Id of the journey
     * @return object Result of the request
     */
    public function Stats($journeyId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$journeyId."/stats");
    }
}
