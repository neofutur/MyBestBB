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
require_once PUN_ROOT.'lang/'.$pun_user['language'].'/reputation.php';
if ($pun_config['o_reputation_enabled'] == 1 && $pun_user['reputation_enable_adm'] == 1) 
{ ?>
				<div class="inform">
					<fieldset>
						<legend><?php echo $lang_reputation['Manage reputation'] ?></legend>
						<div class="infldset">
							<label><?php echo $lang_reputation['Description Manage reputation'] ?><br /></label>
							<input type="radio" name="reputation_enable" value="1"<?php if ($pun_user['reputation_enable'] == '1') echo ' checked="checked"' ?> />&nbsp;<strong>Yes</strong>&nbsp;&nbsp;&nbsp;<input type="radio" name="reputation_enable" value="0"<?php if ($pun_user['reputation_enable'] == '0') echo ' checked="checked"' ?> />&nbsp;<strong>No</strong>
						</div>
					</fieldset>
				</div>
<?php
}

				
