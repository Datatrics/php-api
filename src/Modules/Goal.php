<?php
namespace Datatrics\API\Modules;

class Goal extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/goal");
    }

    /**
     * Get one or multiple goals
     * @param string goal id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($goalId = null, $args = array("limit" => 50))
    {
        return $goalId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$goalId."?".http_build_query($args));
    }

    /**
     * Create new goal
     * @param object Containing all the information of a goal
     * @return object Result of the request
     */
    public function Create($goal)
    {
        return $this->request(self::HTTP_POST, "", $goal);
    }

    /**
     * Create new goal
     * @param id of the goal
     * @param object Containing all the information of a goal
     * @return object Result of the request
     */
    public function Update($goalId, $goal)
    {
        return $this->request(self::HTTP_PUT, "/".$goalId, $goal);
    }

    /**
     * Delete a goal object by goal id
     * @param string Id of the goal
     * @return object Result of the request
     */
    public function Delete($goalId)
    {
        return $this->request(self::HTTP_DELETE, "/".$goalId);
    }
}
