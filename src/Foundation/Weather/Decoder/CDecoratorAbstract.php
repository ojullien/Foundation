<?php
namespace Foundation\Weather\Decoder;
/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Parent class for decorator class used to extend the fonctionnalities of a decoder class.
 *
 * @category   Foundation
 * @package    Weather
 * @subpackage Decoder
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CDecoratorAbstract extends \Foundation\Weather\Decoder\CDecoderAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param \Foundation\Weather\Decoder\DecoderInterface $pDecoder The decoder being decorated.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct( \Foundation\Weather\Decoder\DecoderInterface $pDecoder )
    {
        $this->_pDecoratedDecoder = $pDecoder;
    }

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    protected $_sDebugID = '';

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_pDecoratedDecoder = NULL;
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /** Decorator section
     * ****************** */

    /**
     * The decoder being decorated.
     *
     * @var \Foundation\Weather\Decoder\DecoderInterface
     */
    protected $_pDecoratedDecoder = NULL;

}