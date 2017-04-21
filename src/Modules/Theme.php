<?php
namespace Datatrics\API\Modules;

class Theme extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/theme");
    }

    /**
     * Get the project theme
     * @param string template id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get()
    {
        $this->request(self::HTTP_GET, "");
    }

    /**
     * Update a theme
     * @param object Containing all the information of a template
     * @return object Result of the request
     */
    public function Update($template)
    {
        return $this->request(self::HTTP_PUT, "", $template);
    }
}
