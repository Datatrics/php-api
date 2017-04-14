<?php
namespace Datatrics\API\Modules;

class Behavior extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/behavior");
    }

    /**
     * Get a list of behaviors
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($args = array("limit" => 50))
    {
        return $this->request(self::HTTP_GET, "?".http_build_query($args));
    }

    /**
     * Get a list of Visits
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetVisit($args = array("limit" => 50))
    {
        return $this->request(self::HTTP_GET, "/visit?".http_build_query($args));
    }

    /**
     * Get one or multiple events
     * @param string event id, leave null for list of events
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetEvent($eventId = null, $args = array("limit" => 50))
    {
        return $eventId == null ? $this->request(self::HTTP_GET, "/event?".http_build_query($args)) : $this->request(self::HTTP_GET, "/event/".$eventId."?".http_build_query($args));
    }

    /**
     * Create new event
     * @param object Containing all the information of a event
     * @return object Result of the request
     */
    public function CreateEvent($event)
    {
        return $this->request(self::HTTP_POST, "/evet", $event);
    }

    /**
     * Update a event
     * @param object Event containing the eventid and fields that need to be updated
     * @throws \Exception When eventid is not present
     * @return object Result of the request
     */
    public function UpdateEvent($event)
    {
        if(!isset($event['eventid']))
            throw new \Exception("event must contain a eventid");

        return $this->request(self::HTTP_PUT, "/event/".$event['eventid'], $profile);
    }

    /**
     * Updates a maximum of 50 events at a time.
     * @param array Containing events with a maximum of 50
     * @throws \Exception When more that 50 events are provided
     * @return object Result of the request
     */
    public function UpdateBulk($events)
    {
        if (count($events) > 50)
            throw new \Exception("Maximum of 50 events allowed at a time");

        return $this->request(self::HTTP_POST, "/event/bulk", $events);
    }
}