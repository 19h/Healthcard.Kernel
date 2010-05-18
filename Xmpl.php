<?php
        $c = unserialize( base64_decode( file_get_contents( "F:\\Global" ) ) );
                print_r( $c );
        if ( isset( $_GET['m'] ) ) {
                print_r( $c = array( 'auth' => '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'lastAccess' => 1264703063, 'personal' => array( 'surname' => 'Kenan', 'name' => 'Sulayman', 'street' => 'Dudenstr.32a', 'post' => '10965', 'city' => 'Berlin', 'blood' => '0', 'insecom' => 'Central Privatversicherungen', 'insecnr' => '631321', 'from' => 'Deutsch',  ), 'desease' => array( 1 => array( 0 => array( 0 => array( 1, 13, 21 ), 1 => 1245854927,  ), 1 => array( 0 => array( 2, 3, 21 ), 1 => 1246854999,  ), 2 => array( 0 => array( 14, 21 ), 1 => 1249854927,  ),  ), 2 => array( array( "Paracetamol", strtotime( "01/20/2010" ), array( 'surname' => 'Hr. Dr.', 'name' => 'Venus', 'street' => 'Gross-Schwasser-Weg 11', 'post' => '18057', 'city' => 'Rostock' ),  ), array( "Novaminsulfon", strtotime( "01/13/2010" ), array( 'surname' => 'Hr. Dr.', 'name' => 'Venus', 'street' => 'Gross-Schwasser-Weg 11', 'post' => '18057', 'city' => 'Rostock' ),  ) ), 3 => array(  ),  ), 'immuData' => array( 0 => array( 0 => 'A/H1N1', 1 => 1247854863,  ), 1 => array( 0 => 'A/H9N2', 1 => 1236277327,  ), 2 => array( 0 => 'A/H7N3', 1 => 1252346872,  ),  ), 'cdates' => array( array( 'surname' => 'Hr. Dr.', 'name' => 'Venus', 'street' => 'Gross-Schwasser-Weg 11', 'post' => '18057', 'city' => 'Rostock', 'at' => strtotime( "22nd March 2010" ) + 54000,  ), array( 'surname' => 'Hr. Dr.', 'name' => 'Humboldt', 'street' => 'Manfred-Von-Richthofen-Str. 12', 'post' => '12101', 'city' => 'Berlin', 'at' => strtotime( "22nd April 2010" ) + 46800,  ),  ),  ) );
                file_put_contents( "F:\\Global", base64_encode( serialize( $c ) ) ) or print "failed";
        }
        ////  session_start(); ( $_GET['ks'] == session_id() ) or die('Please consider not to access the backend directly. Thanks.');
        ////  isset( $_GET['e'] ) or die("Please enable.");
        ////        header("Content-type: text/plain");
        //////        if ( isset( $_GET['s'] ) ) {
        ////                $c = unserialize( base64_decode ( file_get_contents ( "Z:\\Global" ) ) );
        ////    $c['channel'] = (($c['channel']==2)?3:2);
        ////                file_put_contents ( "Z:\\Global", base64_encode ( serialize( $c ) ) ) or print "failed";
        //////    switch ( $c['channel'] ) {
        //////      case 2:
        //////        die ( "<b>Arzt.</b>" );
        //////      case 3:
        //////        die ( "<b>Notfall.</b>" );
        //////      case 4:
        //////        die ( "<b>Apotheker.</b>" );
        //////      case 5:
        //////        die ( "<b>Therapeut.</b>" );
        //////    }
        //////        }
        //////        print "\n";
        //        //$c = unserialize( base64_decode ( file_get_contents ( "Z:\\Global" ) ) );
        //        $c = array (
        //        'auth' => '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',
        //        'lastAccess' => time(),
        //        'personal' => array(
        //        'surname' => 'Kenan',
        //        'name' => 'Sulayman',
        //        'street' => 'Dudenstr.32a',
        //        'post' => '10965',
        //        'city' => 'Berlin',
        //        'blood' => '0',
        //        'insecom' => 'Central Privatversicherungen',
        //        'insecnr' => '631321',
        //        'from' => 'Deutsch'
        //      ),
        //                    'desease' => array(
        //                        array(
        //                                21,
        //        ( time() - 16848000 ) - ( rand()&200 )
        //                        ),
        //                        array(
        //                                14,
        //        ( time() - 16848000 ) - ( rand()&200 )
        //                        ),
        //                        array(
        //                                12,
        //        ( time() - 16848000 ) - ( rand()&200 )
        //                        )),
        //        'immuData' => array(
        //      array(
        //        'A/H1N1',
        //        ( time() - 16848000 ) - ( rand()&200 )
        //      ),
        //      array(
        //        'A/H9N2',
        //        ( time() - 28425600 ) - ( rand()&200 )
        //      ),
        //      array(
        //        'A/H7N3',
        //        ( time() - 12355999 ) - ( rand()&200 )
        //      )
        //        )
        //                );
        //        var_dump($c);
        //        file_put_contents ( "F:\\Global", base64_encode ( serialize( $c ) ) ) or print "failed";
        //
?>