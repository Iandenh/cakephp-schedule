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

use Cake\Console\Command;
use Iandenh\Schedule\Command\CallableCommand;
use Iandenh\Schedule\Command\ExecCommand;

class Schedule
{
    /**
     * @var Event[]
     */
    protected $events = [];

    /**
     * Add a command to the Schedule
     *
     * @param \Cake\Console\Command|callable $command
     * @param string $cron
     * @throws \Exception
     */
    public function add($command, $cron)
    {
        if (is_callable($command)) {
            $command = new CallableCommand($command);
        }

        if (!$command instanceof Command) {
            throw new \Exception('Not good');
        }

        return $this->addEvent(new Event($cron, $command));
    }

    /**
     * Add a command to the Schedule
     *
     * @param \Cake\Console\Command|callable $command
     * @param string $cron
     * @return Event
     * @throws \Exception
     */
    public function call(callable $command, $cron)
    {
        $command = new CallableCommand($command);

        return $this->addEvent(new Event($cron, $command));
    }

    /**
     * Add CakePHP Command to the Schedule
     * @param Command $command
     * @param $cron
     * @return Event
     */
    public function command(Command $command, $cron)
    {
        return $this->addEvent(new Event($cron, $command));
    }

    /**
     * Add exec command
     * @param string $command
     * @param $cron
     * @return Event
     * @throws \Exception
     */
    public function exec(string $command, $cron)
    {
        $command = new ExecCommand($command);

        return $this->addEvent(new Event($cron, $command));
    }

    /**
     * Add a event to the schedule
     * @param Event $event
     * @return Event
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;

        return $event;
    }

    /**
     * @return Event[]
     */
    public function getCommands()
    {
        return $this->events;
    }
}
