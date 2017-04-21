<?php
namespace Datatrics\API\Modules;

class Link extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/link");
    }

    /**
     * retreive a link
     * @param int link id
     * @return object Result of the request
     */
    public function Get($linkId)
    {
        return $this->request(self::HTTP_GET, "/".$linkId);
    }


    /**
     * retreive a link
     * @param int link id
     * @return object Result of the request
     */
    public function Create($link)
    {
        return $this->request(self::HTTP_POST, "", $link);
    }
}
