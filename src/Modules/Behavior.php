<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Behavior extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/behavior");
    }

    /**
     * Get a list of behaviors
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($args = array("limit" => 50))
    {
        return $this->request(Client::HTTP_GET, $this->GetUrl(), $args);
    }

    /**
     * Get a list of Visits
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetVisit($args = array("limit" => 50))
    {
        return $this->request(Client::HTTP_GET, $this->GetUrl()."/visit", $args);
    }

    /**
     * Get one or multiple events
     * @param string event id, leave null for list of events
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetEvent($eventId = null, $args = array("limit" => 50))
    {
        if (is_null($eventId)) {
            return $this->request(Client::HTTP_GET, $this->GetUrl()."/event", $args);
        }
        return $this->request(Client::HTTP_GET, $this->GetUrl()."/event/".$eventId, $args);
    }

    /**
     * Create new event
     * @param object Containing all the information of a event
     * @return object Result of the request
     */
    public function CreateEvent($event)
    {
        return $this->request(Client::HTTP_POST, $this->GetUrl()."/event", $event);
    }

    /**
     * Update a event
     * @param object Event containing the eventid and fields that need to be updated
     * @throws \Exception When eventid is not present
     * @return object Result of the request
     */
    public function UpdateEvent($event)
    {
        if (!isset($event['eventid'])) {
            throw new \Exception("event must contain a eventid");
        }

        return $this->request(Client::HTTP_PUT, $this->GetUrl()."/event/".$event['eventid'], $event);
    }

    /**
     * Updates a maximum of 50 events at a time.
     * @param array Containing events with a maximum of 50
     * @throws \Exception When more that 50 events are provided
     * @return object Result of the request
     */
    public function Bulk($events)
    {
        if (count($events) > 50) {
            throw new \Exception("Maximum of 50 events allowed at a time");
        }
        return $this->request(Client::HTTP_POST, $this->GetUrl()."/event/bulk", ['items' => $events]);
    }
}
