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

    public function loadCurrency($xmlExchangeRates) {
        foreach($xmlExchangeRates->currency as $currency){
            $currencyArray = null;
            foreach($currency->rateHistory->rates as $rates) {
                $currencyRateValue = "";
                foreach ($rates as $rate) {
                    foreach($rate->attributes() as $a => $b) {
                        if($b!="EUR" && $b!="GBP" && $b!="1") {
                            $currencyRateValue = $b;
                        }
                    }
                    $currencyArray = [
                        'date' => $rates['date'],
                        'rate' =>$currencyRateValue,
                    ];
                }
                if($currency->code=="GBP") {
                    $this->addCurrencyArray($currencyArray);
                } else {
                    $this->addCurrencyArray($currencyArray);
                }
            }
        }    
    }
}

?>