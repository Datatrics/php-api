<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Sale extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/sale");
    }

    /**
     * Get one or multiple sales
     * @param string sale id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($saleId = null, $args = array("limit" => 50))
    {
        if (is_null($saleId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$saleId, $args);
    }

    /**
     * Create new sale
     * @param object Containing all the information of a sale
     * @return object Result of the request
     */
    public function Create($sale)
    {
        return $this->GetClient()->Post($this->GetUrl(), $sale);
    }

    /**
     * Delete a sale object by sale id
     * @param string Id of the sale
     * @return object Result of the request
     */
    public function Delete($saleId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$saleId);
    }

    /**
     * Updates a maximum of 50 sale items at a time.
     * @param array Containing content items with a maximum of 50
     * @throws \Exception When more that 50 content items are provided
     * @return object Result of the request
     */
    public function Bulk($items)
    {
        if (count($items) > 50) {
            throw new \Exception("Maximum of 50 sale items allowed at a time");
        }

        return $this->GetClient()->Post($this->GetUrl()."/bulk", ['items' => $items]);
    }
}
