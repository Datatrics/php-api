<?php
namespace Datatrics\API\Modules;

class Campaign extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/campaign");
    }

    /**
     * Get one or multiple campaigns
     * @param string campaign id, leave null for list of campaigns
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($campaignId = null, $args = array("limit" => 50))
    {
        return $campaignId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$campaignId."?".http_build_query($args));
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
        return $laneId == null ? $this->request(self::HTTP_GET, "/".$campaignId."/lane/?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$campaignId."/lane/".$laneId."?".http_build_query($args));
    }

    /**
     * Create new campaign
     * @param object Containing all the information of a lane
     * @return object Result of the request
     */
    public function Create($campaign)
    {
        return $this->request(self::HTTP_POST, "", $campaign);
    }

    /**
     * Create new lane
     * @param string campaign id
     * @param object Containing all the information of a lane
     * @return object Result of the request
     */
    public function CreateLane($campaignId, $lane)
    {
        return $this->request(self::HTTP_POST, "/".$campaignId."/lane", $lane);
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

        return $this->request(self::HTTP_PUT, "/".$campaign['campaignid'], $campaign);
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

        return $this->request(self::HTTP_PUT, "/".$campaignId."/lane/".$lane['laneid'], $lane);
    }

    /**
     * Delete a campaign object by campaign id
     * @param string Id of the campaign
     * @return object Result of the request
     */
    public function Delete($campaignId)
    {
        return $this->request(self::HTTP_DELETE, "/".$campaignId);
    }

    /**
     * Retrieve stats of a lane by campaign
     * @param string Id of the campaign
     * @return object Result of the request
     */
    public function Stats($campaignId)
    {
        return $this->request(self::HTTP_GET, "/".$campaignId."/stats");
    }

    /**
     * Retrieve stats of a lane by campaign and lane id
     * @param string Id of the campaign
     * @param string Id of the lane to be deleted
     * @return object Result of the request
     */
    public function StatsLane($campaignId, $laneId)
    {
        return $this->request(self::HTTP_GET, "/".$campaignId."/lane/".$laneId."/stats");
    }
}
