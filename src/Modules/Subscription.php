<?php
namespace Datatrics\API\Modules;

use Datatrics\API\Client;

class Subscription extends Base
{
    /**
     * Private constructor so only the client can create this
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        $this->SetUrl("/project/" . $this->GetClient()->GetProjectId() . "/subscription");
    }

    /**
     * Get one or multiple subscriptions
     * @param string subscription id, leave null for list of boxes
     * @param object Containing query arguments
     * @return object Result of the request
     */
    public function Get($subscriptionId = null)
    {
        if (is_null($subscriptionId)) {
            return $this->GetClient()->Get($this->GetUrl());
        }
        return $this->GetClient()->Get($this->GetUrl()."/".$subscriptionId);
    }

    /**
     * Create new subscription
     * @param object Containing all the information of a subscription
     * @return object Result of the request
     */
    public function Create($subscription)
    {
        return $this->GetClient()->Post($this->GetUrl(), $subscription);
    }

    /**
     * Create new subscription
     * @param id of the subscription
     * @param object Containing all the information of a subscription
     * @return object Result of the request
     */
    public function Update($subscription)
    {
        if (!isset($subscription['subscriptionid'])) {
            throw new \Exception('subscription must contain subscriptionid');
        }
        return $this->GetClient()->Put($this->GetUrl()."/".$subscription['subscriptionid'], $subscription);
    }

    /**
     * Delete a subscription object by subscription id
     * @param string Id of the subscription
     * @return object Result of the request
     */
    public function Delete($subscriptionId)
    {
        return $this->GetClient()->Delete($this->GetUrl()."/".$subscriptionId);
    }
}
