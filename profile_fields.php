<?php
/***********************************************************************

  Copyright (C) 2006  El Bekko (elbekko@gmail.com)

  This file isn't part of PunBB.

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
// Load the profile.php/register.php language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/prof_reg.php';

if($pun_user['is_guest'])
	message($lang_common['No view']);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id < 2)
    message($lang_common['Bad request']);

// Load the profile.php language file
require PUN_ROOT.'lang/'.$pun_user['language'].'/profile.php';

if(isset($_GET['action']) && $_GET['action'] == 'update')
{
	$fields = $_POST['fields'];
	foreach($fields as $key => $value)
	{
		$value = pun_htmlspecialchars($db->escape($value));
		$key = intval($key);
		
		if($db->result($db->query("SELECT f_id FROM ".$db->prefix."profile_field_entries WHERE f_id=".$key." AND u_id=".$id)))
			$db->query("UPDATE ".$db->prefix."profile_field_entries SET value='".$value."' WHERE f_id=".$key." AND u_id=".$id) or die(mysql_error());
		else
			$db->query("INSERT INTO ".$db->prefix."profile_field_entries (value, f_id, u_id) VALUES ('$value', '".$key."', '".$id."')") or die(mysql_error());
	}
	
	redirect("profile_fields.php?id=$id ?>", "Extra profile fields updated.");
}

$page_title = pun_htmlspecialchars($pun_config['o_board_title']) . " / Profile fields";
define('PUN_ALLOW_INDEX', 1);
require PUN_ROOT.'header.php';
include_once PUN_ROOT.'include/parser.php';

$id = $id;
generate_profile_menu('fields');
?>

<div class="blockform">
	<h2><span style="float:right"><a href="javascript:history.go(-1)"><?php echo $lang_common['Go back'] ?></a></span><span>Change your custom profile fields</span></h2>
	<div class="box">
		<form method="post" action="profile_fields.php?action=update&amp;id=<?php echo $id ?>" onsubmit="return process_form(this)">
			<div class="inform">
			<fieldset>
			<legend>Custom fields</legend>
				<?php
				$res1 = $db->query("SELECT * FROM ".$db->prefix."profile_field_entries WHERE u_id=".$id) or die(mysql_error());
				while($row1 = $db->fetch_assoc($res1))
					$entries[$row1['f_id']] = $row1['value'];
				
				$result = $db->query("SELECT * FROM ".$db->prefix."profile_fields ORDER BY `order` ASC");
				while($row = $db->fetch_assoc($result))
				{
					echo "\t\t\t<label><strong>".$row['name']."</strong><br />\n\t\t\t<input type=\"text\" name=\"fields[".$row['id']."]\" value=\"".$entries[$row['id']]."\" /></label>\n";
				}
				?>
				<input type="submit" name="update" value="<?php echo $lang_common['Submit'] ?>" style="margin-bottom: 10px; margin-top: 5px" />
			</fieldset>
			</div>
		</form>
	</div>
</div>
<div class="clearer"></div>
</div>
<?php
$footer_style = 'index';
require PUN_ROOT.'footer.php';
?>
