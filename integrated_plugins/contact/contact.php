<?php
define('PUN_ROOT', './');
define('PUN_QUIET_VISIT', 1);
require PUN_ROOT.'include/common.php';
$page_title = pun_htmlspecialchars($pun_config['o_board_title']) . ' / Contactez-nous';		//Set the page title here
define('PUN_ALLOW_INDEX', 1);
require PUN_ROOT.'header.php';
require PUN_ROOT.'include/parser.php';
//echo "<PRE>"; print_r ($pun_config); echo "</PRE>";

if ($_POST[form_sent] == 1) {
//Process The Form
?>

<?php
	$recipient = "$toName <".$toMail.">";
	$headers ="From: ".$_POST[name]." <".$_POST[email].">";
	$subject = "WEBFORM:".$_POST[subject];
	$message = str_replace("\\", "", $_POST[comments]);
	mail($pun_config['o_admin_email'], $subject, $message, $headers);
?>


<div class="blockform">
	<h2><span>Contactez-nous <?php echo $pun_config['o_board_title']; ?></span></h2>
	<div class="box">
		<form id="contact" method="post" action="contact.php">
			<div class="inform">
				<fieldset>
					<legend>Email Sent</legend>
					<div class="infldset">
						<b>Thank you for contacting us!</b> The following information was sent to <?php echo $pun_config['o_board_title']; ?>.<br /><br />
						<label>Votre Nom:<br /><?php echo $_POST[name]; ?><br /></label>
						<label>Votre Email:<br /><?php echo $_POST[email]; ?><br /></label>
						<label>Sujet:<br /><?php echo $_POST[subject]; ?><br /></label>
						<label>Commentaires:<br /><?php echo $_POST[comments]; ?><br /></label>
					</div>
				</fieldset>
			</div>
		</form>
	</div>
</div>

<?php } else { 
//Display the Form
?>

<div class="blockform">
	<h2><span>Formulaire de contact d'<?php echo $pun_config['o_board_title']; ?></span></h2>
	<div class="box">
		<form id="contact" method="post" action="contact.php">
			<div class="inform">
				<fieldset>
					<legend>Entrez vos informations de contact.</legend>
					<div class="infldset">
						Veuillez écrire vos information et votre message ici. Si vous avez de commentaires, problèmes ou autre avec le forum, merci de nous les faire parvenir.<br />
						<input type="hidden" name="form_sent" value="1" /><br />
						<label>Nom<br /><input type="text" name="name" value="" size="40" maxlength="40" /><br /></label>
						<label>Email<br /><input type="text" name="email" value="" size="40" maxlength="50" /><br /></label>
						<label>Sujet<br /><input type="text" name="subject" value="" size="40" maxlength="50" /><br /></label>
						<label>Message<br /><textarea name="comments" rows="5" cols="40"></textarea><br /></label>
					</div>
				</fieldset>
			</div>
			<p><input type="submit" name="update" value="Envoyez" /></p>
		</form>
	</div>
</div>



<?php

}	//close if statement
 
require PUN_ROOT.'footer.php';