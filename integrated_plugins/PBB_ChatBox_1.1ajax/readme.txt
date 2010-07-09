##
##
##        Mod title:  Poki BB ChatBox
##
##      Mod version:  1.0
##   Works on PunBB:  1.2.*
##     Release date:  2005-07-20
##           Author:  Pokemon_JOJO - pokemonjojo@mibhouse.org
##
##      Description:  Add a very simple ChatBox in punbb
##		      Support Multi Languages
##		      Support Multi Skins
##
##   Affected files:  none
##
##       Affects DB:  Yes
##
##            Notes:  No
##
##     Update Notes:  No update aviable from old version.
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

chatbox.php to /
install_mod.php to /
lang/LANGUAGE/chatbox.php to lang/LANGUAGE
plugins/AP_ChatBox.php to plugins/

#
#---------[ 2. RUN ]---------------------------------------------------------
#

install_mod.php

#
#---------[ 3. DELETE ]---------------------------------------------------
#

install_mod.php

#
#---------[ 4. ADD ]---------------------------------------------------------
#

Open the admin plugin and it will allow you to configure the mod.

#
#---------[ 5. ADD ]---------------------------------------------------------
#

"Additional menu items" from your Administration -> Options

X = <a href="chatbox.php">ChatBox</a>

where X is the position at which the link should be inserted
(e.g. 0 to insert at the beginning and 2 to insert after "User list").

#
#---------[ 6. HAVE FUN ]----------------------------------------------------
#
