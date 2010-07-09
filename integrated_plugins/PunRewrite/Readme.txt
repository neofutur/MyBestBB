##
##
##        Mod title:  PunRewrite
##
##      Mod version:  1.0
##   Works on PunBB:  1.2.10
##     Release date:  2005-11-20
##           Author:  Kévin Dunglas (keyes) [dunglas+punbb AT gmail DOT com]
##                    http://placelibre.ath.cx/keyes/
##
##      Description: PunRewrite is a mod to enhance your positioning in search engines.
##                   It rewrite URLs to include the topic title. URL like 
##                   http://placelibre.ath.cx/viewtopic.php?id=2459 comes 
##                   http://placelibre.ath.cx/2459-maintenant-milices.html with this hack.
##                   Other features:
##                     * Rewrite URLs for forums and topics
##                     * Transform special characters like "é" or "ç" in normal characters like "e" or "c"
##                     * Remove words words of less than three letters.

##
##   Affected files:  index.php
##                    viewforum.php
##                    viewtopic.php
##                    search.php
##
##       Affects DB:  No
##
##            Notes:  Licence GPL. You must use Apache with mod_rewrite enabled.
##
##       DISCLAIMER:  Please note that "mods" are not officially supported by
##                    PunBB. Installation of this modification is done at your
##                    own risk. Backup your forum database and any and all
##                    applicable files before proceeding.
##
##


#
#---------[ 1. UPLOAD ]-------------------------------------------------------
#

.htaccess to /
rewrite.php to /include/

#
#---------[ 2. OPEN ]---------------------------------------------------------
#

include/common.php


#
#---------[ 3. FIND (line: 35) ]---------------------------------------------
#

// Load the functions script
require PUN_ROOT.'include/functions.php';

#
#---------[ 4. AFTER, ADD ]-------------------------------------------------
#

require PUN_ROOT.'include/rewrite.php';
	
#
#---------[ 5. OPEN ]---------------------------------------------------------
#

index.php

#
#---------[ 6. FIND (line: 100) ]---------------------------------------------
#

$forum_field = '<h3><a href="viewforum.php?id='.$cur_forum['fid'].'">'.pun_htmlspecialchars($cur_forum['forum_name']).'</a></h3>';

#
#---------[ 7. REPLACE WITH ]-------------------------------------------------
#

$forum_field = '<h3><a href="'.makeurl("f", $cur_forum['fid'], $cur_forum['forum_name']).'">'.pun_htmlspecialchars($cur_forum['forum_name']).'</a></h3>';

#
#---------[ 6. FIND (line: 111) ]---------------------------------------------
#

		$last_post = '<a href="viewtopic.php?pid='.$cur_forum['last_post_id'].'#p'.$cur_forum['last_post_id'].'">'.format_time($cur_forum['last_post']).'</a> <span class="byuser">'.$lang_common['by'].' '.pun_htmlspecialchars($cur_forum['last_poster']).'</span>';

#
#---------[ 7. REPLACE WITH ]-------------------------------------------------
#

		$last_post = '<a href="'.makeurl("p", $cur_forum['last_post_id'], format_time($cur_forum['last_post'])).'#p'.$cur_forum['last_post_id'].'">'.format_time($cur_forum['last_post']).'</a> <span class="byuser">'.$lang_common['by'].' '.pun_htmlspecialchars($cur_forum['last_poster']).'</span>';


#
#---------[ 8. OPEN ]---------------------------------------------------------
#

viewforum.php

#
#---------[ 9. FIND (line: 149) ]---------------------------------------------
#

$last_post = '<a href="viewtopic.php?pid='.$cur_topic['last_post_id'].'#p'.$cur_topic['last_post_id'].'">'.format_time($cur_topic['last_post']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['last_poster']).'</span>';

#
#---------[ 10. REPLACE WITH ]-------------------------------------------------
#

$last_post = '<a href="'.makeurl("p", $cur_topic['last_post_id'], format_time($cur_topic['last_post'])).'#p'.$cur_topic['last_post_id'].'">'.format_time($cur_topic['last_post']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['last_poster']).'</span>';

#
#---------[ 11. FIND (line: 195) ]---------------------------------------------
#

