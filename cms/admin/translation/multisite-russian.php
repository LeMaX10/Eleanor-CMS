<?php
return[
	#Для /cms/admin/modules/multisite.php
	'site-name'=>'Название сайта',
	'site-url'=>'Адрес сайта',
	'site-url_'=>'Слеш в конце обязателен',
	'sync'=>'Пользователи синхронизированы',
	'sync_'=>'Если пользователи синхронизированы - автовход будет производится по ID пользователя, если нет - по логину.',
	'secret'=>'Секрет сайта',
	'prefix'=>'Префикс таблиц',
	'db-host'=>'Хост БД',
	'db-host_'=>'Очистите это поле, чтобы использовать текущую БД',
	'db-name'=>'Название базы данных',
	'db-user'=>'Пользователь базы данных',
	'db-pass'=>'Пароль базы данных',
	'config'=>'Конфигурация',

	'EMPTY_SITE_NAME'=>'У одного из сайтов не заполнено название',
	'WRONG_SITE_URL'=>'У одного из сайтов адрес введен некорректно.',
	'MULTI_SITE_TABLE_WAS_NOT_FOUND'=>'Таблица мультисайта не найдена',
	'THIS_SITE'=>'Попытка связать сайт сам с собой (&quot;%&quot;)',
];