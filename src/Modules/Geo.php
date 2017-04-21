<?php
namespace Datatrics\API\Modules;

class Geo extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     */
    public function __construct($apikey)
    {
        parent::__construct($apikey, "/project/geo");
    }

    /**
     * Get addres based on ip addres
     * @param string ip
     * @return object Result of the request
     */
    public function Get($ip)
    {
        $args = ['ip' => $ip];
        $this->request(self::HTTP_GET, "?".http_build_query($args));
    }
}
