<?php
namespace Foundation\Log\Writer;

/**
 * Foundation Framework
 *
 * @package   Log
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * Interface for log writer implementations.
 *
 * @category   Foundation
 * @package    Log
 * @subpackage Writer
 * @version    1.0.0
 * @since      1.0.0
 */
interface WriterInterface
{

    /**
     * Perform shutdown activities.
     *
     * @return void
     */
    public function shutdown();

    /**
     * Write a log message. Returns FALSE on error.
     *
     * @param \Foundation\Log\CMessage $pMessage Detailed message data.
     * @return void
     */
    public function write(\Foundation\Log\CMessage $pMessage);
}
