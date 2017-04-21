<?php
namespace Datatrics\API\Modules;

class Tracker extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/tracker");
    }

    /**
     * Get the tracker stats
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Stats($args = array())
    {
        $this->request(self::HTTP_GET, "/stats?".http_build_query($args));
    }
}
