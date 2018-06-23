class Daemon extends CI_Controller
{
    // Remember to disable CI's csrf-checks for this controller

    function index( )
    {
        ignore_user_abort( 1 );
        try
        {
            if ( strcmp( $_SERVER['REMOTE_ADDR'], $_SERVER['SERVER_ADDR'] ) != 0 && !in_array( $_SERVER['REMOTE_ADDR'], $this->config->item( 'proxy_ips' ) ) )
            {
                log_message( "error", "Daemon called from untrusted IP-address: " . $_SERVER['REMOTE_ADDR'] );
                show_404( '/daemon' );
                return;
            }

            $this->load->library( 'encrypt' );
            $params = unserialize( urldecode( $this->encrypt->decode( $_POST['data'] ) ) );
            unset( $_POST );
            $model = array_shift( $params );
            $method = array_shift( $params );
            $this->load->model( $model );
            if ( call_user_func_array( array( $this->$model, $method ), $params ) === FALSE )
            {
                log_message( "error", "Daemon could not call: " . $model . "::" . $method . "()" );
            }
        }
        catch(Exception $e)
        {
            log_message( "error", "Daemon has error: " . $e->getMessage( ) . $e->getFile( ) . $e->getLine( ) );
        }
    }
}

class Daemon
{
    public function execute_background( /* model, method, params */ )
    {
        $ci = &get_instance( );
        // The callback URL (its ourselves)
        $parts = parse_url( $ci->config->item( 'base_url' ) . "/daemon" );
        if ( strcmp( $parts['scheme'], 'https' ) == 0 )
        {
            $port = 443;
            $host = "ssl://" . $parts['host'];
        }
        else 
        {
            $port = 80;
            $host = $parts['host'];
        }
        if ( ( $fp = fsockopen( $host, isset( $parts['port'] ) ? $parts['port'] : $port, $errno, $errstr, 30 ) ) === FALSE )
        {
            throw new Exception( "Internal server error: background process could not be started" );
        }
        $ci->load->library( 'encrypt' );
        $post_string = "data=" . urlencode( $ci->encrypt->encode( serialize( func_get_args( ) ) ) );
        $out = "POST " . $parts['path'] . " HTTP/1.1\r\n";
        $out .= "Host: " . $host . "\r\n";
        $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out .= "Content-Length: " . strlen( $post_string ) . "\r\n";
        $out .= "Connection: Close\r\n\r\n";
        $out .= $post_string;
        fwrite( $fp, $out );
        fclose( $fp );
    }
}