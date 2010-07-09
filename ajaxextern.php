<?php
// Add pages you don't want the box to be displayed on in this array
$notonpage = array();

	if(!defined('PUN') || in_array(basename($_SERVER['PHP_SELF']), $notonpage))
	return;
?>
<script type="text/javascript" src="<?php echo PUN_ROOT; ?>include/js/ajax_extern.js"></script>
