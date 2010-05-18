<?php
        //require( 'Application.php' );
        header( 'Content-type: text/plain' );
        //session_start(); ( $_GET['ubint'] == session_id() ) or die('Please consider not to access the backend directly. Thanks.');
        
        /*
         * Verification of kernel dependencies.
         */
        
        require( '.\\iConfig.php' );
        require( 'Examples\\Desg.php' );
        
        class Interfaces {
                public $card, $interfaces, $master = array(  );
                public $mode = null;
                public $DeviceLock = array( '4449890143652621027797175729763298888905144884106744242448936580442276025605432301712227920677093644303592023826460024623656084280907914331093029011430619' );
                
                // identify cards
                public function findCard(  ) {
                        for ( $i = $k = 0, $c = explode( '.', 'A.B.C.D.E.F.G.H.I.J.K.L.M.N.O.P.Q.R.S.T.U.V.W.X.Y.Z' ); $i <= count( $c ) - 1; ++$i )
                                if ( file_exists( $c[ $i ] . '://Pdb.dat' ) && file_exists( $c[ $i ] . '://chr.vrf' ) )
                                        if ( file_get_contents( $c[ $i ] . '://chr.vrf' ) == sha1( file_get_contents( $c[ $i ] . '://Pdb.dat' ) xor md5_file( $c[ $i ] . '://Pdb.dat' ) ) ) {
                                                if ( !in_array( @file_get_contents( $c[ $i ] . '://!Signature' ), $this->DeviceLock ) ) {
                                                        die( "Unerlaubte Ger&auml;tekennung oder fehlende Signatur. Bitte entfernen sie " . $c[ $i ] . ":\\<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
                                                }
                                                $this->card[  ] = $c[ $i ];
                                        } else {
                                                die( $c[ $i ] . ":\ ist fehlerhaft. Bitte entfernen sie dieses Ger&auml;t um fortzufahren.<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
                                        } else
                                        continue;
                        for ( $i = $k = 0, $c = explode( '.', 'A.B.C.D.E.F.G.H.I.J.K.L.M.N.O.P.Q.R.S.T.U.V.W.X.Y.Z' ); $i <= count( $c ) - 1; ++$i )
                                if ( file_exists( $c[ $i ] . '://Pdb.dat' ) && file_exists( $c[ $i ] . '://m.vrf' ) )
                                        if ( file_get_contents( $c[ $i ] . '://m.vrf' ) == sha1( file_get_contents( $c[ $i ] . '://Pdb.dat' ) xor md5_file( $c[ $i ] . '://Pdb.dat' ) ) ) {
                                                if ( !in_array( @file_get_contents( $c[ $i ] . '://!Signature' ), $this->DeviceLock ) ) {
                                                        die( "Unerlaubte Ger&auml;tekennung oder fehlende Signatur. Bitte entfernen sie " . $c[ $i ] . ":\\<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
                                                }
                                                $this->master[  ] = $c[ $i ];
                                        } else {
                                                die( $c[ $i ] . ":\ ist fehlerhaft. Bitte entfernen sie dieses Ger&auml;t um fortzufahren.<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
                                        } else
                                        continue;
                        if ( count( $this->master ) >= 2 )
                                die( "Mehr als eine Arzt-Authentifikation sind angeschlossen. Entfernen sie eine Authentifikation." );
                        
                        if ( count( $this->card ) >= 2 )
                                die( "Mehr als eine Gesundheitskarte sind angeschlossen. Entfernen sie eine Karte." );
                        return;
                }
                
                public function getInfo( $attribute, $at, $o_sub_channel = false ) {
                        doTimestamp(  );
                        if ( file_exists( $n = $at . ':\\\\Global' ) )
                                if ( $c = unserialize( base64_decode( file_get_contents( $n ) ) ) )
                                        if ( ( ( $o_sub_channel != false ) ? isset( $c[ $o_sub_channel ][ $attribute ] ) : isset( $c[ $attribute ] ) ) )
                                                return( ( $o_sub_channel != false ) ? $c[ $o_sub_channel ][ $attribute ] : $c[ $attribute ] );
                                        else
                                                return false;
                                else
                                        return false;
                        else
                                return false;
                        return null;
                }
                
		public function log ( $what ) {
			$pid = $this->getInfo( 'auth', $this->card[ 0 ] );
			//$interface->card[ 0 ]
			$c = unserialize( base64_decode( file_get_contents( $this->master[0].":\\Container" ) ) );
				$c[] = array(
					$pid,
					$what
				);
			return file_put_contents( $this->master[0].":\\Container", base64_encode ( serialize( $c ) ) );
		}
		
                public function estCon( $auth ) {
                        $obj = $this;
                        $device = $obj->card[ 0 ];
                        if ( $this->mode == 3 )
                                return true;
                        /* intl. auth. */
                        if ( sha1( $_GET[ 'Dauth' ] ) == $obj->getInfo( 'auth', @$device ) )
                                return true;
                        else
                                return false;
                }
                
                // wrapper... MUSTN'T EVER BE FALSE IF CALLED VIA new Interfaces() !!!
                public function isInitialized(  ) {
                        return @is_array( $this->card );
                }
                
                public function Interfaces(  ) {
                        return $this->findCard(  );
                }
                
                public function invokeflush(  ) {
                        return '<script type="text">true;</script>';
                }
        }
        $interface = new Interfaces(  );
	if ( isset( $_GET[ 'x' ] ) ) {
		header("Content-type: text/plain");
		exit(print_r(unserialize( base64_decode( file_get_contents( $interface->master[0].":\\Container" ) ) )));
	}
	
        //if ( isset( $_GET['dn'] ) && isset( $_GET['dt'] ) && isset( $_GET['u'] ) ) {
        if ( $interface->estCon( $_GET[ 'u' ] ) && isset( $_GET[ 'dtyp' ] ) ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                $b = $_GET[ 'dtyp' ];
                $c[ 'desease' ][ $b ][  ] = array( explode( ',', $_GET[ 'dnose' ] ), strtotime( $_GET[ 'dt' ] ) );
                var_export( $c );
                //file_put_contents ( $interface->card[0] . ":\\Global", base64_encode ( serialize( $c ) ) ) or print "failed";
                exit;
        }
        
        if ( isset( $_GET[ 'delRec' ] ) ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                print_r( $c );
		$y = $c[ 'desease' ][ 2 ][ $_GET[ 'delRec' ] ];
                unset( $c[ 'desease' ][ 2 ][ $_GET[ 'delRec' ] ] );
                $c[ 'desease' ][ 2 ] = array_values( $c[ 'desease' ][ 2 ] );
                print_r( $c );
		$interface->log ( array( "DEL RECEIPT", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }
        
        if ( isset( $_GET[ 'delMeeting' ] ) ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                print_r( $c );
		$y = $c[ 'cdates' ][ $_GET[ 'delMeeting' ] ];
                unset( $c[ 'cdates' ][ $_GET[ 'delMeeting' ] ] );
                $c[ 'cdates' ] = array_values( $c[ 'cdates' ] );
                print_r( $c );
		$interface->log ( array( "DEL MEETING", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }
        
        if ( isset( $_GET[ 'delDiagnose' ] ) ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                print_r( $c );
		$y = $c[ 'desease' ][1][ $_GET[ 'delDiagnose' ] ];
                unset( $c[ 'desease' ][1][ $_GET[ 'delDiagnose' ] ] );
                $c[ 'desease' ] = array_values( $c[ 'desease' ][1] );
                print_r( $c );
		$interface->log ( array( "DEL DIAGNOSE", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }
        
        if ( isset( $_GET[ 'putMeeting' ] )/*&& $interface->estCon($_GET['u'])*/ ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                //print_r($c);
                $c[ 'cdates' ][  ] = $y = array_merge( $interface->getInfo( 'identity', $interface->master[ 0 ] ), array( 'at' => strtotime( $_GET[ 'dt' ] ) ) );
                $c[ 'cdates' ] = array_values( $c[ 'cdates' ] );
                //print_r($c);
                print "Gespeichert!";
		$interface->log ( array( "PUT MEETING", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }
        
        if ( isset( $_GET[ 'pTherapy' ] )/*&& $interface->estCon($_GET['u'])*/ ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                //print_r($c);
                $c[ 'desease' ][3][  ] = $y = array_merge( $interface->getInfo( 'identity', $interface->master[ 0 ] ), array( 'at' => strtotime( $_GET[ 'dd' ] ), 'desc' => $_GET['dn'] ) );
                $c[ 'desease' ][3] = array_values( $c[ 'desease' ][3] );
                //print_r($c);
                print "Gespeichert!";
		$interface->log ( array( "PUT THERAPY", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }
        
        if ( isset( $_GET[ 'pDiagnose' ] ) && isset( $_GET[ 'dn' ] ) && isset( $_GET[ 'dd' ] ) && isset( $_GET[ 'aP' ] )/*&& $interface->estCon($_GET['u'])*/ ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                //print_r($c);
		$c['desease'][1][$_GET['aP']] = $y = array( explode( ",", str_replace ( " ", "", $_GET['dn'] ) ), strtotime($_GET[ 'dd' ]) );
		$c['desease'][1] = array_values( $c['desease'][1] );
                //print_r($c);
                print "Gespeichert!";
		$interface->log ( array( "PUT DIAGNOSE", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }

        if ( isset( $_GET[ 'Receipt' ] )/*&& $interface->estCon($_GET['u'])*/ ) {
                $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
                //print_r($c);
                $c[ 'desease' ][ 2 ][] = $y = array(
			$_GET['n'],
			time(),
			$interface->getInfo( 'identity', $interface->master[ 0 ] )
		);
                $c[ 'desease' ][2] = array_values( $c[ 'desease' ][2] );
                //print_r($c);
                print "Gespeichert!";
		$interface->log ( array( "PUT DIAGNOSE", $y ) );
                file_put_contents( $interface->card[ 0 ] . ":\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
                exit;
        }
        exit;
        $c = unserialize( base64_decode( file_get_contents( $interface->card[ 0 ] . ":\\Global" ) ) );
        print_r( $c );
        print count( $c[ 2 ] );
        
        //}
        //print_r($_GET);
?>