<?php

// Simplified Chinese (UTF-8) was Translated by CoolHD
// Any suggestion just feel free to mail me.
// coolhd.tw@yahoo.com.tw
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'chinese-simplified';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'zh_CN.UTF-8';
		break;

	default:
		$locale = 'zh_CN';
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
'Bad request'			=>	'请求错误。您使用的连接有误或已失效。',
'No view'				=>	'您没有权限浏览该版块。',
'No permission'			=>	'您没有权限浏览该页面。',
'Bad referrer'			=>	'HTTP_REFERER 错误。您从未授权的地方连入本页。如果一再发生相同问题，请确认 "管理/Options " 里的 \'Base URL\' 设定无误，并请通过点击论坛导航链接的方式进入本论坛其他页面。更多关于这项错误的资料请参考 PunBB 官方网站的技术文件。',

// Topic/forum indicators
'New icon'				=>	'有新帖',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'这个主题已经关闭',
'Redirect icon'			=>	'已移动版面',

// Miscellaneous
'Announcement'			=>	'公告',
'Options'				=>	'选项',
'Actions'				=>	'操作',
'Submit'				=>	'提交',	// "name" of submit buttons
'Ban message'			=>	'您已被停权。',
'Ban message 2'			=>	'停权时效至',
'Ban message 3'			=>	'将您停权的管理员或版主给您的留言：',
'Ban message 4'			=>	'有任何疑问请与论坛管理员联系：',
'Never'					=>	'无',
'Today'					=>	'今天',
'Yesterday'				=>	'昨天',
'Info'					=>	'信息',		// a common table header
'Go back'				=>	'返回前页',
'Maintenance'			=>	'维护',
'Redirecting'			=>	'跳转中',
'Click redirect'		=>	'如果您不想再等，或是您的浏览器没有自动跳转到新页面，请单击此处。',
'on'					=>	'启用',		// as in "BBCode is on"
'off'					=>	'关闭',
'Invalid e-mail'		=>	'您输入的电子邮件地址无效。',
'required field'		=>	'为必填栏目。',	// for javascript form validation
'Last post'				=>	'最后回复',
'by'					=>	'作者',	// as in last post by someuser
'New posts'				=>	'新帖',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'跳转到本主题第一篇新帖。',	// the popup text for new posts links
'Username'				=>	'用户名',
'Password'				=>	'密码',
'E-mail'				=>	'电子邮件',
'Send e-mail'			=>	'发送电子邮件',
'Moderated by'			=>	'版主',
'Registered'			=>	'注册日期',
'Subject'				=>	'标题',
'Message'				=>	'内容',
'Topic'					=>	'主题',
'Forum'					=>	'版面',
'Posts'					=>	'帖数',
'Replies'				=>	'回复',
'Author'				=>	'作者',
'Pages'					=>	'跳页',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] 标签',
'Smilies'				=>	'表情符号',
'and'					=>	'及',
'Image link'			=>	'图片',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'引用',	// For [quote]'s
'Code'					=>	'代码',		// For [code]'s
'Mailer'				=>	'系统邮件签名',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'重要信息',
'Write message legend'	=>	'写下您要回复的消息然后发送',

// Title
'Title'					=>	'头衔',
'Member'				=>	'会员',	// Default title
'Moderator'				=>	'版主',
'Administrator'			=>	'论坛管理员',
'Banned'				=>	'停权',
'Guest'					=>	'访客',

// Stuff for include/parser.php
'BBCode error'			=>	'帖内 BBCode 语法不正确。',
'BBCode error 1'		=>	'有 [/quote] 却没有 [quote]。',
'BBCode error 2'		=>	'有 [code] 却没有 [/code]。',
'BBCode error 3'		=>	'有 [/code] 却没有 [code]。',
'BBCode error 4'		=>	'缺少一个或多个 [/quote]。',
'BBCode error 5'		=>	'缺少一个或多个 [quote]。',

// Stuff for the navigator (top of every page)
'Index'					=>	'首页',
'User list'				=>	'用户列表',
'Rules'					=>  '站规',
'Search'				=>  '搜索',
'Register'				=>  '注册',
'Login'					=>  '登录',
'Not logged in'			=>  '您尚未登录。',
'Profile'				=>	'个人资料',
'Logout'				=>	'注销',
'Logged in as'			=>	'欢迎再度访问本论坛,',
'Admin'					=>	'管理',
'Last visit'			=>	'您上次来访时间是',
'Show new posts'		=>	'列出所有新帖',
'Mark all as read'		=>	'把所有帖子标记为已读',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'论坛页尾',
'Search links'			=>	'搜索链接',
'Show recent posts'		=>	'列出最近的帖子',
'Show unanswered posts'	=>	'列出无回复的帖子',
'Show your posts'		=>	'列出自己的帖子',
'Show subscriptions'	=>	'列出自己订阅的主题',
'Jump to'				=>	'快速跳转',
'Go'					=>	'进入版面',		// submit button in forum jump
'Move topic'			=>  '移动主题',
'Open topic'			=>  '开启主题',
'Close topic'			=>  '关闭主题',
'Unstick topic'			=>  '取消主题置顶',
'Stick topic'			=>  '设定主题置顶',
'Moderate forum'		=>	'管理版面',
'Delete posts'			=>	'删除多篇文章',
'Debug table'			=>	'除错信息',

// For extern.php RSS feed
'RSS Desc Active'		=>	'最近热门的主题在',	// board_title will be appended to this string
'RSS Desc New'			=>	'最新的主题在',					// board_title will be appended to this string
'Posted'				=>	'发帖时间'	// The date/time a topic was started

);
