<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Card extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/card");
    }

    /**
     * Get one or multiple cards
     * @param string card id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($cardId = null, $args = array("limit" => 50))
    {
        if (is_null($cardId)) {
            return $this->GetClient()->Get($this->GetUrl(), $args);
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$cardId, $args);
    }

    /**
     * Create new card
     * @param object Containing all the information of a card
     * @return object Result of the request
     */
    public function Create($card)
    {
        return $this->GetClient()->Post($this->GetUrl(), $card);
    }

    /**
     * Update a card
     * @param object Containing all the information of a card
     * @return object Result of the request
     */
    public function Update($card)
    {
        if (!isset($card['cardid'])) {
            throw new \Exception("card must contain a cardid");
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$card['cardid'], $card);
    }
}
