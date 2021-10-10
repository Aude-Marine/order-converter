<?php

class Order {
    private $xmlOrders;

    public function setXmlOrders($xmlOrders) {
        $this->xmlOrders = $xmlOrders;
    }

    public function getXmlOrders() {
        return $this->xmlOrders;
    }
}

?>