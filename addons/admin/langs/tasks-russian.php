<?php
return array(
	#Для /addons/admin/modules/tasks.php
	'handler'=>'Задача',
	'name'=>'Название',
	'runyear'=>'Годы',
	'runyear_'=>'Укажите годы, в которые необходимо запускать задачу. Укажите * для запуска каждый год. Например: '.date('Y').','.date('Y',strtotime('+1year')),
	'runmonth'=>'Месяцы',
	'runmonth_'=>'Укажите месяцы, в которые необходимо запускать задачу. Укажите * для запуска каждый месяц. Например: '.date('m').','.date('m',strtotime('+1month')),
	'runday'=>'Дни',
	'runday_'=>'Укажите дни месяца, в которые необходимо запускать задачу. Укажите * для запуска каждый день. Например: '.date('d').','.date('d',strtotime('+7day')),
	'runhour'=>'Часы',
	'runhour_'=>'Укажите часы, в которые необходимо запускать задачу. Укажите * для запуска каждый час. Например: '.date('H').','.date('H',strtotime('+2hour')),
	'runminute'=>'Минуты',
	'runminute_'=>'Укажите минуты, в которые необходимо запускать задачу. Укажите * для запуска каждую минуту. Например: '.date('i').','.date('i',strtotime('+1min')),
	'runsecond'=>'Секунды',
	'runsecond_'=>'Укажите секунды, в которые необходимо запускать задачу. Укажите * для запуска каждую секунду. Например: 14,12',
	'maxrun'=>'Максимальное число запусков задачи',
	'alreadyrun'=>'Текущее число запусков',
	'ondone'=>'После достижения предела',
	'ondone_'=>'Что сделать с задачей после достижения предела запуска.',
	'deactivate'=>'Деактивировать',
	'delete'=>'Удалить',
	'status'=>'Активировать',
	'delc'=>'Подтверждение удаления',
	'list'=>'Список задач',
	'adding'=>'Добавление задачи',
	'editing'=>'Редактирование задачи',
);