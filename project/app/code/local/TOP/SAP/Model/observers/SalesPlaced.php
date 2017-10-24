<?php

class TOP_SAP_Model_observers_SalesPlaced extends Mage_Core_Model_Session_Abstract
{
    public function orderSAP(Varien_Event_Observer $event_Observer)
    {
        Mage::log($event_Observer->getOrder()->getData());
        //TODO do it!
    }
}
