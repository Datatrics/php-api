<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Project extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project");
    }

    /**
     * Get one or multiple projects
     * @param string project id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($projectId = null, $args = array("limit" => 50))
    {
        if (is_null($projectId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$projectId, $args);
    }

    /**
     * Create new project
     * @param object Containing all the information of a project
     * @return object Result of the request
     */
    public function Create($project)
    {
        return $this->GetClient()->Post($this->GetUrl(), $project);
    }

    /**
     * Update a project
     * @param id of the project
     * @param object Containing all the information of a project
     * @throws \Exception when projectid is missing
     * @return object Result of the request
     */
    public function Update($project)
    {
        if (!isset($project['projectid'])) {
            throw new \Exception("project must contain a projectid");
        }
        return $this->GetClient()->Post($this->GetUrl()."/".$project['projectid'], $project);
    }

    /**
     * Delete a project object by project id
     * @param string Id of the project
     * @return object Result of the request
     */
    public function Delete($projectId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$projectId);
    }

    /**
     * Retrieve fields of a project object by project id
     * @param string Id of the project
     * @return object Result of the request
     */
    public function Fields($projectId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$projectId."/fields");
    }

    /**
     * Retrieve logs of a project object by project id
     * @param string Id of the project
     * @return object Result of the request
     */
    public function Logs($projectId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$projectId."/logs");
    }
}
