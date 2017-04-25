<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Interaction extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/interaction");
    }

    /**
     * Get one or multiple interactions
     * @param string interaction id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($interactionId = null, $args = array("limit" => 50))
    {
        if (is_null($interactionId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$interactionId, $args);
    }

    /**
     * Create new interaction
     * @param object Containing all the information of a interaction
     * @return object Result of the request
     */
    public function Create($interaction)
    {
        return $this->GetClient()->Post($this->GetUrl(), $interaction);
    }

    /**
     * Update a interaction
     * @param object Containing all the information of a interaction
     * @return object Result of the request
     */
    public function Update($interaction)
    {
        if (!isset($interaction['interactionid'])) {
            throw new \Exception("interaction must contain a interactionid");
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$interaction['interactionid'], $interaction);
    }

    /**
     * Delete a interaction object by interaction id
     * @param string Id of the interaction
     * @return object Result of the request
     */
    public function Delete($interactionId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$interactionId);
    }

    /**
     * Updates a maximum of 50 interaction items at a time.
     * @param array Containing interaction items with a maximum of 50
     * @throws \Exception When more that 50 interaction items are provided
     * @return object Result of the request
     */
    public function Bulk($interactions)
    {
        if (count($interactions) > 50) {
            throw new \Exception("Maximum of 50 interaction items allowed at a time");
        }

        return $this->GetClient()->Post($this->GetUrl()."/bulk", ['items' => $interactions]);
    }
}
