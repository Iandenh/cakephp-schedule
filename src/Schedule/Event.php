<?php
/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Ian den Hartog (https://iandh.nl)
 * @since     0.0.1
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Iandenh\Schedule\Schedule;

use Cake\Chronos\Chronos;
use Cake\Console\Command;
use Cron\CronExpression;

class Event
{
    protected $cron;

    /**
     * @var \Cake\Console\Command
     */
    protected $command;

    /**
     * Event constructor.
     *
     * @param $cron
     * @param \Cake\Console\Command $command
     */
    public function __construct($cron, Command $command)
    {
        $this->cron = $cron;
        $this->command = $command;
    }

    /**
     * @return mixed
     */
    public function getCron()
    {
        return $this->cron;
    }

    /**
     * @param mixed $cron
     */
    public function setCron($cron)
    {
        $this->cron = $cron;
    }

    /**
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param Command $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * Checks if the event isDue to execute
     *
     * @return bool
     */
    public function isDue(): bool
    {
        $date = Chronos::now();

        return CronExpression::factory($this->cron)->isDue($date->toDateTimeString());
    }
}
