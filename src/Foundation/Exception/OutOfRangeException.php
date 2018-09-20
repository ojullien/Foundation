<?php
namespace Foundation\Exception;

/**
 * Foundation Framework
 *
 * @package   Exception
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * Exception thrown when an illegal index was requested.
 * This represents error in the program logic and should be detected at compile time.
 * This kind of exceptions should directly lead to a fix in the code.
 */
class OutOfRangeException extends \OutOfRangeException implements \Foundation\Exception\ExceptionInterface
{

}
