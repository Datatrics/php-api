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
     * @param string bucket id, leave null for list of buckets
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($bucketId = null, $args = array("limit" => 50))
    {
        return $bucketId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$bucketId."?".http_build_query($args));
    }

    /**
     * Get one or multiple buckets
     * @param string bucket id
     * @param string object id, leave null for list of objects
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function GetObject($bucketId, $objectId, $args = array("limit" => 50))
    {
        return $objectId == null ? $this->request(self::HTTP_GET, "/".$bucketId."/object?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$bucketId."/object/".$objectId."?".http_build_query($args));
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
     * Create new bucket
     * @param string bucket id
     * @param object Containing all the information of a bucket
     * @return object Result of the request
     */
    public function CreateObject($bucketId, $object)
    {
        return $this->request(self::HTTP_POST, "/".$bucketId."/object", $object);
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

    /**
     * Updates a maximum of 50 object at a time
     * @param array Containing objects with a maximum of 50
     * @throws \Exception When more that 50 objects are provided
     * @return object Result of the request
     */
    public function UpdateBulk($bucketId, $items)
    {
        if (count($items) > 50) {
            throw new \Exception("Maximum of 50 content items allowed at a time");
        }

        return $this->request(self::HTTP_POST, "/".$bucketId."/object/bulk", ['items' => $items]);
    }
}
