<?php

class ExchangeRate {
    private $currencyArray;

    public function addCurrencyArray($currencyArray) {
        if(!isset($this->currencyArray)){
            $this->currencyArray = [];
        }
        $this->currencyArray[] = $currencyArray;
    }

    public function getCurrencyArray() {
        return $this->currencyArray;
    }

    public function setCurrencyArray($currencyArray) {
        $this->currencyArray = $currencyArray;
    }
}

?>