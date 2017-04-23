<?php
namespace Datatrics\API\Modules;

class Tric extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/tric");
    }

    /**
     * Get one or multiple trics
     * @param string tric id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($tricId = null, $args = array("limit" => 50))
    {
        return $tricId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$tricId."?".http_build_query($args));
    }

    /**
     * Create new tric
     * @param object Containing all the information of a tric
     * @return object Result of the request
     */
    public function Create($tric)
    {
        return $this->request(self::HTTP_POST, "", $tric);
    }

    /**
     * Create new tric
     * @param id of the tric
     * @param object Containing all the information of a tric
     * @return object Result of the request
     */
    public function Update($tricId, $tric)
    {
        return $this->request(self::HTTP_PUT, "/".$tricId, $tric);
    }

    /**
     * Delete a tric object by tric id
     * @param string Id of the tric
     * @return object Result of the request
     */
    public function Delete($tricId)
    {
        return $this->request(self::HTTP_DELETE, "/".$tricId);
    }

    /**
     * Do a tric object by tric id
     * @param string Id of the tric
     * @return object Result of the request
     */
    public function Do($tricId)
    {
        return $this->request(self::HTTP_GET, "/".$tricId);
    }
}
