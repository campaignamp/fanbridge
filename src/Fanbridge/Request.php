<?php

namespace CampaignAmp\FanBridge;

use CampaignAmp\FanBridge\Response;
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
    public function get($endpoint, array $parameters = []): Response
    {
        $response = $this->guzzle
            ->request('GET', $endpoint, [
                    'query' =>$parameters
                ]
            );

        return new Response($response);
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return Response
     */
    public function post($endpoint, array $parameters = []): Response
    {
        $response = $this->guzzle
            ->request('POST', $endpoint, [
                'form_params' => $parameters
            ]);

        return new Response($response);
    }

}
