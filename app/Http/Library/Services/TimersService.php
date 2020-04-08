<?php

namespace App\Library\Services;

/**
 * Class TimersService
 * @package App\Library\Services
 */
class TimersService
{

    /**
     * @var array
     */
    protected $configTimers;

    /**
     * @var array
     */
    protected $timeCache;

    /**
     * TimersService constructor.
     * @param $configTimers
     */
    public function __construct($configTimers)
    {
        $this->setConfigTimers($configTimers);
    }

    /**
     * @return array
     */
    public function getConfigTimers(): array
    {
        return $this->configTimers;
    }

    /**
     * @param array $configTimers
     */
    public function setConfigTimers(array $configTimers): void
    {
        $this->configTimers = $configTimers;
    }

    /**
     * @return mixed
     */
    public function getTimer()
    {
        if (!$this->timeCache && $this->getConfigTimers()) {
            foreach ($this->getConfigTimers() as $data) {
                $this->timeCache[] = $this->getTimeData($data);
            }
        }

        return $this->timeCache;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getTimeData(array $data): array
    {
        $time = 0;
        $text = '';

        if (!isset($data['type'])) {
            if (isset($data['days'])) {
                $time = $this->getNextTimeDay(
                    $data['days'],
                    $data['hour'],
                    $data['min']
                );
            } else {
                $time = $this->getNextTime($data['hours'], $data['min']);
            }
        } else {
            $text = $data['time'] ?? '';
        }

        $timerList = [];
        if (!empty($data['timers'])) {
            foreach ($data['timers'] as $timers) {
                $timerList[] = $this->getTimeData($timers);
            }
        }

        $result = [
            'time' => $time,
            'text' => $text,
            'name' => $data['name'],
            'icon' => array_key_exists('icon', $data) ? $data['icon'] : '',
        ];

        if ($timerList) {
            $result['timers'] = $timerList;
        }

        return $result;
    }

    /**
     * @param array $hourList
     * @param $minute
     * @return int
     */
    public function getNextTime(array $hourList, $minute): int
    {
        return $this->nextFight($hourList, $minute);
    }

    /**
     * @param array $dayList
     * @param $hour
     * @param $minute
     * @return int
     */
    public function getNextTimeDay(array $dayList, $hour, $minute): int
    {
        $nextTime = PHP_INT_MAX;
        $currentTimeStamp = $this->getCurrentTimeStamp();

        $nDate = date('n', $currentTimeStamp);
        $yDate = date('Y', $currentTimeStamp);
        $jDate = date('j', $currentTimeStamp);

        foreach ($dayList as $day) {
            if (date('l', $currentTimeStamp) === $day &&
                $currentTimeStamp <= ($time = mktime($hour, $minute, 0, $nDate, $jDate, $yDate))) {
                $nextTime = $time;
                break;
            }
            $timeStamp = mktime(
                $hour,
                $minute,
                0,
                date('n', strtotime('next ' . $day, $currentTimeStamp)),
                date('j', strtotime('next ' . $day, $currentTimeStamp)),
                date('Y', strtotime('next ' . $day, $currentTimeStamp))
            );
            if ($nextTime > $timeStamp) {
                $nextTime = $timeStamp;
            }
        }

        return $nextTime;
    }

    /**
     * @param array $hourList
     * @param $minute
     * @return int
     */
    protected function nextFight(array $hourList, $minute): int
    {
        sort($hourList);
        $result = 0;

        $timeStamp = $this->getCurrentTimeStamp();

        $nDate = date('n', $timeStamp);
        $yDate = date('Y', $timeStamp);
        $jDate = date('j', $timeStamp);
        $mDate = date('m', $timeStamp);

        foreach ($hourList as $hour) {
            // same day
            if (($result = mktime($hour, $minute, 0, $nDate, $jDate, $yDate)) >= $timeStamp) {
                break;
            }
            $result = 0;
        }

        if (!$result) {
            // next day
            foreach ($hourList as $hour) {
                if (($result = mktime($hour, $minute, 0, $nDate, date('j', strtotime('+1 day', $timeStamp)), $yDate)) >=
                    $timeStamp
                ) {
                    break;
                }
            }
        }

        if (!$result) {
            // next month
            foreach ($hourList as $hour) {
                if (($result = mktime($hour, $minute, 0, $mDate + 1, 1, $yDate)) >= $timeStamp) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @return int
     */
    protected function getCurrentTimeStamp(): int
    {
        return time();
    }
}
