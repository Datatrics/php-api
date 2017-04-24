<?php
namespace Datatrics\API\Modules;

class Base
{
    const CLIENT_VERSION = '2.0.0';

    const HTTP_GET = 'GET';
    const HTTP_POST = 'POST';
    const HTTP_PUT = 'PUT';
    const HTTP_DELETE = 'DELETE';

    /**
     * @var string
     */
    protected $api_endpoint = 'https://api.datatrics.com/2.0';

    /**
     * @var string
     */
    protected $api_key;

    /**
     * Base constructor.
     * @param $apikey
     * @param $endpoint
     */
    public function __construct($apikey, $endpoint)
    {
        $this->api_key = $apikey;
        $this->api_endpoint .= $endpoint;
    }

    /**
     * @return string
     */
    protected function getApiEndpoint()
    {
        return $this->api_endpoint;
    }

    /**
     * @param string $api_endpoint
     * @return Base
     */
    protected function setApiEndpoint($api_endpoint)
    {
        $this->api_endpoint = $api_endpoint;
        return $this;
    }

    /**
     * @return string
     */
    protected function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param string $api_key
     * @return Base
     */
    protected function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function checkApiKey()
    {
        if (empty($this->api_key)) {
            throw new \Exception('You have not set an api key. Please use setApiKey() to set the API key.');
        }
    }

    /**
     * @param $url
     * @param null|array $payload
     * @return string
     */
    public function getUrl($url, $payload = null)
    {
        $url = $this->api_endpoint.$url;
        if ($payload) {
            $url .= "?".http_build_query($payload);
        }
        return $url;
    }

    /**
     * @param int   $responseCode
     * @param array $responseBody
     *
     * @throws \Exception
     */
    private function handleResponseError($responseCode, $responseBody)
    {
        $errorMessage = 'Unknown error: ' . $responseCode;

        if ($responseBody && array_key_exists('error', $responseBody)) {
            $errorMessage = $responseBody['error']['message'];
        }
        if ($responseBody && array_key_exists('message', $responseBody)) {
            $errorMessage = $responseBody['message'];
        }


        throw new \Exception($errorMessage, $responseCode);
    }

    /**
     * @param resource $curlHandle
     *
     * @throws \Exception
     */
    private function handleCurlError($curlHandle)
    {
        $errorMessage = 'Curl error: ' . curl_error($curlHandle);

        throw new \Exception($errorMessage, curl_errno($curlHandle));
    }

    /**
     * Perform an http call. This method is used by the resource specific classes.
     *
     * @param $method
     * @param $url
     * @param $payload
     *
     * @return string|object
     *
     * @throws \Exception
     */
    public function request($method, $url, $payload = null)
    {
        $this->checkApiKey();

        $user_agent = 'Datatrics php-api '.self::CLIENT_VERSION;
        $request_headers = array(
            'Accept: application/json',
            'X-apikey: '.$this->api_key,
            'X-client-name: '.$user_agent,
            'X-datatrics-client-info: '.php_uname(),
        );

        if ($method == 'post' || $method == 'put') {
            if (!$payload || !is_array($payload)) {
                throw new \Exception('Invalid payload', 100);
            }
            $request_headers['Content-Type'] = 'application/json';
            $curlOptions = array(
                CURLOPT_URL           => $this->getUrl($url),
                CURLOPT_CUSTOMREQUEST => strtoupper($method),
                CURLOPT_POSTFIELDS    => json_encode($payload),
            );
        } elseif ($method == 'delete') {
            $curlOptions = array(
                CURLOPT_URL           => $this->getUrl($url),
                CURLOPT_CUSTOMREQUEST => 'DELETE',
            );
        } else {
            $curlOptions = array(
                CURLOPT_URL => $this->getUrl($url, $payload),
            );
        }

        $curlOptions += array(
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT      => $user_agent,
            CURLOPT_SSLVERSION     => 6,
            CURLOPT_HTTPHEADER     => $request_headers
        );

        $curlHandle = curl_init();

        curl_setopt_array($curlHandle, $curlOptions);

        $responseBody = curl_exec($curlHandle);

        if (curl_errno($curlHandle)) {
            $this->handleCurlError($curlHandle);
        }

        $responseBody = json_decode($responseBody, true);
        $responseCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

        curl_close($curlHandle);


        if ($responseCode < 200 || $responseCode > 299 || ($responseBody && array_key_exists('error', $responseBody))) {
            $this->handleResponseError($responseCode, $responseBody);
        }
        if ($responseCode < 200 || $responseCode > 299 || ($responseBody && array_key_exists('message', $responseBody))) {
            $this->handleResponseError($responseCode, $responseBody);
        }

        return $responseBody;
    }
}
