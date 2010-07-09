<?php

// Language definitions used in profile.php
$lang_profile = array(

// Navigation and sections
'Profile menu'				=>	'控制菜单',
'Section essentials'		=>	'用户设置',
'Section personal'			=>	'个人资料',
'Section messaging'			=>	'联系方式',
'Section personality'		=>	'头像与签名',
'Section display'			=>	'论坛风格',
'Section privacy'			=>	'隐私设定',
'Section admin'				=>	'管理员设定',

// Miscellaneous
'Username and pass legend'	=>	'输入您的用户名与密码',
'Personal details legend'	=>	'输入您的个人资料',
'Contact details legend'	=>	'输入您的联系方式',
'Options display'			=>	'设定您的显示选项',
'Options post'				=>	'设定您的帖子浏览选项',
'User activity'				=>	'用户动态',
'Paginate info'				=>	'输入您想在一个页面中浏览的主题数及帖子数',

// Password stuff
'Pass key bad'				=>	'您用的密码激活密钥有误或是已经过期，请重新申请新密码。如果还是无法更换，请与论坛管理员联系：',
'Pass updated'				=>	'密码已更新，请用新密码登入。',
'Pass updated redirect'		=>	'密码已更新，跳转中 &hellip;',
'Wrong pass'				=>	'旧密码不正确。',
'Change pass'				=>	'更改密码',
'Change pass legend'		=>	'请输入并且确认您的新密码',
'Old pass'					=>	'旧密码',
'New pass'					=>	'新密码',
'Confirm new pass'			=>	'确认新密码',

// E-mail stuff
'E-mail key bad'			=>	'您用的电子邮件激活密钥有误或是已经过期，请重新申请更换电子邮件地址。如果还是无法更换，请与论坛管理员联络：',
'E-mail updated'			=>	'电子邮件地址修改完成。',
'Activate e-mail sent'		=>	'系统已经发信至新的电子邮件地址，内有激活新电子邮件地址的链接。如果一直收不到激活邮件，请与论坛管理员联络：',
'E-mail legend'				=>	'输入您的新电子邮件地址',
'E-mail instructions'		=>	'输入新的电子邮件地址后，系统会发信至新地址，内有激活新电子邮件地址的链接。请使用激活信件内的链接激活新的电子邮件地址。',
'Change e-mail'				=>	'更改电子邮件地址',
'New e-mail'				=>	'新电子邮件地址',

// Avatar upload stuff
'Avatars disabled'			=>	'论坛管理员已关闭头像功能。',
'Too large ini'				=>	'欲上传的文件过大，服务器拒绝接收。',
'Partial upload'			=>	'上传不完整，请再试一次。',
'No tmp directory'			=>	'PHP无法保存上传的文件至暂存区。',
'No file'					=>	'请选择要上传的文件。',
'Bad type'					=>	'您上传的文件类型被拒绝，请使用 gif、jpg 或是 png 文件。',
'Too wide or high'			=>	'您上传的图片宽度或高度超过限制',
'Too large'					=>	'您上传的图片大小超过限制',
'pixels'					=>	'像素',
'bytes'						=>	'位元组',
'Move failed'				=>	'服务器保存文件失败，请与论坛管理员联络：',
'Unknown failure'			=>	'发生不明错误，请再试一次。',
'Avatar upload redirect'	=>	'头像上传完成，跳转中 &hellip;',
'Avatar deleted redirect'	=>	'头像已删除，跳转中 &hellip;',
'Avatar desc'				=>	'“头像”就是在帖子旁，显示在帐号名称下方的小型图片。图片的大小不可超过',
'Upload avatar'				=>	'上传头像',
'Upload avatar legend'		=>	'请输入一个头像文件以供上传',
'Delete avatar'				=>	'删除头像',	// only for admins
'File'						=>	'文件',
'Upload'					=>	'上传',	// submit button

// Form validation stuff
'Dupe username'				=>	'已经有人使用这个用户名，请重新选择。',
'Forbidden title'			=>	'您输入的头衔内含禁用字词，请重新选择。',
'Profile redirect'			=>	'资料已更新，跳转中 &hellip;',

// Profile display stuff
'Not activated'				=>	'该使用者尚未激活帐号，帐号激活程序在第一次登录时会自动完成。',
'Unknown'					=>	'(未知)',	// This is displayed when a user hasn't filled out profile field (e.g. Location)
'Private'					=>	'(保密)',	// This is displayed when a user does not want to receive e-mails
'No avatar'					=>	'(无头像)',
'Show posts'				=>	'列出所有帖子',
'Realname'					=>	'真实姓名',
'Location'					=>	'居住地',
'Website'					=>	'个人网站',
'Jabber'					=>	'Jabber',
'ICQ'						=>	'ICQ',
'MSN'						=>	'MSN Messenger',
'AOL IM'					=>	'AOL IM',
'Yahoo'						=>	'Yahoo! Messenger',
'Avatar'					=>	'头像',
'Signature'					=>	'个人签名',
'Sig max length'			=>	'最大长度',
'Sig max lines'				=>	'最大行数',
'Avatar legend'				=>	'设定头像显示选项',
'Avatar info'				=>	'“头像”就是在每篇帖子旁显示的小图片。请用下面链接上传头像，并且勾选“使用头像”，才能正常显示头像。',
'Change avatar'				=>	'更改头像',
'Use avatar'				=>	'使用头像',
'Signature legend'			=>	'编辑您的签名',
'Signature info'			=>	'“个人签名”就是加在每篇帖子尾端的一小段文字，内容可以随心所欲，从座右铭到自己的星座都可以写。只要版面设定许可，签名里也可以使用 BBCode 标签；在修改签名时，文字框下边会列出哪些功能被开启、哪些没有被开启。',
'Sig preview'				=>	'预览现有个人签名：',
'No sig'					=>	'目前没有设定个人签名。',
'Topics per page'			=>	'每页显示主题数',
'Topics per page info'		=>	'这里设定每一页要列出的主题数目。如果不确定要设定多少数量，请保留空白，系统会自动使用预设设定。',
'Posts per page'			=>	'每页显示帖子数',
'Posts per page info'		=>	'这里设定每一页要显示的帖子数目。如果不确定要设定多少数量，请保留空白，系统会自动使用预设设定。',
'Leave blank'				=>	'留空即可使用预设设置',
'Notify full'				=>	'帖子内容加入订阅通知信',
'Notify full info'			=>	'开启这个功能后，如果您订阅的主题有新回复，订阅通知信里面会用纯文字方式附上新回复的内容。',
'Show smilies'				=>	'显示表情符号为图标',
'Show smilies info'			=>	'假如您启用这个选项，小图标将会取代文字型的表情符号。',
'Show images'				=>	'在帖子里显示图片。',
'Show images info'			=>	'如果您不想看到帖子里的图片，就把这个功能关掉（例如用 [img] 标签加入的图片）。',
'Show images sigs'			=>	'在个人签名里显示图片。',
'Show images sigs info'		=>	'如果您不想看到个人签名里的图片，就把这个功能关掉（例如用 [img] 标签加入的图片）。',
'Show avatars'				=>	'在帖子里显示个人头像。',
'Show avatars info'			=>	'这里设定帖子里是否要显示个人头像。',
'Show sigs'					=>	'显示个人签名。',
'Show sigs info'			=>	'这里设定帖子里是否要显示个人签名。',
'Style legend'				=>	'选择您喜爱的版面风格',
'Style info'				=>	'您可以选择使用不同的外观风格浏览本论坛。',
'Admin note'				=>	'管理员备忘',
'Pagination legend'			=>	'输入您的分页选项',
'Post display legend'		=>	'设定浏览帖子选项',
'Post display info'			=>	'如果您使用的网络速度比较慢，可以取消显示这些项目，特别像是取消在帖子里显示图片及个人签名等项目，这样会使您浏览页面的速度快一些。',
'Instructions'				=>	'当您更新完个人资料后，会再度回到本页。',

// Administration stuff
'Group membership legend'	=>	'选择用户群组',
'Save'						=>	'保存',
'Set mods legend'			=>	'设定版主权限',
'Moderator in'				=>	'设定为版主',
'Moderator in info'			=>	'设定此会员可以管理的版面。请注意：这个设定只对版主有效，论坛管理员拥有所有版面的管理权限。',
'Update forums'				=>	'更新版面',
'Delete ban legend'			=>	'删除 (只有论坛管理员可以做) 或者对会员实施停权',
'Delete user'				=>	'删除用户',
'Ban user'					=>	'停权',
'Confirm delete legend'		=>	'重要: 删除用户前必读',
'Confirm delete user'		=>	'确认删除用户',
'Confirmation info'			=>	'请确认您要删除的用户',	// the username will be appended to this string
'Delete warning'			=>	'警告：删除用户和其帖子后便无法再恢复！假如您选择不要删除该用户所发表的帖子，则那些帖子在以后只能以手工的方式删除。',
'Delete posts'				=>	'删除这名用户所发表的帖子和发表的主题。',
'Delete'					=>	'删除',		// submit button (confirm user delete)
'User delete redirect'		=>	'用户已删除，跳转中 &hellip;',
'Group membership redirect'	=>	'用户群组已保存，跳转中 &hellip;',
'Update forums redirect'	=>	'版主权限已更新，跳转中 &hellip;',
'Ban redirect'				=>	'跳转中 &hellip;'

);
