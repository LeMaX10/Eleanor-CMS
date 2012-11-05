<?php
/*
	Copyright � Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym
*/
if(!defined('CMS'))die;
global$Eleanor;
$event=isset($_POST['event']) ? (string)$_POST['event'] : '';
Eleanor::$Template->queue[]='Blocks';
switch($event)
{	case'settitle':
		$id=isset($_POST['id']) ? (int)$_POST['id'] : 0;
		$title=isset($_POST['title']) ? (string)Eleanor::$POST['title'] : '';
		Eleanor::$Db->Update(P.'blocks_l',array('title'=>$title),'`id`='.$id.' AND `language` IN (\'\',\''.Language::$main.'\')');
		Result(true);
	break;
	case'tryconf':
		$f=isset($_POST['f']) ? (string)$_POST['f'] : '';
		if($f and false!==$p=strrpos($f,'.'))
		{
			$conf=substr_replace($f,'.config',$p,0);
			$conf=Eleanor::FormatPath($conf);
			if(is_file($conf))
			{
				$conf=include$conf;
				if(!is_array($conf))
					$conf=false;
			}
			else
				$conf=false;
		}
		else
			$conf=false;
		if(!$conf)
			return Result(false);
		$Lst=Eleanor::LoadListTemplate('table-form');
		$Eleanor->Controls->arrname=array('config');
		$a=$Eleanor->Controls->DisplayControls($conf);
		$c='';
		foreach($conf as $k=>&$v)
			if(is_array($v))
				$c.=$Lst->item(array($v['title'],Eleanor::$Template->LangEdit($a[$k],null),'tip'=>isset($v['descr']) ? $v['descr'] : '','tr'=>array('class'=>'trfile trconf')));
			else
				$c.=$Lst->head(array($v,'tr'=>array('class'=>'trfile trconf infolabel first')));
		Result($c);
	break;
}