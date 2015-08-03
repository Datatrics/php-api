<?php

/*
 * This file is part of the Datatrics package.
 *
 * (c) Datatrics
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datatrics\Api;

/*
 * Api component
 *
 * @author Nico Borghuis <nico@datatrics.com>
 * @author Bas Nieland <bas@datatrics.com>
 * @author Pepijn Yben <pepijn@datatrics.com>
 */
class Api
{
    /**
     * The allowed HTTP Methods.
     *
     * @var array
     */
    private $allowedMethods = array('GET','POST');

    /**
     * The url of the API.
     *
     * @var string
     */
    private $url = 'https://api.datatrics.com';

    /**
     * The version of the API.
     *
     * @var float
     */
    private $version = 1.1;

    /**
     * The API key.
     *
     * @var string
     */
    private $apiKey;

    /**
     * The API will use this as the default project id.
     *
     * @var string
     */
    private $projectId;

    /**
     * Create a new API instance.
     *
     * @param string $apiKey
     * @param string $projectId
     */
    public function __construct($apiKey, $projectId = null)
    {
        $this->setApiKey($apiKey);
        $this->setProjectId($projectId);
    }

    /**
     * Get the endpoint.
     *
     * @param string $method
     * @param string $action
     * @param array  $query
     *
     * @return string
     *
     * @throws \Exception
     */
    private function getEndpoint($method, $action, $query = null)
    {
        if (is_null($query)) {
            return $this->url.'/'.$this->version.'/'.$method.'/'.$action;
        }
        if (is_array($query)) {
            return $this->url.'/'.$this->version.'/'.$method.'/'.$action.'?'.http_build_query($query);
        }
        throw new \Exception('The given query is not an array');
    }

    /**
     * Do the request to the API.
     *
     * @param string $url
     * @param array  $opts
     * @param string $httpMethod
     *
     * @return mixed
     *
     * @throws \Exception
     */
    private function request($url, $opts = array(), $httpMethod = 'GET')
    {
        if (!in_array($httpMethod, $this->allowedMethods)) {
            throw new \Exception('Method not allowed');
        }

        $opts[CURLOPT_URL] = $url;
        $opts[CURLOPT_TIMEOUT] = 100;
        $opts[CURLOPT_USERAGENT] = 'Datatrics/API '.$this->version;
        $opts[CURLOPT_SSL_VERIFYPEER] = true;
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            $message = curl_error($ch);
            $code = curl_errno($ch);
            curl_close($ch);
            throw new \Exception($message, $code);
        } else {
            $info = curl_getinfo($ch);
            curl_close($ch);
            if ($info['http_code'] >= 200 && $info['http_code'] < 300) {
                return json_decode($data, true);
            } else {
                throw new \Exception('HTTP Error', $info['http_code']);
            }
        }

        return;
    }

    /**
     * Do the get request.
     *
     * @param string $method
     * @param string $action
     * @param array  $query
     *
     * @return array
     *
     * @throws \Exception
     */
    public function GET($method, $action, $query = array())
    {
        if (!isset($query['projectid']) && !is_null($this->projectId)) {
            $query['projectid'] = $this->getProjectId();
        }

        $query['apikey'] = $this->getApiKey();
        $url = $this->getEndpoint($method, $action, $query);
        $opts = array();

        return $this->request($url, $opts, 'GET');
    }

    /**
     * Do the post request.
     *
     * @param string $method
     * @param string $action
     * @param array  $query
     *
     * @return array
     *
     * @throws \Exception
     */
    public function POST($method, $action, $query = array())
    {
        if (!isset($query['projectid']) && !is_null($this->projectId)) {
            $query['projectid'] = $this->getProjectId();
        }

        $query['apikey'] = $this->getApiKey();
        $url = $this->getEndpoint($method, $action);
        $opts = array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($query),
        );

        return $this->request($url, $opts, 'POST');
    }

    /**
     * Get the apiKey.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getApiKey()
    {
        if (is_null($this->apiKey)) {
            throw new \Exception('Apikey required');
        }

        return $this->apiKey;
    }

    /**
     * Set the apiKey.
     *
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get the default project id.
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set the default project id.
     *
     * @param string $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }
}
