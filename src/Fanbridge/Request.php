<?php

namespace CampaignAmp\FanBridge;

use Fanbridge\Response;
use GuzzleHttp\Client as Guzzle;

class Request
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_NOT_FOUND = 404;
    const HTTP_STATUS_SERVER_ERROR = 500;

    /**
     * @var GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->guzzle = new Guzzle();
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return Response
     */
    protected function get($endpoint, array $parameters = []): Response
    {
        $response = $this->guzzle
            ->request('GET', $endpoint, $parameters);

        return new Response($response);
    }

}
