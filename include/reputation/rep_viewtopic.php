<?php 
/******************************************************************************************************
		Reputation Plugin for PunBB
		----------------------------
-- Version 2.2.0
-- Created by hcs on 24-04-2006  hcs@mail.ru

-- GPL:
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
******************************************************************************************************/
// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
    exit();

if ($cur_post['poster_id']!=1 && $pun_user['g_rep_enable'] == 1 && $pun_config['o_reputation_enabled'] == 1 
	&& $cur_post['reputation_enable'] == 1 && $pun_user['reputation_enable_adm'] == 1 && $pun_user['reputation_enable'] == 1) 
{ ?>
          				<dd><?php  
            echo '<a href="reputation.php?uid='.$cur_post['poster_id'] . '">'. $lang_reputation['Reputation'] . '</a>'; 
            ?> :  <?php 
            //If viewer are guest or user who post this message,then we do not show control buttons
            if($pun_user['is_guest'] != true && $pun_user['username'] != $cur_post['username']) { 
            	$repdata='&amp;pid=' .$cur_post['id'] . '&amp;uid=' .$cur_post['poster_id'] .'&amp;method=';
            	$repdataplus=$repdata .'1'; 
            	$repdataminus=$repdata .'2';       				 
            ?><a href="./reputation.php?<?php echo $repdataplus; ?>"><img src="./img/warn_add.gif" alt="+" style="border: 0;" /></a>&nbsp;&nbsp;<strong><?php echo $cur_post['count_rep_plus']-$cur_post['count_rep_minus']; ?>&nbsp;&nbsp;</strong><a href="./reputation.php?<?php echo $repdataminus; ?>"><img src="./img/warn_minus.gif" alt="-" style="border: 0;" /></a><?php 
            }  
            else 
            {
            	?> &nbsp;&nbsp;<strong><?php echo $cur_post['count_rep_plus']-$cur_post['count_rep_minus']; ?>&nbsp;</strong><?php 
            }
            ?></dd><?php echo "\n";
} 
?>
