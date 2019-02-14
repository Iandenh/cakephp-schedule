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

class CallableCommand extends Command
{
    /**
     * A callable.
     *
     * @var callable
     */
    protected $callable;

    /**
     * Constructor
     *
     * @param callable $callable A closure.
     */
    public function __construct(callable $callable)
    {
        parent::__construct();
        $this->callable = $callable;
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
        return ($this->callable)(
            $args,
            $io
        );
    }
}
