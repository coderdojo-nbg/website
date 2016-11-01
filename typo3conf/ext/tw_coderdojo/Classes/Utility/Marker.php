<?php
namespace Tollwerk\TwCoderdojo\Utility;

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

class Marker
{
  /**
   * Total amount of colors
   *
   * @var int
   */
  protected static $amount = null;
  /**
   * Colors
   *
   * @var array
   */
  protected static $colors = array(
    'black',
    'basaltgrey',
    'signalgrey',
    'white',
    'greenblue',
    'avionblue',
    'oxidered',
    'coralred',
    'yellowgrey',
    'ferngreen',
    'pastelgreen',
    'sulfuryellow',
  );
  /**
   * Net price
   *
   * @var float
   */
  const NET = 84.03;
  /**
   * Gross price
   *
   * @var float
   */
  const GROSS = 100;

  /**
   * Create and return the net sum
   *
   * @param \string $content Content
   * @param \array $config Configuration
   * @return \string          Net sum
   */
  public function net($content, array $config)
  {
    self::setup();
    return number_format(self::NET * self::$amount, 2, ',', '.');
  }

  /**
   * Create and return the gross sum
   *
   * @param \string $content Content
   * @param \array $config Configuration
   * @return \string          Gross sum
   */
  public function gross($content, array $config)
  {
    self::setup();
    return number_format(self::GROSS * self::$amount, 2, ',', '.');
  }

  /**
   * Create and return the VAT sum
   *
   * @param \string $content Content
   * @param \array $config Configuration
   * @return \string          VAT sum
   */
  public function vat($content, array $config)
  {
    self::setup();
    return number_format((self::GROSS - self::NET) * self::$amount, 2, ',', '.');
  }

  /**
   * Return the number of submitted colors
   *
   * @return int Submitted colors
   */
  public static function amount() {
    self::setup();
    return self::$amount;
  }

  /**
   * One time setup
   */
  public static function setup()
  {
    if (self::$amount === null) {
      self::$amount = 0;
      if (!empty($_POST['formhandler']) && is_array($_POST['formhandler'])) {
        foreach (self::$colors as $color) {
          if (!empty($_POST['formhandler'][$color])) {
            self::$amount += intval($_POST['formhandler'][$color]);
          }
        }
      }
    }
  }
}
