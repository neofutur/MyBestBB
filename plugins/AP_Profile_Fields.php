<?php
/***********************************************************************

  Copyright (C) 2006  El Bekko (elbekko@gmail.com)

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
/* .: Queries :.
CREATE TABLE `profile_fields` (
  `id` int(6) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `lang_entry` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
)
#########################################################################
CREATE TABLE `profile_field_entries` (
  `e_id` int(6) NOT NULL auto_increment,
  `f_id` int(6) NOT NULL,
  `value` varchar(255) default NULL,
  `u_id` int(6) NOT NULL,
  PRIMARY KEY  (`e_id`)
)
#########################################################################
*/
require PUN_ROOT.'lang/'.$pun_user['language'].'/AP_Profile_Fields.php';

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);

if(isset($_GET['action']) && $_GET['action'] == "submitnew")
{
	// Handle the new one here =)
	$name = $db->escape($_POST['name']);
	$lang_entry = $db->escape($_POST['lang_entry']);
	$order = $db->escape(intval($_POST['order']));
	
	$db->query("INSERT INTO ".$db->prefix."profile_fields (name, lang_entry, `order`) VALUES ('$name', '$lang_entry', '$order')") or die(mysql_error());
	redirect($_SERVER['PHP_SELD']."?plugin=".$plugin, "Added.");
}

if(isset($_GET['action']) && $_GET['action'] == 'submitedit')
{
	$name = $db->escape($_POST['name']);
	$lang_entry = $db->escape($_POST['lang_entry']);
	$order = $db->escape(intval($_POST['order']));
	$id = $db->escape($_POST['id']);

	$db->query("UPDATE ".$db->prefix."profile_fields SET name = '$name', lang_entry = '$lang_entry', `order` = '$order' WHERE id = '$id' LIMIT 1") or die(mysql_error());
	redirect($_SERVER['PHP_SELD']."?plugin=".$plugin, "Edited.");

}

if(isset($_GET['action']) && $_GET['action'] == "submitdelete")
{
	$id = intval($db->escape($_POST['id']));
	
	$db->query("DELETE FROM ".$db->prefix."profile_fields WHERE id=$id") or die(mysql_error());
	$db->query("DELETE FROM ".$db->prefix."profile_field_entries WHERE e_id=$id") or die(mysql_error());
	redirect($_SERVER['PHP_SELD']."?plugin=".$plugin, "Deleted.");
}
// Display the admin navigation menu
generate_admin_menu($plugin);

?>
<div id="main" class="blockform">
	<h2><span><?php echo $lang_Profile_Fields["title"]; ?></span></h2>
	<div class="box">
		<div class="inbox" style="padding:5px;">
		<fieldset style="float: left; margin-right: 5px;">
		<legend><?php echo $lang_Profile_Fields["MI_help"]; ?></legend>
		<p><?php echo $lang_Profile_Fields["description"]; ?></p>
		</fieldset>
		<fieldset>
		<legend><?php echo $lang_Profile_Fields["MI_menu"]; ?></legend>
		<ul>
		<li style="list-style:inside disc"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=new"; ?>"><?php echo $lang_Profile_Fields["Option_New"]; ?></a></li>
		<li style="list-style:inside disc"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=edit"; ?>"><?php echo $lang_Profile_Fields["Option_Edit"]; ?></a></li>
		<li style="list-style:inside disc"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=delete"; ?>"><?php echo $lang_Profile_Fields["Option_Delete"]; ?></a></li>
		<li style="list-style:inside disc"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=list"; ?>"><?php echo $lang_Profile_Fields["Option_View"]; ?></a></li>
		</ul>
		</fieldset>
		</div>
	</div>
</div>
<br />
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

