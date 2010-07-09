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
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'utf-8',
'lang_multibyte'		=>	true,

// Notices
'Bad request'			=>	'잘못된 요청. 따라온 링크가 틀리거나 오래된 것입니다.',
'No view'				=>	'이 곳의 포럼을 보실 수 있는 권한이 없습니다.',
'No permission'			=>	'선택하신 페이지를 보실 수 있는 권한이 없습니다.',
'Bad referrer'			=>	'잘못된 HTTP_REFERER. 허가되지 않은 주소로 이 곳에 오셨습니다. 만약 문제가 지속된다면 관리자/선택사항에 있는 \'기본 URL\' 이 올바르게 설정되어 있는지 확인하시고 그 곳의 URL 주소로 이 포럼을 방문하시기 바랍니다. Referrer 검사에 관련한 보다 자세한 정보는 PunBB 문서를 참고하시기 바랍니다.',

// Topic/forum indicators
'New icon'				=>	'새 글들이 올라와 있습니다.',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'이 이야깃거리는 잠겨져 있습니다.',
'Redirect icon'			=>	'이동된 포럼',

// Miscellaneous
'Announcement'			=>	'알림',
'Options'				=>	'선택사항',
'Actions'				=>	'실행',
'Submit'				=>	'올림',	// "name" of submit buttons
'Ban message'			=>	'이 포럼으로의 접근이 금지되었습니다.',
'Ban message 2'			=>	'접근 금지는 다음 날짜 이후에 해제됩니다 - ',
'Ban message 3'			=>	'접근을 금지시킨 관리자 혹은 돌보는 이가 다음과 같은 글을 남겼습니다:',
'Ban message 4'			=>	'문의 사항이 있으시면 다음의 주소로 포럼 관리자에게 문의하시기 바랍니다.',
'Never'					=>	'없음',
'Today'					=>	'오늘',
'Yesterday'				=>	'어제',
'Info'					=>	'정보',		// a common table header
'Go back'				=>	'되돌아가기',
'Maintenance'			=>	'포럼 보수',
'Redirecting'			=>	'되돌아감',
'Click redirect'		=>	'자동으로 이동되지 않거나 혹은 더 이상 오래 기다리지 않시려면 여기를 누르십시오.',
'on'					=>	'켬',		// as in "BBCode is on"
'off'					=>	'끔',
'Invalid e-mail'		=>	'입력하신 전자우편 주소는 잘못된 것입니다.',
'required field'		=>	'은(는) 반드시 입력하셔야 합니다.',	// for javascript form validation
'Last post'				=>	'마지막 글',
'by'					=>	'글쓴이',	// as in last post by someuser
'New posts'				=>	'새&nbsp;글',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'이 이야깃거리의 첫번쨰 새로운 글 보기',	// the popup text for new posts links
'Username'				=>	'사용자 이름',
'Password'				=>	'암호',
'E-mail'				=>	'전자우편',
'Send e-mail'			=>	'전자우편 보내기',
'Moderated by'			=>	'돌보는 이',
'Registered'			=>	'등록 날짜',
'Subject'				=>	'주제',
'Message'				=>	'전하는 글',
'Topic'					=>	'이야깃거리',
'Forum'					=>	'포럼',
'Posts'					=>	'글 수',
'Replies'				=>	'댓글 수',
'Author'				=>	'글쓴이',
'Pages'					=>	'장 수',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] 꼬리표',
'Smilies'				=>	'그림말',
'and'					=>	'그리고',
'Image link'			=>	'그림',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'씀',	// For [quote]'s
'Code'					=>	'코드',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'중요 정보',
'Write message legend'	=>	'전하는 글을 쓰시고 올려주십시오',

// Title
'Title'					=>	'이름표',
'Member'				=>	'회원',	// Default title
'Moderator'				=>	'돌보는 이',
'Administrator'			=>	'관리자',
'Banned'				=>	'접근 금지됨',
'Guest'					=>	'손님',

// Stuff for include/parser.php
'BBCode error'			=>	'전하는 글 중에 쓰인 BBCode의 용법이 옳지 않습니다.',
'BBCode error 1'		=>	'[/quote]처럼 생긴 여는 꼬리표가 빠져 있습니다.',
'BBCode error 2'		=>	'[code]처럼 생긴 닫는 꼬리표가 빠져 있습니다.',
'BBCode error 3'		=>	'[/code]처럼 생긴 여는 꼬리표가 빠져 있습니다.',
'BBCode error 4'		=>	'[quote]처럼 생긴 닫는 꼬리표가 하나 혹은 여러개가 빠져 있습니다.',
'BBCode error 5'		=>	'[/quote]처럼 생긴 여는 꼬리표가 하나 혹은 여러개가 빠져 있습니다.',

// Stuff for the navigator (top of every page)
'Index'					=>	'처음',
'User list'				=>	'회원 명단',
'Rules'					=>  '규정',
'Search'				=>  '찾기',
'Register'				=>  '등록하기',
'Login'					=>  '들어가기',
'Not logged in'			=>  '들어오지 않으셨습니다.',
'Profile'				=>	'개인 정보',
'Logout'				=>	'나가기',
'Logged in as'			=>	'들어옴:',
'Admin'					=>	'포럼 관리',
'Last visit'			=>	'마지막 방문일',
'Show new posts'		=>	'마지막에 방문한 날로부터 새로 쓰여진 글 보기',
'Mark all as read'		=>	'모든 글들을 읽은 것으로 함',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'보드 바닥',
'Search links'			=>	'검색 링크',
'Show recent posts'		=>	'최근에 올려진 글 보기',
'Show unanswered posts'	=>	'댓글이 안달린 글 보기',
'Show your posts'		=>	'자기가 쓴 글 보기',
'Show subscriptions'	=>	'구독중인 글 보기',
'Jump to'				=>	'이동',
'Go'					=>	'가기',		// submit button in forum jump
'Move topic'			=>  '이야깃거리 옮기기',
'Open topic'			=>  '이야깃거리 풀기',
'Close topic'			=>  '이야깃거리 잠그기',
'Unstick topic'			=>  '이야깃거리 놓아주기',
'Stick topic'			=>  '이야깃거리 매달기',
'Moderate forum'		=>	'포럼 돌보기',
'Delete posts'			=>	'여러 글 지우기',
'Debug table'			=>	'디버그 정보',

// For extern.php RSS feed
'RSS Desc Active'		=>	'가장 최근에 이야깃거리에 달린 글 - ',	// board_title will be appended to this string
'RSS Desc New'			=>	'가장 최근의 이야깃거리 - ',					// board_title will be appended to this string
'Posted'				=>	'쓰여짐'	// The date/time a topic was started

);
