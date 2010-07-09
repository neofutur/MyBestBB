<?php
/* Editing anything in this file to improve your stats will get your board removed! */

define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

$result = $db->query('SELECT COUNT(id)-1 FROM '.$db->prefix.'users') or error('error1', __FILE__, __LINE__, $db->error());
$stats['total_users'] = $db->result($result);

$result = $db->query('SELECT SUM(num_topics), SUM(num_posts) FROM '.$db->prefix.'forums') or error('error2', __FILE__, __LINE__, $db->error());
list($stats['total_topics'], $stats['total_posts']) = $db->fetch_row($result);

echo '<?xml version="1.0" ?>';
?>

<boardstats>
	<key>7HvRmu8vVm</key>
	<title><?php echo pun_htmlspecialchars(strip_tags($pun_config['o_board_title'])) ?></title>
	<description><?php echo pun_htmlspecialchars(strip_tags($pun_config['o_board_desc'])) ?></description>
	<version><?php echo $pun_config['o_cur_version'] ?></version>
	<language><?php echo $pun_config['o_default_lang'] ?></language>
	<users><?php echo $stats['total_users'] ?></users>
	<topics><?php echo $stats['total_topics'] ?></topics>
	<posts><?php echo $stats['total_posts'] ?></posts>
</boardstats>
