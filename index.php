<?php
	session_start();
	isset($_SESSION['sA']) or ($_SESSION['sA'] = session_id());
?>
<?="<"?>?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="html">
	<head>
		<title>Gesundheitskarte</title>
		<link rel="stylesheet" type="text/css" href="includes/global.css" title="Default" />
		<link rel="stylesheet" type="text/css" href="includes/print.css" media="print" />
                <link rel="stylesheet" type="text/css" href="includes/local.css" title="Default" />
		
                <script type="text/javascript" src="includes/prototype.js"></script>
		<script type="text/javascript" src="includes/scriptaculous.js"></script>
		<script type="text/javascript" src="Kernel?ubint=<?=$_SESSION['sA']?>"></script>
		
		<style type="text/css">tr{vertical-align:top}</style>
		<link rel="icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<link rel="start" href="/" title="Home" />
	</head>
	<body id="body" onload="Config.Initialize()">
                <div id="Quote" style="margin-bottom: 1.8em;">
			<p id="$q">
				<h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">
					&laquo; Ladevorgang l&auml;uft.. &raquo;&nbsp;&nbsp;|&nbsp;&nbsp;<img src="images/init.gif" alt="Loading.." />
				</h1>
			</p>
		</div>
		<div id="content">
			<!--|-W-|-->
		</div>
		<div id="artic" style="margin-top: 1.8em; display: none;"> 
		<!-- dev:articulate // meant to be DISABLED --> 
			<div id='artic_form'> 
				<form id="articulate" onsubmit="return false;"> 
					<input type="text"/> 
				</form> 
			</div> 
		<!-- end:dev --> 
		</div> 
		<div id="EQ" style="display: none;"></div>
		<div id="identity" style="display: none;"></div>
		<div id="footer">
			<p id="copyright">
				&laquo; s-k_load()&/@{body,main} &raquo;
			</p>
		</div>
        </body>
	<script type="text/javascript">
		if ( <?=preg_match('/(.*?)Win(.*?)/', $_SERVER['SERVER_SOFTWARE'])?"true":"false"?> ){ // Verify deprecation. // <?=preg_match('/(.*?)Win(.*?)/', $_SERVER['SERVER_SOFTWARE'])?"true":"false"?>
			// verstecke Kernel Interface
			$('content').hide();
			// initialisiere Kernel->PeriodicalUpdater zur r. von ''Auth;Intf.;Repl;Card;Intok.''
			Config.Kernel.init( false );
			// initialisiere Modus Anzeige; [ Arzt; Therapeut; $Notfall; Apotheker ] @pos -> pID;;
			Config.Ui.intState();
		} else {
			$('content').hide();
			$('artic').hide();
			$('$h1').update('Execution on Darwin or Linux is impossible.<br/><small><small><small>- However, your system might be able to handle it. -</small></small></small>');
			$('copyright').update('<?=preg_replace('/Unix/', "<b style=\'color: white;\'>Unix</b>", $_SERVER['SERVER_SOFTWARE'])?>');
		}
	</script>
</html>