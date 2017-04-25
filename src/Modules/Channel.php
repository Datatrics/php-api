<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Channel extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/channel");
    }

    /**
     * Get one or multiple channels
     * @param string channel id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($channelId = null, $args = array("limit" => 50))
    {
        if (is_null($channelId)) {
            return $this->GetClient()->Get($this->getUrl(), $args);
        }
        return $this->GetClient()->Get($this->getUrl()."/".$channelId, $args);
    }

    /**
     * Create new channel
     * @param object Containing all the information of a channel
     * @return object Result of the request
     */
    public function Create($channel)
    {
        return $this->GetClient()->Post($this->getUrl(), $channel);
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
        return $this->GetClient()->Put($this->getUrl()."/".$channel['channelid'], $channel);
    }

    /**
     * Delete a channel object by channel id
     * @param string Id of the channel
     * @return object Result of the request
     */
    public function Delete($channelId)
    {
        return $this->GetClient()->Delete($this->getUrl()."/".$channelId);
    }
}
