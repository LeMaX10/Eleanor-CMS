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

class Blocks
{
		$blocks;

	protected static
		$dump;

	{
		{
			$order=$blocks=array();
			while($a=$R->fetch_assoc())
			{
				$order[$a['id']]=(float)self::QuietEval($a['code']);
				$blocks[$a['id']]=$a['blocks'];
			}
			if($order)
			{
				arsort($order,SORT_NUMERIC);
				$p=reset($order);
			}
			else
				$p=0;
			if($p>0)
			{
				$k=key($order);
				self::$blocks=(array)unserialize($blocks[$k]);
			}
			else
			{
				$b=(array)Eleanor::$Cache->Get('blocks_defgr-'.Eleanor::$service,true);
				self::$blocks=isset($b['blocks']) ? (array)$b['blocks'] : array();
			}

			$ids=array();
			foreach(self::$blocks as &$pl)
				foreach($pl as &$id)
					$ids[]=$id;
			if($ids)
			{
				while($a=$R->fetch_assoc())
				{
						continue;

					if((int)$a['showfrom'] and $t<strtotime($a['showfrom']))
						continue;
					if((int)$a['showto'] and $t>=strtotime($a['showto']))
					{
						continue;
					}

					if($a['ctype']=='file')
					{
						if(!$a['file'] or !is_file($f))
							continue;
							$a['text']=file_get_contents($f);
						else
						{
							if($a['config'])
								$vars['CONFIG']=$a['config'] ? (array)unserialize($a['config']) : array();
							if(is_object($a['text']) and $a['text'] instanceof Template)
								$a['text']=(string)$a['text'];
						}
					}
					else
						$a['text']=OwnBB::Parse($a['text']);
					if($a['text'])
						self::$dump[$a['id']]=array(
							't'=>$a['title'],
							'c'=>$a['text'],
							'tpl'=>$a['template'] ? $a['template'] : !$a['notemplate'],
						);
				}
		}
		$s='';
		if(isset(self::$blocks[$place]))
		{
			foreach(self::$blocks[$place] as &$v)
			{
					$b=self::$dump[$v];
				else
					continue;

					$s.=$Tpl($b['tpl']===true ? 'Blocks_'.$place : $b['tpl'],array('title'=>$b['t'],'content'=>$b['c']));
				else
					$s.=$b['c'];
			}
		}
		return$s;
	}

	/*
		�������-������� eval, ����� ��� �� ����� ��� ��������� ����������
	*/
	protected static function QuietEval($c)
	{