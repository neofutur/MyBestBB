<?php
/***********************************************************************

  Copyright (C) 2002-2005  Rickard Andersson (rickard@punbb.org)

  This file is part of PunBB.

  PunBB is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  PunBB is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA

************************************************************************/

define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

// No guest here !
if ($pun_user['is_guest'])
	redirect('login.php', $lang_pms['Login required']);
	
// User enable PM ?
if (!$pun_user['use_pm'] == '1')
	redirect('profile.php?section=privacy&amp;id='.$pun_user['id'], $lang_pms['Disabled PM']);

// Are we allowed to use this ?
if (!$pun_config['o_pms_enabled'] =='1' || $pun_user['g_pm'] == 0)
	message($lang_common['No permission']);
	
// Check for new messages
$result_messages = $db->query('SELECT COUNT(id) FROM '.$db->prefix.'messages WHERE showed=0 AND owner='.$pun_user['id']) or error('Impossible de vérifier la présence de nouveaux messages', __FILE__, __LINE__, $db->error());
$num_new_mp = $db->result($result_messages);

if ($num_new_mp > 0)
{
	$new_message_txt = $num_new_mp == 1 ? $lang_pms['New message'] : sprintf($lang_pms['New messages'],$num_new_mp);
	$new_message_link = $num_new_mp == 1 ? $lang_pms['See new'] : sprintf($lang_pms['See news'],$num_new_mp);
}
else {
	$new_message_txt = $new_message_link = $lang_pms['No new'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="<?php echo $lang_common['lang_direction'] ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $lang_common['lang_encoding'] ?>" />
<title><?php echo pun_htmlspecialchars($pun_config['o_board_title']).' / '.$new_message_txt ?></title>
<link rel="stylesheet" type="text/css" href="style/<?php echo $pun_user['style'].'.css' ?>" />
<style type="text/css">
<!--
div#new_pm {
margin: 50px 20% 12px 20%;
}
-->
</style>

<script type="text/javascript">
//<![CDATA[
function go_to_inbox()
{
	window.opener.document.location.href = "pms_list.php";
	window.close();
}
//]]>
</script>
</head>
<body>

<div class="pun">
	<div class="block" id="new_pm">
		<h2><?php echo $lang_pms['Private Messages'] ?></h2>
		<div class="box">
			<div class="inbox">
				<p><?php echo $new_message_txt ?></p>
				<p><a href="pms_list.php" onclick="go_to_inbox();return false;"><?php echo $new_message_link ?></a></p>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
// End the transaction
$db->end_transaction();

// Close the db connection (and free up any result data)
$db->close();
?>