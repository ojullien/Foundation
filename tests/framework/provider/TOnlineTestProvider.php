<?php
namespace Foundation\Test\Framework\Provider;

trait TOnlineTestProvider
{

    /**
     * Returns true if we are online.
     *
     * @return boolean
     */
    public function isOnline()
    {
        $fp = @fsockopen( "www.google.com", 80, $iErrno, $sErrstr, 5 );
        if( !$fp )
        {
            $bReturn = FALSE;
        }
        else
        {
            @fclose( $fp );
            $bReturn = TRUE;
        }
        return $bReturn;
    }

}