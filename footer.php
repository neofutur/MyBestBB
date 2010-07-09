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

$tpl_temp = trim(ob_get_contents());
$tpl_main = str_replace('<pun_main>', $tpl_temp, $tpl_main);
ob_end_clean();
// END SUBST - <pun_main>


// START SUBST - <pun_footer>
ob_start();

?>
<div id="brdfooter" class="block">
	<h2><span><?php echo $lang_common['Board footer'] ?></span></h2>
	<div class="box">
		<div class="inbox">
<?php

// If no footer style has been specified, we use the default (only copyright/debug info)
$footer_style = isset($footer_style) ? $footer_style : NULL;
/* Start MOD PM */
if ($footer_style == 'pms_list')
{
?>
                        <dl id="searchlinks" class="conl">
                                <dt><strong>Liens messages privï¿½s</strong></dt>
<?php
if ($num_new_mp > 0)
        echo "\t\t\t\t\t\t".'<dd><a href="pms_list.php?action=markall&amp;box='.$box.'&amp;p='.$p.'">'.$lang_pms['Mark all'].'</a></dd>'."\n";

        echo '</dl>';
}
/* End MOD PM */

if ($footer_style == 'index' || $footer_style == 'search')
{
	if (!$pun_user['is_guest'])
	{
		echo "\n\t\t\t".'<dl id="searchlinks" class="conl">'."\n\t\t\t\t".'<dt><strong>'.$lang_common['Search links'].'</strong></dt>'."\n\t\t\t\t".'<dd><a href="search.php?action=show_24h">'.$lang_common['Show recent posts'].'</a></dd>'."\n";
		echo "\t\t\t\t".'<dd><a href="search.php?action=show_unanswered">'.$lang_common['Show unanswered posts'].'</a></dd>'."\n";

		if ($pun_config['o_subscriptions'] == '1')
			echo "\t\t\t\t".'<dd><a href="search.php?action=show_subscriptions">'.$lang_common['Show subscriptions'].'</a></dd>'."\n";

		echo "\t\t\t\t".'<dd><a href="search.php?action=show_user&amp;user_id='.$pun_user['id'].'">'.$lang_common['Show your posts'].'</a></dd>'."\n\t\t\t".'</dl>'."\n";
	}
	else
	{
		if ($pun_user['g_search'] == '1')
		{
			echo "\n\t\t\t".'<dl id="searchlinks" class="conl">'."\n\t\t\t\t".'<dt><strong>'.$lang_common['Search links'].'</strong></dt><dd><a href="search.php?action=show_24h">'.$lang_common['Show recent posts'].'</a></dd>'."\n";
			echo "\t\t\t\t".'<dd><a href="search.php?action=show_unanswered">'.$lang_common['Show unanswered posts'].'</a></dd>'."\n\t\t\t".'</dl>'."\n";
		}
	}
}
/*else if ($footer_style == 'viewforum' || $footer_style == 'viewtopic')
{*/
else if ($footer_style == 'viewpoll')
{
        echo "\n\t\t\t".'<div class="conl">'."\n";

        // Display the "Jump to" drop list
        if ($pun_config['o_quickjump'] == '1')
        {
                // Load cached quickjump
                @include_once PUN_ROOT.'cache/cache_quickjump_'.$pun_user['g_id'].'.php';
                if (!defined('PUN_QJ_LOADED'))
                {
                        require_once PUN_ROOT.'include/cache.php';
                        generate_quickjump_cache($pun_user['g_id']);
                        require PUN_ROOT.'cache/cache_quickjump_'.$pun_user['g_id'].'.php';
                }
        }

        if ($is_admmod)
        {
                echo "\t\t\t".'<dl id="modcontrols"><dt><strong>'.$lang_topic['Mod controls'].'</strong></dt><dd><a href="moderatepoll.php?fid='.$forum_id.'&amp;tid='.$id.'&amp;p='.$p.'">'.$lang_common['Delete posts'].'</a></dd>'."\n";
                echo "\t\t\t".'<dd><a href="moderatepoll.php?fid='.$forum_id.'&amp;move_topics='.$id.'">'.$lang_common['Move topic'].'</a></dd>'."\n";

                if ($cur_topic['closed'] == '1')
                        echo "\t\t\t".'<dd><a href="moderatepoll.php?fid='.$forum_id.'&amp;open='.$id.'">'.$lang_common['Open topic'].'</a></dd>'."\n";
                else
                        echo "\t\t\t".'<dd><a href="moderatepoll.php?fid='.$forum_id.'&amp;close='.$id.'">'.$lang_common['Close topic'].'</a></dd>'."\n";

                if ($cur_topic['sticky'] == '1')
                        echo "\t\t\t".'<dd><a href="moderatepoll.php?fid='.$forum_id.'&amp;unstick='.$id.'">'.$lang_common['Unstick topic'].'</a></dd></dl>'."\n";
                else
                        echo "\t\t\t".'<dd><a href="moderatepoll.php?fid='.$forum_id.'&amp;stick='.$id.'">'.$lang_common['Stick topic'].'</a></dd></dl>'."\n";
        }

        echo "\t\t\t".'</div>'."\n";
}

	echo "\n\t\t\t".'<div class="conl">'."\n";

	// Display the "Jump to" drop list
	if ($pun_config['o_quickjump'] == '1')
	{
		// Load cached quickjump
		@include_once PUN_ROOT.'cache/cache_quickjump_'.$pun_user['g_id'].'.php';
		if (!defined('PUN_QJ_LOADED'))
		{
			require_once PUN_ROOT.'include/cache.php';
			generate_quickjump_cache($pun_user['g_id']);
			require PUN_ROOT.'cache/cache_quickjump_'.$pun_user['g_id'].'.php';
		}
	}

	if ($footer_style == 'viewforum' && $is_admmod)
		echo "\t\t\t".'<p id="modcontrols"><a href="moderate.php?fid='.$forum_id.'&amp;p='.$p.'">'.$lang_common['Moderate forum'].'</a></p>'."\n";
	else if ($footer_style == 'viewtopic' && $is_admmod)
	{
		echo "\t\t\t".'<dl id="modcontrols"><dt><strong>'.$lang_topic['Mod controls'].'</strong></dt><dd><a href="moderate.php?fid='.$forum_id.'&amp;tid='.$id.'&amp;p='.$p.'">'.$lang_common['Delete posts'].'</a></dd>'."\n";
		echo "\t\t\t".'<dd><a href="moderate.php?fid='.$forum_id.'&amp;move_topics='.$id.'">'.$lang_common['Move topic'].'</a></dd>'."\n";

		if ($cur_topic['closed'] == '1')
			echo "\t\t\t".'<dd><a href="moderate.php?fid='.$forum_id.'&amp;open='.$id.'">'.$lang_common['Open topic'].'</a></dd>'."\n";
		else
			echo "\t\t\t".'<dd><a href="moderate.php?fid='.$forum_id.'&amp;close='.$id.'">'.$lang_common['Close topic'].'</a></dd>'."\n";

		if ($cur_topic['sticky'] == '1')
			echo "\t\t\t".'<dd><a href="moderate.php?fid='.$forum_id.'&amp;unstick='.$id.'">'.$lang_common['Unstick topic'].'</a></dd></dl>'."\n";
		else
			echo "\t\t\t".'<dd><a href="moderate.php?fid='.$forum_id.'&amp;stick='.$id.'">'.$lang_common['Stick topic'].'</a></dd></dl>'."\n";
	}

	echo "\t\t\t".'</div>'."\n";

