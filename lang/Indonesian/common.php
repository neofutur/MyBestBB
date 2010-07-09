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
'Bad request'			=>	'Ditemukan kesalahan. Link yang anda tuju tidak dapat ditemukan atau tidak benar.',
'No view'				=>	'Anda tidak diperbolehkan menjelajah forum-forum ini.',
'No permission'			=>	'Anda tidak memiliki izin untuk mengakses halaman ini.',
'Bad referrer'			=>	'HTTP_REFERER tidak dikenal. Anda diarahkan ke halaman ini oleh sumber yang tidak dikenal. Jika hal ini terjadi terus-menerus, silakan memeriksa kembali apakah \'Base URL\' telah diisi dengan benar di Admin/Options dan anda mengunjungi forum ini melalui URL tersebut. Informasi lebih lanjut mengenai hal ini dapat diperoleh di dokumentasi PunBB.',

// Topic/forum indicators
'New icon'				=>	'Ada posting baru',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Topik ini ditutup',
'Redirect icon'			=>	'Forum yang diarahkan',

// Miscellaneous
'Announcement'			=>	'Pengumuman',
'Options'				=>	'Pengaturan',
'Actions'				=>	'Tindakan',
'Submit'				=>	'Kirim',	// "name" of submit buttons
'Ban message'			=>	'Anda telah dikeluarkan dari forum ini dan dilarang untuk mengaksesnya.',
'Ban message 2'			=>	'Larangan ini berlaku sampai akhir',
'Ban message 3'			=>	'Administrator atau moderator yang telah mengeluarkan dan melarang anda meninggalkan pesan sebagai berikut:',
'Ban message 4'			=>	'Silakan mengajukan keberatan, saran, kritik atau masukkan lainnya ke administrator forum melalui',
'Never'					=>	'Tidak pernah',
'Today'					=>	'Hari ini',
'Yesterday'				=>	'Kemarin',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Kembali ke halaman sebelumnya',
'Maintenance'			=>	'Pemeliharaan',
'Redirecting'			=>	'Sedang diarahkan ke halaman yang dituju',
'Click redirect'		=>	'Klik di sini jika anda tidak ingin menunggu lebih lama (atau jika browser anda tidak memberikan respon apa-apa)',
'on'					=>	'aktif',		// as in "BBCode is on"
'off'					=>	'non aktif',
'Invalid e-mail'		=>	'Alamat e-mail yang anda berikan tidak sah.',
'required field'		=>	'adalah kolom yang harus diisi di formulir ini.',	// for javascript form validation
'Last post'				=>	'Posting terakhir',
'by'					=>	'oleh',	// as in last post by someuser
'New posts'				=>	'Posting terbaru',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Ke posting baru pertama di dalam topik ini.',	// the popup text for new posts links
'Username'				=>	'Nama pengguna',
'Password'				=>	'Kata sandi',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Kirim e-mail',
'Moderated by'			=>	'Moderator:',
'Registered'			=>	'Terdaftar',
'Subject'				=>	'Subyek',
'Message'				=>	'Pesan',
'Topic'					=>	'Topik',
'Forum'					=>	'Forum',
'Posts'					=>	'Posting',
'Replies'				=>	'Balasan',
'Author'				=>	'Penulis',
'Pages'					=>	'Halaman',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'tag [img]',
'Smilies'				=>	'Smilies',
'and'					=>	'dan',
'Image link'			=>	'gambar',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'menulis',	// For [quote]'s
'Code'					=>	'Kode',		// For [code]'s
'Mailer'				=>	'Mailer',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Penting',
'Write message legend'	=>	'Tulis pesan anda dan kirimkan',

// Title
'Title'					=>	'Panggilan',
'Member'				=>	'Pengguna',	// Default title
'Moderator'				=>	'Moderator',
'Administrator'			=>	'Administrator',
'Banned'				=>	'Pengguna yang dilarang',
'Guest'					=>	'Pengunjung',

// Stuff for include/parser.php
'BBCode error'			=>	'Syntax BBCode dalam pesan ini tidak benar.',
'BBCode error 1'		=>	'Tag awal untuk [/quote] tidak ada.',
'BBCode error 2'		=>	'Tag akhir untuk [code] tidak ada.',
'BBCode error 3'		=>	'Tag awal untuk [/code] tidak ada.',
'BBCode error 4'		=>	'Tidak ditemukan satu atau lebih tag akhir untuk [quote].',
'BBCode error 5'		=>	'Tidak ditemukan satu atau lebih tag awal untuk [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Index',
'User list'				=>	'Daftar pengguna',
'Rules'					=>  'Aturan penggunaan',
'Search'				=>  'Pencarian',
'Register'				=>  'Pendaftaran',
'Login'					=>  'Login',
'Not logged in'			=>  'Anda belum login.',
'Profile'				=>	'Profil',
'Logout'				=>	'Keluar',
'Logged in as'			=>	'Login sebagai',
'Admin'					=>	'Administrasi',
'Last visit'			=>	'Kunjungan terakhir',
'Show new posts'		=>	'Menampilkan posting terbaru sejak kunjungan terakhir',
'Mark all as read'		=>	'Menandai semua topik sebagai yang sudah dibaca',
'Link separator'		=>	'',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Catatan kaki forum',
'Search links'			=>	'Cari link',
'Show recent posts'		=>	'Menampilkan posting terbaru',
'Show unanswered posts'	=>	'Menampilkan posting yang belum dijawab',
'Show your posts'		=>	'Menampilkan posting anda',
'Show subscriptions'	=>	'Menampilkan topik langganan anda',
'Jump to'				=>	'Pindah ke',
'Go'					=>	' Go ',		// submit button in forum jump
'Move topic'			=>  'Pindah topik',
'Open topic'			=>  'Buka topik',
'Close topic'			=>  'Tutup topik',
'Unstick topic'			=>  'Melepas rekatan topik',
'Stick topic'			=>  'Merekatkan topik',
'Moderate forum'		=>	'Memoderasi forum',
'Delete posts'			=>	'Hapus posting sekali banyak',
'Debug table'			=>	'Informasi debug',

// For extern.php RSS feed
'RSS Desc Active'		=>	'Topik teraktif saat ini di',	// board_title will be appended to this string
'RSS Desc New'			=>	'Topik terbaru di',					// board_title will be appended to this string
'Posted'				=>	'Ditulis'	// The date/time a topic was started

);
