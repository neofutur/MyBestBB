<?php


// Translated by Spiros Doikas - www.translatum.gr/cv.htm
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'greek';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'el_GR.GR-ASCII';
		break;

	default:
		$locale = 'el_GR';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'windows-1253',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'���������� ������. � ��������� ��� ������������ ����� ���������� � ������.',
'No view'				=>	'��� ����� �������� �� ����� ���� �� ������.',
'No permission'			=>	'��� ����� �������� ��������� �� ���� �� ������.',
'Bad referrer'			=>	'���������� HTTP_REFERER. � ��������� �� ����� ��� ���������� ����� ��� ��� �� ��������������� ����. ��� �� �������� ��� ����� ����������� ��� �� \'URL �����]\' ���� ������� ����� ��� Admin/Options (����������/��������) ��� ��� ������������ �� ������ ��������������� �� ������������ URL. �������� �� ������ ������������ ����������� ������� �� ��� ������ ���������� ���� ���������� ��� PunBB.',

// Topic/forum indicators
'New icon'				=>	'�������� ��� ��������',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'���� �� ���� ���� �������',
'Redirect icon'			=>	'������������� ������',

// Miscellaneous
'Announcement'			=>	'����������',
'Options'				=>	'��������',
'Actions'				=>	'���������',
'Submit'				=>	'�������',	// "name" of submit buttons
'Ban message'			=>	'����� ����������� ��� ���� �� ������.',
'Ban message 2'			=>	'� ����������� ����� ��� ����� ���',
'Ban message 3'			=>	'� ������������ � � ����������� � ������ ������� ��� ���������� ��� ����� �� �������� ������:',
'Ban message 4'			=>	'��� ����� ������� ��� ������������ ���� ������������ ��� ������ ���',
'Never'					=>	'����',
'Today'					=>	'������',
'Yesterday'				=>	'����',
'Info'					=>	'�����������',		// a common table header
'Go back'				=>	'���������',
'Maintenance'			=>	'���������',
'Redirecting'			=>	'�������������',
'Click redirect'		=>	'������� ��� ��� ��� ������ �� ���������� ���� (� ��� �� ��������� ���������� ��� �������������� ��� ��� ��������� ��������)',
'on'					=>	'������',		// as in "BBCode is on"
'off'					=>	'���������',
'Invalid e-mail'		=>	'� ��������� e-mail ��� ���������� ��� ����� ������.',
'required field'		=>	'����� ��� ����������� ����� �� ���� �� �����.',	// for javascript form validation
'Last post'				=>	'��������� ������',
'by'					=>	'���',	// as in last post by someuser
'New posts'				=>	'���&nbsp;��������',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'�������� ��� ����� ��� ������ �� ���� �� ����.',	// the popup text for new posts links
'Username'				=>	'����� ������',
'Password'				=>	'������� ���������',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'�������� e-mail',
'Moderated by'			=>	'�����������',
'Registered'			=>	'�������',
'Subject'				=>	'������',
'Message'				=>	'������',
'Topic'					=>	'����',
'Forum'					=>	'������',
'Posts'					=>	'��������',
'Replies'				=>	'����������',
'Author'				=>	'���������',
'Pages'					=>	'�������',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'������� [img]',
'Smilies'				=>	'���������',
'and'					=>	'���',
'Image link'			=>	'������',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'������',	// For [quote]'s
'Code'					=>	'�������',		// For [code]'s
'Mailer'				=>	'��������� ������������',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'���������� �����������',
'Write message legend'	=>	'������ �� ������ ��� ��� ������� �� ������ "�������"',

// Title
'Title'					=>	'�������',
'Member'				=>	'�����',	// Default title
'Moderator'				=>	'�����������',
'Administrator'			=>	'������������',
'Banned'				=>	'�������������',
'Guest'					=>	'����������',

// Stuff for include/parser.php
'BBCode error'			=>	'�� ���������� ��� ������ BBCode ��� ������ ����� ���������.',
'BBCode error 1'		=>	'������ � ������ ������� ��� �� [/quote].',
'BBCode error 2'		=>	'������ � ������ ������� ��� �� [code].',
'BBCode error 3'		=>	'������ � ������ ������� ��� �� [/code].',
'BBCode error 4'		=>	'������� ��� � ������������ �������� ��� �� [quote].',
'BBCode error 5'		=>	'������� ��� � ������������ ������� �������� ��� �� [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'������',
'User list'				=>	'����� �������',
'Rules'					=>  '�������',
'Search'				=>  '���������',
'Register'				=>  '�������',
'Login'					=>  '�������',
'Not logged in'			=>  '��� ����� ������������.',
'Profile'				=>	'������',
'Logout'				=>	'����������',
'Logged in as'			=>	'������������ ��',
'Admin'					=>	'����������',
'Last visit'			=>	'��������� ��������',
'Show new posts'		=>	'�������� ���� ��������� ��� ��� ��������� ��������',
'Mark all as read'		=>	'������� ���� ��� ��������� �� �����������',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'��������� ������',
'Search links'			=>	'��������� ����������',
'Show recent posts'		=>	'�������� ��������� ���������',
'Show unanswered posts'	=>	'�������� ����������� ���������',
'Show your posts'		=>	'�������� ��� ��������� ���',
'Show subscriptions'	=>	'�������� ��������� �� ������������',
'Jump to'				=>	'�������� ��',
'Go'					=>	'�������� ',		// submit button in forum jump
'Move topic'			=>  '���������� �������',
'Open topic'			=>  '������� �������',
'Close topic'			=>  '�������� �������',
'Unstick topic'			=>  '�� ������ ����',
'Stick topic'			=>  '������ ����',
'Moderate forum'		=>	'����������� ������',
'Delete posts'			=>	'�������� ��������� ���������',
'Debug table'			=>	'����������� ���������� ���������',

// For extern.php RSS feed
'RSS Desc Active'		=>	'�� ��� �������� ������ ������ ���',	// board_title will be appended to this string
'RSS Desc New'			=>	'�� ��� �������� ������ ���',					// board_title will be appended to this string
'Posted'				=>	'������������'	// The date/time a topic was started

);













