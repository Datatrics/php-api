<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Campaign extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/campaign");
    }

    /**
     * Get one or multiple campaigns
     * @param string campaign id, leave null for list of campaigns
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($campaignId = null, $args = array("limit" => 50))
    {
        if (is_null($campaignId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$campaignId, $args);
    }

    /**
     * Get one or multiple lanes
     * @param string campaign id
     * @param string lane id, leave null for list of lanes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetLane($campaignId, $laneId = null, $args = array("limit" => 50))
    {
        if (is_null($laneId)) {
            return $this->GetClient()->Get($this->GetUrl()."/".$campaignId."/lane", $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$campaignId."/lane/".$laneId, $args);
    }

    /**
     * Create new campaign
     * @param object Containing all the information of a lane
     * @return object Result of the request
     */
    public function Create($campaign)
    {
        return $this->GetClient()->Post($this->GetUrl(), $campaign);
    }

    /**
     * Create new lane
     * @param string campaign id
     * @param object Containing all the information of a lane
     * @return object Result of the request
     */
    public function CreateLane($campaignId, $lane)
    {
        return $this->GetClient()->Post($this->GetUrl()."/".$campaignId."/lane", $lane);
    }

    /**
     * Update a campaign
     * @param object campaign containing the campaign id and fields that need to be updated
     * @throws \Exception When boxid is not present
     * @return object Result of the request
     */
    public function Update($campaign)
    {
        if (!isset($campaign['campaignid'])) {
            throw new \Exception("campaign must contain a campaignid");
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$campaign['campaignid'], $campaign);
    }

    /**
     * Update a lane
     * @param string Id of the campaign
     * @param object lane containing the laneid and fields that need to be updated
     * @throws \Exception When boxid is not present
     * @return object Result of the request
     */
    public function UpdateLane($campaignId, $lane)
    {
        if (!isset($lane['laneid'])) {
            throw new \Exception("lane must contain a laneid");
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$campaignId."/lane/".$lane['laneid'], $lane);
    }

    /**
     * Delete a campaign object by campaign id
     * @param string Id of the campaign
     * @return object Result of the request
     */
    public function Delete($campaignId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$campaignId);
    }

    /**
     * Delete a campaign object by campaign id
     * @param string Id of the campaign
     * @return object Result of the request
     */
    public function DeleteLane($campaignId, $laneId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$campaignId."/lane/".$laneId);
    }

    /**
     * Retrieve stats of a lane by campaign
     * @param string Id of the campaign
     * @return object Result of the request
     */
    public function Stats($campaignId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$campaignId."/stats");
    }

    /**
     * Retrieve stats of a lane by campaign and lane id
     * @param string Id of the campaign
     * @param string Id of the lane to be deleted
     * @return object Result of the request
     */
    public function StatsLane($campaignId, $laneId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$campaignId."/lane/".$laneId."/stats");
    }
}
