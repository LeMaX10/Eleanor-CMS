<?php
/*
	Copyright © Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym

	Шаблон по умолчанию для админки модуля меню
	Рекомендуется скопировать этот файл в templates/[шаблон админки]/Classes/[имя этого файла] и там уже начинать править.
	В случае если такой файл уже существует - правьте его.
*/

class TplAdminMenu
{
	/*
		Страница отображения всех пунктов меню
		$items - массив статических страниц. Формат: ID=>array(), ключи внутреннего массива:
			title - заголовок пункта меню
			pos - целое число, характеризующее позицию пункта меню
			status - статус активности пункта меню
			_aswap - ссылка на включение / выключение активности пункта меню
			_aedit - ссылка на редактирование пункта меню
			_adel - ссылка на удаление пункта меню
			_aparent - ссылка на просмотр подстраниц текущей пункта меню
			_aup - ссылка на поднятие пункта меню вверх, если равна false - значит пункт меню уже и так находится в самом верху
			_adown - ссылка на опускание пункта меню вниз, если равна false - значит пункт меню уже и так находится в самом низу
			_aaddp - ссылка на добавление подпунктов к данному пункту
		$subitems - массив подпунктов меню для страниц из массива $items. Фомат: ID=>array(id=>array(), ...), где ID - идентификатор пункта меню, id - идентификатор статической подстраницы. Ключи массива статической подстраницы:
			title - заголовок пункта меню
			_aedit - ссылка на редактирование пункта меню
		$navi - массив, хлебные крошки навигации. Формат ID=>array(), ключи:
			title - заголовок крошки
			_a - ссылка подпункты данной крошки. Может быть равно false
		$cnt - число пунктов меню всего
		$pp - количество пунктов меню на страницу
		$qs - массив параметров адресной строки для каждого запроса
		$page - номер текущей страницы, на которой мы сейчас находимся
		$links - перечень необходимых ссылок, массив с ключами:
			sort_status - ссылка на сортировку списка $items по статусу активности (возрастанию/убыванию в зависимости от текущей сортировки)
			sort_title - ссылка на сортировку списка $items по названию (возрастанию/убыванию в зависимости от текущей сортировки)
			sort_pos - ссылка на сортировку списка $items по позиции (возрастанию/убыванию в зависимости от текущей сортировки)
			sort_id - ссылка на сортировку списка $items по ID (возрастанию/убыванию в зависимости от текущей сортировки)
			form_items - ссылка для параметра action формы, внтури которой происходит отображение перечня $items
			pp - фукнция-генератор ссылок на изменение количества пунктов меню отображаемых на странице
			first_page - ссылка на первую страницу пагинатора
			pages - функция-генератор ссылок на остальные страницы
	*/
	public static function ShowList($items,$subitems,$navi,$cnt,$pp,$qs,$page,$links)
	{

	}

	/*
		Страница добавления/редактирования пункта меню
		$id - идентификатор редактируемого пункта меню, если $id==0 значит пункт меню добавляется
		$controls - перечень контролов в соответствии с классом контролов. Если какой-то элемент массива не является массивом, значит это заголовок подгруппы контролов
		$values - результирующий HTML код контролов, который необходимо вывести на странице. Ключи данного массива совпадают с ключами $controls
		$errors - массив ошибок
		$back - URL возврата
		$hasdraft - признак того, что у пункта меню черновик
		$links - перечень необходимых ссылок, массив с ключами:
			delete - ссылка на удаление категории или false
			nodraft - ссылка на правку/добавление категории без использования черновика или false
			draft - ссылка на сохранение черновиков (для фоновых запросов)
	*/
	public static function AddEdit($id,$controls,$values,$errors,$back,$hasdraft,$links)
	{

	}
}