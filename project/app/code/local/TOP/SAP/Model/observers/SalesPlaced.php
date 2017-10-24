<?php

/**
 * Class TOP_SAP_Model_observers_SalesPlaced
 */

/**
 * Class TOP_SAP_Model_observers_SalesPlaced
 * Observer on sales_order_place_after
 */

class TOP_SAP_Model_observers_SalesPlaced extends Mage_Core_Model_Session_Abstract
{
    public function orderSAP(Varien_Event_Observer $event_Observer)
    {
        /*
         * Example data
            2017-10-24T10:23:19+00:00 DEBUG (7): Street:
            2017-10-24T10:23:19+00:00 DEBUG (7): Array
            (
                [0] => Via di test
            )

            2017-10-24T10:23:19+00:00 DEBUG (7): City:
            2017-10-24T10:23:19+00:00 DEBUG (7): Città test

            2017-10-24T10:23:19+00:00 DEBUG (7): PostCode:
            2017-10-24T10:23:19+00:00 DEBUG (7): Ancora test

            2017-10-24T10:23:19+00:00 DEBUG (7): Region:
            2017-10-24T10:23:19+00:00 DEBUG (7): null || Il test dei test

            2017-10-24T10:23:19+00:00 DEBUG (7): Country:
            2017-10-24T10:23:19+00:00 DEBUG (7): IT

         */
        Mage::log('Street: ');
        Mage::log($event_Observer->getOrder()->getShippingAddress()->getStreet());
        Mage::log('City: ');
        Mage::log($event_Observer->getOrder()->getShippingAddress()->getCity());
        Mage::log('PostCode: ');
        Mage::log($event_Observer->getOrder()->getShippingAddress()->getPostcode());
        Mage::log('Region: ');
        Mage::log($event_Observer->getOrder()->getShippingAddress()->getRegion());
        Mage::log('Country: ');
        Mage::log($event_Observer->getOrder()->getShippingAddress()->getCountryId());
        die;
        //TODO cURL it!
    }
}
