<?php
/***********************************************************************

  Copyright (C) 2005  Terrell Russell (punbb@terrellrussell.com)
  
  Copyright (C) 2006  FoxMaSk (foxmask@punbb.fr)

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


/*********************************************************************** 
18 Mai 2006 - Auteur FoxMask -  AP_Email_Global_Plus v 1.0

adaptee du plugin AP_Email_Global.php de Terrell Russell

ce plugin permet d'envoyer des mails en masse a un groupe d'utilisateurs donne
et ajoute le groupe administrateur pour 'accuser' reception du mail de masse.

************************************************************************/


// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);



// --------------------------------------------------------------------

// Confirm Page

if (isset($_POST['confirm']))
{
	// Make sure message body was entered
	if (trim($_POST['message_body']) == '')
		message('Vous n\'avez pas ecrit de message!');

	// Make sure message subject was entered
	if (trim($_POST['message_subject']) == '')
		message('Vous n\'avez pas precise le sujet!');

	// Display the admin navigation menu
	generate_admin_menu($plugin);
	
	$preview_message_body = nl2br(pun_htmlspecialchars($_POST['message_body']));
	
    if (! is_numeric($_POST['group_id']) ) message('tsss tsss tsss!!!');
    
    // envoi a tous les groupes sauf invite
    if ($_POST['group_id'] == '0' ) 
	    $sql = "SELECT count(*) AS usercount
				FROM ".$db->prefix."users
				WHERE group_id <> '3' ORDER BY username";
    else 
    // envoi a un groupe en particulier
	    $sql = "SELECT count(*) AS usercount
				FROM ".$db->prefix."users
				WHERE group_id = '".$_POST['group_id']."'" .
			" ORDER BY username";
                
	$result = $db->query($sql) or error('Ne peut trouver le nombre d\'utilisateur dans la base de donnees', __FILE__, __LINE__, $db->error());
   	$row = $db->fetch_assoc($result);

?>
	<div id="exampleplugin" class="blockform">
		<h2><span>Mail de Masse - Confirmation</span></h2>
		<div class="box">
			<div class="inbox">
				<p>Merci de confirmer votre message ci-dessous.<br /><br />Pour d'eventuelles corrections: <a href="javascript: history.go(-1)">Retour</a>.</p>
			</div>
		</div>

		<h2 class="block2"><span>Confirmation de l'envoi du Message</span></h2>
		<div class="box">
			<form id="broadcastemail" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
				<div class="inform">
					<input type="hidden" name="message_subject" value="<?php echo pun_htmlspecialchars($_POST['message_subject']) ?>" />
					<input type="hidden" name="message_body" value="<?php echo pun_htmlspecialchars($_POST['message_body']) ?>" />
                    <input type="hidden" name="group_id" value="<?php echo $_POST['group_id']; ?>"/>
					<fieldset>
						<legend>Destinataires</legend>
						<div class="infldset">
							[ <strong><?php echo $row['usercount'] ?></strong> ] membres vont recevoir ce message (Administrateur inclu).
						</div>
					</fieldset>
				</div>
				<div class="inform">
					<fieldset>
						<legend>Contenu du message</legend>
						<div class="infldset">
							<table class="aligntop" cellspacing="0">
								<tr>
									<th scope="row">Sujet</th>
									<td>
										<?php echo pun_htmlspecialchars($_POST['message_subject']) ?>
									</td>
								</tr>
								<tr>
									<th scope="row">Corps du message</th>
									<td>
										<?php echo $preview_message_body ?>
									</td>
								</tr>
							</table>
							<div class="fsetsubmit"><input type="submit" name="send_message" value="Confirmer - Envoyer." tabindex="3" /></div>
							<p class="topspace">A n'effectuer qu'une seule fois. La patience est une vertu.</p>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php

}

// --------------------------------------------------------------------

// Send the Message

