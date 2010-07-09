<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'english';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'en_US.US-ASCII';
		break;

	default:
		$locale = 'en_US';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);
*/

// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'rtl',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'ÿ·» Œ«ÿ∆. «·—«»ÿ «·–Ì   »⁄Â €Ì— ’ÕÌÕ √Ê „Â„·.',
'No view'				=>	'·Ì” ·œÌﬂ «·’·«ÕÌ… ·«” ⁄—«÷ Â–Â «·„‰ œÌ« .',
'No permission'			=>	'·Ì” ·œÌﬂ «·’·«ÕÌ… ··Ê’Ê· ≈·Ï Â–Â «·’›Õ….',
'Bad referrer'			=>	'HTTP_REFERER €Ì— „ﬁ»Ê·° ·ﬁœ Ê’·  ≈·Ï Â–Â «·’›Õ… „‰ Œ·«· „’œ— €Ì— „—Œ’. Ì—ÃÏ «·⁄Êœ… Ê «·„Õ«Ê·… „—… «Œ—Ï. ›Ì Õ«·  ﬂ—«— «·„‘ﬂ·…  √ﬂœ „‰ ’Õ… \'Base URL\' ÷„‰ Admin/Options √Ê √‰ﬂ  ﬁÊ„ »“Ì«—… «·„‰ œÏ „‰ Œ·«· «·⁄‰Ê«‰ «·„‰«”»° „‰ √Ã· „⁄·Ê„«  √ﬂÀ— —«Ã⁄ «· ÊÀÌﬁ ·‹ PunBB.',

// Topic/forum indicators
'New icon'				=>	'Â‰«ﬂ „‘«—ﬂ«  ÃœÌœ…',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Â–« «·„Ê÷Ê⁄  „ ≈€·«ﬁÂ',
'Redirect icon'			=>	'„‰ œÏ „⁄«œ  ÊÃÌÂÂ',

// Miscellaneous
'Announcement'			=>	'≈⁄·«‰',
'Options'				=>	'ŒÌ«—« ',
'Actions'				=>	'›⁄«·Ì« ',
'Submit'				=>	'√—”·',	// "name" of submit buttons
'Ban message'			=>	'√‰  „ÿ—Êœ „‰ Â–« «·„‰ œÏ.',
'Ban message 2'			=>	'„œ… «·ÿ—œ ” ‰ ÂÌ ›Ì ‰Â«Ì…',
'Ban message 3'			=>	'«·„œÌ— √Ê «·„‘—› «·–Ì ÿ—œﬂ  —ﬂ ·ﬂ Â–Â «·—”«·…:',
'Ban message 4'			=>	'„‰ ›÷·ﬂ ÊÃ¯Â √Ì «” ›”«— ≈·Ï „œÌ— «·„‰ œÏ ⁄·Ï',
'Never'					=>	'√»œ«',
'Today'					=>	'«·ÌÊ„',
'Yesterday'				=>	'√„”',
'Info'					=>	'„⁄·Ê„« ',		// a common table header
'Go back'				=>	'—ÃÊ⁄ ··Œ·›',
'Maintenance'			=>	'’Ì«‰…',
'Redirecting'			=>	'≈⁄«œ…  ÊÃÌÂ',
'Click redirect'		=>	'«‰ﬁ— Â‰« ≈–« ﬂ‰  ·«  —Ìœ «·«‰ Ÿ«— ÿÊÌ·« (√Ê √‰ „ ’›Õﬂ ·« Ìœ⁄„ «·«‰ ﬁ«· «· ·ﬁ«∆Ì)',
'on'					=>	'Ì⁄„·',		// as in "BBCode is on"
'off'					=>	'·« Ì⁄„·',
'Invalid e-mail'		=>	'«·»—Ìœ «·«·ﬂ —Ê‰Ì «·–Ì √œŒ· Â €Ì— ’ÕÌÕ.',
'required field'		=>	'Õﬁ· „ÿ·Ê» ›Ì Â–« «·„‰ œÏ.',	// for javascript form validation
'Last post'				=>	'¬Œ— „‘«—ﬂ…',
'by'					=>	'»Ê«”ÿ…',	// as in last post by someuser
'New posts'				=>	'„‘«—ﬂ…&nbsp;ÃœÌœ…',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'«‰ ﬁ· ≈·Ï √Ê· „‘«—ﬂ… ÃœÌœ… ›Ì Â–« «·„Ê÷Ê⁄.',	// the popup text for new posts links
'Username'				=>	'«”„ «·„” Œœ„',
'Password'				=>	'ﬂ·„… «·„—Ê—',
'E-mail'				=>	'«·»—Ìœ',
'Send e-mail'			=>	'√—”· »—Ìœ',
'Moderated by'			=>	'»≈‘—«›',
'Registered'			=>	'„”Ã·',
'Subject'				=>	'«·⁄‰Ê«‰',
'Message'				=>	'«·—”«·…',
'Topic'					=>	'«·„Ê÷Ê⁄',
'Forum'					=>	'«·„‰ œÏ',
'Posts'					=>	'«·„‘«—ﬂ« ',
'Replies'				=>	'«·—œÊœ',
'Author'				=>	'«·ﬂ« »',
'Pages'					=>	'’›Õ« ',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'⁄·«„… [img]',
'Smilies'				=>	'«» ”«„« ',
'and'					=>	'Ê',
'Image link'			=>	'’Ê—…',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'ﬂ »',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'»«⁄À «·»—Ìœ',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'„⁄·Ê„«  Â«„…',
'Write message legend'	=>	'«ﬂ » —”«· ﬂ À„ √—”·',

