<?php
namespace Datatrics\API\Modules;

class Card extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param string $apikey
     * @param string $projectid
     */
    public function __construct($apikey, $projectid)
    {
        parent::__construct($apikey, "/project/" . $projectid . "/card");
    }

    /**
     * Get one or multiple cards
     * @param string card id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($cardId = null, $args = array("limit" => 50))
    {
        return $cardId == null ? $this->request(self::HTTP_GET, "?".http_build_query($args)) : $this->request(self::HTTP_GET, "/".$cardId."?".http_build_query($args));
    }

    /**
     * Create new card
     * @param object Containing all the information of a card
     * @return object Result of the request
     */
    public function Create($card)
    {
        return $this->request(self::HTTP_POST, "", $card);
    }

    /**
     * Create new card
     * @param id of the card
     * @param object Containing all the information of a card
     * @return object Result of the request
     */
    public function Update($cardId, $card)
    {
        return $this->request(self::HTTP_PUT, "/".$cardId, $card);
    }
}
