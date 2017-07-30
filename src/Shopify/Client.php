<?php

namespace Shopify;

class Client
{
    protected $apiKey;
    protected $secretKey;
    protected $url;

    protected $password;

    protected $authUrl;

    public function __construct()
    {
        $this->authUrl = 'https://' . $this->apiKey . ':' . $this->password . '@' . $this->url . '/';
    }
}