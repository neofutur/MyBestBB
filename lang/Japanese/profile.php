<?php

// Language definitions used in profile.php
$lang_profile = array(

// Navigation and sections
'Profile menu'				=>	'プロフィールメニュー',
'Section essentials'		=>	'エッセンシャル',
'Section personal'			=>	'パーソナル',
'Section messaging'			=>	'メッセージング',
'Section personality'		=>	'パーソナリティー',
'Section display'			=>	'表示',
'Section privacy'			=>	'プライバシー',
'Section admin'				=>	'管理',

// Miscellaneous
'Username and pass legend'	=>	'ユーザ名およびパスワードを入力してください。',
'Personal details legend'	=>	'あなたの個人情報詳細を入力してください。',
'Contact details legend'	=>	'メッセージング詳細を入力してください。',
'Options display'			=>	'表示オプションを設定してください。',
'Options post'				=>	'投稿表示オプションを設定してください。',
'User activity'				=>	'ユーザ活動',
'Paginate info'				=>	'各ページで表示したいトピック数および投稿数を入力してください。',

// Password stuff
'Pass key bad'				=>	'パスワードアクティベートキーが正しく無い、または期限切れです。新しいパスワードを再度請求してください。正常に動作しない場合は、フォーラム管理者にお問合せください。管理者メールアドレス:',
'Pass updated'				=>	'パスワードが更新されました。新しいパスワードでログイン可能です。',
'Pass updated redirect'		=>	'パスワードが更新されました。リダイレクト中 ...',
'Wrong pass'				=>	'現在のパスワードが間違っています。',
'Change pass'				=>	'パスワードの変更',
'Change pass legend'		=>	'あなたの新しいパスワードを入力してください。',
'Old pass'					=>	'現在のパスワード',
'New pass'					=>	'新しいパスワード',
'Confirm new pass'			=>	'新しいパスワードをもう一度',

// E-mail stuff
'E-mail key bad'			=>	'メールアドレスアクティベートキーが正しく無い、または期限切れです。新しいメールアドレスを再度請求してください。正常に動作しない場合は、フォーラム管理者にお問合せください。管理者メールアドレス:',
'E-mail updated'			=>	'メールアドレスが更新されました。',
'Activate e-mail sent'		=>	'指定されたメールアドレスに新しいメールのアクティベートに関するメールが送信されました。メールが到着しない場合は、フォーラム管理にお問合せください。管理者メールアドレス:',
'E-mail legend'				=>	'あなたの新しいメールアドレスを入力してください。',
'E-mail instructions'		=>	'新しいメールアドレスを入力してください。アクティベートのためのリンクが記載されたメールが新しいメールアドレス宛に送信されます。新しいメールアドレスをアクティベートするために、受信したメールの中にあるリンクをクリックしてください。',
'Change e-mail'				=>	'メールアドレスの変更',
'New e-mail'				=>	'新しいメールアドレス',

// Avatar upload stuff
'Avatars disabled'			=>	'管理者はアバターのサポートを停止しています。',
'Too large ini'				=>	'選択されたファイルのサイズが大き過ぎます。サーバがアップロードを許可しませんでした。',
'Partial upload'			=>	'選択されたファイルは一部のみアップロードされました。もう一度アップロードしてください。',
'No tmp directory'			=>	'PHPはテンポラリロケーションにアップロードファイルを保存できません。',
'No file'					=>	'アップロードするファイルを選択してください。',
'Bad type'					=>	'許可されたタイプのファイルではありません。アップロード可能なファイルタイプは、gif、jpeg、pngです。',
'Too wide or high'			=>	'あなたがアップロードしようとしたファイルは、許可されたサイズより大き過ぎます。',
'Too large'					=>	'画像の大きさが許可された値を超えています',
'pixels'					=>	'ピクセル',
'bytes'						=>	'バイト',
'Move failed'				=>	'サーバにファイルをアップロード出来ませんでした。フォーラム管理者にお問合せください。管理者メールアドレス:',
'Unknown failure'			=>	'エラーが発生しました。もう一度お試しください。',
'Avatar upload redirect'	=>	'アバターがアップロードされました。リダイレクト中 ...',
'Avatar deleted redirect'	=>	'アバターが削除されました。リダイレクト中 ...',
'Avatar desc'				=>	'アバターは、あなたの全投稿に表示されるユーザ名下部の小さな画像です。最大サイズ:',
'Upload avatar'				=>	'アバターのアップロード',
'Upload avatar legend'		=>	'アップロードするアバターファイルを入力してください。',
'Delete avatar'				=>	'アバターの削除',	// only for admins
'File'						=>	'ファイル',
'Upload'					=>	'アップロード',	// submit button

// Form validation stuff
'Dupe username'				=>	'同じユーザ名が既に登録されています。別のユーザ名をお使いください。',
'Forbidden title'			=>	'あなたが入力して肩書きに使用禁止語が含まれています。他の肩書きを選択してください。',
'Profile redirect'			=>	'プロフィールが更新されました。リダイレクト中 ...',

// Profile display stuff
'Not activated'				=>	'このユーザは、まだアクティベートされていません。ユーザの最初のログイン後にアカウントはアクティベートされます。',
'Unknown'					=>	'(Unknown)',	// This is displayed when a user hasn't filled out profile field (e.g. Location)
'Private'					=>	'プライベート',	// This is displayed when a user does not want to receive e-mails
'No avatar'					=>	'アバター無し',
'Show posts'				=>	'全投稿を表示する',
'Realname'					=>	'本名',
'Location'					=>	'都道府県',
'Website'					=>	'ウェブサイト',
'Jabber'					=>	'Jabber',
'ICQ'						=>	'ICQ',
'MSN'						=>	'MSNメッセンジャー',
'AOL IM'					=>	'AOL IM',
'Yahoo'						=>	'Yahoo!メッセンジャー',
'Avatar'					=>	'アバター',
'Signature'					=>	'署名',
'Sig max length'			=>	'最大長',
'Sig max lines'				=>	'最大行数',
'Avatar legend'				=>	'あなたのアバター表示オプションを設定してください。',
'Avatar info'				=>	'アバターは、あなたの投稿のすべてに表示される小さなイメージです。下記のリンクをクリックして、あなたのアバターをアップロードすることができます。あなたの投稿にアバターを表示するには、下記の「アバターを使用する」チェックボックスをチェックしてください。',
'Change avatar'				=>	'アバターの変更',
'Use avatar'				=>	'アバターを使用する',
'Signature legend'			=>	'あなたの署名を作成してください。',
'Signature info'			=>	'署名は、あなたの投稿に付けられる小さなテキストです。署名には、あなたが好きなことを入力することができます。恐らくあなたが好きな引用や星座を入力することでしょう。内容はあなた次第です! このフォーラムで許可されている場合、署名でBBCodeを使用することができます。この機能を使用できるかどうかは、あなたが署名を編集する時に、入力欄の下に表示されます。',
'Sig preview'				=>	'現在の署名のプレビュー:',
'No sig'					=>	'現在、プロフィールに署名は保存されていません。',
'Topics per page'			=>	'1ページ当たりのトピック数',
'Topics per page info'		=>	'ここではフォーラムを閲覧する時の1ページ当たりの表示トピック数を設定します。分からないときは空白のままにしてください。フォーラムデフォルトが使用されます。',
'Posts per page'			=>	'1ページ当たりの投稿数',
'Posts per page info'		=>	'ここではフォーラムを閲覧する時の1ページ当たりの表示投稿数を設定します。分からないときは空白のままにしてください。フォーラムデフォルトが使用されます。',
'Leave blank'				=>	'デフォルトを使用する場合は空白',
'Notify full'				=>	'サブスクリプションのメールに投稿を含む。',
'Notify full info'			=>	'この設定を行うと新規投稿のテキストバージョンがサブスクリプション通知メールに含まれます。',
'Show smilies'				=>	'スマイリーをグラフィックアイコンとして表示する',
'Show smilies info'			=>	'このオプションを有効にした場合、テキストスマイリーの代わりに小さなイメージが表示されます。',
'Show images'				=>	'投稿のイメージを表示する。',
'Show images info'			=>	'投稿にイメージを表示したくない場合、このオプションを無効にしてください ( 例 [img]-タグで表示されるイメージ)。',
'Show images sigs'			=>	'ユーザ証明にイメージを表示する。',
'Show images sigs info'		=>	'署名にイメージを表示したく無い場合、このオプションを無効にしてください ( 例 [img]-タグで表示されるイメージ)。',
'Show avatars'				=>	'投稿にユーザアバターを表示する。',
'Show avatars info'			=>	'このオプションでは、投稿にユーザアバターイメージを表示するかどうか設定します。',
'Show sigs'					=>	'ユーザ署名を表示する。',
'Show sigs info'			=>	'ユーザ署名を表示したい場合、このオプションを有効にしてください。',
'Style legend'				=>	'スタイルを選択してください。',
'Style info'				=>	'このフォーラムで異なる表示スタイルを使用することが出来ます。',
'Admin note'				=>	'管理者メモ',
'Pagination legend'			=>	'あなたの表示オプションを入力してください。',
'Post display legend'		=>	'あなたの投稿表示オプションを設定してください。',
'Post display info'			=>	'あなたが遅い接続環境を使用している場合、これらのオプション、特に投稿および署名でのイメージ表示を無効にすることで、ページの表示速度が速くなります。',
'Instructions'				=>	'あなたがプロフィールを更新した場合、このページにリダイレクトされます。',

// Administration stuff
'Group membership legend'	=>	'ユーザグループの選択',
'Save'						=>	'保存',
'Set mods legend'			=>	'モデレータアクセスの設定',
'Moderator in'				=>	'モデレータ ',
'Moderator in info'			=>	'このユーザがモデレートできるフォーラムを選択してください。注意: この設定はモデレータのみに適用されます。管理者には、常にすべてのフォーラムに対する全権限があります。',
'Update forums'				=>	'フォーラムの更新',
'Delete ban legend'			=>	'削除 ( 管理者のみ ) またはユーザの利用拒否',
'Delete user'				=>	'ユーザの削除',
'Ban user'					=>	'ユーザの利用拒否',
'Confirm delete legend'		=>	'重要: ユーザを削除する前にお読みください。',
'Confirm delete user'		=>	'本当にこのユーザを削除してもよろしいですか?',
'Confirmation info'			=>	'本当にこのユーザを削除してもよろしいですか?',	// the username will be appended to this string
'Delete warning'			=>	'警告! ユーザおよび投稿を削除した場合、復旧することはできません。このユーザの投稿を削除しないと選択した場合、後で投稿のみを手動で削除することができます。',
'Delete posts'				=>	'このユーザのすべての投稿およびトピックを削除する。',
'Delete'					=>	'削除',		// submit button (confirm user delete)
'User delete redirect'		=>	'ユーザが削除されました。リダイレクト中 ...',
'Group membership redirect'	=>	'グループメンバーシップが保存されました。リダイレクト中 ...',
'Update forums redirect'	=>	'フォーラムモデレータ権限が更新されました。リダイレクト中 ...',
'Ban redirect'				=>	'リダイレクト中 ...;'

);
