<?php
namespace Tollwerk\TwCoderdojo\Domain\Model;


	/***************************************************************
	 *
	 *  Copyright notice
	 *
	 *  (c) 2015 Joschi Kuphal <joschi@tollwerk.de>, tollwerk GmbH
	 *
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 3 of the License, or
	 *  (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

/**
 * Veranstaltungsort
 */
class Location extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Adresse
	 *
	 * @var string
	 */
	protected $streetAddress = '';

	/**
	 * Postleitzahl
	 *
	 * @var string
	 */
	protected $postalCode = '';

	/**
	 * Ort
	 *
	 * @var string
	 */
	protected $locality = '';

	/**
	 * Latitude
	 *
	 * @var float
	 */
	protected $latitude = 0.0;

	/**
	 * Longitude
	 *
	 * @var float
	 */
	protected $longitude = 0.0;

	/**
	 * Google Maps URL
	 *
	 * @var string
	 */
	protected $googlemaps = '';

	/**
	 * Land
	 *
	 * @var \SJBR\StaticInfoTables\Domain\Model\Country
	 */
	protected $country = null;

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns the streetAddress
	 *
	 * @return string $streetAddress
	 */
	public function getStreetAddress()
	{
		return $this->streetAddress;
	}

	/**
	 * Sets the streetAddress
	 *
	 * @param string $streetAddress
	 * @return void
	 */
	public function setStreetAddress($streetAddress)
	{
		$this->streetAddress = $streetAddress;
	}

	/**
	 * Returns the postalCode
	 *
	 * @return string $postalCode
	 */
	public function getPostalCode()
	{
		return $this->postalCode;
	}

	/**
	 * Sets the postalCode
	 *
	 * @param string $postalCode
	 * @return void
	 */
	public function setPostalCode($postalCode)
	{
		$this->postalCode = $postalCode;
	}

	/**
	 * Returns the locality
	 *
	 * @return string $locality
	 */
	public function getLocality()
	{
		return $this->locality;
	}

	/**
	 * Sets the locality
	 *
	 * @param string $locality
	 * @return void
	 */
	public function setLocality($locality)
	{
		$this->locality = $locality;
	}

	/**
	 * Returns the latitude
	 *
	 * @return float $latitude
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param float $latitude
	 * @return void
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 *
	 * @return float $longitude
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param float $longitude
	 * @return void
	 */
	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	}

	/**
	 * Returns the country
	 *
	 * @return \SJBR\StaticInfoTables\Domain\Model\Country $country
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \SJBR\StaticInfoTables\Domain\Model\Country $country
	 * @return void
	 */
	public function setCountry(\SJBR\StaticInfoTables\Domain\Model\Country $country)
	{
		$this->country = $country;
	}

	/**
	 * Returns the Google Maps URL
	 *
	 * @return string
	 */
	public function getGooglemaps()
	{
		return $this->googlemaps;
	}

	/**
	 * Sets the Google Maps URL
	 *
	 * @param string $googlemaps
	 */
	public function setGooglemaps($googlemaps)
	{
		$this->googlemaps = $googlemaps;
	}
}