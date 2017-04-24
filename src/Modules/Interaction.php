<?php
namespace Datatrics\API\Modules;

class Interaction extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/interaction");
    }

    /**
     * Get one or multiple interactions
     * @param string interaction id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($interactionId = null, $args = array("limit" => 50))
    {
        return $interactionId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$interactionId."?".http_build_query($args));
    }

    /**
     * Create new interaction
     * @param object Containing all the information of a interaction
     * @return object Result of the request
     */
    public function Create($interaction)
    {
        return $this->request(self::HTTP_POST, "", $interaction);
    }

    /**
     * Update a interaction
     * @param object Containing all the information of a interaction
     * @return object Result of the request
     */
    public function Update($interaction)
    {
        if (!isset($interaction['interactionid'])) {
            throw new \Exception("interaction must contain a interactionid");
        }
        return $this->request(self::HTTP_PUT, "/".$interaction['interactionid'], $interaction);
    }

    /**
     * Delete a interaction object by interaction id
     * @param string Id of the interaction
     * @return object Result of the request
     */
    public function Delete($interactionId)
    {
        return $this->request(self::HTTP_DELETE, "/".$interactionId);
    }

    /**
     * Updates a maximum of 50 interaction items at a time.
     * @param array Containing interaction items with a maximum of 50
     * @throws \Exception When more that 50 interaction items are provided
     * @return object Result of the request
     */
    public function UpdateBulk($interactions)
    {
        if (count($interactions) > 50) {
            throw new \Exception("Maximum of 50 interaction items allowed at a time");
        }

        return $this->request(self::HTTP_POST, "/bulk", ['items' => $interactions]);
    }
}
