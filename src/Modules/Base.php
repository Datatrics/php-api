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
    public function getApiEndpoint()
    {
        return $this->api_endpoint;
    }

    /**
     * @param string $api_endpoint
     * @return Base
     */
    public function setApiEndpoint($api_endpoint)
    {
        $this->api_endpoint = $api_endpoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param string $api_key
     * @return Base
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        return $this;
    }



    /**
     * Perform an http call. This method is used by the resource specific classes.
     *
     * @param $http_method
     * @param $api_method
     * @param $http_body
     *
     * @return string
     *
     * @throws \Exception
     */
    public function request($http_method, $api_method, $http_body = null)
    {
        if (empty($this->api_key)) {
            throw new \Exception('You have not set an api key. Please use setApiKey() to set the API key.');
        }
        $url = $this->api_endpoint.$api_method;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $user_agent = 'Datatrics Frontend '.self::CLIENT_VERSION;
        $request_headers = array(
            'Accept: application/json',
            'User-Agent: '.$user_agent,
            'X-apikey: '.$this->api_key,
            'X-Client-Name: '.$user_agent,
            'X-Datatrics-Client-Info: '.php_uname(),
        );
        if ($http_body !== null) {
            $request_headers[] = 'Content-Type: application/json';
            if ($http_method == self::HTTP_POST) {
                curl_setopt($ch, CURLOPT_POST, 1);
            } elseif ($http_method == self::HTTP_PUT) {
                curl_setopt($ch, CURLOPT_PUT, 1);
            } else {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_method);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $http_body);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        $body = curl_exec($ch);
        if (curl_errno($ch) == CURLE_SSL_CACERT || curl_errno($ch) == CURLE_SSL_PEER_CERTIFICATE || curl_errno($ch) == 77 /* CURLE_SSL_CACERT_BADFILE (constant not defined in PHP though) */) {
            /*
             * On some servers, the list of installed certificates is outdated or not present at all (the ca-bundle.crt
             * is not installed). So we tell cURL which certificates we trust. Then we retry the requests.
             */
            $request_headers[] = 'X-Datatrics-Debug: used shipped root certificates';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
            curl_setopt($ch, CURLOPT_CAINFO, realpath(dirname(__FILE__).'/cacert.pem'));
            $body = curl_exec($ch);
        }
        if (strpos(curl_error($ch), "certificate subject name 'mollie.nl' does not match target host") !== false) {
            /*
             * On some servers, the wildcard SSL certificate is not processed correctly. This happens with OpenSSL 0.9.7
             * from 2003.
             */
            $request_headers[] = 'X-Datatrics-Debug: old OpenSSL found';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            $body = curl_exec($ch);
        }
        if (curl_errno($ch)) {
            throw new \Exception('Unable to communicate with Datatrics ('.curl_errno($ch).'): '.curl_error($ch));
        }
        
        return json_decode($body);
    }
}
