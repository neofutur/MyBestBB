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
'lang_direction'				=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'			=>	true,

// Notices
'Bad request'				=>	'गलत अनुरोध। आपके द्वारा दिया गया लिंक गलत है या टाईमबार हो चुका है।',
'No view'				=>	'आपको इस फोरम को देखने की अनुमति नहीं है।',
'No permission'			=>	'आपको इस पेज को देखने की अनुमति नहीं है।',
'Bad referrer'				=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'नई पोस्ट हैं ।',
'Normal icon'				=>	'<!-- -->',
'Closed icon'				=>	'यह प्रकरण बन्द हो चुका है ।',
'Redirect icon'				=>	'अनुप्रेषित फोरम',

// Miscellaneous
'Announcement'			=>	'घोषणा',
'Options'				=>	'विकल्प',
'Actions'				=>	'कार्यवाहियां',
'Submit'				=>	'प्रस्तुत करें ',// "name" of submit buttons
'Ban message'				=>	'आपको इस फोरम से प्रतिबंधित कर दिया गया है ।',
'Ban message 2'			=>	'प्रतिबंध की अवधि की समाप्ति होगी:',
'Ban message 3'			=>	'प्रबंधक या नियामक जिसने भी आप पर प्रतिबंध लगाया है ने निम्नाकित संदेश दिया है।',
'Ban message 4'			=>	'कृपया फोरम प्रबंधक से सीधा संपर्क यहां करें:',
'Never'					=>	'कभी नहीं',
'Today'					=>	'आज',
'Yesterday'				=>	'कल',
'Info'					=>	'सूचना',		// a common table header
'Go back'				=>	'पीछे जाएं',
'Maintenance'				=>	'रख-रखाव',
'Redirecting'				=>	'अनुप्रेषण',
'Click redirect'				=>	'यदि आप प्रतीक्षा नहीं करना चाहते तो यहां क्लिक करें (या यदि आपका ब्राउजर स्वचालित अग्रेषण करने में असमर्थ रहा है)',
'on'					=>	'ऑन',		// as in "BBCode is on"
'off'					=>	'ऑफ',
'Invalid e-mail'				=>	'आपके द्वारा दिया गया ई-मेल पता अवैध है।',
'required field'				=>	'यह इस फोरम का आवश्यक फील्ड है।',	// for javascript form validation
'Last post'				=>	'आखिरी पोस्ट',
'by'					=>	'लेखक',	// as in last post by someuser
'New posts'				=>	'नई &nbsp;पोस्टें',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'			=>	'इस प्रकरण की पहली नई पोस्ट पर जाएं.',	// the popup text for new posts links
'Username'				=>	'प्रयोक्तानाम',
'Password'				=>	'पासवर्ड',
'E-mail'					=>	'ई-मेल',
'Send e-mail'				=>	'ई-मेल भेजें',
'Moderated by'				=>	'नियामक ',
'Registered'				=>	'पंजीकृत',
'Subject'				=>	'विषय',
'Message'				=>	'संदेश',
'Topic'					=>	'प्रकरण',
'Forum'					=>	'फोरम',
'Posts'					=>	'पोस्टें',
'Replies'				=>	'जवाब',
'Author'				=>	'लेखक',
'Pages'					=>	'पेज',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'स्माइलीज़',
'and'					=>	'और',
'Image link'				=>	'इमेज',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'लिखा',	// For [quote]'s
'Code'					=>	'कोड',		// For [code]'s
'Mailer'					=>	'मेल प्रेषक',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'			=>	'महत्वपूर्ण सूचना',
'Write message legend'		=>	'अपना संदेश लिखें व प्रस्तुत करें',

// Title
'Title'					=>	'प्रयोक्ता स्तर',
'Member'				=>	'सदस्य',	// Default title
'Moderator'				=>	'नियामक',
'Administrator'				=>	'प्रबंधक',
'Banned'				=>	'प्रतिबंधित',
'Guest'					=>	'आगन्तुक',

// Stuff for include/parser.php
'BBCode error'				=>	'The BBCode syntax in the message is incorrect.',
'BBCode error 1'			=>	'Missing start tag for [/quote].',
'BBCode error 2'			=>	'Missing end tag for [code].',
'BBCode error 3'			=>	'Missing start tag for [/code].',
'BBCode error 4'			=>	'Missing one or more end tags for [quote].',
'BBCode error 5'			=>	'Missing one or more start tags for [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'विषय सूची',
'User list'				=>	'प्रयोक्ता',
'Rules'					=>  	'नियम',
'Search'				=>  	'खोज',
'Register'				=>  	'नया पंजीयन',
'Login'					=>  	'लॉगिन',
'Not logged in'				=>	'आप लॉगिन नहीं हुए हैं',
'Profile'					=>	'प्रोफाइल',
'Logout'				=>	'लॉगआउट',
'Logged in as'				=>	'आपका लॉगिन नाम',
'Admin'					=>	'प्रबंधन',
'Last visit'				=>	'आखिरी आगमन',
'Show new posts'			=>	'आखिरी आगमन के बाद की नई पोस्टों को दिखाएं',
'Mark all as read'			=>	'सभी प्रकरणों को पढ़ा हुआ अंकित करें',
'Link separator'			=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'				=>	'बोर्ड का निचला सिरा',
'Search links'				=>	'लिंक्स की खोज',
'Show recent posts'			=>	'हाल ही की पोस्ट दिखाएं',
'Show unanswered posts'		=>	'अनुत्तरित पोस्ट दिखाएं',
'Show your posts'			=>	'आपकी पोस्टें हैं',
'Show subscriptions'			=>	'आप द्वारा अधिसूचित किये गए प्रकरण',
'Jump to'				=>	'सीधा पहुंचें',
'Go'					=>	' जाएं ',		// submit button in forum jump
'Move topic'				=>  	'प्रकरण हटाएं',
'Open topic'				=>  	'प्रकरण खोलें',
'Close topic'				=>  	'प्रकरण बंद करें',
'Unstick topic'				=>  	'घोषणात्मक प्रकरण हटाएं',
'Stick topic'				=>  	'घोषणात्मक प्रकरण',
'Moderate forum'			=>	'नियामित फोरम',
'Delete posts'				=>	'अनेक पोस्टें मिटाएं',
'Debug table'				=>	'डिबग इन्फोर्मेशन',

// For extern.php RSS feed
'RSS Desc Active'			=>	'हाल ही के सक्रिय प्रकरण',	// board_title will be appended to this string
'RSS Desc New'			=>	'नवीनतम प्रकरण',					// board_title will be appended to this string
'Posted'				=>	'पोस्ट किया गया'	// The date/time a topic was started

);
