##
##
##        Mod title:  Board Logo
##
##      Mod version:  1.0
##   Works on PunBB:  Should work on every version
##     Release date:  2006-03-03
##           Author:  El Bekko
##
##      Description:  Allows you to add a board logo
##
##	 Difference with  
## previous version:  /
##
##   Affected files:  admin.tpl
##	 				  main.tpl
##					  header.php
##					  admin_options.php
##                    
##       Affects DB:  Inserts a row into config
##
##            Notes:  None
##
##       DISCLAIMER:  Please note that "mods" are not officially supported by
##                    PunBB. Installation of this modification is done at your
##                    own risk. Backup your forum database and any and all
##                    applicable files before proceeding.
##
##
#
#
#
#---------[ 1. UPLOAD ]---------------------------------------------------------
#
	install_mod.php
#
#---------[ 2. OPEN   ]---------------------------------------------------------
#
	main.tpl
#
#---------[ 3. FIND line 17 ]---------------------------------------------------
#
	<pun_title>
#
#---------[ 4. ADD BEFORE ]-----------------------------------------------------
#
	<pun_logo>
#
#---------[ 5. OPEN   ]---------------------------------------------------------
#
	admin.tpl
#
#---------[ 6. FIND line 16 ]---------------------------------------------------
#
	<pun_title>
#
#---------[ 7. ADD BEFORE ]-----------------------------------------------------
#
	<pun_logo>
#
#---------[ 8. OPEN   ]---------------------------------------------------------
#
	admin_options.php
#
#---------[ 9. FIND line 112 ]--------------------------------------------------
#
	$form['avatars_size'] = intval($form['avatars_size']);
#
#---------[ 10. ADD AFTER ]-----------------------------------------------------
#
	$form['board_logo'] = addslashes($form['board_logo']);
#
#---------[ 11. FIND line 158 ]-------------------------------------------------
#
	<tr>
		<th scope="row">Board title</th>
		<td><input type="text" name="form[board_title]" size="50" maxlength="255" value="<?php echo pun_htmlspecialchars($pun_config['o_board_title']) ?>" />
		<span>The title of this bulletin board (shown at the top of every page). This field may <strong>not</strong> contain HTML.</span>									</td>
	</tr>
#
#---------[ 12. ADD AFTER ]-----------------------------------------------------
#
	<tr>
	  <th scope="row">Board logo </th>
	  <td><input name="form[board_logo]" type="text" value="<?php echo pun_htmlspecialchars($pun_config['o_board_logo']) ?>" size="50" maxlength="255" />
      <span>The logo of this bulletin board (shown at the top of every page). This field may <strong>not</strong> contain HTML.</span> </td>
    </tr>
#
#---------[ 13. OPEN   ]---------------------------------------------------------
#
	header.php
#
#---------[ 14. FIND line 154 ]-------------------------------------------------
#
	// START SUBST - <pun_page>
#
#---------[ 15. ADD BEFORE ]-----------------------------------------------------
#
	// START SUBST - <pun_logo>
	$tpl_main = str_replace('<pun_logo>','<center><img src="'.PUN_ROOT.'img/' . stripslashes($pun_config['o_board_logo']) . '" alt="pun_logo" /></center>',$tpl_main);
	// END SUBST - <pun_logo>
#
#---------[ 16. SAVE/UPLOAD 	 ]---------------------------------------------
#
