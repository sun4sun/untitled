<?php


namespace ComposerIncludeFiles;


use GuzzleHttp\Client;

class SimpleCurrencyProvider extends BaseCurrency
{
    private $client;
    private $response;
    private $uri;

    /**
     * EuropeanCentralBank constructor.
     * @param $uri
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->client = new Client();
        $res = $this->client->request('GET', $uri);
        $this->response = json_decode($res->getBody());
        //var_dump($this->response);
    }

    public function setCurrencyFromProvider() : void
    {
        $this->baseCurrency = $this->response->base;
        $this->currencyRates = $this->response->rates;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCurrency() : array
    {
        if ($this->baseCurrency && $this->currencyRates) {
            return [
                "base" => $this->baseCurrency,
                "rates" => $this->currencyRates
            ];
        } else
            throw new \Exception("Check provider request conditions", 500);
    }
}
