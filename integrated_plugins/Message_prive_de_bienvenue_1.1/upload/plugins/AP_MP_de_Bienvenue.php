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

define('PLUGIN_URL', 'admin_loader.php?plugin=AP_MP_de_Bienvenue.php');

if (isset($_POST['form_sent']))
{
    $form = array_map('trim', $_POST['form']);
    
    $errors = array();
    $message = pun_linebreaks(pun_trim($form['welcome_message_mp']));

    if ($message == '')
        $message = 'Bienvenue %user%';
    else if (strlen($message) > 65535)
        $errors[] = 'Le message est trop long.';

    // Validate BBCode syntax
    if ($pun_config['p_message_bbcode'] == '1' && strpos($message, '[') !== false && strpos($message, ']') !== false)
    {
        require_once PUN_ROOT.'include/parser.php';
        $message = preparse_bbcode($message, $errors);
    }
    
    if (!empty($errors))
        message(implode('<br />',$errors));
        
    $form['welcome_message_mp'] = $message;
    
    while (list($key, $input) = @each($form))
    {
        // Only update values that have changed
        if (array_key_exists('o_'.$key, $pun_config) && $pun_config['o_'.$key] != $input)
        {
            if ($input != '' || is_int($input))
                $value = '\''.$db->escape($input).'\'';
            else
                $value = 'NULL';

            $db->query('UPDATE '.$db->prefix.'config SET conf_value='.$value.' WHERE conf_name=\'o_'.$db->escape($key).'\'') or error('Impossible de mettre a  jour la configuration des forums', __FILE__, __LINE__, $db->error());
        }
    }
    
    // Regenerate the config cache
    require_once PUN_ROOT.'include/cache.php';
    generate_config_cache();

    redirect(PLUGIN_URL, 'Parametres enregistres. Redirection ...');
}
	
// Display the admin navigation menu
generate_admin_menu($plugin);

?>
	<div class="block">
		<h2><span>Plugin "Message privé de Bienvenue"</span></h2>
		<div class="box">
			<div class="inbox">
				<p>Ce plugin permet d'activer et de créer le message de bienvenue que tous les nouveaux inscrits recevront dans leur messagerie personnelle.</p>
			</div>
		</div>
	</div>
	<br />
	<div class="blockform">
		<h2 class="block2"><span>Réglages</span></h2>
		<div class="box">
			<form method="post" action="<?php echo PLUGIN_URL ?>">
			<p class="submittop"><input type="submit" name="save" value=" Enregistrer " /></p>
				<div class="inform">
					<fieldset>
					<legend>Réglage de base</legend>
						<div class="infldset">
							<input type="hidden" name="form_sent" value="1" />
							<p>Activer l'envoi de message de bienvenue en message privé pour chaque nouvelle inscription ? </p>
							<label style="display: inline;"><input type="radio" name="form[welcome_mp]" value="1"<?php if ($pun_config['o_welcome_mp'] == '1') echo ' checked="checked"' ?> /> <strong>Oui</strong></label>   <label style="display: inline;"><input type="radio" name="form[welcome_mp]" value="0"<?php if ($pun_config['o_welcome_mp'] == '0') echo ' checked="checked"' ?> /> <strong>Non</strong></label>
							<br />
						</div>
					</fieldset>
				</div>
				<div class="inform">
					<fieldset>
					<legend>action du message de bienvenue</legend>
						<div class="txtarea">
							<label for="req_message"><strong><?php echo $lang_common['Message'] ?></strong></label>
							<textarea name="form[welcome_message_mp]" id="req_message" rows="20" cols="95"><?php echo $pun_config['o_welcome_message_mp'] ?></textarea>
							<?php 
                            /* Si vous utilisez la PunToolbar, d�comentez les lignes suivantes : */
                            /* punToolBar */
//if (file_exists(PUN_ROOT.'cache/cache_puntoolbar.php')) {
//    include PUN_ROOT.'cache/cache_puntoolbar.php';
//} else {
//    require_once PUN_ROOT.'include/cache_puntoolbar.php';
//    generate_ptb_cache();
//    require PUN_ROOT.'cache/cache_puntoolbar.php';
//}
?>
							<br />
							<p><strong>Note :</strong> %user% sera remplacé par le nom de l'utilisateur.</p>
							<ul class="bblinks">
								<li><a href="help.php#bbcode" onclick="window.open(this.href); return false;"><?php echo $lang_common['BBCode'] ?></a>: <?php echo ($pun_config['p_au_bbcode'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
								<li><a href="help.php#img" onclick="window.open(this.href); return false;"><?php echo $lang_common['img tag'] ?></a>: <?php echo ($pun_config['p_au_img_tag'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
								<li><a href="help.php#smilies" onclick="window.open(this.href); return false;"><?php echo $lang_common['Smilies'] ?></a>: <?php echo ($pun_config['o_smilies_sig'] == '1') ? $lang_common['on'] : $lang_common['off']; ?></li>
							</ul>
						</div>
					</fieldest>
				</div>
				<div class="inform">
					<fieldset>
					<legend> Apercu du message de bienvenue</legend>
						<div class="infldset">
<?php
						require PUN_ROOT.'include/parser.php';
						$parsed_message = parse_message($pun_config['o_welcome_message_mp'],0);
						$message_preview = '<p>Voici votre message tel qui sera recu :</p>'."\n\t\t\t\t\t".'<hr />'."\n\t\t\t\t\t\t".'<p>'.$parsed_message.'</p>'."\n";
 ?>
							<?php echo $message_preview ?>
						</div>
					</fieldset>
				</div>
			<p class="submitend"><input type="submit" name="save" value=" Enregistrer " /></p>
		</div>
	</div>
