<?php
namespace Datatrics\API\Modules;

class Touchpoint extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/touchpoint");
    }

    /**
     * Get one or multiple touchpoints
     * @param string touchpoint id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($touchpointId = null, $args = array("limit" => 50))
    {
        return $touchpointId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$touchpointId."?".http_build_query($args));
    }

    /**
     * Create new touchpoint
     * @param object Containing all the information of a touchpoint
     * @return object Result of the request
     */
    public function Create($touchpoint)
    {
        return $this->request(self::HTTP_POST, "", $touchpoint);
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
        return $this->request(self::HTTP_PUT, "/".$touchpoint['touchpointid'], $touchpoint);
    }

    /**
     * Delete a touchpoint object by touchpoint id
     * @param string Id of the touchpoint
     * @return object Result of the request
     */
    public function Delete($touchpointId)
    {
        return $this->request(self::HTTP_DELETE, "/".$touchpointId);
    }

    /**
     * Delete a touchpoint object by touchpoint id
     * @param string Id of the touchpoint
     * @return object Result of the request
     */
    public function Stats($touchpointId, $args)
    {
        if (count($args)) {
            return $this->request(self::HTTP_GET, "/".$touchpointId."/stats?".http_build_query($args));
        } else {
            return $this->request(self::HTTP_GET, "/".$touchpointId."/stats");
        }
    }
}
