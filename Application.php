<?
	/*
		(c) Kenan Sulayman. 2010.
		Contains several bugs. TODO fix.
			{
				data-transfer,
				//no-release-on-working, -> partially fixed; Check reposistory!!
				tba-e-ake* // not to be fixed within MARCH version...
			}
			
		* to be announced either addaptive kernel extension (.) ? - required implementation of algo. ; DUMMY..
		*
		* The initial algorithms by Thorben are going to be implemented as of next build... // ?
	*/
	
	header('Content-type: text/plain');
	session_start(); ( $_GET['ubint'] == session_id() ) or die('Please consider not to access the backend directly. Thanks.');
	
	/*
	 * Verification of kernel dependencies.
	 */
	
	require('.\\iConfig.php');
	require('Examples\\Desg.php');
	
        class Interfaces {
                public $card, $interfaces, $master = array();
		public $mode = null;
		public $DeviceLock = array ( '4449890143652621027797175729763298888905144884106744242448936580442276025605432301712227920677093644303592023826460024623656084280907914331093029011430619' );
                
		// identify cards
                public function findCard() {
                        for ( $i=$k=0, $c=explode('.', 'A.B.C.D.E.F.G.H.I.J.K.L.M.N.O.P.Q.R.S.T.U.V.W.X.Y.Z'); $i <= count($c)-1; ++$i )
                                if ( file_exists ( $c[$i] . '://Pdb.dat' ) && file_exists ( $c[$i] . '://chr.vrf' ) )
					if ( file_get_contents ( $c[$i] . '://chr.vrf' ) == sha1( file_get_contents ( $c[$i] . '://Pdb.dat' ) xor md5_file( $c[$i] . '://Pdb.dat' ) ) ){
						if ( !in_array( @file_get_contents ( $c[$i] . '://!Signature' ), $this->DeviceLock ) ) {
							die ( "Unerlaubte Ger&auml;tekennung oder fehlende Signatur. Bitte entfernen sie " . $c[$i] . ":\\<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
						}
	                                        $this ->card[] = $c[$i];
					} else {
						die( $c[$i] . ":\ ist fehlerhaft. Bitte entfernen sie dieses Ger&auml;t um fortzufahren.<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
					}
                                else continue;
                        for ( $i=$k=0, $c=explode('.', 'A.B.C.D.E.F.G.H.I.J.K.L.M.N.O.P.Q.R.S.T.U.V.W.X.Y.Z'); $i <= count($c)-1; ++$i )
                                if ( file_exists ( $c[$i] . '://Pdb.dat' ) && file_exists ( $c[$i] . '://m.vrf' ) )
					if ( file_get_contents ( $c[$i] . '://m.vrf' ) == sha1( file_get_contents ( $c[$i] . '://Pdb.dat' ) xor md5_file( $c[$i] . '://Pdb.dat' ) ) ){
						if ( !in_array( @file_get_contents ( $c[$i] . '://!Signature' ), $this->DeviceLock ) ) {
							die ( "Unerlaubte Ger&auml;tekennung oder fehlende Signatur. Bitte entfernen sie " . $c[$i] . ":\\<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
						}
	                                        $this ->master[] = $c[$i];
					} else {
						die( $c[$i] . ":\ ist fehlerhaft. Bitte entfernen sie dieses Ger&auml;t um fortzufahren.<script type='text/javascript'>if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }</script>" );
					}
                                else continue;
			if ( count($this->master) >= 2 )
				die ( "Mehr als eine Arzt-Authentifikation sind angeschlossen. Entfernen sie eine Authentifikation." );
			
			if ( count($this->card) >= 2 )
				die ( "Mehr als eine Gesundheitskarte sind angeschlossen. Entfernen sie eine Karte." );
                        return;
                }
		
		public function getInfo ( $attribute, $at, $o_sub_channel = false ) {
			doTimestamp();
			if ( file_exists( $n = $at . ':\\\\Global' ) )
				if ( $c = unserialize( base64_decode ( file_get_contents ( $n ) ) ) )
					if ( (($o_sub_channel != false) ? isset ( $c[$o_sub_channel][$attribute] ) : isset ( $c[$attribute] )) )
						return (($o_sub_channel != false) ? $c[$o_sub_channel][$attribute] : $c[$attribute]);
					else
						return false;
				else
					return false;
			else
				return false;
			return null;
		}
		
		public function estCon ( $auth ) {
			$obj = $this; $device = $obj->card[0];
			if ( $this->mode==3 ) return true;
			/* intl. auth. */
			if ( sha1($_GET['Dauth']) == $obj->getInfo('auth', @$device) )
				return true;
			else
				return false;
		}
		
		// wrapper... MUSTN'T EVER BE FALSE IF CALLED VIA new Interfaces() !!! <- 0x000001F -> self debug.
                public function isInitialized(){
			$x = $this->getInfo ('desease', $interface->card[0]);
			define ( 'cp', count($x[1]) );
                        return @is_array( $this->card );
                }
                
                public function Interfaces () {
                        return $this->findCard();
                }
		
		public function invokeflush() {
			return '<script type="text">true;</script>';
		}
        }
        $interface = new Interfaces();
/*	die( $interface->getInfo('auth','Z')); */
	
	switch ( $interface->getInfo ('channel', $interface->master[0]) ) {
		case 2: $interface->mode = 2; break;
		case 3: $interface->mode = 3; break;
		case 4: $interface->mode = 4; break;
		case 5: $interface->mode = 5; break;
		default: die ( "Besch&auml;digtes &Auml;rzte-Zertifikat." );
	}
	
	if ( isset( $_GET['indicateMode'] ) ) {
		print "Sie sind zur Zeit angemeldet als ";
		switch ( $interface->mode ) {
			case 2:
				die ( "<b>Arzt.</b>" );
			case 3:
				die ( "<b>Ambulanz.</b>" );
			case 4:
				die ( "<b>Apotheker.</b>" );
			case 5:
				die ( "<b>Therapeut.</b>" );
		}
		exit;
	}
	$interface->isInitialized() or exit("Idle");

	//$interface->write();
	//header( 'Content-type: text/plain' );
	
	if ( isset( $_GET['indicateDevices'] ) ) {
		print_r( json_encode($interface->card) ); 
		exit;
	}
	
	if ( isset( $_GET['auth'] ) ) { header('Content-type: text/html'); ?><html>
	<head>
		<meta name="stoekp" value="<?=sha1(uniqid());?>">
	</head>
	<body>
			<span style='margin-bottom: 0; text-align: left; font-family: Georgia, "Hoefler Text", "DejaVu Serif", "Bistream Vera Serif", "Lucida Bright", serif; font-weight: normal;'>
				<input name="title" id="authdb" class="huge" type="text" style="width: 795px; text-align: center;" value="Kennwort" onfocus="this.value='';this.type='password';"/><br/>
				<center><h5>Fortfahren mit der Eingabe-Taste.</h5></center><!--<input type="button" value="Submit." style="width: 100%"/>-->
			</span>
	</body>
	<script type="text/javascript">Config.Kernel.Invoke( $('authdb'), "keypress", Config.Ui.AuthControler );</script>
</html><? }
	
	if ( isset( $_GET['indicateInterface'] ) ) {
		//if( !$interface -> isInitialized() )
			//print '<p id="$q"><h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">&laquo; Bitte f&uuml;hren sie einen Datentr&auml;ger ein. &raquo;</h1></p>';
		//if ( !$interface -> verify() )
			//print '<p id="$q"><h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">&laquo; Datentr&auml;ger fehlerhaft. &raquo;</h1></p>';
			if ( count($interface->card) == 0 )
				die ( 'Proc:Waiting'/* . $interface->invokeflush()*/ );
			$xmsg = array ( "Idle", "Error:Failure", "Proc:Waiting", "Proc:Authentication" );
			if ( isset($_GET['map']) && isset($_GET['Dauth']) or $interface->mode==3 ) {
				if( $interface -> estCon( $_GET['Dauth']) or $interface->mode==3 ) {
					if ( !isset($_GET['sheet']) ) {
						die( "Proc:success" );
					} else {
						if ( isset($_GET["retrVolume"]) ) {
							if ( !isset($_GET['adv']) ) {
								// load from db
								$ambulance = array(
									$interface->getInfo('surname',$interface->card[0], 'personal'),
									$interface->getInfo('name',$interface->card[0], 'personal'),
									$interface->getInfo('street',$interface->card[0], 'personal'),
									$interface->getInfo('post',$interface->card[0], 'personal'),
									$interface->getInfo('city',$interface->card[0], 'personal'),
									$interface->getInfo('blood',$interface->card[0], 'personal'),
									$interface->getInfo('insecom',$interface->card[0], 'personal'),
									$interface->getInfo('insecnr',$interface->card[0], 'personal'),
									$interface->getInfo('from',$interface->card[0], 'personal'),
									$interface->getInfo('immuData',$interface->card[0])
								);
								initI( $ambulance[0], $ambulance[1], $ambulance[2], $ambulance[3], $ambulance[4], $ambulance[5], $ambulance[6], $ambulance[7], $ambulance[8], $ambulance[9]);
								exit;
								exit;
							} else {
								if ( isset($_GET['advmode']) ) {
									if ( isset($_GET['add']) ) {
										if ( isset($_GET['t']) ) {
											show_new_form();
										} else if ( isset($_GET['r']) ) {
											show_receipt_form();
										} else if ( isset($_GET['thr']) ) {
											show_therapy_form();
										} else {
											show_add_form();
										}
									} else {
										if ( isset($_GET['edit']) ) {
											if ( isset($_GET['cd']) && isset($_GET['order']) && isset($_GET['type']) ) {
												show_add_form( $_GET['cd'], $_GET['type'], $_GET['order'], $interface->getInfo( 'desease', $interface->card[0] ));
												exit;
											} else {
												die;
											}
										} else {
											print ( $interface->mode != 3 ) ? "true" : "false";
										}
									}
									exit;
								} else {
									initP( $interface->mode, $interface->getInfo( 'desease', $interface->card[0] ), $interface->getInfo( 'cdates', $interface->card[0] ) );
									exit;
								}
							}
						} else {
							if ( $interface->mode!=3 ) {
								die("Proc:recl");
							} else {
								die("Ambulance");
							}
						}
					}
				}
			}
			if ( isset( $_GET['Dauth'] ) && $_GET['Dauth'] != '' ) {
				//die ( $_GET['Dauth'] . '?' );
					die(
						( $interface -> estCon( $_GET['Dauth'] ) ) ? (
							"Proc:repetite"
						) : (
							"Proc:Authentication:Failure"
						)
					);
			} else if ( $_GET['Dauth'] == '' ) {
				//die ( "Proc:Authentication:Failure" );
			}
			if ( count($interface->card) < 1 )
				die ( $xmsg [0] );
			else
				if ( count($interface->card) > 0 )
					die ( 'Proc:Authentication' );
				else
					die ( 'Proc:Waiting'/* . $interface->invokeflush()*/ );
	}
?>