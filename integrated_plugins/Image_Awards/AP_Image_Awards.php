<?php
/***********************************************************************

  PunBB Copyright (C) 2002-2005  Rickard Andersson (rickard@punbb.org)

  This file is not part of PunBB.

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

##
##
##  A few notes of interest for aspiring plugin authors:
##
##  1. If you want to display a message via the message() function, you
##     must do so before calling generate_admin_menu($plugin).
##
##  2. Plugins are loaded by admin_loader.php and must not be
##     terminated (e.g. by calling exit()). After the plugin script has
##     finished, the loader script displays the footer, so don't worry
##     about that. Please note that terminating a plugin by calling
##     message() or redirect() is fine though.
##
##  3. The action attribute of any and all <form> tags and the target
##     URL for the redirect() function must be set to the value of
##     $_SERVER['REQUEST_URI']. This URL can however be extended to
##     include extra variables (like the addition of &amp;foo=bar in
##     the form of this example plugin).
##
##  4. If your plugin is for administrators only, the filename must
##     have the prefix "AP_". If it is for both administrators and
##     moderators, use the prefix "AMP_". This example plugin has the
##     prefix "AMP_" and is therefore available for both admins and
##     moderators in the navigation menu.
##
##  5. Use _ instead of spaces in the file name.
##
##  6. Since plugin scripts are included from the PunBB script
##     admin_loader.php, you have access to all PunBB functions and
##     global variables (e.g. $db, $pun_config, $pun_user etc).
##
##  7. Do your best to keep the look and feel of your plugins' user
##     interface similar to the rest of the admin scripts. Feel free to
##     borrow markup and code from the admin scripts to use in your
##     plugins. If you create your own styles they need to be added to
##     the "base_admin" style sheet.
##
##  8. Plugins must be released under the GNU General Public License or
##     a GPL compatible license. Copy the GPL preamble at the top of
##     this file into your plugin script and alter the copyright notice
##     to refrect the author of the plugin (i.e. you).
##
##


// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);

//
// The rest is up to you!
//

// If the "Show text" button was clicked
if (isset($_POST['assign_award']))
{
	// Make sure something something was entered
	if (trim($_POST['award_user_id']) == '')
		message('You must assign the award to an user!');

	$db->query('UPDATE '.$db->prefix.'users SET imgaward="'.$db->escape($_POST['award_filename']).'" WHERE id="'.intval($_POST['award_user_id']).'" LIMIT 1') or error('Error when assigning new image award to user.',__FILE__,__LINE__,$db->error());
		
	message('Award added.');
		
}
else	// If not, we show the "Show text" form
{
	
	
	// Generate a dropdown for all the awards ...
	$awardmod_dropdown = '<select name="award_filename" tabindex="2"><option value="">**Remove Award**</option>';
	// figure out what files we have ... 
	$awardmod_directory = dir('./img/awards');
	while(($awardmod_temp = $awardmod_directory->read()) != false)
	{
		if(!is_dir($awardmod_temp) && $awardmod_temp != 'index.html')
		{
			$awardmod_dropdown .= '<option value="'.$awardmod_temp.'">'.str_replace('_',' ',substr($awardmod_temp,0,strrpos($awardmod_temp,'_'))).'</option>';
		}
	}
	$awardmod_directory->close();
	$awardmod_dropdown .= '</select>';
	
	
	
	// Display the admin navigation menu
	generate_admin_menu($plugin);

?>
	<div id="exampleplugin" class="blockform">
		<h2><span>Image Awards administration plugin</span></h2>
		<div class="box">
			<div class="inbox">
				<p>This plugin handles the image awards. Each user is allowed a maximum of one award.</p>
				<p>To add your own awards, just put the files in the "img/awards/" folder and name them in the following way:</p>
				<p>* Name of award with underscore (_) instead of space.</p>
				<p>* Dimensions of award separaded by a small x</p>
				<p>* File extension (heh, a no brainer ;))</p>
				<p>Example: An award called "Test Award" with size 100 pixels horizontal and 20 pixels high, in png format should be named: "Test_Award_100x20.png" in the directory. Failing to follow this standard will most probably make the awards to fail! This naming scheme is used to display the 'no image' version of the award (when people don't want to see avatars, they get the award as text instead), And also to format the img tag correctly.</p>
			</div>
		</div>

		<h2 class="block2"><span>Toolbox</span></h2>
		<div class="box">
			<form id="new" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
				<div class="inform">
					<fieldset>
						<legend>Give a user an award</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">User id</th>
								<td>
									<input type="text" name="award_user_id" size="5" tabindex="1" />
									<span>The user id of the user you want to assign or remove an award on.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Award<div><input type="submit" name="assign_award" value="Assign Award" tabindex="3" /></div></th>
								<td>
									<?php echo $awardmod_dropdown; ?>
									<span>The award the user is to be assigned (or select **Remove Award** to clear award on user)</span>
								</td>
							</tr>
						</table>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php

}

// Note that the script just ends here. The footer will be included by admin_loader.php.
