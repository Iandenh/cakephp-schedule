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
use Symfony\Component\Process\Process;

class ExecCommand extends Command
{
    protected $command;

    /**
     * Constructor
     *
     * @param array|string $callable A closure.
     */
    public function __construct($command)
    {
        parent::__construct();
        if (is_string($command)) {
            $command = [$command];
        }

        $this->command = $command;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $process = new Process($this->command);

        return $process->run();
    }
}
