<?php

namespace Components\Services;

use GuzzleHttp\Client as GuzzleHttpClient;
use Components\Exceptions\HttpRequestException;

class GenericRequest
{
    const HEADER_PAGE = 'X-GET-PAGE';
    const HEADER_MAX_RESULTS = 'X-MAX-RESULTS';

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $agentName = 'DEFAULT';

    /**
     * @var GuzzleHttpClient
     */
    private $httpClient;

    /**
     * DwApiRequest constructor.
     *
     * @param string $url
     * @param string $token
     * @param string $agentName
     */
    public function __construct($url, $token, $agentName)
    {
        $this->httpClient = new GuzzleHttpClient();
        $this->url = rtrim($url, '/').'/';
        $this->token = $token;
        $this->agentName = $agentName;
    }


    /**
     * Do a generic [GET] Request server
     *
     * @param string $endpoint
     * @param array $payload
     * @param int $page
     * @param null||int $maxResults
     * @return array
     */
    public function doPostRequest($endpoint, array $payload = [], $page = 1, $maxResults = null)
    {
        if (!is_integer($page) || $page < 1) {
            throw new \InvalidArgumentException('Parameter page should be a value greater than 1');
        }

        if (null !== $maxResults && (!is_integer($maxResults) || $maxResults < 1)) {
            throw new \InvalidArgumentException('Parameter maxResults should be a value greater than 1 or null');
        }

        $response = $this->httpClient->request(
            'POST',
            $this->url.$endpoint,
            [
                'headers' => [
                    'User-Agent' => 'BOOTSTRAP-API-CLIENT-'.$this->agentName,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json; charset=utf-8',
                    'X-AUTH-TOKEN' => $this->token,
                    self::HEADER_PAGE => ($page - 1),
                    self::HEADER_MAX_RESULTS => $maxResults,
                ],
                'body' => json_encode($payload),
            ]
        );

        $result = $response->getBody()->getContents();
        if (200 !== $response->getStatusCode()) {
            throw new HttpRequestException('There was a problem with your request.');
        }

        return json_decode($result);
    }
}
