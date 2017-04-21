<?php
namespace Datatrics\API\Modules;

class NextBestAction extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/nextbestaction");
    }

    /**
     * Get one or multiple nextbestactions
     * @param string nextbestaction id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($nextbestactionId = null, $args = array("limit" => 50))
    {
        return $nextbestactionId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$nextbestactionId."?".http_build_query($args));
    }

    /**
     * Create new nextbestaction
     * @param object Containing all the information of a nextbestaction
     * @return object Result of the request
     */
    public function Create($nextbestaction)
    {
        return $this->request(self::HTTP_POST, "", $nextbestaction);
    }

    /**
     * Create new nextbestaction
     * @param id of the nextbestaction
     * @param object Containing all the information of a nextbestaction
     * @return object Result of the request
     */
    public function Update($nextbestactionId, $nextbestaction)
    {
        return $this->request(self::HTTP_PUT, "/".$nextbestactionId, $nextbestaction);
    }

    /**
     * Delete a nextbestaction object by nextbestaction id
     * @param string Id of the nextbestaction
     * @return object Result of the request
     */
    public function Delete($nextbestactionId)
    {
        return $this->request(self::HTTP_DELETE, "/".$nextbestactionId);
    }

    /**
     * Delete a nextbestaction object by nextbestaction id
     * @param string Id of the nextbestaction
     * @return object Result of the request
     */
    public function Schedule($nextbestactionId)
    {
        return $this->request(self::HTTP_PUT, "/".$nextbestactionId."/schedule");
    }

    /**
     * Delete a nextbestaction object by nextbestaction id
     * @param string Id of the nextbestaction
     * @return object Result of the request
     */
    public function Assign($nextbestactionId)
    {
        return $this->request(self::HTTP_PUT, "/".$nextbestactionId."/assign");
    }
}
