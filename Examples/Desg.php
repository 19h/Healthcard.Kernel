<?php	
	function doTimestamp () {
		return;
	}
	function initI ( $surname, $name, $street, $post, $city, $blood, $insecomp, $insecurance, $from, $immunization_data ) { ?>
<p id="$q">
	<h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">
		<!--<p>-->
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em; float: right; text-align: right;">
				Blutgruppe: <?=$blood?><br/><?=$insecomp?><br/>Versicherungsnr.: <?=$insecurance?><br/><?=$from?>e Staatsangeh&ouml;rigkeit
			</h1>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: left; text-align: left;">
				<?=$surname?> <?=$name?><br/><?=$street?><br/><?=$post?> <?=$city?></h1><br/><br/><br/><br/><br/><br />
			</h1>
		<!--</p>-->
		<!--<p>-->
				<h1 class="title" style="font-size: 1.2em; /*text-align: center;*/">
					<?php
						if ( count($immunization_data) != 0 ) {
							print "<span style=\"text-align: right;\">";
							print "Impfungen:<br/>";
							for ( $i=0; $i<=count($immunization_data);++$i ) {
								print $immunization_data[$i][0] . " am " . date("j\.m\.Y H:i", @$immunization_data[$i][1]);
								if( $i != ( count($immunization_data) - 1 ) )
									print "<br/>";
								else
									break;
							}
							print "</span>";
						} else {
							print "Keine Informationen &uuml;ber Impfungen vorhanden.";
						}
					?>
				</h1>
		<!--</p>-->
	</h1>
</p><? }
	function InitP ( $m, $d, $t ) { ?>
			<?php
				$x = new iDB;
	//			for ( $i = 0; $i <= $b = count( $d ); ++$i ) {
	//				if ( $i == $b ) break;
	//				print '<h1 class="title"' /*style="font-size: 1.83em; padding: 0.3em 1em; float: right; text-align: ' . ( ( ( count ( $d ) % ($i+1) ) != 0 ) ? "left" : "right" ) . ';*/ . ' style="font-size: 1em;text-align:' . ( ( ( count ( $d ) % ($i+1) ) == 0 ) ? "left" : "right" ) . ';">';
	//				print date("j\.m\.Y", $d[1][$i][1]);
	//				$y = $x->getiDB($d[1][$i][0]);
	//				$vos = array("ae", "oe", "ue", "ß", "ä", "ö", "ü", "a/e", "o/e", "u/e", "Ä", "Ö", "Ü", "\\\'", "\\\"");
	//                                $tos = array("&auml;", "&ouml;", "&uuml;", "&szlig;", "&auml;", "&ouml;", "&uuml;", "ae", "oe", "ue", "&Auml;", "&Ouml;", "&Uuml;", "'", "\"");
	//                                $y = str_replace($vos, $tos, $y);
	//				print "<br/><p weight=\"1 em;\">" . $y . "</p>";
	//				print "</h1>";
	//			}
				/* --------------------------------------------------- */
				function rpl ( $v ) {
					$vos = array("ae", "oe", "ue", "ß", "ä", "ö", "ü", "a/e", "o/e", "u/e", "Ä", "Ö", "Ü", "\\\'", "\\\"");
					$tos = array("&auml;", "&ouml;", "&uuml;", "&szlig;", "&auml;", "&ouml;", "&uuml;", "ae", "oe", "ue", "&Auml;", "&Ouml;", "&Uuml;", "'", "\"");
					$y = str_replace($vos, $tos, $v);
					return $y;
				}
				/* --------------------------------------------------- */
				
				for ( $left = $right = array(), $i = $p = 0; $i <= $b = count( $d ); ++$i ) {
					if ( $i == $b ) break;
					if ( ( @( count ( $d ) % ($i) ) == 0 ) ) {
						if ( !isset($d[1][$i][0]) or !isset($d[1][$i][1]) )
							continue;
						$left[] = array(
							$d[1][$i][0],
							$d[1][$i][1],
							$i
						);
						++$p;
					} else {
						if ( !isset($d[1][$i][0]) or !isset($d[1][$i][1]) )
							continue;
						$right[] = array(
							$d[1][$i][0],
							$d[1][$i][1],
							$i
						);
					}
				}
				
				for ( $lft = $rght = array(), $i = 1; $i <= $b = count( $d ); ++$i ) {
					if ( $i == $b ) break;
					if ( ( @( count ( $d ) % ($i) ) == 0 ) ) {
						if ( !isset($d[1][$i][0]) or !isset($d[1][$i][1]) )
							continue;
						$lft[] = array(
							$d[2][$i-1][0], //name
							$d[2][$i-1][1],  //date
							$d[2][$i-1][2],  //dr
							$i-1
						);
					} else {
						if ( !isset($d[1][$i][0]) or !isset($d[1][$i][1]) )
							continue;
						$rght[] = array(
							$d[2][$i-1][0], //name
							$d[2][$i-1][1],  //date
							$d[2][$i-1][2],  //dr
							$i-1
						);
					}
				}
				
				//for ( $lt = $rht = array(), $i = 1; $i <= $b = count( $d ); ++$i ) {
				//	if ( $i == $b ) break;
				//	if ( ( @( count ( $d ) % ($i) ) == 0 ) ) {
				//		if ( !isset($d[1][$i][0]) or !isset($d[1][$i][1]) )
				//			continue;
				//		$lft[] = array(
				//			$d[3][$i-1][0], //name
				//			$d[3][$i-1][1],  //date
				//			$d[3][$i-1][2]  //dr
				//		);
				//	} else {
				//		if ( !isset($d[1][$i][0]) or !isset($d[1][$i][1]) )
				//			continue;
				//		$rght[] = array(
				//			$d[3][$i-1][0], //name
				//			$d[3][$i-1][1],  //date
				//			$d[3][$i-1][2]  //dr
				//		);
				//	}
				//}
			?>
<p id="$q">
	<h1 class="title" id="$h1" style="font-size: 2.3em; text-align: center; margin-bottom:0.5em;">
		<? if ( $m != 6 ) ?>
		<div id="artic_top_controls"> 
			<div id="artic_posts_descr" onclick="Config.Ui.Edit_t(1)" style="float: left;font-size: 1em; cursor: pointer;" title="Ausblenden" onclick=""><h1 style="float: left;font-size: 1em;">&laquo;-/+&raquo;<sup>-</sup></h1></div> 
			<!--<div style="float: right;font-size: 1em;" id="artic_form_descr" title="Bearbeiten" onclick="Config.Ui.Add();"><h1 style="float: right; cursor: pointer; font-size: 1em;">&laquo;+&raquo;<sup>+</sup></h1></div> -->
		</div>
		<? ; ?>
		<br/><br/><hr/>
	<? if ( $m == 2 ) ?>
		<h1 class="title"><small><small><small><small><small onclick="Config.Ui.Edit('','','')">Neu</small><sup>+</sup></small></small></small></small> - Diagnosen</h1>
		<!--<p>-->
		<!---->
		<!--<?=str_repeat("<br/>",round(((count( $s )/2)+1)))?>-->
		<!--<hr/>-->
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em; float: left; text-align: left;">
				<?
					foreach( $left as $key ) {
						print "<a href=\"javascript:Config.Ui.Edit('" . $key[1] . "',1," . $key[2] . ");\">" . date("j\.m\.Y", $key[1]) . "</a>";
						print "&nbsp;<a href=\"javascript:Config.Ui.delDiagnose('" . $key[2] . "')\"><small><small>[entfernen]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						foreach( $key[0] as $w )
							print "<small><small><small>|" . rpl($x->getidb($w)) . "| </small></small></small>";
						print "<br/>";
					}
				?>
			</h1>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: right; text-align: right;">
				<?
					foreach( $right as $key ) {
						print "<a href=\"javascript:Config.Ui.Edit('" . $key[1] . "',1," . $key[2] . ");\">" . date("j\.m\.Y", $key[1]) . "</a>";
						print "&nbsp;<a href=\"javascript:Config.Ui.delDiagnose('" . $key[2] . "')\"><small><small>[entfernen]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						foreach( $key[0] as $w )
							print "<small><small><small>|" . rpl($x->getidb($w)) . "| </small></small></small>";
						print "<br/>";
					}
				?>
			</h1>
			<br/><br/><br/><br/><br/><br/><br/><br/>
	<? ; if ( $m == 2 or $m == 4 ) ?>
			<hr/><h1 class="title"><small><small><small><small><small onclick="Config.Ui.Add_r()">Neu</small><sup>+</sup></small></small></small></small> - Rezepte</h1>
			<?
				if (count($d[2])==0) {
					print "<h1>Es sind keine Rezepte ausgestellt.</h1>";
				} else {
			?>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em; float: left; text-align: left;">
				<?
					foreach( $lft as $key ) {
						if ( $key[1] == null or $key[0] == null or $key[2] == null )
							break;
						print "<a href=\"javascript:Config.Ui.Add_r(". $key[3] .");\">" . date("j\.m\.Y", $key[1]) . "</a>";
						print "&nbsp;<a href=\"javascript:Config.Ui.delReceipt('" . $key[3] . "')\"><small><small>[ausgegeben]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>|" . $key[0] . "| </small></small></small>";
						$s = $key[2];
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>" . $s['surname'] . " " . $s['name'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['street'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['post'] . " " . $s['city'] .  "</small></small></small>";
						print "<br/>";
					}
				?>
			</h1>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: right; text-align: right;">
				<?
					foreach( $rght as $key ) {
						if ( $key[1] == null or $key[0] == null or $key[2] == null )
							break;
						print "<a href=\"javascript:Config.Ui.Add_r(". $key[3] .");\">" . date("j\.m\.Y", $key[1]) . "</a>";
						print "&nbsp;<a href=\"javascript:Config.Ui.delReceipt('" . $key[3] . "')\"><small><small>[ausgegeben]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>|" . $key[0] . "| </small></small></small>";
						$s = $key[2];
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>" . $s['surname'] . " " . $s['name'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['street'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['post'] . " " . $s['city'] .  "</small></small></small>";
						print "<br/>";
					}
				?>
			</h1>
			<br/><br/><br/><br/><br/><br/><?}?><br/><br/>
	<? ; if ( $m == 2 or $m == 3 )?>
						<hr/><h1 class="title"><small><small><small><small><small onclick="Config.Ui.Add_th()">Neu</small><sup>+</sup></small></small></small></small> - Therapien</h1>
			<?php
				for ( $l = $r = array(), $x = array(), $i = 1; $i <= $b = count( $d[3] ); ++$i ) {
					if ( $i == $b ) break;
					if ( ( @( count ( $d[3] ) % ($i+1) ) == 0 ) ) {
						if ( $d[3][$i-1]['at'] < time() )
							continue;
						$npp[$d[3][$i-1]['at']] = $i-1;
						$l[] = $d[3][$i-1];
					} else {
						if ( $d[3][$i-1]['at'] < time() )
							continue;
						$npp[$d[3][$i-1]['at']] = $i-1;
						$r[] = $d[3][$i-1];
					}
				}
				if ( count ( $l ) != 0 or count ( $r ) != 0 ) {
			?>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: left; text-align: left;">
				<?
					foreach( $l as $x => $s ) {
						print date("j\.m\.Y H:i", $s['at']);
						print "&nbsp;<a href=\"javascript:Config.Ui.delMeeting('" . $npp[$s['at']] . "')\"><small><small>[entfernen]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>" . $s['surname'] . " " . $s['name'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['street'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['post'] . " " . $s['city'] .  "</small></small></small>";
						print "<br/><br/>";
					}
				?>
				<br/><br/><br/><br/>
			</h1>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: right; text-align: right;">
				<?
					foreach( $r as $x => $s ) {
						print date("j\.m\.Y H:i", $s['at']);
						// $t[$i-1] = $s
						print "&nbsp;<a href=\"javascript:Config.Ui.delMeeting('" . $npp[$s['at']] . "')\"><small><small>[entfernen]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>" . $s['surname'] . " " . $s['name'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['street'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['post'] . " " . $s['city'] .  "</small></small></small>";
						print "<br/><br/>";
					}
				?>
				<br/><br/><br/><br/>
			</h1><?}else{?><h1>Zur Zeit sind keine Therapien verordnet.</h1><?}?><br/>
	<? ; ?>
			<hr/><h1 class="title"><small><small><small><small><small onclick="Config.Ui.Add_t()">Neu</small><sup>+</sup></small></small></small></small> - Termine</h1>
			<?php
				unset ( $npp );
				unset ( $r );
				unset ( $l );
				unset ( $x );
				unset ( $b );
				for ( $l = $r = array(), $x = array(), $i = 1; $i <= $b = count( $t ); ++$i ) {
					if ( $i == $b+1 ) break;
					if ( ( @( count ( $t ) % ($i+1) ) == 0 ) ) {
						$npp[$t[$i-1]['at']] = $i-1;
						$l[] = $t[$i-1];
					} else {
						$npp[$t[$i-1]['at']] = $i-1;
						$r[] = $t[$i-1];
					}
				}
				if ( count ( $l ) != 0 or count ( $r ) != 0 ) {
			?>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: left; text-align: left;">
				<?
					foreach( $l as $x => $s ) {
						print date("j\.m\.Y H:i", $s['at']);
						print "&nbsp;<a href=\"javascript:Config.Ui.delMeeting('" . $npp[$s['at']] . "')\"><small><small>[entfernen]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>" . $s['surname'] . " " . $s['name'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['street'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['post'] . " " . $s['city'] .  "</small></small></small>";
						print "<br/><br/><br/><br/>";
					}
				?>
				<br/><br/><br/><br/>
			</h1>
			<h1 class="title" style="font-size: 1.83em; /*text-align: center;*/ padding: 0.3em 1em;float: right; text-align: right;">
				<?
					foreach( $r as $x => $s ) {
						print date("j\.m\.Y H:i", $s['at']);
						// $t[$i-1] = $s
						print "&nbsp;<a href=\"javascript:Config.Ui.delMeeting('" . $npp[$s['at']] . "')\"><small><small>[entfernen]</small></small></a>";
						print "<br/><span style=\"width: 1em;\"></span>";
						print "<small><small><small>" . $s['surname'] . " " . $s['name'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['street'] . "</small></small></small><br/>";
						print "<small><small><small>" . $s['post'] . " " . $s['city'] .  "</small></small></small>";
						print "<br/><br/><br/><br/>";
					}
				?>
				<br/><br/><br/><br/>
			</h1>
			
			<?=str_repeat( "<br/>", ceil( $p * 3 ) + 1 )?><?}else {?>
				<h1>Kein zuk&uuml;nftiger Termin ist eingetragen.</h1>
			<?}?>
		<!--</p>-->
	</h1>
<?} function show_add_form ( $d = false, $w = false, $o = false, $res = false ) { $x; if ( $d != false ){ $k =1; }?>
<form id="fmit" onsubmit="return false;">
	<center>
		<?php
			if ( !is_numeric($d) )
				$d = false;	
			if ( !is_numeric($o) )
				$o = false;		
		?>
		<? $v_b = ( $w != '2' ) ? @join( ', ', $res[$w][$o][0]) : $res[$w][$o][0] ?>
		<h1 style="margin-bottom: 10px;"><small><small>Datum:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="title" id="ddate" type="text" style="width: 400px; text-align: center; font-size: 0.85em;" value="<?=($d)?date("m/d/y", $d):date("m/d/y")?>"/>&nbsp;&nbsp;&nbsp;<small>mm/dd/yyyy</small><span style="float: right"><input type="submit" id="sbmt" value="Best&auml;tigen"/></span></small></small></h1>
		<h1 style="margin-bottom: 10px;"><small><small>Diagnose:&nbsp;<input name="title" id="dnose" type="text" style="width: 400px; text-align: center; font-size: 0.85em;" onclick="" value="<?=$v_b?>"/>&nbsp;&nbsp;&nbsp;<small>Verrechnungsziffer</small></small></small></h1><br/>
		<input type="hidden" value="<?=(!$o)?cp:$o?>" id="did" />
	</center>
</form>
<script type="text/javascript">
	Event.observe($('fmit'), 'submit', Config.Ui.Controler);
</script>
<? } function show_new_form() { ?>
<form id="fmit" onsubmit="return false;">
	<center>
		<input type="hidden" name="pd" value="<?=$_GET['p']?>"/>
		<h1 style="margin-bottom: 10px;"><small><small>Datum:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="title" id="ddate" type="text" <?/*onclick="this.value=''"*/?> style="width: 310px; text-align: center; font-size: 0.85em;" value="<?=date("m/d/y H:i")?>"/>&nbsp;&nbsp;&nbsp;<small>mm/dd/yyyy hh:mm</small><span style="float: right"><input type="submit" id="sbmt" value="Hinzuf&uuml;gen"/></span></small></small></h1>
	</center>
</form>
<script type="text/javascript">
	Event.observe($('fmit'), 'submit', Config.Ui.Meeting);
</script>
<? } function show_receipt_form() { ?>
<form id="fmit" onsubmit="return false;">
	<center>
		<h1 style="margin-bottom: 10px;"><small><small>Medikament:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="title" id="dmed" type="text" onfocus="this.value=''" value="" style="width: 310px; text-align: center; font-size: 0.85em;"/>&nbsp;&nbsp;&nbsp;<small></small><span style="margin-left: 6em;"><input type="submit" id="sbmt" value="Hinzuf&uuml;gen"/></span></small></small></h1>
	</center>
</form>
<script type="text/javascript">
	Event.observe($('fmit'), 'submit', Config.Ui.Receipt);
</script>
<?} function show_therapy_form() { ?>
<form id="fmit" onsubmit="return false;">
	<center>
		<h1 style="margin-bottom: 10px;"><small><small><input name="title" id="dn" type="text" onfocus="this.value=''" value="Beschreibung" style="width: 310px; text-align: center; font-size: 0.85em;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&laquo;&nbsp;&nbsp;Therapie&nbsp;&nbsp;&nbsp;<small></small><span style="margin-left: 6em;"><input type="submit" id="sbmt" value="Hinzuf&uuml;gen"/></span></small></small></h1>
		<h1 style="margin-bottom: 10px;"><small><small><input name="title" id="dd" type="text" onfocus="this.value=''" value="<?=date("m/d/y")?>" style="width: 310px; text-align: center; font-size: 0.85em;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&laquo;&nbsp;&nbsp;G&uuml;ltigkeit&nbsp;&nbsp;&nbsp;<small></small><span style="margin-left: 6em;"></h1>
	</center>
</form>
<script type="text/javascript">
	Event.observe($('fmit'), 'submit', Config.Ui.Therapy);
</script>
<? } ?>