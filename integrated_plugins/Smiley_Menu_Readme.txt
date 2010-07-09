##
##
##        Mod title:  Smiley Menu
##
##      Mod version:  0.6
##   Works on PunBB:  Should work on every version
##     Release date:  2006-04-20
##           Author:  El Bekko (elbekko@gmail.com)
##
##      Description:  This tool adds the possibility to 
##					  easily add smileys to posts by
##					  clicking on them in a small menu.
##
##	 Difference with  
## previous version:  Now in Quick Post too.
##
##   Affected files:  post.php, viewtopic.php
##                    
##       Affects DB:  No
##
##            Notes:  Changed the check for duplicate entries in 0.5
##
##       DISCLAIMER:  Please note that "mods" are not officially supported by
##                    PunBB. Installation of this modification is done at your
##                    own risk. Backup your forum database and any and all
##                    applicable files before proceeding.
##
##
#
#
#---------[ 1. OPEN ]---------------------------------------------------------
#

post.php


#
#---------[ 5. FIND (line: 332) ]---------------------------------------------
#
$form = '<form id="post" method="post" action="post.php?action=post&amp;tid='.$tid.'" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}">';

#
#---------[ 6. REPLACE WITH     ]---------------------------------------------
#
$form = '<form id="post" method="post" name="post" action="post.php?action=post&amp;tid='.$tid.'" onsubmit="this.submit.disabled=true;if(process_form(this)){return true;}else{this.submit.disabled=false;return false;}">';

#
#---------[ 7. FIND (line: 385) ]---------------------------------------------
#
$form = '<form id="post" method="post" action="post.php?action=post&amp;fid='.$fid.'" onsubmit="return process_form(this)">';

#
#---------[ 8. REPLACE WITH     ]---------------------------------------------
#
$form = '<form id="post" method="post" name="post" action="post.php?action=post&amp;fid='.$fid.'" onsubmit="return process_form(this)">';

#
#---------[ 9. FIND (line: 467) ]---------------------------------------------
#
$cur_index = 1;

?>
#
#---------[ 10. ADD AFTER		]---------------------------------------------
#
<script type="text/javascript">
function AddSmiley(text) {
	var txtarea = document.post.msg;
	text = ' ' + text + ' ';
	if (txtarea.createTextRange && txtarea.caretPos) {
		var caretPos = txtarea.caretPos;
		caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
		txtarea.focus();
	} else {
		txtarea.value  += text;
		txtarea.focus();
	}
}
</script>

#
#---------[ 11. FIND (line: 488) ]---------------------------------------------
#
<legend><?php echo $lang_common['Write message legend'] ?></legend>

#
#---------[ 12. ADD AFTER		]---------------------------------------------
#
<!-- Start of smilies list -->
<fieldset style="margin-left:4px; line-height:1.5em; width:20%; float:right; margin-top:16px; text-align:left; text-decoration:none">
<legend>Smilies</legend>
<?php
	# Display all smilies
require_once PUN_ROOT.'include/parser.php';
$smilies = "";
$images = array();
foreach($smiley_text as $key => $value)
	{
	$smiley_text[$key] = str_replace("</p>"," ",$smiley_text[$key]);
	$smiley_text[$key] = str_replace("<p>"," ",$smiley_text[$key]);
	
	if(in_array($smiley_img[$key],$images))
			{
			continue;
			}
	$images[] = $smiley_img[$key];
	
	$smilies .= "<tt OnClick=\"javascript:AddSmiley('".$smiley_text[$key]."')\">" . parse_message($smiley_text[$key],0) . "</tt>";
	}
$smilies = str_replace(array("<p>","</p>")," ",$smilies);
echo $smilies;
?>
</fieldset>
<!-- End of smilies list -->

#
#---------[ 11. FIND (line: 532) ]---------------------------------------------
#
<textarea name="req_message" rows="20" cols="95" tabindex="<?php echo $cur_index++ ?>"><?php echo isset($_POST['req_message']) ? pun_htmlspecialchars($message) : (isset($quote) ? $quote : ''); ?></textarea><br /></label>

#
#---------[ 12. REPLACE WITH     ]---------------------------------------------
#
<textarea id="msg" name="req_message" rows="20" cols="95" tabindex="<?php echo $cur_index++ ?>"><?php echo isset($_POST['req_message']) ? pun_htmlspecialchars($message) : (isset($quote) ? $quote : ''); ?></textarea><br /></label>
#
#---------[ 13. OPEN ]----------------------------------------------------------
#
	viewtopic.php
#
#---------[ 14. FIND (line: 357) ]---------------------------------------------
#	
// Display quick post if enabled
if ($quickpost)
{

?>
#
#---------[ 15. ADD AFTER		]---------------------------------------------
#
	<script type="text/javascript">
	function AddSmiley(text) {
		var txtarea = document.post.req_message;
		text = ' ' + text + ' ';
		if (txtarea.createTextRange && txtarea.caretPos) {
			var caretPos = txtarea.caretPos;
			caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? caretPos.text + text + ' ' : caretPos.text + text;
			txtarea.focus();
		} else {
			txtarea.value  += text;
			txtarea.focus();
		}
	}
	</script>
#
#---------[ 16. FIND (line: 385) ]---------------------------------------------
#
	<input type="hidden" name="form_user" value="<?php echo (!$pun_user['is_guest']) ? pun_htmlspecialchars($pun_user['username']) : 'Guest'; ?>" />
#
#---------[ 17. ADD AFTER		]---------------------------------------------
#
	<!-- Start of smilies list -->
	<fieldset style="line-height:1.5em; float:right; text-align:left; text-decoration:none; float:left; margin-bottom:0.5em">
	<legend>Smilies</legend>
	<?php
		# Display all smilies
	require_once PUN_ROOT.'include/parser.php';
	$smilies = "";
	$images = array();
	$i = 1;
	foreach($smiley_text as $key => $value)
		{
		$smiley_text[$key] = str_replace("</p>"," ",$smiley_text[$key]);
		$smiley_text[$key] = str_replace("<p>"," ",$smiley_text[$key]);
		
		if(in_array($smiley_img[$key],$images))
				{
				continue;
				}
		$images[] = $smiley_img[$key];
		
		$smilies .= "<tt OnClick=\"javascript:AddSmiley('".$smiley_text[$key]."')\">" . parse_message($smiley_text[$key],0) . "</tt>";
		if($i == 12)
			{
			break;
			}
		$i++;
		}
	$smilies = str_replace(array("<p>","</p>")," ",$smilies);
	echo $smilies;
	?>
	</fieldset>
	<!-- End of smilies list -->	
#
#---------[ 18. SAVE/UPLOAD 	 ]---------------------------------------------
#