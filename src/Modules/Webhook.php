<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Webhook extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct($client)
    {
        parent::__construct($client);
        $this->setUrl("/project/" . $client->GetProjectId() . "/webhook");
    }

    /**
     * Trigger a Datatrics webhooke
     * @param string $channel
     * @param string $type
     * @param object $webhook payload data
     * @return object Result of the request
     */
    public function Send($channel, $type, $webhook)
    {
        return $this->GetClient()->Post($this->getUrl()."/".$channel."/$type", $webhook);
    }
}
