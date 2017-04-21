<?php
namespace Datatrics\API\Modules;

class Bucket extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/bucket");
    }

    /**
     * Get one or multiple buckets
     * @param string bucket id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($bucketId = null, $args = array("limit" => 50))
    {
        return $bucketId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$bucketId."?".http_build_query($args));
    }

    /**
     * Create new bucket
     * @param object Containing all the information of a bucket
     * @return object Result of the request
     */
    public function Create($bucket)
    {
        return $this->request(self::HTTP_POST, "", $bucket);
    }

    /**
     * Delete a bucket object by bucket id
     * @param string Id of the bucket
     * @return object Result of the request
     */
    public function Delete($bucketId)
    {
        return $this->request(self::HTTP_DELETE, "/".$bucketId);
    }

    /**
     * List fields of a bucket
     * @param string Id of the bucket
     * @return object Result of the request
     */
    public function Fields($bucketId)
    {
        return $this->request(self::HTTP_GET, "/".$bucketId."/fields");
    }
}
