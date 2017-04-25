<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class User extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/user");
    }

    /**
     * Get one or multiple users
     * @param string user id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($userId = null, $args = array("limit" => 50))
    {
        if (is_null($userId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$userId, $args);
    }

    /**
     * Create new user
     * @param object Containing all the information of a user
     * @return object Result of the request
     */
    public function Create($user)
    {
        return $this->GetClient()->Post($this->GetUrl(), $user);
    }

    /**
     * Update a user
     * @param id of the user
     * @param object Containing all the information of a user
     * @return object Result of the request
     */
    public function Update($user)
    {
        if (!isset($user['userid'])) {
            throw new \Exception('user must contain userid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$user['userid'], $user);
    }

    /**
     * Delete a user object by user id
     * @param string Id of the user
     * @return object Result of the request
     */
    public function Delete($userId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$userId);
    }

    /**
     * Delete a user object by user id
     * @param string Id of the user
     * @return object Result of the request
     */
    public function Token($username, $password)
    {
        $args = [
            'username' => $username,
            'password' => $password
        ];
        return $this->GetClient()->Post($this->GetUrl()."/getToken", $args);
    }

    /**
     * Delete a user object by user id
     * @param string Id of the user
     * @return object Result of the request
     */
    public function ApiKey($username, $password)
    {
        $args = [
            'username' => $username,
            'password' => $password
        ];
        return $this->GetClient()->Post($this->GetUrl()."/getApiKey", $args);
    }
}
