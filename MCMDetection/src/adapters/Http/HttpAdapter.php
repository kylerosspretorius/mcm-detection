<?php

namespace MCM\MCMDetection\Adapters\Http;

interface HttpAdapter
{
    public function post($endpoint, $payload);
    public function get($endpoint, $payload);
}