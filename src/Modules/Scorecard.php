<?php
namespace Datatrics\API\Modules;

class Scorecard extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/scorecard");
    }

    /**
     * Get one or multiple scorecards
     * @param string scorecard id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($scorecardId = null, $args = array("limit" => 50))
    {
        return $scorecardId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$scorecardId."?".http_build_query($args));
    }

    /**
     * Create new scorecard
     * @param object Containing all the information of a scorecard
     * @return object Result of the request
     */
    public function Create($scorecard)
    {
        return $this->request(self::HTTP_POST, "", $scorecard);
    }

    /**
     * Delete a scorecard object by scorecard id
     * @param string Id of the scorecard
     * @return object Result of the request
     */
    public function Delete($scorecardId)
    {
        return $this->request(self::HTTP_DELETE, "/".$scorecardId);
    }

    /**
     * Updates a maximum of 50 scorecard items at a time.
     * @param array Containing scorecards with a maximum of 50
     * @throws \Exception When more that 50 content items are provided
     * @return object Result of the request
     */
    public function UpdateBulk($scorecards)
    {
        if (count($scorecards) > 50) {
            throw new \Exception("Maximum of 50 scorecards allowed at a time");
        }

        return $this->request(self::HTTP_POST, "/bulk", ['items' => $scorecards]);
    }
}
