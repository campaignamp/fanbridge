<?php

namespace CampaignAmp\FanBridge;

use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\ResponseInterface;

class Response
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param ResponseInterface $response
     * @return array
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->response->getBody()->getContents();
    }

    /**
     * @return array
     */
    public function getBodyAsArray(): array
    {
        return json_decode($this->getBody(), true);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

}
