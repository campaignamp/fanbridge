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
     * @param array $parameters
     * @return array
     */
    public function get($endpoint, array $parameters = []): array
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
    public function post($endpoint, array $parameters = []): array
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
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $code
        ]);

        $response = $this->request
            ->post($this->baseApiUrl . '/login/oauth/access_token?' . $params);

        if ($response && $body = $response->getBody()) {

            $this->setAccessToken($body['access_token']);
        }
    }

}
