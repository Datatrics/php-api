<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Segment extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/segment");
    }

    /**
     * Get one or multiple segments
     * @param string segment id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($segmentId = null, $args = array("limit" => 50))
    {
        if (is_null($segmentId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$segmentId, $args);
    }

    /**
     * Create new segment
     * @param object Containing all the information of a segment
     * @return object Result of the request
     */
    public function Create($segment)
    {
        return $this->GetClient()->Post($this->GetUrl(), $segment);
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
        return $this->GetClient()->Put($this->GetUrl()."/".$segment['segmentid'], $segment);
    }
}
