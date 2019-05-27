<?php


namespace ComposerIncludeFiles;


interface Currency
{
    public function setCurrencyFromProvider();
    public function getCurrency();
}