// Title
'Title'					=>	'«··ﬁ»',
'Member'				=>	'⁄÷Ê',	// Default title
'Moderator'				=>	'„‘—›',
'Administrator'			=>	'„œÌ—',
'Banned'				=>	'„ÿ—Êœ',
'Guest'					=>	'“«∆—',

// Stuff for include/parser.php
'BBCode error'			=>	'’Ì€… «·‹ BBCode ›Ì «·—”«·… €Ì— ’ÕÌÕ….',
'BBCode error 1'		=>	'›ﬁœ«‰ «·⁄·«„… «·»«œ∆… ··«ﬁ »«”.',
'BBCode error 2'		=>	'›ﬁœ«‰ «·⁄·«„… «·Œ« „… ··„’œ— «·»—„ÃÌ.',
'BBCode error 3'		=>	'›ﬁœ«‰ «·⁄·«„… «·»«œ∆… ··„’œ— «·»—„ÃÌ.',
'BBCode error 4'		=>	'›ﬁœ«‰ Ê«Õœ… √Ê √ﬂÀ— „‰ «·⁄·«„«  «·Œ« „… ··«ﬁ »«”.',
'BBCode error 5'		=>	'›ﬁœ«‰ Ê«Õœ… √Ê √ﬂÀ— „‰ «·⁄·«„«  «·»«œ∆… ··«ﬁ »«”.',

// Stuff for the navigator (top of every page)
'Index'					=>	'›Â—”',
'User list'				=>	'«·„” Œœ„Ì‰',
'Rules'					=>  'ﬁÊ«‰Ì‰',
'Search'				=>  '»ÕÀ',
'Register'				=>  ' ”ÃÌ·',
'Login'					=>  'œŒÊ·',
'Not logged in'			=>  '·„  ﬁ„ » ”ÃÌ· œŒÊ·ﬂ.',
'Profile'				=>	'«·„·› «·‘Œ’Ì',
'Logout'				=>	' ”ÃÌ· Œ—ÊÃ',
'Logged in as'			=>	'œŒÊ·ﬂ „”Ã· ﬂ‹',
'Admin'					=>	'«·≈œ«—…',
'Last visit'			=>	'¬Œ— “Ì«—…',
'Show new posts'		=>	'√ÕœÀ «·„‘«—ﬂ«  „‰– ¬Œ— “Ì«—…',
'Mark all as read'		=>	'«⁄ »— ﬂ· «·„Ê«÷Ì⁄ „ﬁ—Ê¡…',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'√”›· «·’›Õ…',
'Search links'			=>	'—Ê«»ÿ «·»ÕÀ',
'Show recent posts'		=>	'√ÕœÀ «·„‘«—ﬂ« ',
'Show unanswered posts'	=>	'„‘«—ﬂ«  ·„ Ì „ «·—œ ⁄·ÌÂ«',
'Show your posts'		=>	'‘«Âœ „œ«Œ·« ﬂ',
'Show subscriptions'	=>	'‘«Âœ Ã„Ì⁄ «·„Ê«÷Ì⁄ «· Ì »œ√ Â«',
'Jump to'				=>	'«‰ ﬁ· ≈·Ï',
'Go'					=>	' «–Â» ',		// submit button in forum jump
'Move topic'			=>  '«‰ﬁ· «·„Ê÷Ê⁄',
'Open topic'			=>  '«› Õ «·„Ê÷Ê⁄',
'Close topic'			=>  '√€·ﬁ «·„Ê÷Ê⁄',
'Unstick topic'			=>  '≈·€«¡  À»Ì  «·„Ê÷Ê⁄',
'Stick topic'			=>  'À»Ì  «·„Ê÷Ê⁄',
'Moderate forum'		=>	'≈‘—«›',
'Delete posts'			=>	'«Õ–› «·„‘«—ﬂ«  «·„ ⁄œœ…',
'Debug table'			=>	'Debug „⁄·Ê„« ',

// For extern.php RSS feed
'RSS Desc Active'		=>	'«·„Ê«÷Ì⁄ «·√ﬂÀ— ‰‘«ÿ« „ƒŒ—« ⁄‰œ',	// board_title will be appended to this string
'RSS Desc New'			=>	'√ÕœÀ «·„Ê«÷Ì⁄ ⁄‰œ',					// board_title will be appended to this string
'Posted'				=>	'„—”·…'	// The date/time a topic was started

);
