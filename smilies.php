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


// Tell header.php to use the help template
// because we don't want to edit header.php lets use the standard header template
define('PUN_HELP', 1);

define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';


if ($pun_user['g_read_board'] == '0')
	message($lang_common['No view']);


// Load the help.php language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/modern_bbcode.php';


$page_title = pun_htmlspecialchars($pun_config['o_board_title']).' / Smilies';
require PUN_ROOT.'header.php';

?>

<script type="text/javascript">
<!--
	function insert_text(open, close)
	{
		var docOpener = window.opener.document;

//		msgfield = (docOpener.all) ? docOpener.all.req_message : docOpener.forms['post']['req_message'];

		msgfield = docOpener.getElementsByName("req_message").item(0);

		// IE support	
		if (docOpener.selection && docOpener.selection.createRange)
		{
			msgfield.focus();
			sel = docOpener.selection.createRange();
			sel.text = open + sel.text + close;
			msgfield.focus();
		}

		// Moz support
		else if (msgfield.selectionStart || msgfield.selectionStart == '0')
		{
			var startPos = msgfield.selectionStart;
			var endPos = msgfield.selectionEnd;

			msgfield.value = msgfield.value.substring(0, startPos) + open + msgfield.value.substring(startPos, endPos) + close + msgfield.value.substring(endPos, msgfield.value.length);
			msgfield.selectionStart = msgfield.selectionEnd = endPos + open.length + close.length;
			msgfield.focus();
		}

		// Fallback support for other browsers
		else
		{
			msgfield.value += open + close;
			msgfield.focus();
		}

		window.close();
		return;
	}
-->
</script>

<div id="smileyblock" class="blocktable">
	<h2><span><?php echo $lang_modern_bbcode['Smilies table'] ?></span></h2>
	<div id="smileybox" class="box">
		<div class="inbox">
			<table cellspacing="0">
			<thead>
				<tr>
					<th class="tcl" scope="col"><?php echo $lang_modern_bbcode['Smiley text'] ?></th>
					<th class="tcr" scope="col"><?php echo $lang_modern_bbcode['Smiley image'] ?></th>
				</tr>
			</thead>
			<tbody>
<?php

// Display the smiley set
require PUN_ROOT.'include/parser.php';

$smiley_dups = array();
$num_smilies = count($smiley_text);

for ($i = 0; $i < $num_smilies; ++$i)
{
	// Is there a smiley at the current index?
	if (!isset($smiley_text[$i]))
		continue;

	if (!in_array($smiley_img[$i], $smiley_dups))
	{
?>
 				<tr>

					<td class="tcl"><?php echo $smiley_text[$i] ?></td>
					<td class="tcr"><a href="javascript:insert_text('<?php echo $smiley_text[$i] ?>', '');"><img src="img/smilies/<?php echo $smiley_img[$i] ?>" alt="" /></a></td>
				</tr>
<?php
	}

	$smiley_dups[] = $smiley_img[$i];

}

?>

			</tbody>
			</table>
		</div>
	</div>
</div>

<?php

require PUN_ROOT.'footer.php';
