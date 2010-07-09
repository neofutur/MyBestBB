##
##
##        Mod title:  List BBCode
##
##      Mod version:  1.0
##   Works on PunBB:  Should work on every version
##     Release date:  2006-02-26
##           Author:  El Bekko
##
##      Description:  This mod creates a list BBCode
##					  Usage:
##					  [list]
##					  [*]Entry
##					  or
##					  [#]Numeric entry
##					  [/list]
##
##	 Difference with  
## previous version:  /
##
##   Affected files:  parser.php
##                    
##       Affects DB:  No
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
#---------[ 1. OPEN ]---------------------------------------------------------
#
include/parser.php
#
#---------[ 2. FIND (approx. line: 26) ]---------------------------------------------
#
// Make sure no one attempts to run this script "directly"
if (!defined('PUN'))
	exit;
#
#---------[ 3. ADD AFTER		]---------------------------------------------
#
//
// Function to do lists
//
function parse_lists($string) 
	{
	$list = str_replace("[*]","<li style=\"list-style:inside\">",$string);
	$list = str_replace("[#]","<li style=\"list-style:inside; list-style-type:decimal\">",$list);
	$new_str = str_replace('[list]', '<menu>', $list);
	$string = str_replace('[/list]', '</menu>', $new_str);
	
	return $string;
	}
#
#---------[ 4. FIND (approx. line: 450) ]---------------------------------------------
#
	// Deal with newlines, tabs and multiple spaces
	$pattern = array("\n", "\t", '  ', '  ');
	$replace = array('<br />', '&nbsp; &nbsp; ', '&nbsp; ', ' &nbsp;');
	$text = str_replace($pattern, $replace, $text);
#
#---------[ 5. ADD AFTER		]---------------------------------------------
#
	// Parse the lists
	$text = parse_lists($text);
#
#---------[ 6. SAVE/UPLOAD 	 ]---------------------------------------------
#