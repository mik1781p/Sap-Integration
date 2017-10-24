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
        /**
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
    public function orderSAP(Varien_Event_Observer $event_Observer){
        $url = 'https://sandbox.api.sap.com/dq/addressCleanse';
        $request = array(
            "addressInput" => array(
            "street" => $event_Observer->getOrder()->getShippingAddress()->getStreet(),
            "locality"=> $event_Observer->getOrder()->getShippingAddress()->getCity(),
            "region"=> $event_Observer->getOrder()->getShippingAddress()->getRegion(),
            "postcode"=> $event_Observer->getOrder()->getShippingAddress()->getPostcode(),
            "country"=> $event_Observer->getOrder()->getShippingAddress()->getCountryId()
        ),
        "addressSettings" => array(
            "casing" => "mixed"
        ),
        "outputFields"=>array(
            "std_addr_address_delivery",
            "std_addr_locality",
            "std_addr_region",
            "std_addr_country_name",
            "addr_latitude",
            "addr_longitude",
            "addr_info_code_msg",
            "geo_info_code_msg"
        ));

        $this->sendCurlRequest($url,$request);

        /**
         * @param $url
         * @param $request
         * @return mixed
         */

    }

    private function sendCurlRequest($url, $request){
        $request = json_encode($request);

        $ch = curl_init($url);

        $options = array(
            CURLOPT_RETURNTRANSFER => false,         // return web page
            CURLOPT_HEADER         => false,        // don't return headers
            CURLOPT_FOLLOWLOCATION => false,         // follow redirects
            CURLOPT_ENCODING       => "utf-8",           // handle all encodings
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 100,          // timeout on connect
            CURLOPT_TIMEOUT        => 100,          // timeout on response
            CURLOPT_POST            => 1,            // i am sending post data
            CURLOPT_POSTFIELDS     => $request,    // this are my post vars
            CURLOPT_SSL_VERIFYPEER => false,        //
            CURLOPT_VERBOSE        => 1,
            CURLOPT_HTTPHEADER     => array(
                "APIKey: efGDg9BJN8G7AtpS5E2AifA4akVHeLSl",
                "Accept: application/json, text/plain",
                "Content-Type: application/json"
            )

        );

        curl_setopt_array($ch,$options);


        $data = curl_exec($ch);
        curl_close($ch);

        Mage::log($data);
    }
}
