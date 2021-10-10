<?php
    require_once('ExchangeRate.php');
    require_once('Orders.php');

    $xmlOrders = simplexml_load_file("Orders.xml") or die("Error: Cannot create object");
    $xmlExchangeRates = simplexml_load_file("ExchangeRates.xml") or die("Error: Cannot create object");

    if(isset($xmlExchangeRates) && !empty($xmlExchangeRates) && isset($xmlExchangeRates->currency) && !empty($xmlExchangeRates->currency)) {

        $currencyExchangeRatesGBP = new ExchangeRate();
        $currencyExchangeRatesEUR = new ExchangeRate();
        
        $currencyExchangeRatesGBP->loadCurrency($xmlExchangeRates);
        $currencyExchangeRatesEUR->loadCurrency($xmlExchangeRates);

        $order = new Order();

        $order->setXmlOrders($xmlOrders);
        $order->convert($currencyExchangeRatesGBP,$currencyExchangeRatesEUR);

    } else { 
        print "There's no exchange rates."; 
    }

?>