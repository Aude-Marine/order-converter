<?php

class Order {

    private $xmlOrders;
    private $filename = "Converted orders.xml";

    public function setXmlOrders($xmlOrders) {
        $this->xmlOrders = $xmlOrders;
    }

    public function getXmlOrders() {
        return $this->xmlOrders;
    }

    public function printXML(){
        header('Content-type: text/xml');
        echo $this->xmlOrders->asXML();
    }

    public function saveXML(){
        $this->xmlOrders->asXML($this->filename);
    }

    public function convert($currencyExchangeRatesGBP,$currencyExchangeRatesEUR) {

        $xmlOrders = $this->xmlOrders;

        if(isset($xmlOrders) && !empty($xmlOrders) && isset($xmlOrders->order) && !empty($xmlOrders->order)) {
            foreach($xmlOrders->order as $order) {
                //Applying exchange rates on the totals
                $orderDate = ((string)$order->date);
                $currencyRate = 0;

                if($order->currency=="GBP") {
                    $ratesGBP = $currencyExchangeRatesGBP->getCurrencyArray();
                    foreach($ratesGBP as $currentExchangeRate) {
                        if($currentExchangeRate['date']==$orderDate) {
                            $order->total = round($order->total*(float)$currentExchangeRate['rate'],2);
                            $currencyRate = (float)$currentExchangeRate['rate'];
                        }
                    }
                //var_dump($currencyRate);exit;
                } else {
                    $ratesEUR = $currencyExchangeRatesEUR->getCurrencyArray();
                    foreach($ratesEUR as $currentExchangeRate) {
                        if($currentExchangeRate['date']==$orderDate) {
                            $order->total = round($order->total*(float)$currentExchangeRate['rate'],2);
                            $currencyRate = (float)$currentExchangeRate['rate'];
                        }
                    }
                }
                //Applying exchange rates to the product's amounts 
                if(isset($order->products) && !empty($order->products)) {
                    foreach($order->products as $products) {
                        foreach($products as $product) {
                            $product['price'] = round($product['price']*$currencyRate,2);
                        }
                    }
                }
                //Changing the currency value
                if($order->currency=="GBP") {
                    $order->currency = "EUR";
                } else {
                    $order->currency = "GBP";
                }
            }
        } else { 
            print "Unfortunately, there's no orders."; 
        }
    }
}

?>