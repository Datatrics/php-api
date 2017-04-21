<?php
namespace Datatrics\API\Modules;

class Template extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/template");
    }

    /**
     * Get one or multiple templates
     * @param string template id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($templateId = null, $args = array("limit" => 50))
    {
        return $templateId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$templateId."?".http_build_query($args));
    }

    /**
     * Create new template
     * @param object Containing all the information of a template
     * @return object Result of the request
     */
    public function Create($template)
    {
        return $this->request(self::HTTP_POST, "", $template);
    }

    /**
     * Create new template
     * @param id of the template
     * @param object Containing all the information of a template
     * @return object Result of the request
     */
    public function Update($templateId, $template)
    {
        return $this->request(self::HTTP_PUT, "/".$templateId, $template);
    }

    /**
     * Delete a template object by template id
     * @param string Id of the template
     * @return object Result of the request
     */
    public function Delete($templateId)
    {
        return $this->request(self::HTTP_DELETE, "/".$templateId);
    }
}
