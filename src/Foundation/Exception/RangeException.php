<?php
namespace Foundation\Exception;
/**
 * Foundation Framework
 *
 * @package   Exception
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Exception thrown to indicate range errors during program execution.
 * Normally this means there was an arithmetic error other than under/overflow.
 * This is the runtime version of DomainException.
 * This represents errors that cannot be detected at compile time.
 */
class RangeException extends \RangeException implements \Foundation\Exception\ExceptionInterface
{

}