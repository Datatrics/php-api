<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Tric extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/tric");
    }

    /**
     * Get one or multiple trics
     * @param string tric id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($tricId = null, $args = array("limit" => 50))
    {
        if (is_null($tricId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$tricId, $args);
    }

    /**
     * Create new tric
     * @param object Containing all the information of a tric
     * @return object Result of the request
     */
    public function Create($tric)
    {
        return $this->GetClient()->Post($this->GetUrl(), $tric);
    }

    /**
     * Update a tric
     * @param id of the tric
     * @param object Containing all the information of a tric
     * @return object Result of the request
     */
    public function Update($tric)
    {
        if (!isset($tric['tricid'])) {
            throw new \Exception('tric must contain tricid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$tric['tricid'], $tric);
    }

    /**
     * Delete a tric object by tric id
     * @param string Id of the tric
     * @return object Result of the request
     */
    public function Delete($tricId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$tricId);
    }

    /**
     * Do a tric object by tric id.
     * @param string Id of the tric
     * @return object Result of the request
     */
    public function Run($tricId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$tricId."/do");
    }
}
