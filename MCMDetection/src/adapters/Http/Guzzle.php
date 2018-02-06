<?php

namespace MCM\MCMDetection\Adapters\Http;


use GuzzleHttp\Client as GuzzleClient;

class Guzzle extends GuzzleClient implements HttpAdapter
{
    public function post($endpoint, $payload)
    {
        parent::__construct([
            'base_uri' => $endpoint,
        ]);

        $res = $this->request('POST', null, [
            'body' => $payload,
            'headers' => ['User-Agent' => 'Hyve Guzzle', 'Content-Type' => 'text/xml'],
            'verify' => false,
        ]);

        return simplexml_load_string($res->getBody()->getContents());
    }

    public function get($endpoint, $payload) {
        parent::__construct([
            'base_uri' => $endpoint,
        ]);

        $res = $this->request('GET', null, [
            'form_params' => $payload,
            'headers' => ['User-Agent' => 'Hyve Guzzle'],
            'verify' => false,
        ]);

        return $res;
    }
}