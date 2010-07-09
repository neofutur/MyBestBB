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


// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);


if (isset($_POST['update_version']))
{
	if (trim($_POST['to_version']) == '')
		message('Vous devez saisir un numero de version.');


	$db->query('UPDATE '.$db->prefix.'config SET conf_value=\''.$db->escape(trim($_POST['to_version'])).'\' WHERE conf_name=\'o_cur_version\'') or error('Unable to update board version string', __FILE__, __LINE__, $db->error());

	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();


	// Display the admin navigation menu
	generate_admin_menu($plugin);

?>
	<div class="block">
		<h2><span>Commutateur De Version</span></h2>
		<div class="box">
			<div class="inbox">
				<p>Version mise a jour.</p>
				<p><a href="javascript: history.go(-1)">Retour</a></p>
			</div>
		</div>
	</div>
<?php

}
else
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);

?>
	<div id="exampleplugin" class="blockform">
		<h2><span>Commutateur De Version</span></h2>
		<div class="box">
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>&amp;foo=bar">
				<div class="inform">
					<fieldset>
						<legend>Saisissez un numero de version et appuyez la "Mettre a jour"</legend>
						<div class="infldset">
							<p>Ce plugin vous permet de mettre a jour la chaine de caractere de version de PunBB.</p>
							<table class="aligntop" cellspacing="0">
								<tr>
									<th scope="row">Nouvelle version</th>
									<td>
										<input type="text" name="to_version" size="8" tabindex="1" />
										<span>La nouvelle chaine de caractere de version.</span>
									</td>
								</tr>
							</table>
							<div class="fsetsubmit"><input type="submit" name="update_version" value="Mettre a jour" tabindex="2" /></div>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php

}

// Note that the script just ends here. The footer will be included by admin_loader.php.
