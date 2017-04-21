<?php
namespace Datatrics\API\Modules;

class Project extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     */
    public function __construct($apikey)
    {
        parent::__construct($apikey, "/project");
    }

    /**
     * Get one or multiple projects
     * @param string project id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($projectId = null, $args = array("limit" => 50))
    {
        return $projectId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$projectId."?".http_build_query($args));
    }

    /**
     * Create new project
     * @param object Containing all the information of a project
     * @return object Result of the request
     */
    public function Create($project)
    {
        return $this->request(self::HTTP_POST, "", $project);
    }

    /**
     * Create new project
     * @param id of the project
     * @param object Containing all the information of a project
     * @return object Result of the request
     */
    public function Update($projectId, $project)
    {
        return $this->request(self::HTTP_PUT, "/".$projectId, $project);
    }

    /**
     * Delete a project object by project id
     * @param string Id of the project
     * @return object Result of the request
     */
    public function Delete($projectId)
    {
        return $this->request(self::HTTP_DELETE, "/".$projectId);
    }

    /**
     * Retrieve fields of a project object by project id
     * @param string Id of the project
     * @return object Result of the request
     */
    public function Fields($projectId)
    {
        return $this->request(self::HTTP_GET, "/".$projectId."/fields");
    }

    /**
     * Retrieve logs of a project object by project id
     * @param string Id of the project
     * @return object Result of the request
     */
    public function Logs($projectId)
    {
        return $this->request(self::HTTP_GET, "/".$projectId."/logs");
    }
}
