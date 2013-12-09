<?php
return array(
	#Для шаблона UsersOnline.php
	'user_info'=>'Информация о посетителе',
	'users'=>function($n){return $n.Russian::Plural($n,array(' пользователь:',' пользователя:',' пользователей:'));},
	'min_left'=>function($n){return $n.Russian::Plural($n,array(' минуту назад',' минуты назад',' минут назад'));},
	'bots'=>function($n){return $n.Russian::Plural($n,array(' поисковый бот:',' поисковых бота:',' поисковых ботов:'));},
	'guests'=>function($n){return $n.Russian::Plural($n,array(' гость',' гостя',' гостей'));},
	'activity'=>'Активность',
	'now_onp'=>'Сейчас на странице',
	'r'=>'Перешел с',
	'browser'=>'Браузер',
	'service'=>'Сервис',
	'c'=>'Поддержка кодировок',
	'e'=>'Поддерживаемые типы данных',
	'ips'=>'IP дополнительные',
	'session_nf'=>'Сессия не найдена',
	'go'=>'Перейти',
	'icq_error'=>'Номер ICQ должен содержать как минимум 5 цифр',

	#Для шаблона Classes/Users.php
	'add'=>'Создать пользователя',
	'save'=>'Сохранить пользователя',
	'not_imp'=>'-Не важно-',
	'begins'=>'Начинается с',
	'contains'=>'Содержит',
	'match'=>'Совпадает',
	'endings'=>'Заканчивается на',
	'name'=>'Имя пользователя',
	'fullname'=>'Полное имя',
	'group'=>'Группа',
	'agroups'=>'Дополнительные группы',
	'last_visit'=>'Последний визит',
	'register'=>'Регистрация',
	'from-to'=>'от - до ГГГГ-ММ-ДД ЧЧ:ММ:СС',
	'unf'=>'Пользователи не найдены',
	'upp'=>'Пользователей на страницу: %s',
	'deleting'=>'Вы действительно хотите удалить пользователя <b>%s</b> (%s)?',
	'lap'=>'Имя и пароль',
	'general'=>'Основное',
	'extra'=>'Личное',
	'special'=>'Специальное',
	'block'=>'Блокировка',
	'statistics'=>'Статистика',
	'pass'=>'Пароль',
	'passc'=>'Еще раз пароль',
	'pass_'=>'Можно не вводить - система сгенерирует автоматически',
	'slname'=>'Информировать об изменении имени',
	'slname_'=>'Пользователю будет выслано сообщение с информацией о новом имени',
	'slpass'=>'Информировать об изменении пароля',
	'slpass_'=>'Пользователю будет выслано сообщение с информацией о новом пароле',
	'slnew'=>'Информировать о создании учетной записи',
	'slnew_'=>'Пользователю будет выслано сообщение с информацией о его новой учетной записи на Вашем сайте',
	'account'=>'Учётная запись',
	'lang'=>'Язык',
	'timezone'=>'Часовой пояс',
	'inherit'=>'Наследовать',
	'addo'=>'Добавить',
	'replace'=>'Заменить',
	'ban-to'=>'Забанить до',
	'ban-exp'=>'Причина бана',
	'fla'=>'Неудачные попытки авторизации',
	'clean'=>'Очистить',
	'avatar'=>'Аватар',
	'alocation'=>'Размещение',
	'apersonal'=>'Загрузить',
	'agallery'=>'Из галереи',
	'amanage'=>'Управление',
	'gallery_select'=>'Выбрать',
	'noavatar'=>'Нет аватара',
	'sessions'=>'Открытые сессии пользователя',
	'find'=>'Найти',
	'staticip'=>'Постоянный IP адрес',
	'staticip_'=>'Включение этой опции рекомендуется для пользователей с постоянным IP адресом. При включении, кука аунтификации привязывается к IP адресу, что делает невозможным кражу кук.',
	'externals'=>'Внешние сервисы',
	'awo'=>'всех, кто онлайн',
	'alls'=>'всех',
	'allg'=>'всех, кто заходил',
	'sshow'=>'Отображать',
	'who'=>'Кто',
	'ets'=>'Вход на сайт',
	'pl'=>'Адрес страницы',
	'guest'=>'Гость',
	'expire'=>'Истекает %s',
	'expired'=>'Истекла %s',
	'spp'=>'Сессий на страницу: %s',
	'no_avatars'=>'Доступных аватаров нет',
	'cancel_avatar'=>'Отменить',
	'togals'=>'К галереям',
	'datee'=>'Дата истечения',
	'csnd'=>'Текущую сессию нельзя удалять',
	'snf'=>'Сессии не найдены',

	#Errors
	'SITE_ERROR'=>'Адрес сайта введен некорректно!',
	'SHORT_ICQ'=>'Номер ICQ должен содержать как минимум 5 цифр',
	'ERROR_BANDATE'=>'Некорректно введена дата блокировки пользователя',
	'PASSWORD_MISMATCH'=>'Пароли не совпадают',
	'AVATAR_NOT_EXISTS'=>'Выбранного аватара не существует',
	'EMPTY_NAME'=>'Имя пользователя не заполнено',
	'EMAIL_ERROR'=>'Введен некорректный e-mail',
	'EMPTY_PASSWORD'=>'Пароль не задан',
	'NAME_EXISTS'=>'Пользователь с таким именем уже существует',
	'EMAIL_EXISTS'=>'Пользователь с таким e-mail уже существует',
	'EMPTY_EMAIL'=>'E-mail не задан',

	#Внешняя авторизация
	'twitter.com'=>'Twitter',
	'www.facebook.com'=>'Facebook',
	'openid.yandex.ru/server'=>'Яндекс',
	'vkontakte.ru'=>'VK',
);