/* mod hide from spiders bots */
if (!$spiders) $spiders = array(
        'AltaVista Intranet V2.0 www.altavista.de search-support@altavista.de',
        'AnzwersCrawl/2.0 (anzwerscrawl@anzwers.com.au; http://faq.anzwers.com.au/anzwerscrawl.html)',
        'Arachnoidea (arachnoidea@euroseek.com)',
        'ArchitextSpider',
        'Googlebot/1.0 (googlebot@googlebot.com http://googlebot.com/)',
        'Gulliver/1.2',
        'Infoseek Sidewinder/0.9',
        'Lycos_Spider_(T-Rex)/3.0',
        'Mozilla/3.01 (Win95; I)',
        'Scooter/1.0',
        'Scooter/1.0 scooter@pa.dec.com',
        'Scooter/1.1 (custom)',
        'Scooter/2.0 G.R.A.B. X2.0',
        'Scooter/2.0 G.R.A.B. V1.1.0',
        'Slurp/2.0 (slurp@inktomi.com; http://www.inktomi.com/slurp.html)',
        'Slurp.so/1.0 (slurp@inktomi.com; http://www.inktomi.com/slurp.html)',
        'Ultraseek',
        'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)',
        'msnbot/1.0 (+http://search.msn.com/msnbot.htm)',
        'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'Mozilla/5.0 (compatible; BecomeBot/2.3; MSIE 6.0 compatible; +http://www.become.com/site_owners.html)',
        'findlinks/1.1-a7 (+http://wortschatz.uni-leipzig.de/findlinks/)',
        'StackRambler/2.0 (MSIE incompatible)',
        'msnbot/0.9 (+http://search.msn.com/msnbot.htm)',
        'ia_archiver',
        'Findexa Crawler (http://www.findexa.no/gulesider/article26548.ece)',
        'Mozilla/3.0 (compatible; WebMon 1.0.10; Windows XP)',
        'Acoon Robot v1.01 (www.acoon.de)',
        'fido/1.0 Harvest/1.4.pl2',
        'GAIS Robot/1.0B2',
        'KIT_Fireball/2.0',
        'lwp-trivial/1.27',
        'Mozilla/2.0 (compatible; EZResult -- Internet Search Engine)',
        'Mozilla/2.0 (compatible; T-H-U-N-D-E-R-S-T-O-N-E)',
        'Mozilla/3.0 (compatible; MuscatFerret/1.4.1; olly@muscat.co.uk)',
        'Mozilla/3.0 (compatible; MuscatFerret/1.5.2; olly@muscat.co.uk)',
        'Mozilla/3.0 (compatible; MuscatFerret/1.5.3; olly@muscat.co.uk)',
        'Mozilla/4.04 [de] (Win95; I ;Kolibri gncwebbot)',
        'Mozilla/4.04 [de] (Win95; I ;Nav; Kolibri gncwebbot)',
        'search.at V1.2',
        'SwissSearch V1.2',
        'The Informant',
        'WebCrawler/3.0 Robot libwww/5.0a',
        'WebCrawler-AddURL/2.0'
        );

if (!in_array($_SERVER['HTTP_USER_AGENT'], $spiders)) {
/* /mod hide from spiders bots */
?>
			<p class="conr">Powered by <a href="http://www.punbb.org/">PunBB</a> and <a href="http://mybestbb.ww7.be">MyBestBB</a><?php if ($pun_config['o_show_version'] == '1') echo ' '.$pun_config['o_cur_version']; ?><br /></p>
<?php
/* mod hide from spiders bots */
}
/* /mod hide from spiders bots */

// Display debug info (if enabled/defined)
if (defined('PUN_DEBUG'))
{
	// Calculate script generation time
	list($usec, $sec) = explode(' ', microtime());
	$time_diff = sprintf('%.3f', ((float)$usec + (float)$sec) - $pun_start);
	echo "\t\t\t".'<p class="conr">[ Generated in '.$time_diff.' seconds, '.$db->get_num_queries().' queries executed ]</p>'."\n";
}

?>
			<div class="clearer"></div>
		</div>
	</div>
</div>
<?php


// End the transaction
$db->end_transaction();

// Display executed queries (if enabled)
if (defined('PUN_SHOW_QUERIES'))
	display_saved_queries();

$tpl_temp = trim(ob_get_contents());
$tpl_main = str_replace('<pun_footer>', $tpl_temp, $tpl_main);
ob_end_clean();
// END SUBST - <pun_footer>

// removed in punbb 1.2.15
// START SUBST - <pun_include "*">
//while (preg_match('#<pun_include "([^/\\\\]*?)">#', $tpl_main, $cur_include))
//{
//	if (!file_exists(PUN_ROOT.'include/user/'.$cur_include[1]))
//		error('Unable to process user include &lt;pun_include "'.htmlspecialchars($cur_include[1]).'"&gt; from template main.tpl. There is no such file in folder /include/user/');
//	ob_start();
//	include PUN_ROOT.'include/user/'.$cur_include[1];
//	$tpl_temp = ob_get_contents();
//	$tpl_main = str_replace($cur_include[0], $tpl_temp, $tpl_main);
//    ob_end_clean();
//}
// END SUBST - <pun_include "*">


// Close the db connection (and free up any result data)
$db->close();

// Spit out the page
exit($tpl_main);
