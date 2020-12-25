<?php

namespace Drobko\Storelocator\Model;

use Drobko\Storelocator\Api\Data\StoreLocatorInterface;
use Magento\Framework\Model\AbstractModel;

class StoreLocator extends AbstractModel implements StoreLocatorInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    protected $_eventPrefix = "store_locator";
    /**
     * Construct
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Drobko\Storelocator\Model\ResourceModel\StoreLocator::class);
    }

    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::STORE_ID);
    }
    /**
     * Get ID
     *
     * @return string;
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get Description
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }
    /**
     * Get Zip
     * @return string
     *
     */
    public function getZip()
    {
        return $this->getData(self::ZIP);
    }

    /**Get Country
     * @return string
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * Get State
     * @return string
     */
    public function getState()
    {
        return $this->getData(self::STATE);
    }

    /**
     * Get Address
     * @return string
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * Get City
     * @return string
     */
    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    /**
     * Get Timetable
     * @return string
     */
    public function getTimetable()
    {
        return $this->getData(self::TIMETABLE);
    }

    /**
     * Get Longitude
     * @return float
     */
    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * Get Latitude
     * @return float
     */
    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * Get is Visible
     * @return false|true
     */
    public function getIsVisible()
    {
        return $this->getData(self::VISIBLE);
    }

    /**Get Creation Time
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**Get Update Time
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**Set id
     * @param int $id
     * @return StoreLocatorInterface
     */
    public function setId($id)
    {
        return $this->setData(self::STORE_ID, $id);
    }
    /**
     * Set Name
     * @param string $name
     * @return StoreLocatorInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set Description
     * @param string $description
     * @return StoreLocatorInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @return string|void
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }
    /**Set ZIP
     * @param string $zip
     * @return StoreLocatorInterface
     */
    public function setZip($zip)
    {
        return $this->setData(self::ZIP, $zip);
    }

    /**Set Country
     * @param string $country
     * @return StoreLocatorInterface
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**Set State
     * @param string $state
     * @return StoreLocatorInterface
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }

    /**Set Address
     * @param string $address
     * @return StoreLocatorInterface
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**Set City
     * @param string $city
     * @return StoreLocatorInterface
     */
    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    /**Set Timetable
     * @param string $timetable
     * @return StoreLocatorInterface
     */
    public function setTimetable($timetable)
    {
        return $this->setData(self::TIMETABLE, $timetable);
    }

    /**Set Longitude
     * @param float $longitude
     * @return StoreLocatorInterface
     */
    public function setLongitude($longitude)
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

    /**Set Latitude
     * @param float $latitude
     * @return StoreLocatorInterface
     */
    public function setLatitude($latitude)
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    /**Set is Visible
     * @param true|false $isVisible
     * @return StoreLocatorInterface
     */
    public function setIsVisible($isVisible)
    {
        return $this->setData(self::VISIBLE, $isVisible);
    }

    /**Set Creation Time
     * @param string $creationTime
     * @return StoreLocatorInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**Set Update Time
     * @param string $updateTime
     * @return StoreLocatorInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }


}
