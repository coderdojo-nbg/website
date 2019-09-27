<?php

namespace Tollwerk\TwCoderdojo\Domain\Repository;

/***********************************************************************************
 *  The MIT License (MIT)
 *
 *  Copyright © 2015 Joschi Kuphal <joschi@kuphal.net> / @jkphl
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy of
 *  this software and associated documentation files (the "Software"), to deal in
 *  the Software without restriction, including without limitation the rights to
 *  use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 *  the Software, and to permit persons to whom the Software is furnished to do so,
 *  subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 *  FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 *  COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 *  IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 *  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ***********************************************************************************/

use Tollwerk\TwCoderdojo\Domain\Model\Date;
use Tollwerk\TwCoderdojo\Domain\Model\Person;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Date repository
 *
 * @package Tollwerk\TwCoderdojo\Domain\Repository
 */
class DateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Default orderings
     *
     * @var array
     */
    protected $defaultOrderings = array('start' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);

    /**
     * Default configuration
     */
    public function initializeObject()
    {
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Return the next dates
     *
     * @return QueryResultInterface Next CoderDojo dates
     */
    public function findNext()
    {
        $today = new \DateTime('@'.(mktime(0, 0, 0)));
        $query = $this->createQuery();
        $query->matching($query->greaterThanOrEqual('start', $today->format('Y-m-d H:i:s')));

        return $query->execute();
    }

    /**
     * Return the past dates (in descending order)
     *
     * @return QueryResultInterface Past CoderDojo dates
     */
    public function findPast()
    {
        $today = new \DateTime('@'.(mktime(0, 0, 0)));
        $query = $this->createQuery();
        $query->matching($query->lessThan('end', $today->format('Y-m-d H:i:s')));
        $query->setOrderings(array('start' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));

        return $query->execute();
    }

    /**
     * Find a registration trigger date
     *
     * @param \DateTimeInterface $dateTime Reference date
     * @param int $limit                   Max. number of dates in the past
     *
     * @return Date Registration trigger date
     */
    public function findRegistrationTriggerDate(\DateTimeInterface $dateTime, $limit = Date::ACTIVE_REGISTRATIONS)
    {
        $query = $this->createQuery();
        $query->matching($query->lessThan('end', $dateTime->format('Y-m-d H:i:s')));
        $query->setOrderings(array('start' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));
        $query->setLimit($limit);
        foreach ($query->execute() as $date) {
        }

        return $date;
    }

    /**
     * Find all dates a particular mentor attended or will attend
     *
     * @param Person $mentor Mentor
     *
     * @return array|QueryResultInterface
     * @throws InvalidQueryException
     */
    public function findByMentor(Person $mentor)
    {
        $query = $this->createQuery();
        $query->matching($query->logicalOr([
            $query->contains('mentors', $mentor),
            $query->contains('ninjas', $mentor),
        ]));

        return $query->execute();
    }
}
