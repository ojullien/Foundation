<?php
namespace Foundation\Protocol;
/**
 * Foundation Framework
 *
 * @package   Protocol
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements usefull methods for determining client IP address.
 *
 * @category   Foundation
 * @package    Protocol
 * @version    1.0.0
 * @since      1.0.0
 */
final class CRemoteAddress
{
    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    private $_sDebugID = '';

    /**
     * Constructor.
     *
     * As default the proxy setting is disabled - IP address is mostly needed to increase
     * security. HTTP_* are not reliable since can easily be spoofed. It can be enabled
     * just for more flexibility, but if user uses proxy to connect to trusted services
     * it's his/her own risk, only reliable field for IP address is $_SERVER['REMOTE_ADDR'].
     *
     * @param array $server         The current PHP environment.
     * @param type  $useProxy       [OPTIONAL] Whether to use proxy addresses or not.
     * @param type  $proxyHeader    [OPTIONAL] HTTP header to introspect for proxies.
     * @param type  $trustedProxies [OPTIONAL] List of trusted proxy IP addresses.
     * @throws \Foundation\Exception\InvalidArgumentException If an argument is not valid.
     */
    public function __construct( array $server, $useProxy = FALSE, $proxyHeader = 'HTTP_X_FORWARDED_FOR',
                                 $trustedProxies = [ ] )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'cremoteaddress', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $server, $useProxy, $proxyHeader,
                    $trustedProxies ] );
        //@codeCoverageIgnoreEnd
        // Checks arguments
        if( !is_bool( $useProxy ) )
            throw new \Foundation\Exception\InvalidArgumentException( 'The "use proxy" argument is not valid.' );

        if( !is_string( $proxyHeader ) )
            throw new \Foundation\Exception\InvalidArgumentException( 'The "proxy header" argument is not valid.' );

        // Proxy IP address
        if( !empty( $server ) )
        {
            $pValidator = new \Foundation\Type\Complex\CIp( NULL );
            if( $useProxy )
            {
                // Convert proxy header
                $proxyHeader = strtoupper( trim( $proxyHeader ) );
                if( 0 !== strpos( $proxyHeader, 'HTTP_' ) )
                {
                    $proxyHeader = 'HTTP_' . $proxyHeader;
                }

                // Convert trusted proxy
                $aTrustedProxies = array_map( 'trim', $trustedProxies );

                // Get IP address
                if( isset( $server[$proxyHeader] ) )
                {
                    // Extract IPs and compare against trusted proxies IPs;
                    $aIPs = array_diff( array_map( 'trim', explode( ',', $server[$proxyHeader] ) ), $aTrustedProxies );

                    // Find the right-most
                    if( !empty( $aIPs ) )
                    {
                        $pValidator->setValue( array_pop( $aIPs ) );
                    }//if( !empty(...
                }//if( isset( ...
            }

            // Direct IP address
            if( !$pValidator->isValid() && isset( $server['REMOTE_ADDR'] ) )
                $pValidator->setValue( $server['REMOTE_ADDR'] );

            // Save the value
            $this->_Value = $pValidator->getValue();
            unset( $pValidator );
        }//if( !empty(...
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        $this->_Value = NULL;
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set( $name, $value )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return ( isset( $this->_Value ) ) ? $this->_Value : '';
    }

    /** Type section
     * ************* */

    /**
     * Current remote address
     * @var string
     */
    private $_Value = NULL;

    /**
     * Determines if the remote address is set and is not NULL.
     * Returns TRUE if the remote address has value other than NULL, FALSE otherwise.
     *
     * @return boolean
     */
    public function isValid()
    {
        return isset( $this->_Value );
    }

    /**
     * Returns the remote address.
     *
     * @return mixed Returns the remote address or NULL if the remote address is not valid.
     */
    public function getValue()
    {
        return $this->_Value;
    }

}