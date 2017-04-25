<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Template extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct($client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/template");
    }

    /**
     * Get one or multiple templates
     * @param string template id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($templateId = null, $args = array("limit" => 50))
    {
        if (is_null($templateId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$templateId, $args);
    }

    /**
     * Create new template
     * @param object Containing all the information of a template
     * @return object Result of the request
     */
    public function Create($template)
    {
        return $this->GetClient()->Post($this->GetUrl(), $template);
    }

    /**
     * Update a template
     * @param id of the template
     * @param object Containing all the information of a template
     * @return object Result of the request
     */
    public function Update($template)
    {
        if (!isset($template['templateid'])) {
            throw new \Exception('template must contain templateid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$template['templateid'], $template);
    }

    /**
     * Delete a template object by template id
     * @param string Id of the template
     * @return object Result of the request
     */
    public function Delete($templateId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$templateId);
    }
}
