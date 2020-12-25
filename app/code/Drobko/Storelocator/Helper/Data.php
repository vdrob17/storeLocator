<?php

namespace Drobko\Storelocator\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const DROBKO_STORELOCATOR_SETTINGS_GENERAL_ENABLED = "settings/general/enabled";
    const DROBKO_STORELOCATOR_SETTINGS_GENERAL_API = "settings/general/api";

    /**
     * @return ScopeConfigInterface
     */
    public function getStoreLocatorEnabled()
    {
        return $this->scopeConfig->getValue(self::DROBKO_STORELOCATOR_SETTINGS_GENERAL_ENABLED);
    }

    public function getStoreLocatorAPI()
    {
        return $this->scopeConfig->getValue(self::DROBKO_STORELOCATOR_SETTINGS_GENERAL_API);
    }

    public function getGeo($address)
    {
        // url encode the address
        $address = urlencode($address);
        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$this->getStoreLocatorAPI()}";
        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if ($resp['status'] == 'OK') {

            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";

            // verify if data is complete
            if ($lati && $longi) {

                // put the data in the array
                $data_arr = [];

                array_push(
                    $data_arr,
                    $lati,
                    $longi
                );
                return $data_arr;
            } else {
                return false;
            }
        } else {
            $this->_logger->error($resp['status']);
            return false;
        }
    }
}
