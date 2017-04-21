<?php
namespace Datatrics\API\Modules;

class Webhook extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/webhook");
    }

    /**
     * Trigger a Datatrics webhooke
     * @param string channel
     * @param string type
     * @param object Containing payload data
     * @return object Result of the request
     */
    public function Send($channel, $type, $webhook)
    {
        return $this->request(self::HTTP_POST, "/".$channel."/$type", $webhook);
    }
}
