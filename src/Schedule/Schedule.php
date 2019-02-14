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

class Schedule
{
    /**
     * @var Event[]
     */
    protected $events = [];

    /**
     * Add a command to the Schedule
     *
     * @param  \Cake\Console\Command|callable $command
     * @param  string                         $cron
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

        $this->events[] = new Event($cron, $command);
    }

    /**
     * @return Event[]
     */
    public function getCommands()
    {
        return $this->events;
    }
}
