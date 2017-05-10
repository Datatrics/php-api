<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Content extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/content");
    }

    /**
     * Get one or multiple contents
     * @param string content id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($contentId = null, $args = array("limit" => 50, 'type' => 'item'))
    {
        if (is_null($contentId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$contentId, $args);
    }

    /**
     * Create new content
     * @param object Containing all the information of a content
     * @return object Result of the request
     */
    public function Create($content)
    {
        return $this->GetClient()->Post($this->GetUrl(), $content);
    }

    /**
     * Create new content
     * @param object Containing all the information of a content
     * @throws \Exception When contentid, source, type or itemtype is not present
     * @return object Result of the request
     */
    public function Update($content)
    {
        if (!isset($content['contentid'])) {
            throw new \Exception("content must contain a contentid");
        }
        if (!isset($content['source'])) {
            throw new \Exception("content must contain a source");
        }
        if (!isset($content['type'])) {
            throw new \Exception("content must contain a type");
        }
        if ($content['type'] == 'item') {
            if (!isset($content['itemtype'])) {
                throw new \Exception("content must contain a itemtype");
            }
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$content['contentid'], $content);
    }

    /**
     * Delete a content object by content id
     * @param string Id of the content
     * @return object Result of the request
     */
    public function Delete($contentId, $args = array('type' => 'item', 'itemtype' => 'product'))
    {
        if ($contentId) {
            if (!isset($args['source'])) {
                throw new \Exception('Source is required');
            }
            if (!isset($args['type'])) {
                throw new \Exception("Type is required");
            }
            if ($args['type'] == 'item') {
                if (!isset($args['itemtype'])) {
                    throw new \Exception("Itemtype is required");
                }
            }
        }
        return $this->GetClient()->Delete($this->GetUrl()."/".$contentId, $args);
    }

    /**
     * Updates a maximum of 50 content items at a time.
     * @param array Containing content items with a maximum of 50
     * @param string Containg type of content items, items or categories
     * @throws \Exception When more that 50 content items are provided
     * @return object Result of the request
     */
    public function Bulk($items, $type = 'items')
    {
        if (count($items) > 50) {
            throw new \Exception("Maximum of 50 content items allowed at a time");
        }

        return $this->GetClient()->Post($this->GetUrl()."/bulk", ['items' => $items, 'type' => $type]);
    }
}
