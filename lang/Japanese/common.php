<?php

/*
// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'Japanese_Japan.932';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'ja_JP.UTF-8';
		break;

	default:
		$locale = 'ja_JP.UTF-8';
		break;
}

// Attempt to set the locale
setlocale(LC_CTYPE, $locale);
*/

// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'UTF-8',
'lang_multibyte'		=>	true,

// Notices
'Bad request'			=>	'要求エラーが発生しました。 要求されたリンクが間違っているか、古くなっています。',
'No view'				=>	'このフォーラムにアクセスする権限がありません。',
'No permission'			=>	'このページにアクセスする権限がありません。',
'Bad referer'			=>	'Bad HTTP_REFERER. このページは権限の無いソースより参照されています。戻ってもう一度お試しください。この問題が継続する場合は、Admin/OptionsでベースURLが正しく設定され、ベースURLよりフォーラムにアクセスしているか否か確認してください。',

// Topic/forum indicators
'New icon'				=>	'新しい投稿があります。',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'このトピックは閉じられています。',
'Redirect icon'			=>	'リダイレクトされたフォーラム',

// Miscellaneous
'Announcement'			=>	'お知らせ',
'Options'				=>	'オプション',
'Actions'				=>	'アクション',
'Submit'				=>	'送信',	// "name" of submit buttons
'Ban message'			=>	'あなたはフォーラム利用を禁止されています。',
'Ban message 2'			=>	'利用禁止終了日:',
'Ban message 3'			=>	'管理者またはモデレータは次のメッセージを残しています:',
'Ban message 4'			=>	'詳細はフォーラム管理者にお問合せください。管理者メールアドレス:',
'Never'					=>	'Never',
'Today'					=>	'本日',
'Yesterday'				=>	'昨日',
'Info'					=>	'インフォメーション',	// a common table header
'Go back'				=>	'戻る',
'Maintenance'			=>	'メンテナンス',
'Redirecting'			=>	'リダイレクト中',
'Click redirect'		=>	'ブラウザが自動的にリダイレクトしない場合はここをクリックしてください',
'on'					=>	'on',		// as in "BBCode is on"
'off'					=>	'off',
'Invalid e-mail'		=>	'入力されたいーメールアドレスが正しくありません。',
'required field'		=>	'を入力してください。',	// for javascript form validation
'Last post'				=>	'最新の投稿',
'by'					=>	'by',	// as in last post by someuser
'New posts'				=>	'新しい投稿',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'このトピックの最初の新規投稿へ移動する。',	// the popup text for new posts links
'Username'				=>	'ユーザ名',
'Password'				=>	'パスワード',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'メールの送信',
'Moderated by'			=>	'モデレート by',
'Registered'			=>	'登録日',
'Subject'				=>	'題名',
'Message'				=>	'メッセージ',
'Topic'					=>	'トピック',
'Forum'					=>	'フォーラム',
'Posts'					=>	'投稿',
'Replies'				=>	'返事',
'Author'				=>	'投稿者',
'Pages'					=>	'ページ',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'[img] タグ',
'Smilies'				=>	'スマイリー',
'and'					=>	', ',
'Image link'			=>	'画像',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'による投稿',	// For [quote]'s
'Code'					=>	'コード',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'重要情報',
'Write message legend'	=>	'メッセージを入力して送信',

// Title
'Title'					=>	'肩書き',
'Member'				=>	'メンバー',	// Default title
'Moderator'				=>	'モデレータ',
'Administrator'			=>	'管理者',
'Banned'				=>	'拒否',
'Guest'					=>	'ゲスト',

// Stuff for include/parser.php
'BBCode error'			=>	'メッセージのBBCode記述が違っています。',
'BBCode error 1'		=>	'[/quote]の開始タグがありません。',
'BBCode error 2'		=>	'[code]の終了タグがありません。',
'BBCode error 3'		=>	'[/code]の開始タグがありません。',
'BBCode error 4'		=>	'[quote]の終了タグがありません。',
'BBCode error 5'		=>	'[/quote]の開始タグがありません。',

// Stuff for the navigator (top of every page)
'Index'					=>	'インデックス',
'User list'				=>	'ユーザリスト',
'Rules'					=>  'ルール',
'Search'				=>  '検索',
'Register'				=>  'ユーザ登録',
'Login'					=>  'ログイン',
'Not logged in'			=>  'ログインしていません。',
'Profile'				=>	'プロフィール',
'Logout'				=>	'ログアウト',
'Logged in as'			=>	'ログインユーザ名:',
'Admin'					=>	'管理',
'Last visit'			=>	'最終ログイン',
'Show new posts'		=>	'前回訪問以降の投稿を表示する',
'Mark all as read'		=>	'すべての投稿を既読にする',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'ボードフッタ',
'Search links'			=>	'リンクの検索',
'Show recent posts'		=>	'最新の投稿を表示する',
'Show unanswered posts'	=>	'未返答の投稿を表示する',
'Show your posts'		=>	'あなたの投稿を表示する',
'Show subscriptions'	=>	'あなたが購読中のトピックを表示する',
'Jump to'				=>	'移動',
'Go'					=>	' GO ',		// submit button in forum jump
'Move topic'			=>  'トピックを移動する',
'Open topic'			=>  'トピックをオープンする',
'Close topic'			=>  'トピックをクローズする',
'Unstick topic'			=>  'トピックをスティッキー解除する',
'Stick topic'			=>  'トピックをスティッキー設定する',
'Moderate forum'		=>	'フォーラム管理',
'Delete posts'			=>	'重複投稿を削除する',
'Debug table'			=>	'デバッグ情報',

// For extern.php RSS feed
'RSS Desc Active'		=>	'最新のアクティブトピック:',	// board_title will be appended to this string
'RSS Desc New'			=>	'最新投稿:',					// board_title will be appended to this string
'Posted'				=>	'投稿日時'	// The date/time a topic was started

);
