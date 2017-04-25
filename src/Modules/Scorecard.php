<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Scorecard extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/scorecard");
    }

    /**
     * Get one or multiple scorecards
     * @param string scorecard id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($scorecardId = null, $args = array("limit" => 50))
    {
        if (is_null($scorecardId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$scorecardId, $args);
    }

    /**
     * Create new scorecard
     * @param object Containing all the information of a scorecard
     * @return object Result of the request
     */
    public function Create($scorecard)
    {
        return $this->GetClient()->Post($this->GetClient(), $scorecard);
    }

    /**
     * Delete a scorecard object by scorecard id
     * @param string Id of the scorecard
     * @return object Result of the request
     */
    public function Delete($scorecardId)
    {
        return $this->GetClient()->Delete($this->GetClient()."/".$scorecardId);
    }

    /**
     * Updates a maximum of 50 scorecard items at a time.
     * @param array Containing scorecards with a maximum of 50
     * @throws \Exception When more that 50 content items are provided
     * @return object Result of the request
     */
    public function Bulk($scorecards)
    {
        if (count($scorecards) > 50) {
            throw new \Exception("Maximum of 50 scorecards allowed at a time");
        }

        return $this->GetClient()->Post($this->GetClient()."/bulk", ['items' => $scorecards]);
    }
}
