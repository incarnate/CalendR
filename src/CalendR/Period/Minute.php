<?php

namespace CalendR\Period;

/**
 * Represents a minute
 *
 * @author Zander Baldwin <mynameis@zande.rs>
 */
class Minute extends PeriodAbstract
{
    /**
     * @param \DateTime        $begin
     * @param FactoryInterface $factory
     *
     * @throws Exception\NotAMinute
     */
    public function __construct(\DateTime $begin, $factory = null)
    {
        if (!self::isValid($begin)) {
            throw new Exception\NotAMinute;
        }

        $this->begin = clone $begin;
        $this->end = clone $begin;
        $this->end->add($this->getDateInterval());

        parent::__construct($factory);
    }

    /**
     * Returns the period as a DatePeriod
     *
     * @return \DatePeriod
     */
    public function getDatePeriod()
    {
        return new \DatePeriod($this->begin, new \DateInterval('PT1S'), $this->end);
    }

    /**
     * @param \DateTime $start
     *
     * @return bool
     */
    public static function isValid(\DateTime $start)
    {
        return $start->format('s') == '00';
    }

    /**
     * Returns the minute
     *
     * @return string
     */
    public function __toString()
    {
        return $this->format('i');
    }

    /**
     * Returns a \DateInterval equivalent to the period
     *
     * @return \DateInterval
     */
    public static function getDateInterval()
    {
        return new \DateInterval('PT1M');
    }
}