else if (isset($_POST['send_message']))
{

	require_once PUN_ROOT.'include/email.php';

	// Display the admin navigation menu
	generate_admin_menu($plugin);
                
    if (! is_numeric($_POST['group_id']) ) message ('tsss tsss tsss!!!');
    
    // envoi a tous les groupes sauf invite
    if ($_POST['group_id'] == '0' ) 
	    $sql = "SELECT username, email
				FROM ".$db->prefix."users
				WHERE group_id <> '3' ORDER BY username";
    
    // envoi au groupe administrateur seulement
    elseif ($_POST['group_id'] == '1' ) 
    
	    $sql = "SELECT username, email
				FROM ".$db->prefix."users
				WHERE group_id = '1'" .
			" ORDER BY username";
            
    else 
    // envoi a un groupe en particulier + groupe administrateur
	    $sql = "SELECT username, email
				FROM ".$db->prefix."users
				WHERE group_id = '".$_POST['group_id']."' or group_id = '1'" .
			" ORDER BY username";
            
	$result = $db->query($sql) or error('Ne peut trouver les utilisateurs dans la base de donnees', __FILE__, __LINE__, $db->error());
   	while($row = $db->fetch_assoc($result))
   	{
   		$addresses[$row['username']] = $row['email'];
   	}

	$usercount = count($addresses);
    
	foreach ($addresses as $recipientname => $recipientemail)
	{
	
		$mail_to        = $recipientname." <".$recipientemail.">";
		$mail_subject   = pun_htmlspecialchars($_POST['message_subject']);
		$mail_message   = pun_htmlspecialchars($_POST['message_body']);
        
		pun_mail($mail_to, $mail_subject, $mail_message);
	}


	
?>
	<div class="block">
		<h2><span>Mail de Masse - Message Envoye</span></h2>
		<div class="box">
			<div class="inbox">
				<p>Ce message a ete envoye a [ <strong><?php echo $usercount ?></strong> ] membres.</p>
				<p>En tant qu'administrateur, vous allez recevoir une copie de celui-ci.</p>
				<p>Vous pouvez considerer cette copie comme une confirmation de l'envoi.</p>
			</div>
		</div>
	</div>
<?php

}

// --------------------------------------------------------------------

// Display the Main Page

else
{
	// Display the admin navigation menu
	generate_admin_menu($plugin);

?>
	<div id="exampleplugin" class="blockform">
		<h2><span>Mail de Masse</span></h2>
		<div class="box">
			<div class="inbox">
				<p>Ce plugin permet a l'administrateur d'envoyer un mail general a tous les membres d'un groupe du forum.</p>
				<p>Une page recapitulative de confirmation succedera a celle-ci.</p>
			</div>
		</div>

		<h2 class="block2"><span>Rediger un Message</span></h2>
		<div class="box">
			<form id="broadcastemail" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
				<div class="inform">
					<fieldset>
						<legend>Contenu du message</legend>
						<div class="infldset">
							<table class="aligntop" cellspacing="0">
                                <tr>
                                    <th scope="row">Groupe</th>
                                    <td>
                                        <select name="group_id">
                                            <option value="0" select="selected">Tous</option>
                                        <?php 
                                        // on ne prend pas le groupe 'invite'.
                                        $sql_group = "SELECT * FROM ".$db->prefix."groups WHERE g_id <> '3' ORDER BY g_id";
                                        $result_group = $db->query($sql_group) or error('ne peut trouver la liste des groupes d\'utilisateurs',__FILE__, __LINE__, $db->error()); 
                                        while ($row_group = $db->fetch_assoc($result_group)) {
                                        ?>
                                            <option value="<?php echo $row_group['g_id']; ?>"><?php echo $row_group['g_title']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                </tr>
								<tr>
									<th scope="row">Sujet</th>
									<td>
										<input type="text" name="message_subject" size="50" tabindex="1" />
									</td>
								</tr>
								<tr>
									<th scope="row">Corps du message</th>
									<td>
										<textarea name="message_body" rows="14" cols="48" tabindex="2"></textarea>
									</td>
								</tr>
							</table>
							<div class="fsetsubmit"><input type="submit" name="confirm" value="Continuer vers Confirmation" tabindex="3" /></div>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php

}

// --------------------------------------------------------------------

// Note that the script just ends here. The footer will be included by admin_loader.php.
