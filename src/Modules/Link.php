<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Link extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/link");
    }

    /**
     * retreive a link
     * @param int link id
     * @return object Result of the request
     */
    public function Get($linkId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$linkId);
    }


    /**
     * retreive a link
     * @param int link id
     * @return object Result of the request
     */
    public function Create($link)
    {
        return $this->GetClient()->Post($this->GetUrl(), $link);
    }
}
