<?php
namespace Datatrics\API\Modules;

class Segment extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/segment");
    }

    /**
     * Get one or multiple segments
     * @param string segment id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($segmentId = null, $args = array("limit" => 50))
    {
        return $segmentId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$segmentId."?".http_build_query($args));
    }

    /**
     * Create new segment
     * @param object Containing all the information of a segment
     * @return object Result of the request
     */
    public function Create($segment)
    {
        return $this->request(self::HTTP_POST, "", $segment);
    }

    /**
     * Update a segment
     * @param id of the segment
     * @param object Containing all the information of a segment
     * @return object Result of the request
     */
    public function Update($segment)
    {
        if (!isset($segment['segmentid'])) {
            throw new \Exception('segment must contain segmentid');
        }
        return $this->request(self::HTTP_PUT, "/".$segment['segmentid'], $segment);
    }
}
