<?php
/*
	Copyright © Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym
*/
if(!defined('CMS'))die;
$lang=Eleanor::$Language->Load('addons/admin/info-*.php',false);
/*
	Массив, характеризующий набор дополнительных служебных модулей админки. Описания ключей:
	name - имя модуля
		title - Название модуля
		descr - описание модуля
		image - логотипчик модуля
		main - признак того, что модуль надо выводить в верхней (главной) части
		hidden - признак того, что модуль не будет отображаться в общем списке
		services (array) - массив файлов, для подключения в различных сервисах
*/
$info=array(
	'services'=>array(
		'title'=>$lang['sessm'],
		'descr'=>$lang['sessm_'],
		'image'=>'services-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'services.php',
		),
	),
	'modules'=>array(
		'title'=>$lang['modm'],
		'descr'=>$lang['modm_'],
		'image'=>'modules-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'modules.php',
		),
	),
	'multisite'=>array(
		'title'=>$lang['multisite'],
		'descr'=>$lang['multisite_'],
		'image'=>'multisite-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'multisite.php',
			'ajax'=>'multisite_ajax.php',
		),
	),
	'blocks'=>array(
		'title'=>$lang['blokm'],
		'descr'=>$lang['blokm_'],
		'image'=>'blocks-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'blocks.php',
			'ajax'=>'blocks_ajax.php',
		),
	),
	'groups'=>array(
		'title'=>$lang['grm'],
		'descr'=>$lang['grm_'],
		'image'=>'groups-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'groups.php',
		),
	),
	'users'=>array(
		'title'=>$lang['userm'],
		'descr'=>$lang['userm_'],
		'image'=>'users-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'users.php',
			'ajax'=>'users_ajax.php',
		),
	),
	'smiles'=>array(
		'title'=>$lang['smm'],
		'descr'=>$lang['smm_'],
		'image'=>'smiles-*.png',
		'services'=>array(
			'admin'=>'smiles.php',
			'ajax'=>'smiles_ajax.php',
		),
	),
	'sitemap'=>array(
		'title'=>$lang['smg'],
		'descr'=>$lang['smg_'],
		'image'=>'sitemap-*.png',
		'services'=>array(
			'admin'=>'sitemap.php',
			'ajax'=>'sitemap_ajax.php',
		),
	),
	'database'=>array(
		'title'=>$lang['db'],
		'descr'=>$lang['db_'],
		'image'=>'database-*.png',
		'services'=>array(
			'admin'=>'database.php',
			'ajax'=>'database_ajax.php',
		),
	),
	'themes'=>array(
		'title'=>$lang['tmpe'],
		'descr'=>$lang['tmpm_'],
		'image'=>'themes_editor-*.png',
		'services'=>array(
			'admin'=>'themes/index.php',
			'ajax'=>'themes/ajax.php',
			'upload'=>'themes/upload.php',
			'download'=>'themes/download.php',
		),
	),
	'ownbb'=>array(
		'title'=>$lang['ownb'],
		'descr'=>$lang['ownb_'],
		'image'=>'ownbb-*.png',
		'services'=>array(
			'admin'=>'ownbb.php',
		),
	),
	'tasks'=>array(
		'title'=>$lang['tasks'],
		'descr'=>$lang['tasks_'],
		'image'=>'tasks-*.png',
		'main'=>true,
		'services'=>array(
			'admin'=>'tasks.php',
		),
	),
	'spam'=>array(
		'title'=>$lang['spam'],
		'descr'=>$lang['spam_'],
		'image'=>'spam-*.png',
		'services'=>array(
			'admin'=>'spam.php',
			'ajax'=>'spam_ajax.php',
		),
	),
	/*'installer'=>array(
		'title'=>$lang['installer'],
		'descr'=>$lang['installer_'],
		'image'=>'installer-*.png',
		'services'=>array(
			'admin'=>'installer.php',
		),
	),*/
	'comments'=>array(
		'title'=>$lang['comm'],
		'descr'=>$lang['comm_'],
		'image'=>'comments-*.png',
		'services'=>array(
			'admin'=>'comments.php',
		),
	),
	'notes'=>array(
		'title'=>'Notes',
		'descr'=>'',
		'image'=>'',
		'services'=>array(
			'ajax'=>'notes_ajax.php',
		),
	),
	'qmenu'=>array(
		'title'=>'Qmenu edit',
		'descr'=>'',
		'image'=>'',
		'hidden'=>true,
		'services'=>array(
			'admin'=>'qmenu.php',
		),
	),
	'autocomplete'=>array(
		'title'=>'AutoComplete',
		'descr'=>'',
		'image'=>'',
		'hidden'=>true,
		'services'=>array(
			'ajax'=>'autocomplete.php',
		),
	),
	'misc'=>array(
		'title'=>'Misc',
		'descr'=>'',
		'image'=>'',
		'hidden'=>true,
		'services'=>array(
			'ajax'=>'misc_ajax.php',
		),
	),
);
uasort($info,create_function('$a,$b','return strcmp($a[\'title\'],$b[\'title\']);'));