$subject = $lang_forum['Moved'].': <a href="viewtopic.php?id='.$cur_topic['moved_to'].'">'.pun_htmlspecialchars($cur_topic['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['poster']).'</span>';

#
#---------[ 12. REPLACE WITH ]-------------------------------------------------
#

$subject = $lang_forum['Moved'].': <a href="'.makeurl("t", $cur_topic['moved_to'], $cur_topic['subject']).'">'.pun_htmlspecialchars($cur_topic['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['poster']).'</span>';

#
#---------[ 13. FIND (line: 197) ]---------------------------------------------
#

$subject = '<a href="viewtopic.php?id='.$cur_topic['id'].'">'.pun_htmlspecialchars($cur_topic['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['poster']).'</span>';

#
#---------[ 14. REPLACE WITH ]-------------------------------------------------
#

$subject = '<a href="'.makeurl("t", $cur_topic['id'], $cur_topic['subject']).'">'.pun_htmlspecialchars($cur_topic['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['poster']).'</span>';

#
#---------[ 15. FIND (line: 200) ]---------------------------------------------
#

$subject = '<a href="viewtopic.php?id='.$cur_topic['id'].'">'.pun_htmlspecialchars($cur_topic['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['poster']).'</span>';

#
#---------[ 16. REPLACE WITH ]-------------------------------------------------
#

$subject = '<a href="'.makeurl("t", $cur_topic['id'], $cur_topic['subject']).'">'.pun_htmlspecialchars($cur_topic['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($cur_topic['poster']).'</span>';

#
#---------[ 17. OPEN ]---------------------------------------------------------
#

viewtopic.php

#
#---------[ 18. FIND (line: 172) ]---------------------------------------------
#
		<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="viewforum.php?id=<?php echo $cur_topic['forum_id'] ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>

#
#---------[ 19. REPLACE WITH ]-------------------------------------------------
#

		<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="<?php echo makeurl("f", $cur_topic['forum_id'], $cur_topic['forum_name']) ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>

#
#---------[ 20. FIND (line: 315) ]---------------------------------------------
#
	
<h2><span><span class="conr">#<?php echo ($start_from + $post_count) ?>&nbsp;</span><a href="viewtopic.php?pid=<?php echo $cur_post['id'].'#p'.$cur_post['id'] ?>"><?php echo format_time($cur_post['posted']) ?></a></span></h2>

#
#---------[ 21. REPLACE WITH ]-------------------------------------------------
#

<h2><span><span class="conr">#<?php echo ($start_from + $post_count) ?>&nbsp;</span><a href="<?php echo makeurl("p", $cur_post['id'], format_time($cur_post['posted'])).'#p'.$cur_post['id'] ?>"><?php echo format_time($cur_post['posted']) ?></a></span></h2>

#
#---------[ 22. FIND (line: 351) ]---------------------------------------------
#

<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="viewforum.php?id=<?php echo $cur_topic['forum_id'] ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>

#
#---------[ 23. REPLACE WITH ]-------------------------------------------------
#

<ul><li><a href="index.php"><?php echo $lang_common['Index'] ?></a></li><li>&nbsp;&raquo;&nbsp;<a href="<?php echo makeurl("f", $cur_topic['forum_id'], $cur_topic['forum_name']) ?>"><?php echo pun_htmlspecialchars($cur_topic['forum_name']) ?></a></li><li>&nbsp;&raquo;&nbsp;<?php echo pun_htmlspecialchars($cur_topic['subject']) ?></li></ul>

#
#---------[ 24. OPEN ]---------------------------------------------------------
#

search.php

#
#---------[ 25. FIND (line: 544) ]---------------------------------------------
#

					$forum = '<a href="viewforum.php?id='.$temp[0].'">'.pun_htmlspecialchars($temp[1]).'</a>';

#
#---------[ 26. REPLACE WITH ]-------------------------------------------------
#

					$forum = '<a href="'.makeurl("f", $temp[0], $temp[1]).'">'.pun_htmlspecialchars($temp[1]).'</a>';

#
#---------[ 27. FIND (line: 555) ]---------------------------------------------
#

					$subject = '<a href="viewtopic.php?id='.$search_set[$i]['tid'].'">'.pun_htmlspecialchars($search_set[$i]['subject']).'</a>';

#
#---------[ 28. REPLACE WITH ]-------------------------------------------------
#

					$subject = '<a href="'.makeurl("f", $search_set[$i]['tid'], $search_set[$i]['subject']).'">'.pun_htmlspecialchars($search_set[$i]['subject']).'</a>';

#
#---------[ 29. FIND (line: 584) ]---------------------------------------------
#

	<h2><?php echo $forum ?>&nbsp;&raquo;&nbsp;<?php echo $subject ?>&nbsp;&raquo;&nbsp;<a href="viewtopic.php?pid=<?php echo $search_set[$i]['pid'].'#p'.$search_set[$i]['pid'] ?>"><?php echo format_time($search_set[$i]['pposted']) ?></a></h2>

#
#---------[ 30. REPLACE WITH ]-------------------------------------------------
#

	<h2><?php echo $forum ?>&nbsp;&raquo;&nbsp;<?php echo $subject ?>&nbsp;&raquo;&nbsp;<a href="<?php echo makeurl("p", $search_set[$i]['pid'], format_time($search_set[$i]['pposted'])).'#p'.$search_set[$i]['pid'] ?>"><?php echo format_time($search_set[$i]['pposted']) ?></a></h2>

#
#---------[ 31. FIND (line: 616) ]---------------------------------------------
#

					$subject = '<a href="viewtopic.php?id='.$search_set[$i]['tid'].'">'.pun_htmlspecialchars($search_set[$i]['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($search_set[$i]['poster']).'</span>';

#
#---------[ 32. REPLACE WITH ]-------------------------------------------------
#

					$subject = '<a href="'.makeurl("t", $search_set[$i]['tid'], $search_set[$i]['subject']).'">'.pun_htmlspecialchars($search_set[$i]['subject']).'</a> <span class="byuser">'.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($search_set[$i]['poster']).'</span>';

#
#---------[ 33. FIND (line: 673) ]---------------------------------------------
#

						?><td class="tcr"><?php echo '<a href="viewtopic.php?pid='.$search_set[$i]['last_post_id'].'#p'.$search_set[$i]['last_post_id'].'">'.format_time($search_set[$i]['last_post']).'</a> '.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($search_set[$i]['last_poster']) ?></td><?php

#
#---------[ 34. REPLACE WITH ]-------------------------------------------------
#

						?><td class="tcr"><?php echo '<a href="'.makeurl("p", $search_set[$i]['last_post_id'], format_time($search_set[$i]['last_post'])).'#p'.$search_set[$i]['last_post_id'].'">'.format_time($search_set[$i]['last_post']).'</a> '.$lang_common['by'].'&nbsp;'.pun_htmlspecialchars($search_set[$i]['last_poster']) ?></td><?php

#
#---------[ 35. OPEN ]---------------------------------------------------------
#

extern.php

#
#---------[ 36. FIND (line: 126) ]---------------------------------------------
#

// Load the functions script
require PUN_ROOT.'include/functions.php';
#
#---------[ 37. AFTER, ADD ]-------------------------------------------------
#

require(PUN_ROOT.'include/rewrite.php');

#
#---------[ 38. FIND (line: 255) ]---------------------------------------------
#

			echo "\t\t".'<link>'.$pun_config['o_base_url'].'/viewtopic.php?id='.$cur_topic['id'].$url_action.'</link>'."\r\n";

#
#---------[ 39. REPLACE WITH ]-------------------------------------------------
#

			echo "\t\t".'<link>'.$pun_config['o_base_url'].'/'.makeurl("t", $cur_topic['id'], $cur_topic['subject']).$url_action.'</link>'."\r\n";

#
#---------[ 40. FIND (line: 227) ]---------------------------------------------
#

			echo "\t\t".'<description><![CDATA['.escape_cdata($lang_common['Forum'].': <a href="'.$pun_config['o_base_url'].'/viewforum.php?id='.$cur_topic['fid'].'">'.$cur_topic['forum_name'].'</a><br />'."\r\n".$lang_common['Author'].': '.$cur_topic['poster'].'<br />'."\r\n".$lang_common['Posted'].': '.date('r', $cur_topic['posted']).'<br />'."\r\n".$lang_common['Last post'].': '.date('r', $cur_topic['last_post'])).']]></description>'."\r\n";

#
#---------[ 41. REPLACE WITH ]-------------------------------------------------
#

			echo "\t\t".'<description><![CDATA['.escape_cdata($lang_common['Forum'].': <a href="'.$pun_config['o_base_url'].'/'.makeurl("f", $cur_topic['fid'], $cur_topic['forum_name']).'">'.$cur_topic['forum_name'].'</a><br />'."\r\n".$lang_common['Author'].': '.$cur_topic['poster'].'<br />'."\r\n".$lang_common['Posted'].': '.date('r', $cur_topic['posted']).'<br />'."\r\n".$lang_common['Last post'].': '.date('r', $cur_topic['last_post'])).']]></description>'."\r\n";


#
#---------[ 42. SAVE/UPLOAD ]-------------------------------------------------
#
