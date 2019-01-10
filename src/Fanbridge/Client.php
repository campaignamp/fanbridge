<?php

namespace CampaignAmp\Fanbridge;

use CampaignAmp\Fanbridge\Request;

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
        return $this->request
            ->post($endpoint, $parameters);
    }

    /**
     * @param string $clientId
     * @return array
     */
    public function authorise($clientId): array
    {
        //
    }

}
