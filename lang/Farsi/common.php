<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':utf-8
	case 'WIN32':utf-8
		$locale = '������';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'Fa Farsi-utf-8';
		break;

	default:
		$locale = '����� fa';
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
'Bad request'			=>	'�� ����� ������.���� ������ ���� ���.',
'No view'				=>	'��� ����� ���� ��� ����� �� ������.',
'No permission'			=>	'��� ����� ������ �� ��� ����� �� ������.',
'Bad referrer'			=>	'Bad HTTP_REFERER. You were referred to this page from an unauthorized source. If the problem persists please make sure that \'Base URL\' is correctly set in Admin/Options and that you are visiting the forum by navigating to that URL. More information regarding the referrer check can be found in the PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'��� ��� ����',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'�ǁ�� ���� ��� ���',
'Redirect icon'			=>	'������� �����',

// Miscellaneous
'Announcement'			=>	'�������',
'Options'				=>	'��������',
'Actions'				=>	'����� ��',
'Submit'				=>	'��� ',	// "���" of submit buttons
'Ban message'			=>	'��� ������ ��� ���.',
'Ban message 2'			=>	'���� ��� ��� ��� ��',
'Ban message 3'			=>	'���� �� ���� �� ��� �� ��� ��� ���� ���:',
'Ban message 4'			=>	' �� ���� �� ���� Ȑ����',
'Never'					=>	'�ѐ�',
'Today'					=>	'�����',
'Yesterday'				=>	'����',
'Info'					=>	'�������',		// a common table header
'Go back'				=>	'��Ґ��',
'Maintenance'			=>	'�� ����',
'Redirecting'			=>	'��� ���',
'Click redirect'		=>	'��� �� �� ���� ���� ǐ� �� ������ ���� ��� ����(or if your browser does not automatically forward you)',
'on'					=>	'����',		// as in "BBCode is on"
'off'					=>	'��� ����',
'Invalid e-mail'		=>	'����� ���� ��� �������.',
'required field'		=>	'�� ��� ������REQUIRED',	// for javascript form validation
'Last post'				=>	'����� �����',
'by'					=>	'��',	// as in last post by someuser
'New posts'				=>	'���� ���� �����',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'��� �� ����� ����� ��� �����.',	// the popup text for new posts links
'Username'				=>	'��� ������',
'Password'				=>	'���� ����',
'E-mail'				=>	'�����',
'Send e-mail'			=>	'����� �����',
'Moderated by'			=>	'������ ��',
'Registered'			=>	'��� ��� ���',
'Subject'				=>	'�����',
'Message'				=>	'����',
'Topic'					=>	'�ǁ��',
'Forum'					=>	'�����',
'Posts'					=>	'����� ��',
'Replies'				=>	'���� ��',
'Author'				=>	'�������',
'Pages'					=>	'���� ��',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'���� ��',
'and'					=>	'�',
'Image link'			=>	'���',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'�����',	// For [quote]'s
'Code'					=>	'��',		// For [code]'s
'Mailer'				=>	'���� ����',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'������� ���',
'Write message legend'	=>	'���� �� �� ������� � ��� ����',

// Title
'Title'					=>	'�����',
'Member'				=>	'���',	// Default title
'Moderator'				=>	'����',
'Administrator'			=>	'���� ��',
'Banned'				=>	'������/���� ���',
'Guest'					=>	'�����',

// Stuff for include/parser.php
'BBCode error'			=>	'���� �� �� �������.',
'BBCode error 1'		=>	'��� ��� ���� [/quote].',
'BBCode error 2'		=>	'Missing end tag for [code].',
'BBCode error 3'		=>	'Missing start tag for [/code].',
'BBCode error 4'		=>	'Missing one or more end tags for [quote].',
'BBCode error 5'		=>	'Missing one or more start tags for [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'���� ����',
'User list'				=>	'���� �������',
'Rules'					=>  '�������',
'Search'				=>  '�����',
'Register'				=>  '��� ���',
'Login'					=>  '����',
'Not logged in'			=>  '��� ���� ���� ���.',
'Profile'				=>	'������ ���',
'Logout'				=>	'����',
'Logged in as'			=>	'���� ��� �� ',
'Admin'					=>	'������',
'Last visit'			=>	'����� ������',
'Show new posts'		=>	'����� ��� �� �� �� ����� ���� ���',
'Mark all as read'		=>	'����� ����� ������ ��� ��',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'����� ����',
'Search links'			=>	'������ ����',
'Show recent posts'		=>	'����� ��� ��� ����',
'Show unanswered posts'	=>	'����� ��� ��� ���� ����',
'Show your posts'		=>	'����� ��� ��� ���',
'Show subscriptions'	=>	'����� ���� �� ���� ������',
'Jump to'				=>	'��� ��',
'Go'					=>	' ��� ',		// submit button in forum jump
'Move topic'			=>  '������ �ǁ��',
'Open topic'			=>  '��� ���� �ǁ��',
'Close topic'			=>  '���� �ǁ��',
'Unstick topic'			=>  '���� �� ���',
'Stick topic'			=>  '���',
'Moderate forum'		=>	'������ �����',
'Delete posts'			=>	'��� ���� �ǁ��',
'Debug table'			=>	'���� ���� �������',

// For extern.php RSS feed
'RSS Desc Active'		=>	'��� ���� ������� ������� RSS ����� ����',	// board_title will be appended to this string
'RSS Desc New'			=>	'���� ���� �ǁ�� ��',					// board_title will be appended to this string
'Posted'				=>	'������'	// The date/time a topic was started

);
����� ����� �������WWW.PERSIANSAT.NET
