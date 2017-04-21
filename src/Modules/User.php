<?php
namespace Datatrics\API\Modules;

class User extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/user");
    }

    /**
     * Get one or multiple users
     * @param string user id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($userId = null, $args = array("limit" => 50))
    {
        return $userId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$userId."?".http_build_query($args));
    }

    /**
     * Create new user
     * @param object Containing all the information of a user
     * @return object Result of the request
     */
    public function Create($user)
    {
        return $this->request(self::HTTP_POST, "", $user);
    }

    /**
     * Create new user
     * @param id of the user
     * @param object Containing all the information of a user
     * @return object Result of the request
     */
    public function Update($userId, $user)
    {
        return $this->request(self::HTTP_PUT, "/".$userId, $user);
    }

    /**
     * Delete a user object by user id
     * @param string Id of the user
     * @return object Result of the request
     */
    public function Delete($userId)
    {
        return $this->request(self::HTTP_DELETE, "/".$userId);
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
        return $this->request(self::HTTP_POST, "/getToken", $args);
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
        return $this->request(self::HTTP_POST, "/getApiKey", $args);
    }
}
