<?php
/***********************************************************************

  Copyright (C) 2005  Connor Dunn (Connorhd@mypunbb.com)

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

************************************************************************/

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
    exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);
define('PLUGIN_VERSION', '1.2');
define('PLUGIN_URL', 'admin_loader.php?plugin=AP_Messagerie_personnelle.php');

if (isset($_POST['form_sent']))
{
	$form = array_map('trim', $_POST['form']);
	$allow = array_map('trim', $_POST['allow']);
	$limit = array_map('trim', $_POST['limit']);

	while (list($key, $input) = @each($form))
	{
		// Only update values that have changed
		if ((isset($pun_config['o_'.$key])) || ($pun_config['o_'.$key] == NULL))
		{
			if ($pun_config['o_'.$key] != $input)
			{
				if ($input != '' || is_int($input))
					$value = '\''.$db->escape($input).'\'';
				else
					$value = 'NULL';
	
				$db->query('UPDATE '.$db->prefix.'config SET conf_value='.$value.' WHERE conf_name=\'o_'.$key.'\'') or error('Impossible de mettre à jour la configuration', __FILE__, __LINE__, $db->error());
			}
		}
	}

	while (list($id, $set) = @each($allow))
	{
		$db->query('UPDATE '.$db->prefix.'groups SET g_pm='.$set.' WHERE g_id=\''.$id.'\'') or error('Impossible de changer les permissions.', __FILE__, __LINE__, $db->error());
	}
	
	while (list($id, $set) = @each($limit))
	{
		$db->query('UPDATE '.$db->prefix.'groups SET g_pm_limit='.intval($set).' WHERE g_id=\''.$id.'\'') or error('Impossible de changer les permissions.', __FILE__, __LINE__, $db->error());
	}
	
	// Regenerate the config cache
	require_once PUN_ROOT.'include/cache.php';
	generate_config_cache();

	redirect(PLUGIN_URL, 'Options modifiées. Redirection...');
}
else
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);
?>
	<div class="block">
		<h2><span>Messages privés v<?php echo PLUGIN_VERSION ?></span></h2>
		<div class="box">
			<div class="inbox">
				<p>Plugin de gestion des quotas de messages privés en fonctions des groupes</p>
			</div>
		</div>
	</div>
	<div class="blockform">
		<h2 class="block2"><span>Paramètres</span></h2>
		<div class="box">
			<form method="post" action="<?php echo PLUGIN_URL; ?>">
				<div class="inform">
					<input type="hidden" name="form_sent" value="1" />
					<fieldset>
						<legend>Options</legend>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<tr>
								<th scope="row">Activer la messagerie personnelle</th>
								<td>
									<input type="radio" name="form[pms_enabled]" value="1"<?php if ($pun_config['o_pms_enabled'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Oui</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[pms_enabled]" value="0"<?php if ($pun_config['o_pms_enabled'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>Non</strong>
									<span>Permet d'activer ou non le système de messages privés.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Permettre notification</th>
								<td>
									<input type="radio" name="form[pms_notification]" value="1"<?php if ($pun_config['o_pms_notification'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Oui</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[pms_notification]" value="0"<?php if ($pun_config['o_pms_notification'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>Non</strong>
									<span>Permet d'autoriser ou non les utilisateurs a utiliser la notification par courriel de nouveaux messages privés.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Activer notification par pop-up</th>
								<td>
									<input type="radio" name="form[pms_popup]" value="1"<?php if ($pun_config['o_pms_popup'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Oui</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="form[pms_popup]" value="0"<?php if ($pun_config['o_pms_popup'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>Non</strong>
									<span>Permet d'activer la notification par pop-up de nouveaux messages privés sur les forums.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Messages par page</th>
								<td>
									<input type="text" name="form[pms_mess_per_page]" size="5" maxlength="10" value="<?php echo $pun_config['o_pms_mess_per_page'] ?>" />
									<span>Le nombre de messages qui seront visibles par page dans la messagerie.</span>
								</td>
							</tr>
							<tr>
								<th scope="row">Nombre destinataires</th>
								<td>
									<input type="text" name="form[pms_max_receiver]" size="5" maxlength="5" value="<?php echo $pun_config['o_pms_max_receiver'] ?>" />
									<span>Le nombre maximum de destinataires par message privé.</span>
								</td>
							</tr>
						</table>
						</div>
					</fieldset>
				</div>
				<div class="inform">
					<fieldset>
						<legend>Permissions</legend>
						<p>Les administrateurs et les modérateurs n'ont pas de limite d'utilisation des messages privés. A l'inverse, les invités n'ont aucun droit. Enfin, vous pouvez régler les permissions des autres groupes ci-dessous.</p>
						<div class="infldset">
						<table class="aligntop" cellspacing="0">
							<?php
							$result = $db->query('SELECT g_id, g_title, g_pm, g_pm_limit FROM '.$db->prefix.'groups WHERE g_id> g_id != 1 ORDER BY g_id') or error('Impossible de trouver la liste des groupes d\'utilisateur', __FILE__, __LINE__, $db->error());
							while ($cur_group = $db->fetch_assoc($result)) :
								if ($cur_group['g_id'] > PUN_GUEST) :
							?>
							<tr> 
								<th scope="row"><?php echo $cur_group['g_title'] ?></th>
								<td>
									<span>Permettre à ce groupe d'utiliser les messages privés :</span>
									<input type="radio" name="allow[<?php echo $cur_group['g_id'] ?>]" value="1"<?php if ($cur_group['g_pm'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Oui</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="allow[<?php echo $cur_group['g_id'] ?>]" value="0"<?php if ($cur_group['g_pm'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>Non</strong>
								</td>
							</tr>
							<tr>
								<th scope="row">&nbsp;</th>
								<td>
									<span><input type="text" name="limit[<?php echo $cur_group['g_id'] ?>]" size="5" maxlength="10" value="<?php echo $cur_group['g_pm_limit'] ?>" /> est le nombre maximum de messages que les <em><?php echo $cur_group['g_title'] ?></em> pourront avoir dans leurs boites. Mettre 0 pour aucune limite.
								</span>
									</td>
							</tr>
							<?php
								endif;
							endwhile;
							?>
							
						</table>
						</div>
					</fieldset>
				</div>
			<p class="submitend"><input type="submit" name="save" value="Enregistrer" /></p>
			</form>
		</div>
	</div>

<?php
}
?>