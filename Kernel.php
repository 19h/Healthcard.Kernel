<? header('Content-type: text/javascript'); session_start(); ( $_GET['ubint'] == session_id() ) or die('Please consider not to access the backend directly. Thanks.');?>
var Config = {
        Break: true,
	Interface: "Interface?passive",
        Interference: "",
        release: "",
        indicateMode: "",
        recl: "",
        releaseMode: "",
        C: {
                b: true,
                p: null,
                t: false,
                k:false
        },
	init: function() {
		
		return;
	},
        Initialize: function ( intl ) {
                return Config.Break = false;
        },
        Message: function ( id ) {
                var print = function ( msgstr ) { var inn = '<p id="$q"><h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">&laquo; ' + msgstr + ' &raquo;</h1></p>'; $('Quote').update( inn ); };
                switch ( id ) {
                        case "Error:Failure":
                                text = print ( "Datentr&auml;ger fehlerhaft." );
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }
                                break;
                        case "Idle":
                                text = print ( "Bitte legen sie einen Datentr&auml;ger ein." );
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }
                                Config.Interference = "";
                                Config.release = "";
                                Config.indicateMode = "";
                                break;
                        case "Proc:Waiting":
                                text = print ( "Verifikation l&auml;uft.&nbsp;&nbsp;|&nbsp;&nbsp;<img src=\"images/init.gif\" alt=\"Loading..\" />" );
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }
                                break;
                        case "Proc:repetite":
                                text = print ( "Authentifikation erfolgreich." );
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; }
                                setTimeout ( function () {
                                        //Config.Kernel.Advisory( "auth" );
                                        Config.release = "&map&";
                                }, 200 );
                                break;
                        case "Proc:Authentication":
                                text = print ( "Bitte melden sie sich an. <span id=\"<?=sha1( $x = rand() & rand() )?>\" accesskey=\"m\"><small><small><!--(toggle)--></small></small><script type='text/javascript'>Event.observe( $('<?=sha1($x)?>'), 'click', function () { if ( Config.C.b != true ) { Effect.toggle('content', 'appear'); Config.C.b = true; } else { Effect.toggle('content', 'appear'); Config.C.b = true }})</script>" );
                                this.Kernel.Advisory( "auth" );
                                break;
                        case "Proc:Authentication:Failure":
                                text = print ( "Die Authentifikation ist fehlgeschlagen." );
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear', { duration: .2 }); Config.C.b = true; }
                                //Config.indicateMode = "&sheet&";
                                setTimeout ( function () {
                                        //Config.Kernel.Advisory( "auth" );
                                        //Config.Interference = "";
                                        window.location = window.location;
                                }, 1000 );
                                break;
                        case "Ambulance":
                                Config.Kernel.init(true);
                                if ( Config.C.k != true ) {
                                        Config.C.p = new PeriodicalExecuter(function(){
                                                new Ajax.Request("Application?indicateInterface&Dauth=&sheet&retrVolume&ubint=" + "<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                if ( request.responseText == "Idle" ) {
                                                                        window.location = window.location;
                                                                        //Config.C.p.stop();
                                                                        //Config.Kernel.init();
                                                                }
                                                        }
                                                });
                                        }, .5);
                                        new Ajax.Request("Application?indicateInterface&retrVolume&sheet&Dauth=&ubint=<?=$_SESSION['sA']?>", {
                                                onComplete: function(request) {
                                                        setTimeout (
                                                                function () { Effect.toggle('content', 'appear'); },
                                                                50
                                                        );
                                                        Config.C.b = true;
                                                        return $( 'content' ).update( request.responseText );
                                                }
                                        });
                                } else {
                                        return false;
                                }
                                break;
                        case "Proc:success":
                                print ( ( Config.releaseMode == "Sie sind zur Zeit angemeldet als <b>Ambulanz.</b>" ) ? "Krankenblatt" : "Das Krankenblatt wird verarbeitet." );
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear', { duration: .2 }); Config.C.b = true; }
                                setTimeout ( function () {
                                        Config.Kernel.Advisory( "load" );
                                }, 2000 );
                                Config.indicateMode = "&sheet";
                                break;
                        case "Proc:recl":
                                if ( Config.C.b != true ) { Effect.toggle('content', 'appear', { duration: .2 }); Config.C.b = true; }
                                Config.Kernel.Advisory("recl");
                                text = print ( "Krankenblatt" );
                                break;
                        default:
                                text = print ( id );
                                break;
                }
                return;
        },
        Kernel: {
                Effect: {
                        Blind: function ( e ) {
                                return Effect.toggle( $(e), 'blind' );
                        }
                },
                k: 0,
                Parse: {
                        uri: function () {
                                var uri = null;
                                if ( true ) return;
                        }
                },
                        /*
                         * LicenseSwitch &/@ ( Mode.local ) -> ((mode==2)?3:2)
                         */
                LicenseSwitch: function ( type ) {
                        return new Ajax.Request("Xmpl?e&ks=" + "<?=$_SESSION['sA']?>", {
                                onComplete: function(request) {
                                        return true;
                                }
                        });
                },
                Advisory: function ( id, kext ) {
                        // use kext as identity of id. ( f(id)" = kext.. )- id != kext
                        switch ( id ) {
                                case 'auth':
                                        if ( Config.C.b == true ) {
                                                new Ajax.Request('Application?auth' + "&ubint=" + "<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                $( 'content' ).update( request.responseText );
                                                                if ( Config.Kernel.k == 1 ){
                                                                        //if ( Config.Kernel.b == 0 ){
                                                                                Config.Kernel.k = 0;
                                                                        //}
                                                                }
                                                                if ( Config.Kernel.k == 0 ){
                                                                        Effect.toggle('content', 'appear');
                                                                        Config.Kernel.k = 1;
                                                                }
                                                        }
                                                });
                                        }
                                        return Config.C.b = false;
                                        break;
                                case 'recl':
                                        Config.recl = "";
                                        Config.Kernel.init(true);
                                        if ( !Config.C.t ) {
                                                new Ajax.Request("Application?indicateInterface&retrVolume&Dauth=" + Config.Interference + Config.release + Config.indicateMode + "&ubint=" + "<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                setTimeout (
                                                                        function () { Effect.toggle('content', 'appear'); },
                                                                        50
                                                                );
                                                                Config.C.p = new PeriodicalExecuter(function(){
                                                                        new Ajax.Request("Application?indicateInterface&Dauth=&sheet&retrVolume&ubint=" + "<?=$_SESSION['sA']?>", {
                                                                                onComplete: function(request) {
                                                                                        if ( request.responseText == "Idle" ) {
                                                                                                window.location = window.location;
                                                                                        }
                                                                                }
                                                                        });
                                                                }, .5);
                                                                new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&advmode&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                                        onComplete: function(request) {
                                                                                if ( request.responseText == "true" ) {
                                                                                        new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                                                                onComplete: function(request) {
                                                                                                        $('EQ').update(request.responseText);
                                                                                                        Config.C.r = true;
                                                                                                }
                                                                                        });
                                                                                        setTimeout ( function () {
                                                                                                        Effect.toggle('EQ', 'appear');
                                                                                                }, 100
                                                                                        );
                                                                                } else {
                                                                                        alert(request.responseText)
                                                                                        return false;
                                                                                }
                                                                        }
                                                                });
                                                                Config.C.b = false;
                                                                return $( 'content' ).update( request.responseText );
                                                        }
                                                });
                                                Config.C.t = 1;
                                        }
                                        break;
                        }
                        return true;
                },
                Invoke: function ( e, event, f ) {
                        return Event.observe ( e, event, f );
                },
                init: function ( mode ) {
                        if ( mode == true ){
                                return Config.C.p.stop();
                        } else {
                                Config.C.p = new PeriodicalExecuter(function(){
                                        if ( !Config.Break )
                                                new Ajax.Request("Application?indicateInterface&Dauth=" + Config.Interference + Config.release + Config.indicateMode + "&ubint=" + "<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                return Config.Message ( request.responseText );
                                                        }
                                                });
                                        else
                                                return true;
                                }, .5);
                        }
                }
        },
        Ui: {
                Edit: function ( id, type, o ){
                        var enhance = "ref=1";
                        return new Ajax.Request( "Application?indicateInterface&retrVolume&sheet&adv&advmode&edit&" + enhance + "&type=" + type + "&order=" + o + "&cd=" + id + "&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                               onSuccess: function(request) {
                                        $('artic').update(request.responseText);
                                        //alert($('artic').getStyle('display'));
                                        return Config.Ui.Edit_t(0);
                               }
                        });
                },
                Edit_t: function ( hide ) {
                        if ( hide == 1 ) {
                                if ( $('artic').getStyle('display') == 'none' )
                                        return true;
                                else
                                        return Effect.toggle($('artic'),'appear');
                        } else {
                                if ( $('artic').getStyle('display') == 'block' )
                                        return true;
                                else
                                        return Effect.toggle($('artic'),'appear');
                        }
                },
                Add: function ( id ){
                        return new Ajax.Request( "Application?indicateInterface&retrVolume&sheet&adv&advmode&add&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                               onSuccess: function(request) {
                                        $('artic').update(request.responseText);
                                        return Config.Ui.Edit_t(0);
                               }
                        });
                },
                Add_t: function ( id ){
                        return new Ajax.Request( "Application?indicateInterface&retrVolume&sheet&adv&advmode&add&Dauth=" + Config.Interference + "&t&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                               onSuccess: function(request) {
                                        $('artic').update(request.responseText);
                                        Config.Ui.Edit_t(0);
                                        return setTimeout( function () { $('ddate').focus() }, 600 );
                               }
                        });
                },
                Add_r: function ( id ){
                        var x = ( id != '' ) ? "&p=" + id : "";
                        return new Ajax.Request( "Application?indicateInterface&retrVolume&sheet&adv&advmode&add&Dauth=" + Config.Interference + "&r" + x + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                               onSuccess: function(request) {
                                        $('artic').update(request.responseText);
                                        Config.Ui.Edit_t(0);
                                        return setTimeout( function () { $('ddate').focus() }, 600 );
                               }
                        });
                },
                Add_th: function ( id ){
                        var x = ( id != '' ) ? "&p=" + id : "";
                        return new Ajax.Request( "Application?indicateInterface&retrVolume&sheet&adv&advmode&add&Dauth=" + Config.Interference + "&thr" + x + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                               onSuccess: function(request) {
                                        $('artic').update(request.responseText);
                                        Config.Ui.Edit_t(0);
                                        return setTimeout( function () { $('ddate').focus() }, 600 );
                               }
                        });
                },
                delReceipt: function ( id ){
                        if ( confirm ( "Sind sie sicher, dass sie das Rezept entfernen wollen?" ) ) {
                                return new Ajax.Request( "Controler?delRec=" + id, {
                                       onSuccess: function(request) {
                                                new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                $('EQ').update(request.responseText);
                                                        }
                                                });
                                       }
                                });
                        } else {
                                return true;
                        }
                },
                delMeeting: function ( id ){
                        if ( confirm ( "Sind sie sicher, dass sie den Termin entfernen wollen?" ) ) {
                                return new Ajax.Request( "Controler?delMeeting=" + id, {
                                       onSuccess: function(request) {
                                                new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                $('EQ').update(request.responseText);
                                                        }
                                                });
                                       }
                                });
                        } else {
                                return true;
                        }
                },
                delDiagnose: function ( id ){
                        if ( confirm ( "Sind sie sicher, dass sie die Diagnose entfernen wollen?" ) ) {
                                return new Ajax.Request( "Controler?delDiagnose=" + id, {
                                       onSuccess: function(request) {
                                                new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                        onComplete: function(request) {
                                                                $('EQ').update(request.responseText);
                                                        }
                                                });
                                       }
                                });
                        } else {
                                return true;
                        }
                },
                Controler: function () {
                        return new Ajax.Request( "Controler?u=" + Config.Interference + "&ubint=<?=$_SESSION['sA']?>&pDiagnose&dn=" + $('dnose').value + "&dd=" + $('ddate').value + "&aP=" + $('did').value, {
                               onSuccess: function(request) {
                                        alert(request.responseText);
                                        new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                onComplete: function(request) {
                                                        $('EQ').update(request.responseText);
                                                }
                                        });
                                        Effect.toggle($('artic'),'appear')
                                        return true;
                               }
                        });
                },
                Receipt: function () {
                        return new Ajax.Request( "Controler?u=" + Config.Interference + "&ubint=<?=$_SESSION['sA']?>&Receipt&n=" + $('dmed').value, {
                               onSuccess: function(request) {
                                        alert(request.responseText);
                                        new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                onComplete: function(request) {
                                                        $('EQ').update(request.responseText);
                                                }
                                        });
                                        Effect.toggle($('artic'),'appear');
                                        return true;
                               }
                        });
                },
                Meeting: function () {
                        return new Ajax.Request( "Controler?u=" + Config.Interference + "&ubint=<?=$_SESSION['sA']?>&putMeeting&dt=" + $('ddate').value, {
                               onSuccess: function(request) {
                                        alert(request.responseText);
                                        new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                onComplete: function(request) {
                                                        $('EQ').update(request.responseText);
                                                }
                                        });
                                        Effect.toggle($('artic'),'appear');
                                        return true;
                               }
                        });
                },
                Therapy: function () {
                        alert("ddd");
                        return new Ajax.Request( "Controler?u=" + Config.Interference + "&ubint=<?=$_SESSION['sA']?>&pTherapy&dn=" + $('dn').value + "&dd=" + $('dd').value, {
                               onSuccess: function(request) {
                                        //$('artic').update(request.responseText);
                                        alert(request.responseText);
                                        new Ajax.Request("Application?indicateInterface&retrVolume&sheet&adv&Dauth=" + Config.Interference + "&map&sheet&ubint=<?=$_SESSION['sA']?>", {
                                                onComplete: function(request) {
                                                        $('EQ').update(request.responseText);
                                                }
                                        });
                                        Effect.toggle($('artic'),'appear');
                                        return true;
                               }
                        });
                },
                intPrint: function ( msg ) {
                        new Ajax.Request("Application?indicateInterface" + "&ubint=" + "<?=$_SESSION['sA']?>", {
                                onComplete: function(request) {
                                        return $('content').update( request.responseText );
                                }
                        });
        		Effect.toggle($('content')); 
                },
                intStateR: false,
                intState: function ( msg ) {
                        new Ajax.Request("Application?indicateMode&ubint=" + "<?=$_SESSION['sA']?>", {
                                onComplete: function(request) {
                                        // Never happening, but just in case ;)
                                        if ( Config.Ui.intStateR == true )
                                            if ( request.responseText != Config.releaseMode && !/Ambulanz/.test( request.responseText ) )
                                                window.location = window.location;
                                        Config.Ui.intStateR = true;
                                        Config.releaseMode = request.responseText;
                                        return $('copyright').update( request.responseText );
                                }
                        });
                        setTimeout ( Config.Ui.intState, 500 );
                },
                AuthControler: function (e) {
                        var print = function ( msgstr ) { var inn = '<p id="$q"><h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">&laquo; ' + msgstr + ' &raquo;</h1></p>'; $('Quote').update( inn ); };
                        if ( e.keyCode == 13 ) {
                                Config.Interference = $('authdb').value;
                                print ( "Authentikation l&auml;uft.." );
                        } else {
                                return;
                        }
                }
        }
}