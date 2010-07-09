<?php
require("./include/xajax.inc.php");
$xajax = new xajax("quote.server.php"); // initializing xajax
$xajax->registerFunction("quote");   // registers the function that injects the quote into the quick reply field
?>
