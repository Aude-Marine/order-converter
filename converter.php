<?php
    require_once('ExchangeRate.php');
    require_once('Orders.php');

    $xmlOrders = simplexml_load_file("Orders.xml") or die("Error: Cannot create object");

    $xmlExchangeRates = simplexml_load_file("ExchangeRates.xml") or die("Error: Cannot create object");

    $order = new Order();
    $order->setXmlOrders($xmlOrders);

?>