<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Profile extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/profile");
    }

    /**
     * Get one or multiple profiles
     * @param string profile id, leave null for list of profiles
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($profileId = null, $args = array("limit" => 50))
    {
        if (is_null($profileId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$profileId, $args);
    }

    /**
     * Create new profile
     * @param object Containing all the information of a profile
     * @return object Result of the request
     */
    public function Create($profile)
    {
        return $this->GetClient()->Post($this->GetUrl(), $profile);
    }

    /**
     * Delete a profile by profileid
     * @param string Id of the profile to be deleted
     * @return object Result of the request
     */
    public function Delete($profileid)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".profileid);
    }

    /**
     * Update a profile
     * @param object Profile containing the profileid and fields that need to be updated
     * @throws \Exception When profileid is not present
     * @return object Result of the request
     */
    public function Update($profile)
    {
        if (!isset($profile['profileid'])) {
            throw new \Exception("profile must contain a profileid");
        }
        return $this->GetClient()->Post($this->GetUrl()."/".$profile['profileid'], $profile);
    }

    /**
     * Updates a maximum of 50 profiles at a time.
     * @param array Containing profiles with a maximum of 50
     * @throws \Exception When more that 50 profiles are provided
     * @return object Result of the request
     */
    public function Bulk($profiles)
    {
        if (count($profiles) > 50) {
            throw new \Exception("Maximum of 50 profiles allowed at a time");
        }

        return $this->GetClient()->Post($this->GetUrl()."/bulk", ['items' => $profiles]);
    }
}
