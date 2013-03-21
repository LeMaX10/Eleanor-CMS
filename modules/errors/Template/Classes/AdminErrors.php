<?php
/*
	Copyright © Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym

	Шаблон по умолчанию для админки системного модуля страниц ошибок
	Рекомендуется скопировать этот файл в templates/[шаблон админки]/Classes/[имя этого файла] и там уже начинать править.
	В случае если такой файл уже существует - правьте его.
*/

class TPLAdminErrors
{
	/*
		Страница отображения всех страниц ошибок
		$items - массив страниц ошибок. Формат: ID=>array(), ключи внутреннего массива:
			mail - e-mail, куда будут отправляться сообщения об ошибках
			log - флаг логирования ошибки
			url - URI ошибки
			title - название страницы ошибки
			_aedit - ссылка на редактирование страницы ошибки
			_adel - ссылка на удаление страницы ошибки
		$cnt - количество страниц ошибок всего
		$pp - количество страниц ошибок на страницу
		$qs - массив параметров адресной строки для каждого запроса
		$page - номер текущей страницы, на которой мы сейчас находимся
		$links - перечень необходимых ссылок, массив с ключами:
			sort_title - ссылка на сортировку списка $items по названию (возрастанию/убыванию в зависимости от текущей сортировки)
			sort_mail - ссылка на сортировку списка $items по e-mail для отпрвки ошибки (возрастанию/убыванию в зависимости от текущей сортировки)
			sort_log - ссылка на сортировку списка $items по флагу логирования (возрастанию/убыванию в зависимости от текущей сортировки)
			sort_id - ссылка на сортировку списка $items по ID (возрастанию/убыванию в зависимости от текущей сортировки)
			form_items - ссылка для параметра action формы, внтури которой происходит отображение перечня $items
			pp - фукнция-генератор ссылок на изменение количества ошибок отображаемых на странице
			first_page - ссылка на первую страницу пагинатора
			pages - функция-генератор ссылок на остальные страницы
	*/
	public static function ShowList($items,$cnt,$pp,$qs,$page,$links)
	{

	}

	/*
		Интерфейс предпросмотра логотипа выбранной страницы ошибки
	*/
	public static function ImagePreview()
	{

	}

	/*
		Страница добавления/редактирования страницы ошибки
		$id - идентификатор редактируемой страницы ошибки, если $id==0 значит страница ошибки добавляется
		$controls - перечень контролов в соответствии с классом контролов. Если какой-то элемент массива не является массивом, значит это заголовок подгруппы контролов
		$values - результирующий HTML код контролов, который необходимо вывести на странице. Ключи данного массива совпадают с ключами $controls
		$errors - массив ошибок
		$back - URL возврата
		$uploader - интерфейс загрузчика файлов
		$hasdraft - признак того, что у страницы ошибки есть черновик
		$links - перечень необходимых ссылок, массив с ключами:
			delete - ссылка на удаление категории или false
			nodraft - ссылка на правку/добавление категории без использования черновика или false
			draft - ссылка на сохранение черновиков (для фоновых запросов)
	*/
	public static function AddEdit($id,$controls,$values,$errors,$back,$uploader,$hasdraft,$links)
	{

	}

	/*
		Страница удаления ошибки
		$a - массив страницы ошибки, которая удаляется. Ключи:
			title- заголовок страницы ошибки
		$back - URL возврата
	*/
	public static function Delete($a,$back)
	{

	}

	/*
		Страница правки форматов писем
		$controls - перечень контролов в соответствии с классом контролов. Если какой-то элемент массива не является массивом, значит это заголовок подгруппы контролов
		$values - результирующий HTML код контролов, который необходимо вывести на странице. Ключи данного массива совпадают с ключами $controls
		$errors - массив ошибок
	*/
	public static function Letters($controls,$values,$errors)
	{

	}
}