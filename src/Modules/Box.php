<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Box extends Base
{

    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/box");
    }


    /**
     * Get one or multiple boxes
     * @param string box id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($boxId = null, $args = array("limit" => 50))
    {
        if (is_null($boxId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$boxId, $args);
    }

    /**
     * Get all box codes
     * @param string box id
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetCode($boxId, $args = array("limit" => 50))
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$boxId."/code", $args);
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
        if (is_null($versionId)) {
            return $this->GetClient()->Get($this->GetUrl()."/".$boxId."/version/", $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$boxId."/version/".$versionId, $args);
    }

    /**
     * Create new box
     * @param object Containing all the information of a box
     * @return object Result of the request
     */
    public function Create($box)
    {
        return $this->GetClient()->Post($this->GetUrl(), $box);
    }

    /**
     * Create new box
     * @param object Containing all the information of a box
     * @return object Result of the request
     */
    public function CreateVersion($boxId, $version)
    {
        return $this->GetClient()->Post($this->GetUrl()."/".$boxId."/version", $version);
    }

    /**
     * Delete a box version by version id
     * @param string Id of the box
     * @param string Id of the version to be deleted
     * @return object Result of the request
     */
    public function Delete($boxId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$boxId);
    }

    /**
     * Delete a box version by version id
     * @param string Id of the box
     * @param string Id of the version to be deleted
     * @return object Result of the request
     */
    public function DeleteVersion($boxId, $versionId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$boxId."/version/".$versionId);
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

        return $this->GetClient()->Put($this->GetUrl()."/".$box['boxid'], $box);
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

        return $this->GetClient()->Put($this->GetUrl()."/".$boxid."/version/".$version['versionid'], $version);
    }
}
