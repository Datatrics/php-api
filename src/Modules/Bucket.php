<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Bucket extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/bucket");
    }

    /**
     * Get one or multiple buckets
     * @param string bucket id, leave null for list of buckets
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($bucketId = null, $args = array("limit" => 50))
    {
        if (is_null($bucketId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$bucketId, $args);
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
        if (is_null($objectId)) {
            return $this->GetClient()->Get($this->GetUrl()."/".$bucketId."/object", $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$bucketId."/object/".$objectId, $args);
    }

    /**
     * Create new bucket
     * @param object Containing all the information of a bucket
     * @return object Result of the request
     */
    public function Create($bucket)
    {
        return $this->GetClient()->Post($this->GetUrl(), $bucket);
    }

    /**
     * Create new bucket
     * @param string bucket id
     * @param object Containing all the information of a bucket
     * @return object Result of the request
     */
    public function CreateObject($bucketId, $object)
    {
        return $this->GetClient()->Post($this->GetUrl()."/".$bucketId."/object", $object);
    }

    /**
     * Delete a bucket object by bucket id
     * @param string Id of the bucket
     * @return object Result of the request
     */
    public function Delete($bucketId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$bucketId);
    }

    /**
     * List fields of a bucket
     * @param string Id of the bucket
     * @return object Result of the request
     */
    public function Fields($bucketId)
    {
        return $this->GetClient()->Get($this->GetUrl()."/".$bucketId."/fields");
    }

    /**
     * Updates a maximum of 50 object at a time
     * @param array Containing objects with a maximum of 50
     * @throws \Exception When more that 50 objects are provided
     * @return object Result of the request
     */
    public function Bulk($bucketId, $items)
    {
        if (count($items) > 50) {
            throw new \Exception("Maximum of 50 content items allowed at a time");
        }
        return $this->GetClient()->Post($this->GetUrl()."/".$bucketId."/object/bulk", ['items' => $items]);
    }
}
