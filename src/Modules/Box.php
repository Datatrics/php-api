<?php
namespace Datatrics\API\Modules;

class Box extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/box");
    }

    /**
     * Get one or multiple boxes
     * @param string box id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($boxId = null, $args = array("limit" => 50))
    {
        return $boxId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$boxId."?".http_build_query($args));
    }

    /**
     * Get all box codes
     * @param string box id
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetCode($boxId, $args = array("limit" => 50))
    {
        return $this->request(self::HTTP_GET, "/".$boxId."/code?".http_build_query($args));
    }

    /**
     * Get one or multiple versions of a box
     * @param string box id
     * @param string version id, leave null for list of versions
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetVersion($boxId, $versionId = null, $args = array("limit" => 50))
    {
        return $versionId == null ? $this->request(self::HTTP_GET, "/".$boxId."/version?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$boxId."/version/".$versionId."?".http_build_query($args));
    }

    /**
     * Create new box
     * @param object Containing all the information of a box
     * @return object Result of the request
     */
    public function Create($box)
    {
        return $this->request(self::HTTP_POST, "", $box);
    }

    /**
     * Delete a box version by version id
     * @param string Id of the box
     * @param string Id of the version to be deleted
     * @return object Result of the request
     */
    public function Delete($boxId, $versionId)
    {
        return $this->request(self::HTTP_DELETE, "/".$boxId."/version/".$versionId);
    }

    /**
     * Update a box
     * @param object Box containing the boxid and fields that need to be updated
     * @throws \Exception When boxid is not present
     * @return object Result of the request
     */
    public function Update($box)
    {
        if (!isset($box['boxid'])) {
            throw new \Exception("box must contain a boxid");
        }

        return $this->request(self::HTTP_PUT, "/".$box['boxid'], $box);
    }

    /**
     * Update a box
     * @param string Id of the box
     * @param object Version containing the version and fields that need to be updated
     * @throws \Exception When versionid is not present
     * @return object Result of the request
     */
    public function UpdateVersion($boxid, $version)
    {
        if (!isset($version['versionid'])) {
            throw new \Exception("version must contain a versionid");
        }

        return $this->request(self::HTTP_PUT, "/".$boxid."/version/".$version['versionid'], $version);
    }
}
