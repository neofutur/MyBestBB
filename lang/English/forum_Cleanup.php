<?php

$lang_Fourm_Cleanup = array(

'title'                  =>      'Forum cleanup - v',
'description'            =>      'This plugin is used to cleanup the mess made by spammers and edits to the database that have put things out of sync.',

// Descriptions
'Desc_CompleteCleanup'   =>		 'This feature is intended to clean up the mess after a spam attack, how it works is you put in one or more IP addresses (separated by spaces) and it deletes all users and posts with that IP, then performs the rest of the cleanup operations.',
'Desc_SyncTopicPost'	 =>		 'This feature works out the number of posts/topics each forum currently has and resets their post/topic counts, useful if you edited the db.',
'Desc_IP'				 =>		 'Enter a list of one or more IP addresses separated by spaces to be removed from the forum (note it is also recommended you ban these IP addresses from the bans section of admin).',
'Desc_SyncTopicReply'    =>		 'This feature works out the number of replies each topic currently has and resets their reply counts, useful if you edited the db.',
'Desc_SyncUserPost'		 =>		 'This feature works out the number of posts each user currently has and resets their post counts, useful if you deleted alot of posts and want to sync the user post count.',
'Desc_SyncFourmPost'	 =>		 'This feature resets the last post section of all forums, useful to clean up the mess after a spammer or db edit.',
'Desc_SyncTopicLastPost' =>		 'This feature resets the last post section of all topics, useful to clean up the mess after a spammer or db edit.',
'Desc_Delete'			 =>		 'This feature deletes all posts whos topic has been deleted, and inversely all topics whos have no posts and all topics whos forum has been deleted, useful after database edits.',

// Headers
'H_CompleteCleanup'      =>      'Complete spam cleanup',
'H_SyncTopicPost'		 =>		 'Synchronise forum post/topic counts',
'H_SyncTopicReply'    	 =>		 'Synchronise topic reply counts',
'H_SyncUserPost'		 =>		 'Synchronise user post counts',
'H_SyncFourmPost'		 =>		 'Synchronise forum last post',
'H_SyncTopicLastPost'	 =>		 'Synchronise topic last post',
'H_Delete'				 =>		 'Delete orphans',

// Form Labels
'FL_IP'					 =>		 'IP Addresses',

// Errors
'E_Mysql'				 =>		 'Sorry this script requires Mysql 4.0.4 or above, i may support older versions in future scripts'


);?>