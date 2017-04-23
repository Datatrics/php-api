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
     * Create new campaign
     * @param object Containing all the information of a bucket
     * @return object Result of the request
     */
    public function Create($campaign)
    {
        return $this->request(self::HTTP_POST, "", $campaign);
    }

    /**
     * Update a box
     * @param object Box containing the boxid and fields that need to be updated
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
     * Delete a campaign object by campaign id
     * @param string Id of the bucket
     * @param string Id of the object to be deleted
     * @return object Result of the request
     */
    public function Delete($campaignId)
    {
        return $this->request(self::HTTP_DELETE, "/".$campaignId);
    }
}
