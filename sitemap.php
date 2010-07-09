<?php
/***********************************************************************

  Copyright (C) 2002-2005  Neal Poole (smartys@gmail.com)

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

define('PUN_QUIET_VISIT', 1);
define('PUN_ROOT', './');
require PUN_ROOT.'include/common.php';

// false = write to file, true = dynamic
$dynamic = true;

// This only matters if you're writing to the file
$filename = 'sitemap.xml';


// Get the topics
$result = $db->query('SELECT t.id as topic_id, last_post, sticky, num_replies FROM '.$db->prefix.'topics AS t LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=t.forum_id AND fp.group_id=3) WHERE (fp.read_forum IS NULL OR fp.read_forum=1) AND t.moved_to IS NULL ORDER BY last_post DESC') or error('Unable to fetch topic list', __FILE__, __LINE__, $db->error());

// Get the forums
$result2 = $db->query('SELECT f.id as forum_id, last_post, num_topics FROM '.$db->prefix.'forums AS f LEFT JOIN '.$db->prefix.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id=3) WHERE fp.read_forum IS NULL OR fp.read_forum=1 ORDER BY f.id DESC') or error('Unable to fetch forum list', __FILE__, __LINE__, $db->error());


$output = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
$output .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">'."\n";

// The board itself
$output .= "<url>\n";
$output .= "\t<loc>".$pun_config['o_base_url']."/</loc>\n";
$output .= "\t<lastmod>".gmdate('Y-m-d\TH:i:s+00:00', time())."</lastmod>\n";
$output .= "\t<priority>1.0</priority>\n";
$output .= "</url>\n\n";


// Output the data for the forums
while ($cur_forum = $db->fetch_assoc($result2))
{
    $lastmodified = gmdate('Y-m-d\TH:i:s+00:00', $cur_forum['last_post']);
    $viewforum = 'viewforum.php?id='.$cur_forum['forum_id'];
    $priority = '1.0';

	$output .= "<url>\n";
	$output .= "\t<loc>".$pun_config['o_base_url']."/".$viewforum."</loc>\n";
	$output .= "\t<lastmod>$lastmodified</lastmod>\n";
	$output .= "\t<priority>$priority</priority>\n";
	$output .= "</url>\n\n";
        
    if ($cur_forum['num_topics'] >= $pun_config['o_disp_topics_default'])
    {
        $num_pages = ceil($cur_forum['num_topics'] / $pun_config['o_disp_topics_default']);

        //Add page number for subsequent pages
        for ($i = 2; $i <= $num_pages; $i++)
        {
            $output .= "<url>\n";
            $output .= "\t<loc>".$pun_config['o_base_url']."/".$viewforum."&amp;p=".$i."</loc>\n";
            $output .= "\t<lastmod>$lastmodified</lastmod>\n";
            $output .= "\t<priority>$priority</priority>\n";
            $output .= "</url>\n\n";
        }
    }
}

// Output the data for the topics
while ($cur_topic = $db->fetch_assoc($result))
{
    $lastmodified = gmdate('Y-m-d\TH:i:s+00:00', $cur_topic['last_post']);
    $viewtopic = 'viewtopic.php?id='.$cur_topic['topic_id'];
    $priority = ($cur_topic['sticky'] == '1') ? '1.0' : '0.5';

	$output .= "<url>\n";
	$output .= "\t<loc>".$pun_config['o_base_url']."/".$viewtopic."</loc>\n";
	$output .= "\t<lastmod>$lastmodified</lastmod>\n";
	$output .= "\t<priority>$priority</priority>\n";
	$output .= "</url>\n\n";
        
    if ($cur_topic['num_replies'] >= $pun_config['o_disp_posts_default'])
    {
        // We add one because the first post is not counted as a reply but needs to be
        // taken into account for display
        $num_pages = ceil(($cur_topic['num_replies'] + 1) / $pun_config['o_disp_posts_default']);

        for ($i = 2; $i <= $num_pages; $i++)
        {
            $output .= "<url>\n";
            $output .= "\t<loc>".$pun_config['o_base_url']."/".$viewtopic."&amp;p=".$i."</loc>\n";
            $output .= "\t<lastmod>$lastmodified</lastmod>\n";
            $output .= "\t<priority>$priority</priority>\n";
            $output .= "</url>\n\n";
        }
    }
}
$output .= "</urlset>\n";

// If we chose dynamic, we output the sitemap
// Otherwise, we write it to the file
if ($dynamic)
{
    header('Content-type: application/xml');
    echo $output;
}
else
{
    $file = fopen($filename, "w");
    fwrite($file, $output);
    fclose($file);
    echo "Done";
}
?>