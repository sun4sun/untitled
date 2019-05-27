<?php


namespace ComposerIncludeFiles;

/**
 * Interface Currency
 * @package ComposerIncludeFiles
 */
interface Currency
{
    /**
     * @return void
     */
    public function setCurrencyFromProvider();

    /**
     * @return array
     * @throws \Exception
     */
    public function getCurrency();
}
