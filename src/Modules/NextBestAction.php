<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class NextBestAction extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/nextbestaction");
    }

    /**
     * Get one or multiple nextbestactions
     * @param string nextbestaction id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($nextbestactionId = null, $args = array("limit" => 50))
    {
        if (is_null($nextbestactionId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$nextbestactionId, $args);
    }

    /**
     * Create new nextbestaction
     * @param object Containing all the information of a nextbestaction
     * @return object Result of the request
     */
    public function Create($nextbestaction)
    {
        return $this->GetClient()->Post($this->GetUrl(), $nextbestaction);
    }

    /**
     * Update a nextbestaction
     * @param object Containing all the information of a nextbestaction
     * @return object Result of the request
     */
    public function Update($nextbestaction)
    {
        if (!isset($nextbestaction['nextbestactionid'])) {
            throw new \Exception('nextbestaction must contain nextbestactionid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$nextbestaction['nextbestactionid'], $nextbestaction);
    }

    /**
     * Delete a nextbestaction object by nextbestaction id
     * @param string Id of the nextbestaction
     * @return object Result of the request
     */
    public function Delete($nextbestactionId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$nextbestactionId);
    }

    /**
     * Delete a nextbestaction object by nextbestaction id
     * @param string Id of the nextbestaction
     * @return object Result of the request
     */
    public function Schedule($nextbestactionId)
    {
        return $this->GetClient()->Put($this->GetUrl()."/".$nextbestactionId."/schedule");
    }

    /**
     * Delete a nextbestaction object by nextbestaction id
     * @param string Id of the nextbestaction
     * @return object Result of the request
     */
    public function Assign($nextbestactionId)
    {
        return $this->GetClient()->Put($this->GetUrl()."/".$nextbestactionId."/v");
    }
}
