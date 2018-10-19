<?php
/* Redirect browser */
header("Location: http://".$_SERVER['SERVER_NAME']);
 
/* Make sure that code below does not get executed when we redirect. */
exit;
?>