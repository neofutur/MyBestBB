<?php
/******************************************************************************************************
		Smilies.php
		-----------
This tool adds the possibility to easily add smileys without having to edit your parser.php every time.

-- Version 0.5
-- Created by El Bekko on 31-01-2006 

-- GPL:
  This software is free software; you can redistribute it and/or modify it
  under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 2 of the License,
  or (at your option) any later version.

  This software is distributed in the hope that it will be useful, but
  WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston,
  MA  02111-1307  USA
******************************************************************************************************/
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);
// Make the admin plugin
generate_admin_menu($plugin);
?>
<div class="block">
		<h2><span>Custom Smilies Plugin</span></h2>
		<div class="box">
			<div class="inbox">
				<div class="box" style="padding-bottom:1px">
				<h2>Plugin Information</h2>
				This plugin allows you to:<br />
				<menu> 
				<li style="list-style:inside">Easily define new smilies.</li>
				<li style="list-style:inside">Remove custom smilies</li>
				<li style="list-style:inside">Custom smilies <b>do not</b> override regular smilies</li>
				</menu>
				</div>
				<div class="box" style="padding-bottom:1px">
				<h2>Plugin Configuration</h2>
				<menu>
<?php //				<li style="list-style:inside"><a href="<?php // echo "admin_loader.php?plugin=AMP_Smilies.php&action=tablecreate"; " onClick="return confirm('Create the table?')">Create the table!</a></li> ?>
				<li style="list-style:inside"><a href="<?php echo "admin_loader.php?plugin=AMP_Smilies.php&action=cleantable"; ?>" onClick="return confirm('Delete all the smilies?')">Delete all the smilies!</a></li>
				</menu>
				<?php
				
				if(isset($_GET['action']))
					{
					$action = strval($_GET['action']);
					switch($action)
						{
/*						case "tablecreate":
						$create_query = "CREATE TABLE `" . $db->prefix . "smilies` (
										`Id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
										`Smiley_Name` VARCHAR( 255 ) NOT NULL ,
										`Smiley_Text` CHAR( 15 ) NOT NULL ,
										`Smiley_Image` VARCHAR( 255 ) NOT NULL ,
										PRIMARY KEY ( `Id` )
										)";
						$db->query($create_query) or error('Can not insert smiley row', __FILE__, __LINE__, $db->error());
						echo "Smiley table created!";
						break; */
						
						case "cleantable":
						$drop_query = "TRUNCATE TABLE `" . $db->prefix . "smilies`";
						$db->query($drop_query) or error('Can not empty table', __FILE__, __LINE__, $db->error());
						echo "All smilies deleted!";
						break;
						
						default:
						break;
						}
					}
				?>
				</div>
				<div class="box" style="padding-bottom:1px">
				<h2>List of smilies:</h2>
				<table border="0" cellspacing="0" cellpadding="0" style="width:auto">
				  <tr>
				  	<td><b>Smiley Name</b></td>
					<td><b>Smiley Text</b></td>
					<td><b>Smiley Image</b></td>
					<td><b>Delete Smiley</b></td>
				  </tr>
				<?php
				$get_query = "SELECT Id, Smiley_Name, Smiley_Text, Smiley_Image FROM " . $db->prefix . "smilies";
				$get_result = $db->query($get_query) or error('Can not get smileys', __FILE__, __LINE__, $db->error());
				$num_smilies = $db->num_rows($get_result);
				
				if($num_smilies == 0)
					{
					echo "<td>I think it's time to insert some new ones :)</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n";
					}
				else
					{
					while($row = $db->fetch_row($get_result))
						{
							## This may look like crappy coding, but it helps me make sure I have the right stuff :P
						$row['Smiley_Name'] 	= $row[1];
						$row['Smiley_Text'] 	= $row[2];
						$row['Smiley_Image'] 	= $row[3];
						$row['Id']				= $row[0];
						
						echo "<tr>";
						echo "<td>" . pun_htmlspecialchars(stripslashes($row['Smiley_Name'])) . "</td>\n";
						echo "<td>" . pun_htmlspecialchars(stripslashes($row['Smiley_Text'])) . "</td>\n";
						
						// If the selected file doesn't exist, show upload form
						$file = PUN_ROOT . "img/smilies/" . $row['Smiley_Image'];
						if(is_file($file))
							{
							echo "<td><img src=\"" . PUN_ROOT . "img/smilies/" . $row['Smiley_Image'] . "\" alt=\"" . $row['Smiley_Image'] . "\" width=\"15\" height=\"15\" /></td>\n";
							}
						else
							{
							echo "<td><form action=\"admin_loader.php?plugin=AMP_Smilies.php&action=uploadsmiley&smiley_img=" . $row['Smiley_Image'] . "\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" id=\"form1\">
									  <input type=\"file\" name=\"Smiley\" />
									  <input type=\"submit\" name=\"Submit\" value=\"Submit\" />
								  </form></td>\n";
							}
						
						echo "<td>[<a href=\"admin_loader.php?plugin=AMP_Smilies.php&action=delete&Id=" . $row['Id'] . "\" onClick=\"return confirm('Delete this smiley?')\">Delete</a>]</td>\n";
						echo "</tr>";
						} // End of fetch_array 
						
					}
				?>
				<tr>
					<td>&nbsp;</td>
					<td><u><b style="text-align:center; font-size:larger">Insert a smiley</b></u></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<form action="<?php echo "admin_loader.php?plugin=AMP_Smilies.php&action=insert"; ?>" method="post" id="insert">
				<tr>
					<td><input type="text" name="New_Smiley_name"></td>
					<td><input type="text" name="New_Smiley_text"></td>
					<td><input type="text" name="New_Smiley_image"></td>
					<td><input type="submit" name="New_Smiley_submit" value="Submit!"></td>
				</tr>
				</form>
				</table>
				<?php
				if(isset($_GET['action']))
					{
					switch($action)
						{
						case "delete":
						$id = intval($_GET['Id']);
						$del_query = "DELETE FROM " . $db->prefix . "smilies WHERE Id='" . $id . "'";
						$db->query($del_query) or error('Can not delete smiley row', __FILE__, __LINE__, $db->error());
						echo "Smiley deleted. ",mysql_error();
						echo "<script language=\"javascript\" type=\"text/javascript\"> window.location.href='admin_loader.php?plugin=".$plugin."' </script>";
						break;
						
						case "insert":
						$new_smiley_name = $db->escape(strval($_POST['New_Smiley_name']));
						$new_smiley_text = $db->escape(strval($_POST['New_Smiley_text']));
						$new_smiley_image = $db->escape(strval($_POST['New_Smiley_image']));
						$insert_query = "INSERT INTO " . $db->prefix . "smilies(Smiley_Name, Smiley_Text, Smiley_Image) VALUES('$new_smiley_name','$new_smiley_text','$new_smiley_image')";
						$db->query($insert_query) or error('Can not insert smiley row', __FILE__, __LINE__, $db->error());
						echo "Smiley " . stripslashes($new_smiley_text) . " inserted into the database.";
						echo "<script language=\"javascript\" type=\"text/javascript\"> window.location.href='admin_loader.php?plugin=".$plugin."' </script>"; 
						break;
						
						case "uploadsmiley":
						if(isset($_FILES['Smiley']))
							{
							$imagepath = $_GET['smiley_img'];
							$filename = $_FILES['Smiley']['name'];
							$filetype = $_FILES['Smiley']['type'];
							$filesize = $_FILES['Smiley']['size'];
							$file_tmp_name = $_FILES['Smiley']['tmp_name'];
							
							$file_ext = explode(".",$filename);
							$file_ext = strtolower($file_ext[count($file_ext)-1]);
							echo $file_ext;
							$allowedarray = array("png","gif","jpg", "jpeg", "tif", "tiff");
							
							if(!in_array($filetype,$allowedarray))
								{
							
								if(is_uploaded_file($file_tmp_name))
									{
									move_uploaded_file($file_tmp_name, PUN_ROOT . "img/smilies/" . $imagepath);
									echo "Smiley uploaded!";
									echo "<script language=\"javascript\" type=\"text/javascript\"> window.location.href='admin_loader.php?plugin=".$plugin."' </script>";
									}
								}
							else
								{
								echo "Only image files can be uploaded!";
								}
							}
						break;
						
						default:
						break;
						}
					}
				?>
				</div>
				<p><a href="javascript: history.go(-1)">Go back</a></p>
			</div>
		</div>
	</div>