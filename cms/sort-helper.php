<?php
/**
	Eleanor CMS © 2014
	http://eleanor-cms.ru
	info@eleanor-cms.ru
*/
namespace CMS;
defined('CMS\STARTED')||die;

/** Получение количества пунктов на странице
 * @param $query
 * @return int */
function PerPage(&$query)
{
	$cpp=(int)GetCookie('per-page');
	$pp=isset($_GET['per-page']) ? (int)$_GET['per-page'] : 0;

	if($pp>5 and $pp<500)
	{
		if($cpp!==$pp)
			SetCookie('per-page',$pp);
	}
	elseif($cpp>5 and $cpp<500)
		$pp=$cpp;
	else
		$pp=50;

	if($pp!=50)
		$query['per-page']=$pp;

	return$pp;
}

/** Получение вида сортировки, порядка сортировки, лимита для запроса и отступа для большинства ПРЯМЫХ списков
 * @param int $total Количество пунктов в списке
 * @param int $page Номер страницы (может быть скорректирован)
 * @param array $query GET запрос
 * @param array $sorting все возможные виды сортировок
 * @param string $defsort Вид сортировки по умолчанию
 * @param string $deforder Порядок сортировки по умолчанию (asc,desc)
 * @param int|null $pp Пунктов на страницу
 * @return array [$sort,$order,$limit,$offset,$pp] */
function SortOrderLimit($total,&$page,array&$query,array$sorting,$defsort,$deforder='desc',$pp=null)
{
	if(!is_int($pp))
		$pp=PerPage($query);

	if($page<=0)
		$page=1;

	if($total>0)
	{
		if($page>ceil($total/$pp))
			$page=max(1,floor($total/$pp));

		$offset=($page-1)*$pp;
	}
	else
		$offset=0;

	if(isset($_GET['sort']))
	{
		$sort=(string)$_GET['sort'];

		if(!in_array($sort,$sorting))
			$sort=$defsort;
	}
	else
		$sort=$defsort;

	$order=isset($_GET['order']) ? (string)$_GET['order'] : $deforder;

	if($order!='asc')
		$order='desc';

	$query['sort']=$sort==$defsort ? null : $sort;
	$query['order']=$order==$deforder ? null : $order;

	return[$sort,$order,' LIMIT '.($offset==0 ? '' : $offset.',').$pp,$pp,$offset];
}

/** Получение вида сортировки, порядка сортировки, лимита для запроса и отступа для большинства ОБРАТНЫХ списков
 * @param int $total Количество пунктов в списке
 * @param int $page Номер страницы (может быть скорректирован)
 * @param array $query GET запрос
 * @param array $sorting все возможные виды сортировок
 * @param string $defsort Вид сортировки по умолчанию
 * @param string $deforder Порядок сортировки по умолчанию (asc,desc)
 * @param int|null $pp Пунктов на страницу
 * @return array [$sort,$order,$limit,$offset,$pp] */
function RSortOrderLimit($total,&$page,array&$query,array$sorting,$defsort,$deforder='desc',$pp=null)
{
	if(!is_int($pp))
		$pp=PerPage($query);

	$np=$total % $pp;
	$pages=max(ceil($total/$pp)-($np>0 ? 1 : 0),1);
	$intpage=$pages - ($page===null ? $pages : $page) + 1;

	$result=SortOrderLimit($total,$intpage,$query,$sorting,$defsort,$deforder,$pp);
	$page=$pages - $intpage + 1;

	return$result;
}

/** Генерация ссылки на сортировку по динамическому URL
 * @param string $sort Нужный вид сортировки
 * @param array $query Строка запроса
 * @param string $defsort Вид сортировки по умолчанию
 * @param string $deforder Порядок сортировки по умолчанию (asc,desc)
 * @return string */
function SortDynUrl($sort,$query,$defsort,$deforder='asc')
{
	#Инверсия
	$deforder=$deforder=='asc' ? 'desc' : 'asc';

	/** @var DynUrl $Url */
	$Url=$GLOBALS['Eleanor']->DynUrl;
	$so=[
		'sort'=>$defsort===$sort ? null : $sort,
		'order'=>$query['order']===$deforder ? null : $deforder,
	];

	return$Url(array_merge($query,$so));
}

/** Генерация ссылки на сортировку по статическому URL
 * @param string $sort Нужный вид сортировки
 * @param string|null $order Нужный порядок сортировки
 * @param array|string $query Запрос, либо префикс будущей ссылки
 * @param string $defsort Вид сортировки по умолчанию
 * @param string $deforder Порядок сортировки по умолчанию (asc,desc)
 * @return string */
function SortUrl($sort,$order,$query,$defsort,$deforder='desc')
{
	#Инверсия
	if(!$order)
	{
		$order=$query['order'];
		$order=$order=='asc' ? 'desc' : 'asc';
	}

	$so=[
		'sort'=>$defsort===$sort ? null : $sort,
		'order'=>$order===$deforder ? null : $order,
	];

	if(is_string($query))
	{
		$so=Url::Query($so);
		return$query.($so ? '?'.$so : '');
	}

	/** @var Url $Url */
	$Url=$GLOBALS['Eleanor']->Url;
	return$Url($query,'',$so);
}