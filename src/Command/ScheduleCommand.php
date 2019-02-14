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

namespace Iandenh\Schedule\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Iandenh\Schedule\Schedule\Schedule;

class ScheduleCommand extends Command
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Iandenh\Schedule\Schedule\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param  \Cake\Console\Arguments $args The command arguments.
     * @param  \Cake\Console\ConsoleIo $io   The console io
     * @return null|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $schedule = new Schedule();

        $this->schedule($schedule);

        $commands = $schedule->getCommands();

        foreach ($commands as $command) {
            if ($command->isDue()) {
                $pid = pcntl_fork();

                if ($pid == -1) {
                    exit("Error forking...\n");
                } elseif ($pid == 0) {
                    $command->getCommand()->run($args->getArguments(), $io);
                    exit();
                }
            }
        }

        /*
         * While loop to wait till all due commands are run
         */
        while (pcntl_waitpid(0, $status) != -1) {
        }

        return null;
    }
}
