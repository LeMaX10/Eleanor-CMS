<?php
namespace Eleanor\Classes\Language;
defined('CMS\STARTED')||die;

return[
	'error'=>'Помилка',
	'low_php'=>'Для роботи системи необхідний PHP не нижче версії 5.5. У Вас %s.',
	'low_mysql'=>'Для роботи системи необхідний MySQL не нижче версії 5.1',
	'install.lock'=>'Установка заблокована файлом install/install.lock. Видаліть цей файл і оновіть сторінку.',
	'GD'=>'Для роботи системи необхідна бібліотека GD2',
	'MB'=>'Для роботи системи необхідна бібліотека Multibyte String',
	'no_db_driver'=>'Системи керування базами даних не виявлено',
	'must_writeable'=>'Наступні папки та файли повинні бути доступні для запису:<br />',
	'must_ex'=>'Наступних папок та файлів не існує:<br />',
	'err_email'=>'E-mail введено з помилкою',
	'empty_site'=>'Будь ласка, введіть назву сайту.',
	'welcome'=>'Ласкаво просимо! Підготовка до встановлення Eleanor CMS',
	'lang_select'=>'Вибір мови',
	'install'=>'Встановлення',
	'update'=>'Оновлення',
	'license'=>'Ліцензійна угода',
	'read_careful'=>'Прочитайте уважно',
	'get_data'=>'Збирання даних',
	'already_to_install'=>'Все готове до встановлення',
	'installing'=>'Встановлення...',
	'create_admin'=>'Створення облікового запису адміністратора',
	'do_create_admin'=>'Створити',
	'finish'=>'Закінчення установки',
	'i_am_agree_lic'=>'Я приймаю умови ліцензійної угоди',
	'next'=>'Далі &raquo;',
	'you_must_lagree'=>'Ви повинні прийняти умови ліцензійної угоди',
	'sanctions'=>'Санкції',
	'i_am_agree_sanc'=>'Я приймаю умови санкцій',
	'you_must_sagree'=>'Ви повинні прийняти умови санкцій',
	'print'=>'Версія для друку',
	'db_host'=>'Сервер бази даних',
	'db_name'=>'Назва бази даних',
	'db_user'=>'Користувач',
	'db_pass'=>'Пароль',
	'db_pref'=>'Префікс таблиць',
	'db_prefinfo'=>'Увага! Вказуйте унікальний префікс таблиць, оскільки при новій інсталяції системи всі таблиці будуть перезаписані!',
	'site-name'=>'Назва сайту',
	'email'=>'Базовий e-mail',
	'install_me'=>'Встановити',
	'back'=>'&laquo; Назад',
	'select-lang'=>'&laquo; Обрати мову',
	'press_here'=>'Натисніть сюди, якщо Вас не перемістило автоматично',
	'creating_tables'=>'Створення таблиць...',
	'inserting_v'=>'Запис значень...',
	'a_name'=>'Ім\'я користувача',
	'a_rpass'=>'Повторіть пароль',
	'a_email'=>'E-mail',
	'PASS_MISMATCH'=>'Паролі не збігаються',
	'ENTER_NAME'=>'Будь ласка, введіть им\'я користувача',
	'install_finished'=>'Установка успішно закінчена',
	'inst_fin_text'=>'Ваша копія Eleanor CMS успішно встановлена і готова до роботи! Скрипт установки заблоковано файлом install/install.lock, тому якщо Ви бажаєте встановити систему ще раз - Ви повинні вручну видалити цей файл. Ми переконливо рекомендуємо видалити теку install з усім її вмістом виключно з міркувань безпеки.',
	'links%'=>'<a href="%s">Перейти на головну сторінку Вашого сайту</a><br />
<a href="%s">Перейти до панелі адміністратора</a>',
	'requirements'=>'Системні вимоги',
	'skip'=>'Пропуск...',
	'parameter'=>'Параметр',
	'value'=>'Значення',
	'status'=>'Статус',
	'unknown'=>'Невідомо',
	'mysqlver'=>'Для коректної роботи системи потрібен MySQL не нижче версії 5.1.<br />
На жаль, без підключення до БД це встановити неможливо, за додатковою інформацією звертайтеся до вашого хостера.',
	'php_version'=>'<b>Версія PHP</b><br />
<span class="small">Версія PHP повинна бути не нижче 5.5</span>',
	'php_gd'=>'<b>Наявність бібліотеки GD</b><br />
<span class="small">Для роботи системи необхідно Image Processing функції</span>',
	'db_drivers'=>'<b>Драйвери БД</b><br />
<span class="small">Для роботи системи необхідний драйвер бази даних</span>',
	'php_dom'=>'<b>DOM Functions</b><br />
<span class="small">Для імпорту та експорту налаштувань Eleanor CMS, необхідні DOM Functions. Без них виконання цих дій <b>неможливо</b>.</span>',
	'mod_rewrite'=>'<b>Apache mod_rewrite</b><br />
<span class="small">Для работи <abbr title="Friendly URL">FURL</abbr> необхідний mod_rewrite.',
	'not-found'=>'Не знайдені',
	'sysver'=>'Версія системи: ',
	'yes'=>'Так',
	'no'=>'Ні',
	'addl'=>'Додаткові мови',
	'addl_'=>'Виберіть мови, які Ви будете використовувати на сайті',
	'db'=>'База даних',
	'gen_data'=>'Основні дані сайту',
	'timezone'=>'Часовий пояс',
	'EMPTY_NAME'=>'Поле логіна залишено порожнім',
	'EMPTY_PASSWORD'=>'Поле пароля залишено порожнім!',
	'EMAIL_ERROR'=>'E-mail введено невірно!',
	'NAME_EXISTS'=>'Таке ім\'я користувача вже існує!',
	'NAME_TOO_LONG'=>function($l,$e){
		return'Довжина імені користувача не повинна перевищувати '
			.$l.Ukrainian::Plural($l,[' символ',' символи',' символів'])
			.'. Ви ввели '.$e.Ukrainian::Plural($e,[' символ.',' символи.',' символів.']);
	},
	'PASS_TOO_SHORT'=>function($l,$e){
		return'Довжина пароля повинна бути мінімум '.$l.Ukrainian::Plural($l,[' символ',' символи',' символів'])
			.'. Ви ввели тільки '.$e.Ukrainian::Plural($e,[' символ.',' символи.',' символів.']);
	},
];