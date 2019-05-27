<?php


namespace ComposerIncludeFiles;


abstract class BaseCurrency implements Currency
{
    protected $baseCurrency = '';
    protected $currencyRates = array();

    /**
     * @return string
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * @param string $baseCurrency
     */
    public function setBaseCurrency($baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * @return array
     */
    public function getCurrencyRates()
    {
        return $this->currencyRates;
    }

    /**
     * @param array $currencyRates
     */
    public function setCurrencyRates($currencyRates)
    {
        $this->currencyRates = $currencyRates;
    }
}
