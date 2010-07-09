<?php
function makeurl($type, $id, $name) {
	# Type must be "f" for forum, "t" for topic or "p" for post
	# ID is the id of the content wanted
	# Name is the title of the category or topic
	

	$words = explode(" ", $name);
	$url;
	foreach ($words as $word) {
		if(strlen($word) > 3)
			$url .= '-' . $word;
	}
	$url = strtr($url,'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ/','AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-');
	$url = urlencode($type . $id . $url . ".html");

	return $url;
}
?>
