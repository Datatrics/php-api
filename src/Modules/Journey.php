<?php
namespace Datatrics\API\Modules;

class Journey extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/journey");
    }

    /**
     * Get one or multiple journeys
     * @param string journey id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($journeyId = null, $args = array("limit" => 50))
    {
        return $journeyId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$journeyId."?".http_build_query($args));
    }

    /**
     * Create new journey
     * @param object Containing all the information of a journey
     * @return object Result of the request
     */
    public function Create($journey)
    {
        return $this->request(self::HTTP_POST, "", $journey);
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
        return $this->request(self::HTTP_PUT, "/".$journey['journeyid'], $journey);
    }

    /**
     * Delete a journey object by journey id
     * @param string Id of the journey
     * @return object Result of the request
     */
    public function Delete($journeyId)
    {
        return $this->request(self::HTTP_DELETE, "/".$journeyId);
    }

    /**
     * Retrieve stats of a journey by journey id
     * @param string Id of the journey
     * @return object Result of the request
     */
    public function Stats($journeyId)
    {
        return $this->request(self::HTTP_GET, "/".$journeyId."/stats");
    }
}
