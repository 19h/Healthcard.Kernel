<?php
	file_put_contents ( 'Global', base64_encode( serialize( array( 'auth' => sha1(1234) ) ) ) );
?>