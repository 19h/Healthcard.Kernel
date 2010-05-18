<h1>Preferences</h1>
<span id="description">Customize your experiences. </span>
<p id="pref_checkbox_descr">
        <input type="checkbox" id="pInvert" /> &laquo; Inverts the colour of this site. This ain't yet meant to be functional. <br />
        <a href="javascript:void(0);" onclick="javascript:Config.Functions.Pupdt( '&m=posts&p=1', false, true );" style="float: left;">&laquo; get me back </a>
        <a href="javascript:void(0);" onclick="javascript:window.location.replace(unescape(window.location.pathname));" style="float: right;"> apply &raquo;</a>
</p>
<script type="text/javascript">
        if ( Preferences.Prefs.invert )
                $('pInvert').setAttribute('checked', true);
        Event.observe ( 'pInvert', 'click', function () {  return new Ajax.Request('Application?do&pref&invert'); } );
</script>