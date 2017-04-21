<?php
namespace Datatrics\API\Modules;

class Trigger extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/trigger");
    }

    /**
     * Get one or multiple triggers
     * @param string trigger id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($triggerId = null, $args = array("limit" => 50))
    {
        return $triggerId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$triggerId."?".http_build_query($args));
    }

    /**
     * Delete a trigger object by trigger id
     * @param string Id of the trigger
     * @return object Result of the request
     */
    public function Delete($triggerId)
    {
        return $this->request(self::HTTP_DELETE, "/".$triggerId);
    }

    /**
     * Activate a trigger
     * @param object Containing all the information of a trigger
     * @return object Result of the request
     */
    public function Activate($triggerId)
    {
        return $this->request(self::HTTP_PUT, "/".$triggerId."/activate");
    }

    /**
     * Deactivate a trigger
     * @param id of the trigger
     * @return object Result of the request
     */
    public function Deactivate($triggerId)
    {
        return $this->request(self::HTTP_PUT, "/".$triggerId."/deactivate");
    }
}
