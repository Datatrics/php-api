<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Theme extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/theme");
    }

    /**
     * Get the project theme
     * @param string template id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get()
    {
        return $this->GetClient()->Get($this->GetUrl());
    }

    /**
     * Update a theme
     * @param object Containing all the information of a template
     * @return object Result of the request
     */
    public function Update($template)
    {
        return $this->GetClient()->Put($this->GetUrl(), $template);
    }
}
