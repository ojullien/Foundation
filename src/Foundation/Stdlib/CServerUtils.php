<?php
namespace Foundation\Stdlib;

/**
 * Foundation Framework
 *
 * @package   Stdlib
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * Utility class for handling $_SERVER data.
 *
 * @category   Foundation
 * @package    Stdlib
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CServerUtils
{

    /**
     * Tries to find out if the user agent is MSIE and returns the version.
     *
     * @param string $header The string containing the "HTTP USER AGENT" header.
     * @return integer|FALSE
     */
    public static function isMSIE($header)
    {
        // Initialize
        $sTag    = 'MSIE ';
        $bReturn = $iStart = false;

        // Check the parameters
        $header = ( is_string($header) ) ? trim($header) : '';

        // Find out the user agent
        if (strlen($header) > 0) {
            $iStart = stripos($header, $sTag);
        }

        // Case: MSIE
        if ($iStart !== false) {
            $iStart += strlen($sTag);
            $iEnd = stripos($header, '.', $iStart);
            if ($iEnd !== false) {
                $iVersion = substr($header, $iStart, $iEnd - $iStart);
                if (is_numeric($iVersion)) {
                    $bReturn  = (int)$iVersion;
                }
            }
        }

        return $bReturn;
    }

    /**
     * Tries to find out best available locale based on HTTP "Accept-Language" header.
     *
     * @param string $header  The string containing the "Accept-Language" header according to format in RFC 2616.
     * @param array  $allowed [OPTIONAL] List of allowed locales. $allowed[0] is the default.
     * @return string
     */
    public static function acceptFromHttp($header, array $allowed = null)
    {
        // Check the parameter
        $sLocale = null;
        $header  = ( is_string($header) ) ? trim($header) : '';

        // Find out the best available locale
        if (strlen($header) > 0) {
            $sLocale = locale_accept_from_http($header);
        }

        // Check if the locale belongs to the allowed ones
        if (is_array($allowed) && ! empty($allowed)) {
            $sAllowed = null;

            // No locale found from http: set the default
            if (null === $sLocale) {
                $sAllowed = $allowed[0];
            }

            // A locale was found from http: compare to the allowed
            if (null === $sAllowed) {
                foreach ($allowed as $sValue) {
                    if (strcasecmp($sValue, $sLocale) === 0) {
                        $sAllowed = $sValue;
                        break;
                    }//if( strcasecmp(  ..;
                }//foreach( ...
            }

            // A locale was found from http but not in the allowed: try do find out the first best one based on the two
            // first carateres.
            if (null === $sAllowed) {
                $sLocale = substr($sLocale, 0, 2);
                foreach ($allowed as $sValue) {
                    if (stripos($sValue, $sLocale) === 0) {
                        $sAllowed = $sValue;
                        break;
                    }//if( stripos(  ..;
                }//foreach( ...
            }

            // A locale was found from http but not in the allowed: set to default
            if (null === $sAllowed) {
                $sAllowed = $allowed[0];
            }

            $sLocale = $sAllowed;
        }

        return $sLocale;
    }
}
