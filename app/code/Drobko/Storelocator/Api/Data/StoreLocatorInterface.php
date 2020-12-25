<?php

namespace Drobko\Storelocator\Api\Data;


interface StoreLocatorInterface
{
    const STORE_ID = 'store_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const IMAGE = 'image';
    const ZIP = 'zip';
    const COUNTRY = 'country';
    const STATE = 'state';
    const ADDRESS = 'address';
    const CITY = 'city';
    const TIMETABLE = 'timetable';
    const LONGITUDE = 'longitude';
    const LATITUDE = 'latitude';
    const VISIBLE = 'visible';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';

    /**
     * Get ID
     *
     * @return int;
     */
    public function getId();

    /**
     * Get store name
     * @return string;
     */
    public function getName();

    /**
     *  Get Description
     * @return string;
     */
    public function getDescription();

    /**
     * Get Image
     * @return string
     */
    public function getImage();

    /**
     * get ZIP
     * @return string|null
     */
    public function getZip();

    /**
     * Get Country
     * @return string
     */
    public function getCountry();

    /**
     * Get State
     * @return string|null
     */
    public function getState();

    /**
     * Get address
     * @return string
     */
    public function getAddress();

    /**
     * Get city
     * @return string
     */
    public function getCity();

    /**
     * Get Timetable
     * @return string
     */
    public function getTimetable();

    /**
     * Get Longitude
     * @return float
     */
    public function getLongitude();

    /**
     * Get Latitude
     * @return float
     */
    public function getLatitude();

    /**
     * Get isVisible
     * @return true|false
     */
    public function getIsVisible();

    /**
     * Get Creation time
     * @return string|null;
     */
    public function getCreationTime();

    /**
     * Get update time
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * @param $id
     * @return int
     * Set ID
     */
    public function setId($id);

    /**
     * @param $name
     * @return StoreLocatorInterface
     * Set store name
     */
    public function setName($name);

    /**
     * @param string $description
     * @return StoreLocatorInterface
     * Set Description
     */
    public function setDescription($description);

    /**Set Image
     * @param $image
     * @return StoreLocatorInterface
     */
    public function setImage($image);
    /**
     * Set ZIP
     * @param string $zip
     * @return StoreLocatorInterface
     */
    public function setZip($zip);

    /**
     * Set Country
     * @param string $country
     * @return StoreLocatorInterface
     */
    public function setCountry($country);

    /**
     * Set State
     * @param string $state
     * @return StoreLocatorInterface
     */
    public function setState($state);

    /**
     * Set address
     * @param string $address
     * @return StoreLocatorInterface
     */
    public function setAddress($address);

    /**
     * Set city
     * @param string $city
     * @return StoreLocatorInterface
     */
    public function setCity($city);

    /**
     * Set Timetable
     * @param string $timetable
     * @return StoreLocatorInterface
     */
    public function setTimetable($timetable);

    /**
     * Set Longitude
     * @param float $longitude
     * @return StoreLocatorInterface
     */
    public function setLongitude($longitude);

    /**
     * set Latitude
     * @param float $latitude
     * @return StoreLocatorInterface
     */
    public function setLatitude($latitude);

    /**
     * Set isVisible
     * @param true|false $isVisible
     * @return StoreLocatorInterface
     */
    public function setIsVisible($isVisible);

    /**
     * @param  $creationTime
     * @return StoreLocatorInterface
     * Set creation time
     */
    public function setCreationTime($creationTime);

    /**
     * @param $updateTime
     * @return StoreLocatorInterface
     * Set Update Time
     */
    public function setUpdateTime($updateTime);
}
