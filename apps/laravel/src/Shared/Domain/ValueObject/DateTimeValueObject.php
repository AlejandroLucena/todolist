<?php

namespace Modules\Shared\Domain\ValueObject;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

final class DateTimeValueObject
{
    const MONTH_MIN = 1;

    const MONTH_MAX = 12;

    const DAY_MIN = 1;

    const DAY_MAX = 31;

    /**
     * @var int
     */
    private $year;

    /**
     * @var int
     */
    private $month;

    /**
     * @var int
     */
    private $day;

    /**
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     */
    private function __construct($year, $month, $day)
    {
        if (! is_int($year)) {
            throw new InvalidArgumentException(sprintf('%s is not integer', '$year'));
        }
        if (! is_int($month)) {
            throw new InvalidArgumentException(sprintf('%s is not integer', '$month'));
        }
        if (! is_int($day)) {
            throw new InvalidArgumentException(sprintf('%s is not integer', '$day'));
        }

        if ($month < self::MONTH_MIN || $month > self::MONTH_MAX) {
            throw new InvalidArgumentException(sprintf('%s should be in range %d-%d', '$month', self::MONTH_MIN, self::MONTH_MAX));
        }
        /**
         * @todo 02-31
         */
        if ($day < self::DAY_MIN || $day > self::DAY_MAX) {
            throw new InvalidArgumentException(sprintf('%s should be in range %d-%d', '$day', self::DAY_MIN, self::DAY_MAX));
        }

        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     * @return self
     */
    public static function create($year, $month, $day)
    {
        return new self($year, $month, $day);
    }

    /**
     * @return self
     */
    public static function createFromDateTime(DateTimeInterface $dateTime)
    {
        return self::create((int) $dateTime->format('Y'), (int) $dateTime->format('m'), (int) $dateTime->format('d'));
    }

    /**
     * @param  string  $date
     * @return self
     */
    public static function createFromString($date)
    {
        return self::createFromDateTime(new DateTimeImmutable($date));
    }

    /**
     * @return self
     */
    public static function now()
    {
        return self::createFromDateTime(new DateTimeImmutable());
    }

    /**
     * @return int
     */
    public function year()
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function month()
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function day()
    {
        return $this->day;
    }

    /**
     * @return DateTime
     */
    public function toDateTime()
    {
        $dateTime = new DateTime();
        $dateTime->setDate($this->year(), $this->month(), $this->day());
        $dateTime->setTime(0, 0, 0);

        return $dateTime;
    }

    /**
     * @return string
     */
    public function toIso8601Format()
    {
        return $this->toDateTime()->format('Y-m-d\TH:i:s');
    }

    /**
     * @param  Date  $object
     * @return bool
     */
    public function equalsTo(object $object)
    {
        if (! is_a($this, gettype($object))) {
            throw new InvalidArgumentException();
        }

        return
            $this->year() === $object->year() &&
            $this->month() === $object->month() &&
            $this->day() === $object->day();
    }

    /**
     * @param  Date  $object
     * @return bool
     */
    public function laterThan($object)
    {
        if (! is_a($this, gettype($object))) {
            throw new InvalidArgumentException();
        }

        return ($this->year() > $object->year()) ||
        ($this->year() >= $object->year() && $this->month() > $object->month()) ||
        ($this->year() >= $object->year() && $this->month() >= $object->month() && $this->day() > $object->day());
    }

    /**
     * @param  Date  $object
     * @return bool
     */
    public function earlierThan($object)
    {
        if (! is_a($this, gettype($object))) {
            throw new InvalidArgumentException();
        }

        return ! $this->equalsTo($object) && ! $this->laterThan($object);
    }
}
