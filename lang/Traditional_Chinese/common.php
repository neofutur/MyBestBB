<?php

// Traditional Chinese (UTF-8) was Translated by CoolHD
// Any suggestion just feel free to mail me.
// coolhd.tw@yahoo.com.tw
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'chinese-traditional';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'zh_TW.UTF-8';
		break;

	default:
		$locale = 'zh_TW';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'UTF-8',
'lang_multibyte'		=>	true,

// Notices
'Bad request'			=>	'存取錯誤。您使用的連結有誤或已失效。',
'No view'				=>	'您沒有權限瀏覽討論區。',
'No permission'			=>	'您沒有權限瀏覽此頁。',
'Bad referrer'			=>	'HTTP_REFERER 錯誤。 您從未授權的地方連入本頁。如果一再發生相同問題，請確認 管理/Options 裡的 \'Base URL\' 設定無誤，並請透過點選網站導覽列連結的方式進入本論壇其他頁面。更多關於這項錯誤的資料請參考 PunBB 官方網站的技術文件。',

// Topic/forum indicators
'New icon'				=>	'有新文章',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'這個主題已經關閉',
'Redirect icon'			=>	'已移動版面',

// Miscellaneous
'Announcement'			=>	'公告',
'Options'				=>	'選項',
'Actions'				=>	'動作',
'Submit'				=>	'送出',	// "name" of submit buttons
'Ban message'			=>	'您已被停權。',
'Ban message 2'			=>	'停權時效至',
'Ban message 3'			=>	'將您停權的論壇或版面管理員給您的訊息是：',
'Ban message 4'			=>	'有任何疑問請與論壇管理員聯絡：',
'Never'					=>	'無',
'Today'					=>	'今天',
'Yesterday'				=>	'昨天',
'Info'					=>	'資訊',		// a common table header
'Go back'				=>	'返回上一頁',
'Maintenance'			=>	'維護',
'Redirecting'			=>	'載入中',
'Click redirect'		=>	'如果您不想再等，或是您的瀏覽器沒有自動載入新的頁面，請點選此處。',
'on'					=>	'啟用',		// as in "BBCode is on"
'off'					=>	'關閉',
'Invalid e-mail'		=>	'您輸入的電子郵件地址無效。',
'required field'		=>	'為必填欄位。',	// for javascript form validation
'Last post'				=>	'最後發表',
'by'					=>	'作者',	// as in last post by someuser
'New posts'				=>	'新文章',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'跳至本主題第一篇新文章。',	// the popup text for new posts links
'Username'				=>	'帳號',
'Password'				=>	'密碼',
'E-mail'				=>	'電子郵件',
'Send e-mail'			=>	'寄出電子郵件',
'Moderated by'			=>	'版面管理員',
'Registered'			=>	'註冊日期',
'Subject'				=>	'標題',
'Message'				=>	'內容',
'Topic'					=>	'主題',
'Forum'					=>	'版面',
'Posts'					=>	'文章數',
'Replies'				=>	'回覆',
'Author'				=>	'作者',
'Pages'					=>	'頁次',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] 標籤',
'Smilies'				=>	'表情符號',
'and'					=>	'及',
'Image link'			=>	'圖片',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'引用',	// For [quote]'s
'Code'					=>	'代碼',		// For [code]'s
'Mailer'				=>	'系統發函簽名',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'重要資訊',
'Write message legend'	=>	'寫下您要回覆的訊息然後發送',

// Title
'Title'					=>	'頭銜',
'Member'				=>	'會員',	// Default title
'Moderator'				=>	'版面管理員',
'Administrator'			=>	'網站管理員',
'Banned'				=>	'停權',
'Guest'					=>	'訪客',

// Stuff for include/parser.php
'BBCode error'			=>	'文章內 BBCode 語法不正確。',
'BBCode error 1'		=>	'有 [/quote] 卻沒有 [quote]。',
'BBCode error 2'		=>	'有 [code] 卻沒有 [/code]。',
'BBCode error 3'		=>	'有 [/code] 卻沒有 [code]。',
'BBCode error 4'		=>	'缺少一個或多個 [/quote]。',
'BBCode error 5'		=>	'缺少一個或多個 [quote]。',

// Stuff for the navigator (top of every page)
'Index'					=>	'首頁',
'User list'				=>	'會員列表',
'Rules'					=>  '站規',
'Search'				=>  '搜尋',
'Register'				=>  '註冊',
'Login'					=>  '登入',
'Not logged in'			=>  '您尚未登入。',
'Profile'				=>	'個人資料',
'Logout'				=>	'登出',
'Logged in as'			=>	'歡迎再度蒞臨本論壇,',
'Admin'					=>	'管理',
'Last visit'			=>	'您上次來訪時間是',
'Show new posts'		=>	'列出所有新文章',
'Mark all as read'		=>	'把所有文章標示成已讀',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'論壇頁尾',
'Search links'			=>	'搜尋連結',
'Show recent posts'		=>	'列出最近的文章',
'Show unanswered posts'	=>	'列出無回應的文章',
'Show your posts'		=>	'列出自己的文章',
'Show subscriptions'	=>	'列出自己訂閱的主題',
'Jump to'				=>	'快速連結',
'Go'					=>	'進入版面',		// submit button in forum jump
'Move topic'			=>  '移動主題',
'Open topic'			=>  '開啟主題',
'Close topic'			=>  '關閉主題',
'Unstick topic'			=>  '取消主題置頂',
'Stick topic'			=>  '設定主題置頂',
'Moderate forum'		=>	'管理版面',
'Delete posts'			=>	'刪除多篇文章',
'Debug table'			=>	'除錯資訊',

// For extern.php RSS feed
'RSS Desc Active'		=>	'最近熱門的主題在',	// board_title will be appended to this string
'RSS Desc New'			=>	'最新的主題在',					// board_title will be appended to this string
'Posted'				=>	'張貼時間'	// The date/time a topic was started

);
