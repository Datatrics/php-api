<?php
namespace Datatrics\API\Modules;

class Sale extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/sale");
    }

    /**
     * Get one or multiple sales
     * @param string sale id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($saleId = null, $args = array("limit" => 50))
    {
        return $saleId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$saleId."?".http_build_query($args));
    }

    /**
     * Create new sale
     * @param object Containing all the information of a sale
     * @return object Result of the request
     */
    public function Create($sale)
    {
        return $this->request(self::HTTP_POST, "", $sale);
    }

    /**
     * Delete a sale object by sale id
     * @param string Id of the sale
     * @return object Result of the request
     */
    public function Delete($saleId)
    {
        return $this->request(self::HTTP_DELETE, "/".$saleId);
    }

    /**
     * Updates a maximum of 50 sale items at a time.
     * @param array Containing content items with a maximum of 50
     * @throws \Exception When more that 50 content items are provided
     * @return object Result of the request
     */
    public function UpdateBulk($items)
    {
        if (count($items) > 50) {
            throw new \Exception("Maximum of 50 sale items allowed at a time");
        }

        return $this->request(self::HTTP_POST, "/bulk", ['items' => $items]);
    }
}
