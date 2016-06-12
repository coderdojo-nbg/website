<?php
namespace Tollwerk\TwCoderdojo\Controller;

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
use League\CommonMark\Block\Element\Header;
use Tollwerk\TwCoderdojo\Domain\Model\Date;
use Tollwerk\TwCoderdojo\Domain\Model\Person;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Backend module controller
 */
class CoderDojoController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

  /**
   * Date repository
   *
   * @var \Tollwerk\TwCoderdojo\Domain\Repository\DateRepository
   * @inject
   */
  protected $dateRepository;
  /**
   * Code ninja
   *
   * @var string
   */
  protected static $NINJA = ['Code Ninjas', 'Code Ninja', 'Code Ninja'];
  /**
   * Helper
   *
   * @var string
   */
  protected static $HELPER = ['Helfer', 'Helfer', 'Helferin'];
  /**
   * Mentor
   *
   * @var string
   */
  protected static $MENTOR = ['Mentoren', 'Mentor', 'Mentorin'];
  /**
   * Attendees
   *
   * @var string
   */
  const ATTENDEES = 'Teilnehmer';
  /**
   * Single person
   *
   * @var string
   */
  const SINGLE = 'Du';
  /**
   * Multiple persons
   *
   * @var string
   */
  const MULTIPLE = 'ihr';

  /**
   * Display attendee summary
   *
   * @param Date $selectedDate Selected date
   * @return void
   */
  public function indexAction(Date $selectedDate = null)
  {
    $dates = [];
    $now = time();

    /** @var Date $date */
    foreach ($this->dateRepository->findAll() as $date) {
      $dates[] = $date;
      if (($selectedDate === null) && ($date->getStart()->format('U') >= $now)) {
        $selectedDate = $date;
      }
    }
    $this->view->assign('dates', $dates);
    $this->view->assign('selectedDate', $selectedDate);

    $chartSeries = [];
    $genderSeries = [];
    $this->createChartSeries($chartSeries, $genderSeries, 'ninjas', $selectedDate->getNinjas());
    $this->createChartSeries($chartSeries, $genderSeries, 'helpers', $selectedDate->getHelpers());
    $this->createChartSeries($chartSeries, $genderSeries, 'mentors', $selectedDate->getMentors());
    ksort($chartSeries);

    $ages = range(min(array_keys($chartSeries)), max(array_keys($chartSeries)));
    $this->view->assign('ages', json_encode($ages));

    $completeSeries = [
      'ninjas' => array_fill_keys($ages, 0),
      'helpers' => array_fill_keys($ages, 0),
      'mentors' => array_fill_keys($ages, 0),
    ];
    foreach ($chartSeries as $age => $data) {
      foreach ($data as $type => $value) {
        $completeSeries[$type][$age] = $value;
      }
    }
    foreach ($completeSeries as $type => $data) {
      $completeSeries[$type] = json_encode(array_values($data));
    }
    $this->view->assign('chartSeries', $completeSeries);

    foreach ($genderSeries as $type => $data) {
      ksort($genderSeries[$type]);
    }
    $this->view->assign('genderSeries', $genderSeries);

    $this->view->assign('now', new \DateTime('now'));
  }

  /**
   * Download attendee CSV list
   *
   * @param int $date Selected date
   * @return void
   */
  public function downloadAction($date)
  {
    $recipients = [];
    /** @var Date $date */
    $date = $this->dateRepository->findByUid($date);
    $this->createRecipientList($recipients, self::$NINJA, $date->getNinjas());
    $this->createRecipientList($recipients, self::$HELPER, $date->getHelpers());
    $this->createRecipientList($recipients, self::$MENTOR, $date->getMentors());

    if (count($recipients)) {
      $tmpFileName = 'CoderDojo-'.$date->getDojoNumber().'-'.date('Ymd').'.csv';
      $tmpCsvFile = PATH_site.'typo3temp/'.$tmpFileName;
      if (file_exists($tmpCsvFile)) {
        unlink($tmpCsvFile);
      }
      $tmpCsvResource = fopen($tmpCsvFile, 'w');
      fputcsv($tmpCsvResource, array_keys(current($recipients)));
      foreach ($recipients as $recipient) {
        $data = array_map(function($field) {
          if (is_array($field)) {
            $result = implode(', ', array_slice($field, 0, count($field) - 1));
            $result .= ' & '.array_pop($field);
            return $result;
          }
          return $field;
        }, $recipient);
        fputcsv($tmpCsvResource, $data);
      }
      fclose($tmpCsvResource);
      header('Location: /typo3temp/'.$tmpFileName);
    }

    exit;
  }

  /**
   * Create the chart series for a list of persons
   *
   * @param array $chartSeries Chart series
   * @param array $genderSeries Gender series
   * @param string $label Series label
   * @param array $persons Persons
   */
  protected function createChartSeries(array &$chartSeries, array &$genderSeries, $label, array $persons)
  {
    /** @var Person $person */
    foreach ($persons as $person) {

      // Collect the age
      $age = $person->getAge();
      if (!array_key_exists($age, $chartSeries)) {
        $chartSeries[$age] = [];
      }
      if (!array_key_exists($label, $chartSeries[$age])) {
        $chartSeries[$age][$label] = 0;
      }
      ++$chartSeries[$age][$label];

      // Collect the gender
      $gender = $person->getGender();
      if (!array_key_exists($label, $genderSeries)) {
        $genderSeries[$label] = array_fill_keys(range(0, 2), 0);
      }
      ++$genderSeries[$label][$gender];
    }
  }

  /**
   * Create an email recipient list
   *
   * @param array $recipients Recipient list
   * @param array $label Gendered label strings
   * @param array $persons Persons
   */
  protected function createRecipientList(array &$recipients, array $label, array $persons)
  {
    /** @var Person $person */
    foreach ($persons as $person) {
      $email = $person->getEmail();

      // If the email is valid
      if (strlen($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $genderLabel = $label[$person->getGender()];

        // If this is the first recipient with this email address
        if (!array_key_exists($email, $recipients)) {
          $recipients[$email] = [
            'email' => $email,
            'name' => $person->getFirstName(),
            'gender' => $person->getGender(),
            'label' => $genderLabel,
            'salutation' => self::SINGLE
          ];

          continue;
        }

        $recipients[$email]['name'] = array_merge((array)$recipients[$email]['name'], [$person->getFirstName()]);
        $recipients[$email]['gender'] = 0;
        $recipients[$email]['label'] = self::ATTENDEES;
        $recipients[$email]['salutation'] = self::MULTIPLE;
      }
    }
  }
}
