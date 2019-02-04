<?php

namespace CampaignAmp\FanBridge;

use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\ResponseInterface;

class Response
{
    /**
     * @var array
     */
    protected $body;

    /**
     * @param ResponseInterface $response
     * @return array
     */
    public function __construct(ResponseInterface $response)
    {
        $this->setBody(json_decode($response->getBody()->getContents(), true));
    }

    /**
     * @param string $body
     * @return self
     */
    public function setBody($body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

}
