<?php
namespace Datatrics\API\Modules;

class Content extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/content");
    }

    /**
     * Get one or multiple contents
     * @param string content id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($contentId = null, $args = array("limit" => 50, 'type' => 'item', 'itemtype' => 'product'))
    {
        if ($contentId) {
            if (!isset($args['source'])) {
                throw new \Exception('Source is required');
            }
        }
        return $contentId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$contentId."?".http_build_query($args));
    }

    /**
     * Create new content
     * @param object Containing all the information of a content
     * @return object Result of the request
     */
    public function Create($content)
    {
        return $this->request(self::HTTP_POST, "", $content);
    }

    /**
     * Create new content
     * @param id of the content
     * @param object Containing all the information of a content
     * @return object Result of the request
     */
    public function Update($contentId, $content)
    {
        return $this->request(self::HTTP_PUT, "/".$contentId, $content);
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
        }
        return $this->request(self::HTTP_DELETE, "/".$contentId."?".http_build_query($args));
    }

    /**
     * Updates a maximum of 50 content items at a time.
     * @param array Containing content items with a maximum of 50
     * @throws \Exception When more that 50 content items are provided
     * @return object Result of the request
     */
    public function UpdateBulk($items)
    {
        if (count($items) > 50) {
            throw new \Exception("Maximum of 50 content items allowed at a time");
        }

        return $this->request(self::HTTP_POST, "/bulk", ['items' => $items]);
    }
}