switch($action)
{
	default:
	break;
	
	case 'new':
	?>
	<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=submitnew"; ?>">
	<div id="new" class="blockform">
		<h2><span style="float:right"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin; ?>"><small><?php echo $lang_Profile_Fields["MI_Hide"]; ?></small></a></span><span><?php echo $lang_Profile_Fields["H_CreateNewField"]; ?></span></h2>
		<div class="box">
			<div class="inbox" style="padding:5px;">
				<label><?php echo $lang_Profile_Fields["FL_Name"]; ?><br />
				<input type="text" name="name" />
				</label>
				<label><?php echo $lang_Profile_Fields["FL_Lang"]; ?><br />
				<input type="text" name="lang_entry" />
				</label>
				<label><?php echo $lang_Profile_Fields["FL_Order"]; ?><br />
				<input type="text" name="order" />
				</label>
				<input type="submit" name="submit" value="Submit" />
			</div>
		</div>
	</div>
	</form>
	<?php
	break;
	
	case 'delete':
	?>
	<form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=submitdelete"; ?>">
	<div id="new" class="blockform">
		<h2><span style="float:right"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin; ?>"><small><?php echo $lang_Profile_Fields["MI_Hide"]; ?></small></a></span><span><?php echo $lang_Profile_Fields["H_DeleteField"]; ?></span></h2>
		<div class="box">
			<div class="inbox" style="padding:5px;">
				<label><?php echo $lang_Profile_Fields["FL_Name"]; ?><br />
				<select name="id">
				<?php
				$result = $db->query("SELECT id, name FROM ".$db->prefix."profile_fields") or die(mysql_error());
				while($row = $db->fetch_assoc($result))
				{
					echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
				}
				?>
				</select>
				</label>
				<input type="submit" name="submit" value="Submit" />
			</div>
		</div>
	</div>
	</form>
	<?php
	break;
	
	case 'edit':
	?>
	<form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=goedit"; ?>">
	<div id="new" class="blockform">
		<h2><span style="float:right"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin; ?>"><small><?php echo $lang_Profile_Fields["MI_Hide"]; ?></small></a></span><span><?php echo $lang_Profile_Fields["H_EditField"]; ?></span></h2>
		<div class="box">
			<div class="inbox" style="padding:5px;">
				<label><?php echo $lang_Profile_Fields["FL_Name"]; ?><br />
				<select name="id">
				<?php
				$result = $db->query("SELECT id, name FROM ".$db->prefix."profile_fields") or die(mysql_error());
				while($row = $db->fetch_assoc($result))
				{
					echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
				}
				?>
				</select>
				</label>
				<input type="submit" name="submit" value="Submit" />
			</div>
		</div>
	</div>
	</form>
	
	<?php	
	break;
	
	case 'goedit':
	if(isset($_REQUEST['id'])) {
		$id = $db->escape($_REQUEST['id']);
	} else {
		die("No profile field selected.");
	}
	$result = $db->query("SELECT id, name, lang_entry, `order` FROM ".$db->prefix."profile_fields WHERE id = '$id' LIMIT 1") or die(mysql_error());
	if($db->num_rows($result) < 1) {
		die("Invalid entry chosen.");
	} else {
		$row = $db->fetch_assoc($result);
	}
	
	?>
	<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin."&amp;action=submitedit"; ?>">
	<div id="new" class="blockform">
		<h2><span style="float:right"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin; ?>"><small><?php echo $lang_Profile_Fields["MI_Hide"]; ?></small></a></span><span><?php echo $lang_Profile_Fields["H_CreateNewField"]; ?>Create New Profile Field</span></h2>
		<div class="box">
			<div class="inbox" style="padding:5px;">
				<label><?php echo $lang_Profile_Fields["FL_Name"]; ?><br />
				<input type="text" name="name" value="<?php echo htmlentities(stripslashes($row['name'])); ?>" />
				</label>
				<label><?php echo $lang_Profile_Fields["FL_Lang"] ?><br />
				<input type="text" name="lang_entry"  value="<?php echo htmlentities(stripslashes($row['lang_entry'])); ?>"  />
				</label>
				<label><?php echo $lang_Profile_Fields["FL_Order"] ?><br />
				<input type="text" name="order"  value="<?php echo htmlentities(stripslashes($row['order'])); ?>"  />
				</label>
				<input type="submit" name="submit" value="Submit" />
			</div>
		</div>
	</div>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	</form>	
	
	<?php
	break;
	
	case 'list':
	?>
	<div id="new" class="blockform">
		<h2><span style="float:right"><a href="<?php echo $_SERVER['PHP_SELF']."?plugin=".$plugin; ?>"><small><?php echo $lang_Profile_Fields["MI_Hide"] ?></small></a></span><span><?php echo $lang_Profile_Fields["H_ListFields"] ?></span></h2>
		<div class="box">
			<div class="inbox" style="padding:5px;">
				<?php
				$result = $db->query("SELECT id, name, lang_entry, `order` FROM ".$db->prefix."profile_fields") or die(mysql_error());
				while($row = $db->fetch_assoc($result))
				{
					echo "<p><strong>".$lang_Profile_Fields["FL_Id"]."</strong>".$row['id']." <strong>".$lang_Profile_Fields["FL_Name"]."</strong>".$row['name']." <strong>".$lang_Profile_Fields["FL_Lang"]."</strong>".$row['lang_entry']." <strong>".$lang_Profile_Fields["FL_Order"]."</strong>".$row['order']." </p><hr />\n";
				}
				?>
			</div>
		</div>
	</div>
	<?php
	break;
}
?>