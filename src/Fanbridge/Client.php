<?php

namespace CampaignAmp\FanBridge;

use CampaignAmp\FanBridge\Request;

class Client
{
    /**
     * @var string
     */
    protected $baseApiUrl = 'https://api.fanbridge.com/v4';

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @return void
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->request = new Request();
    }

    /**
     * @param string $accessToken
     * @return self
     */
    public function setAccessToken($accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $endpoint
     * @return self
     */
    public function setEndpoint($endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return array
     */
    protected function get($endpoint, array $parameters = []): array
    {
        $parameters = array_merge($parameters, [
            'access_token' => $this->getAccessToken()
        ]);

        return $this->request
            ->get($endpoint, $parameters);
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return array
     */
    protected function post($endpoint, array $parameters = []): array
    {
        $parameters = array_merge($parameters, [
            'access_token' => $this->getAccessToken()
        ]);

        return $this->request
            ->post($endpoint, $parameters);
    }

    /**
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->baseApiUrl . '/login/oauth/authorize?client_id=' . $this->clientId;
    }

    /**
     * @param string $code
     * @return void
     */
    public function getOauthToken($code): void
    {
        $params = http_build_query([
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        ]);

        $response = $this->request
            ->get($this->baseApiUrl . '/login/oauth/access_token?' . $params);

        if ($response && isset($response['access_token'])) {

            $this->setAccessToken($response['access_token']);
        }
    }

}
