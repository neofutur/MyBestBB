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
  
  Traduction : http://www.punbb.fr/

************************************************************************/


// L'id du forum duquel extraire les news
$forum_id = 1;

// Nombre de message de news a afficher
$num_posts_index = 5;

// Chemin vers le template des news
$template_path = PUN_ROOT.'plugins/AP_Generateur_de_News/news.tpl';

// Repertoires dans lesquels le plugin enregistrera le code genere (doivent comporter un slash a la fin)
$output_dir_latest = PUN_ROOT.'news/';
$output_dir_archive = PUN_ROOT.'news/archive/';



/***********************************************************************
                     NE MODIFIEZ PAS LES LIGNES CI-DESSOUS
/***********************************************************************/

// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;

// Tell admin_loader.php that this is indeed a plugin and that it is loaded
define('PUN_PLUGIN_LOADED', 1);


if (isset($_POST['gen_news']))
{
	// Generate front page news
	$result = $db->query('SELECT id, subject FROM '.$db->prefix.'topics WHERE forum_id='.$forum_id.' ORDER BY sticky DESC, posted DESC LIMIT 0, '.$num_posts_index) or error('Impossible de recuperer la liste des sujets', __FILE__, __LINE__, $db->error());
	if (!$db->num_rows($result))
		message('Il n\'y a pas de sujets pour generer les news a partir du forum ID = '.$forum_id.'.');

	require PUN_ROOT.'include/parser.php';

	$news_tpl = file_get_contents($template_path) or error('Impossible d\'ouvrir le fichier template '.$template_path.'. Assurez-vous que la variable $template_path est correctement renseignee.', __FILE__, __LINE__);

	$fh = @fopen($output_dir_latest.'news.html', 'wb');
	if (!$fh)
		error('Impossible d\'ecrire les news dans '.$output_dir_latest.'news.html. Veuillez vous assurer que PHP possede les droits d\'ecriture dans le repertoire '.$output_dir_latest, __FILE__, __LINE__);

	while ($cur_topic = $db->fetch_assoc($result))
	{
		$result2 = $db->query('SELECT posted, poster, poster_id, message, hide_smilies FROM '.$db->prefix.'posts WHERE topic_id='.$cur_topic['id'].' ORDER BY posted ASC LIMIT 1') or error('Impossible de recuperer la liste des sujets', __FILE__, __LINE__, $db->error());
		$cur_post = $db->fetch_assoc($result2);
		
		$message = parse_message($cur_post['message'],	$cur_post['hide_smilies']);
		$message = str_replace('img/smilies/', $pun_config['o_base_url'].'/img/smilies/', $message);

		$search = array(
					'<titre_news>', 
					'<date_news>', 
					'<nom_auteur>',
					'<url_profil_auteur>',
					'<message_news>', 
					'<url_news>'
					);
		$replace = array(
					pun_htmlspecialchars($cur_topic['subject']),
					date($pun_config['o_date_format'].' '.$pun_config['o_time_format'], $cur_post['posted']),
					pun_htmlspecialchars($cur_post['poster']),
					$pun_config['o_base_url'].'/profile.php?id='.$cur_post['poster_id'],
					$message,
					$pun_config['o_base_url'].'/viewtopic.php?id='.$cur_topic['id']
					);

		fwrite($fh, str_replace($search, $replace, $news_tpl));
	}

	fclose($fh);


	// Generate monthly archives
	$year_end = intval(date('Y'));
	$month_end = intval(date('n'));

	$year_start = ($month_end != 1) ? $year_end : $year_end-1;
	$month_start = ($month_end != 1) ? $month_end-1 : 12;

	// How far back should we go?
	$result = $db->query('SELECT MIN(posted) FROM '.$db->prefix.'topics WHERE forum_id='.$forum_id.'') or error('Impossible de recuperer les sujets les plus recents', __FILE__, __LINE__, $db->error());
	$history_limit = $db->result($result);

	$year_limit = intval(date('Y', $history_limit));
	$month_limit = intval(date('n', $history_limit));

	while ($year_end > $year_limit || $month_end > $month_limit)
	{
		$result = $db->query('SELECT id, subject FROM '.$db->prefix.'topics WHERE forum_id='.$forum_id.' AND posted>=UNIX_TIMESTAMP(\''.$year_start.'-'.$month_start.'-01\') AND posted<UNIX_TIMESTAMP(\''.$year_end.'-'.$month_end.'-01\') ORDER BY posted DESC') or error('Impossible de recuperer la liste des sujets', __FILE__, __LINE__, $db->error());
		if ($db->num_rows($result))
		{
			$news_tpl = file_get_contents($template_path) or error('Impossible d\'ouvrir le fichier template '.$template_path.'. Assurez-vous que la variable $template_path est correctement renseignee.', __FILE__, __LINE__);

			$fh = @fopen($output_dir_archive.$year_start.'-'.($month_start > 9 ? $month_start : '0'.$month_start).'.html', 'wb');
			if (!$fh)
				error('Impossible d\'ecrire les archives des news dans '.$output_dir_archive.$year_start.'-'.($month_start > 9 ? $month_start : '0'.$month_start).'.html. Veuillez vous assurer que PHP possede les droits d\'ecriture dans le repertoire '.$output_dir_archive, __FILE__, __LINE__);

			while ($cur_topic = $db->fetch_assoc($result))
			{
				$result2 = $db->query('SELECT posted, poster, poster_id, message, hide_smilies FROM '.$db->prefix.'posts WHERE topic_id='.$cur_topic['id'].' ORDER BY posted ASC LIMIT 1') or error('Impossible de recuperer la liste des sujets', __FILE__, __LINE__, $db->error());
				$cur_post = $db->fetch_assoc($result2);
		
				$message = parse_message($cur_post['message'],	$cur_post['hide_smilies']);
				$message = str_replace('img/smilies/', $pun_config['o_base_url'].'/img/smilies/', $message);
		
				$search = array(
							'<titre_news>', 
							'<date_news>', 
							'<nom_auteur>',
							'<url_profil_auteur>',
							'<message_news>', 
							'<url_news>'
							);
				$replace = array(
							pun_htmlspecialchars($cur_topic['subject']),
							date($pun_config['o_date_format'].' '.$pun_config['o_time_format'], $cur_post['posted']),
							pun_htmlspecialchars($cur_post['poster']),
							$pun_config['o_base_url'].'/profile.php?id='.$cur_post['poster_id'],
							$message,
							$pun_config['o_base_url'].'/viewtopic.php?id='.$cur_topic['id']
							);
		
				fwrite($fh, str_replace($search, $replace, $news_tpl));
			}

			fclose($fh);
		}

		$year_end = $year_start;
		$month_end = $month_start;
		$year_start = ($month_end != 1) ? $year_end : $year_end-1;
		$month_start = ($month_end != 1) ? $month_end-1 : 12;
	}

	generate_admin_menu($plugin);

?>
	<div class="block">
		<h2><span>Resultats du Generateur de News</span></h2>
		<div class="box">
			<div class="inbox">
				<p>News generees avec succes.</p>
			</div>
		</div>
	</div>
<?php

}
else
{
	generate_admin_menu($plugin);

?>
	<div class="blockform">
		<h2><span>Generateur de News</span></h2>
		<div class="box">
			<form id="example" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>&amp;foo=bar">
				<div class="inform">
					<fieldset>
						<legend>Generer un contenu de news statique</legend>
						<div class="infldset">
							<p>Ce plugin recupere les messages depuis le forum specifie et genere un contenu statique de ces messages sur le modele d'un template de news. Il creer un fichier news.html qui contient les plus recentes news et une archive mensuelle  (ex. 2005-01.html) pour tous les messages du forum. <strong>Regardez en haut du fichier source  PHP le code pour ce plugin afin de changer les parametres que vous voyez ci-dessous.</strong></p>
							<table class="aligntop" cellspacing="0">
								<tr>
									<th scope="row">Recupere les messages du forum</th>
									<td><span><?php echo $forum_id ?></span></td>
								</tr>
								<tr>
									<th scope="row">Nombre de messages</th>
									<td><span><?php echo $num_posts_index ?></span></td>
								</tr>
								<tr>
									<th scope="row">Utilise le template</th>
									<td><span><?php echo $template_path ?></span></td>
								</tr>
								<tr>
									<th scope="row">Enregistre les dernieres news dans</th>
									<td><span><?php echo $output_dir_latest ?></span></td>
								</tr>
								<tr>
									<th scope="row">Enregistre les  archives dans </th>
									<td><span><?php echo $output_dir_archive ?></span></td>
								</tr>

							</table>
							<div class="fsetsubmit"><input type="submit" name="gen_news" value="Generer les News" tabindex="1" />
							</div>
						</div>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
<?php

}
