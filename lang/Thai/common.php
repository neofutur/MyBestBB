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
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Bad Request. ไม่มีหน้าเว็บที่คุณร้องขอ ลิงค์อาจจะไม่ถูกต้อง หรือ ถูกเปลี่ยนแปลงไปแล้ว',
'No view'				=>	'คุณไม่ได้รับสิทธิ์ให้ดูฟอรั่มเหล่านี้',
'No permission'			=>	'คุณไม่ได้รับอนุญาตให้เข้าสู่หน้านี้',
'Bad referrer'			=>	'Bad HTTP_REFERER. คุณอยู่หน้านี้เนื่องจากมี การอ้างอิง บางส่วนที่ไม่ถูกต้อง ถ้าปัญหานี้ยังคงดำเนินต่อไป ขอให้ตรวจสอบดูว่า  \'Base URL\' ถูกตั้งค่าไว้ถูกต้อง ใน Admin/Options และคุณเข้าสู่ฟอรั่มนี้ด้วย URL อันนั้น ข้อมูลเพิ่มเติมเกี่ยวกับ referrer check สามารถดูได้จาก PunBB documentation.',

// Topic/forum indicators
'New icon'				=>	'ใหม่',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'ถูกปิด',
'Redirect icon'			=>	'ย้ายไป',

// Miscellaneous
'Announcement'			=>	'ประกาศ',
'Options'				=>	'คุณสมบัติเสริม',
'Actions'				=>	'ลงมือ',
'Submit'				=>	'ส่งข้อมูล',	// "name" of submit buttons
'Ban message'			=>	'คุณถูกแบนจากฟอรั่มนี้',
'Ban message 2'			=>	'การแบนสิ้นสุดเมื่อ',
'Ban message 3'			=>	'ผู้ดูแลระบบ หรือ ผู้ดูแลฟอรั่ม ที่แบนคุณ ได้ส่งข้อความต่อไปนี้ถึงคุณ :',
'Ban message 4'			=>	'ส่งข้อสงสัย หรือ คำถาม ไปยัง ผู้ดูแลฟอรั่ม ได้ที่',
'Never'					=>	'ไม่เคย',
'Today'					=>	'วันนี้',
'Yesterday'				=>	'เมื่อวาน',
'Info'					=>	'ข้อมูล',		// a common table header
'Go back'				=>	'ย้อนกลับ',
'Maintenance'			=>	'ปิดปรับปรุงระบบ',
'Redirecting'			=>	'กำลังเปลี่ยนหน้า',
'Click redirect'		=>	'คลิ๊กที่นี่ หากคุณไม่ต้องการรอ (หรือบราวเซอร์ของคุณไม่เปลี่ยนหน้าให้คุณโดยอัตโนมัติ)',
'on'					=>	'เปิด',		// as in "BBCode is on"
'off'					=>	'ปิด',
'Invalid e-mail'		=>	'ที่อยู่อีเมลที่คุณระบุ ไม่ถูกต้อง',
'required field'		=>	'คือช่องที่จำเป็นต้องใส่ข้อมูล',	// for javascript form validation
'Last post'				=>	'โพสต์ล่าสุด',
'by'					=>	'โดย',	// as in last post by someuser
'New posts'				=>	'มี&nbsp;โพสต์ใหม่',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'ไปยังโพสต์ใหม่ในกระทู้นี้',	// the popup text for new posts links
'Username'				=>	'ชื่อผู้ใช้งาน',
'Password'				=>	'รหัสผ่าน',
'E-mail'				=>	'อีเมล',
'Send e-mail'			=>	'ส่งอีเมล',
'Moderated by'			=>	'ดูแลโดย',
'Registered'			=>	'ลงทะเบียนเมื่อ',
'Subject'				=>	'ชื่อเรื่อง',
'Message'				=>	'ข้อความ',
'Topic'					=>	'กระทู้',
'Forum'					=>	'ฟอรั่ม',
'Posts'					=>	'โพสต์',
'Replies'				=>	'การตอบ',
'Author'				=>	'ผู้เขียน',
'Pages'					=>	'หน้า',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] tag',
'Smilies'				=>	'Smilies',
'and'					=>	'และ',
'Image link'			=>	'รูปภาพ',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'เขียนไว้ว่า',	// For [quote]'s
'Code'					=>	'Code',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'ข้อมูลสำคัญ',
'Write message legend'	=>	'เขียนและส่งข้อความ',

