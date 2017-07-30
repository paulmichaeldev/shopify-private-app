<?php

namespace pmingram\Shopify;

use GuzzleHttp\Client as GuzzleClient;

class ShopifyClient
{
    protected $apiKey;
    protected $secretKey;
    protected $url;

    protected $password;

    protected $authUrl;

    public function __construct($apiKey, $secretKey, $url, $password)
    {
        $this->apiKey = $apiKey;
        $this->secretKey = $secretKey;
        $this->url = $url;
        $this->password = $password;

        $this->authUrl = 'https://' . $this->apiKey . ':' . $this->password . '@' . $this->url . '/';
    }

    public function call($url, $method = 'GET', $payload = [])
    {
        $url = $this->authUrl . $url;

        try {
            // Attempt to send the payload to Shopify
            $guzzleClient = new GuzzleClient;
            $guzzleRequest = $guzzleClient->request($method, $url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($payload),
            ]);

        } catch (\Exception $e) {
            // Log error and return false;
            \Log::error($e->getMessage());
            return false;

        }

        return $guzzleRequest->getBody()->getContents();
    }
}