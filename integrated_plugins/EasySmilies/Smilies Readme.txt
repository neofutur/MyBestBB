##
##
##        Mod title:  Easy Custom Smilies
##
##      Mod version:  0.5.3
##   Works on PunBB:  Should work on every version
##     Release date:  2006-02-01
##           Author:  El Bekko
##
##      Description:  This tool adds the possibility to 
##					  easily add smileys without having 
##					  to edit your parser.php every time.
##
##   Affected files:  parser.php
##                    
##       Affects DB:  Yes
##
##            Notes:  Should work fine now.
##					  Requires FTP CHMOD access to img/smilies folder.
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

install_mod.php to /
AMP_Smilies.php to plugins/


#
#---------[ 2. RUN ]----------------------------------------------------------
#

install_mod.php


#
#---------[ 3. DELETE ]-------------------------------------------------------
#

install_mod.php


#
#---------[ 4. OPEN ]---------------------------------------------------------
#

include/parser.php


#
#---------[ 5. FIND (line: 30) ]---------------------------------------------

// Here you can add additional smilies if you like (please note that you must escape singlequote and backslash)
$smiley_text = array(':)', '=)', ':|', '=|', ':(', '=(', ':D', '=D', ':o', ':O', ';)', ':/', ':P', ':lol:', ':mad:', ':rolleyes:', ':cool:');
$smiley_img = array('smile.png', 'smile.png', 'neutral.png', 'neutral.png', 'sad.png', 'sad.png', 'big_smile.png', 'big_smile.png', 'yikes.png', 'yikes.png', 'wink.png', 'hmm.png', 'tongue.png', 'lol.png', 'mad.png', 'roll.png', 'cool.png');

#---------[ 6. ADD AFTER:      ]---------------------------------------------
#
// This is for the Smilies plugin
	# Query the database
$smiley_result = $db->query("SELECT * FROM " . $db->prefix . "smilies");
if(is_resource($smiley_result))
	{
	$num_rows = $db->num_rows($smiley_result);
	
	if($num_rows > 0)
		{
		while($smiley_row = $db->fetch_row($smiley_result))
			{
			$smiley_text[] 	= stripslashes($smiley_row[2]);
			$smiley_img[] 	= stripslashes($smiley_row[3]);
			}
		}
	}

#---------[ 6.1 CHANGE:        ]---------------------------------------------
# Only if you want to have smilies with &"'<> in them
#
//$smiley_text = array_map('pun_htmlspecialchars', $smiley_text);

#---------[ 6.2 TO:           ]----------------------------------------------
$smiley_text = array_map('pun_htmlspecialchars', $smiley_text);

#
#---------[ 7. OPEN YOUR FTP CLIENT ]----------------------------------------
#---------[ 7.1 FIND: [FOLDER] img/smilies ]---------------------------------
#

CHMOD to 777

#
#---------[ 8. SAVE/UPLOAD ]-------------------------------------------------
#