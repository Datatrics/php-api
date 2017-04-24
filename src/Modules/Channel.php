<?php
namespace Datatrics\API\Modules;

class Channel extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/channel");
    }

    /**
     * Get one or multiple channels
     * @param string channel id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($channelId = null, $args = array("limit" => 50))
    {
        return $channelId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$channelId."?".http_build_query($args));
    }

    /**
     * Create new channel
     * @param object Containing all the information of a channel
     * @return object Result of the request
     */
    public function Create($channel)
    {
        return $this->request(self::HTTP_POST, "", $channel);
    }

    /**
     * Update a channel
     * @param string channel id
     * @param object Containing all the information of a channel
     * @return object Result of the request
     */
    public function Update($channel)
    {
        if (!isset($channel['channelid'])) {
            throw new \Exception("channel must contain a channelid");
        }
        return $this->request(self::HTTP_PUT, "/".$channel['channelid'], $channel);
    }

    /**
     * Delete a channel object by channel id
     * @param string Id of the channel
     * @return object Result of the request
     */
    public function Delete($channelId)
    {
        return $this->request(self::HTTP_DELETE, "/".$channelId);
    }
}
