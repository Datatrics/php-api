<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Goal extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/goal");
    }

    /**
     * Get one or multiple goals
     * @param string goal id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($goalId = null, $args = array("limit" => 50))
    {
        if (is_null($goalId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$goalId, $args);
    }

    /**
     * Create new goal
     * @param object Containing all the information of a goal
     * @return object Result of the request
     */
    public function Create($goal)
    {
        return $this->GetClient()->Post($this->GetUrl(), $goal);
    }

    /**
     * Create new goal
     * @param id of the goal
     * @param object Containing all the information of a goal
     * @return object Result of the request
     */
    public function Update($goal)
    {
        if (!isset($goal['goalid'])) {
            throw new \Exception('goal must contain goalid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$goal['goalid'], $goal);
    }

    /**
     * Delete a goal object by goal id
     * @param string Id of the goal
     * @return object Result of the request
     */
    public function Delete($goalId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$goalId);
    }
}
