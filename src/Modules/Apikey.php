<?php
namespace Datatrics\API\Modules;

class Apikey extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     */
    public function __construct($apikey)
    {
        parent::__construct($apikey, "/apikey");
    }

    /**
     * Get all apikeys
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($args = array("limit" => 50))
    {
        return$this->request(self::HTTP_GET, "?".http_build_query($args));
    }

    /**
     * Create a new apikey
     * @param object Containing all values of the apikey
     * @return object Result of the request
     */
    public function Create($apikey)
    {
        return $this->request(self::HTTP_POST, "", $apikey);
    }
}