// Title
'Title'					=>	'สถานะผู้ใช้งาน',
'Member'				=>	'สมาชิก',	// Default title
'Moderator'				=>	'ผู้ดูแลฟอรั่ม',
'Administrator'			=>	'ผู้ดูแลระบบ',
'Banned'				=>	'คนที่ถูกแบน',
'Guest'					=>	'ผู้มาเยือน',

// Stuff for include/parser.php
'BBCode error'			=>	'รูปแบบ BBCode ในข้อความไม่ถูกต้อง',
'BBCode error 1'		=>	'ขาดแท็คเริ่มต้น ของ [/quote].',
'BBCode error 2'		=>	'ขาดแท็คปิดท้าย ของ [code].',
'BBCode error 3'		=>	'ขาดแท็คเริ่มต้น ของ [/code].',
'BBCode error 4'		=>	'ขาดแท็คปิดท้าย อย่างน้อย 1 แห่ง ของ [quote].',
'BBCode error 5'		=>	'ขาดแท็คเริ่มต้น อย่างน้อย 1 แห่ง ของ [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'หน้าแรก',
'User list'				=>	'รายชื่อผู้ใช้งาน',
'Rules'					=>  'กฎระเบียบ',
'Search'				=>  'ค้นหา',
'Register'				=>  'ลงทะเบียน',
'Login'					=>  'เข้าสู่ระบบ',
'Not logged in'			=>  'คุณยังไม่ได้ล็อคอินเข้าสู่ระบบ',
'Profile'				=>	'ตั้งค่าส่วนตัว',
'Logout'				=>	'ออกจากระบบ',
'Logged in as'			=>	'เข้าสู่ระบบในนาม',
'Admin'					=>	'จัดการระบบ',
'Last visit'			=>	'ครั้งล่าสุดเมื่อ',
'Show new posts'		=>	'แสดงโพสต์ใหม่',
'Mark all as read'		=>	'มาร์คทุกกระทู้ว่าอ่านแล้ว',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'ส่วนท้ายของบอร์ด',
'Search links'			=>	'ลิงค์การค้นหา',
'Show recent posts'		=>	'แสดงโพสต์เมื่อเร็วๆนี้',
'Show unanswered posts'	=>	'แสดงโพสต์ที่ยังไม่มีการตอบ',
'Show your posts'		=>	'แสดงโพสต์ของคุณ',
'Show subscriptions'	=>	'แสดงกระทู้ที่คุณติดตาม',
'Jump to'				=>	'กระโดดไปยัง',
'Go'					=>	' ไป ',		// submit button in forum jump
'Move topic'			=>  'ย้ายกระทู้',
'Open topic'			=>  'เปิดกระทู้',
'Close topic'			=>  'ปิดกระทู้',
'Unstick topic'			=>  'เอาปักหมุดออก',
'Stick topic'			=>  'กระทู้ปักหมุด',
'Moderate forum'		=>	'จัดการแก้ไขฟอรั่ม',
'Delete posts'			=>	'ลบหลายโพสต์',
'Debug table'			=>	'ข้อมูล Debug',

// For extern.php RSS feed
'RSS Desc Active'		=>	'กระทู้ที่มีการเปลี่ยนแปลงล่าสุดอยู่ที่The most recently active topics at',	// board_title will be appended to this string
'RSS Desc New'			=>	'กระทู้ใหม่ล่าสุดอยู่ที่',					// board_title will be appended to this string
'Posted'				=>	'โพสต์เมื่อ'	// The date/time a topic was started

);
