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

class Tasks extends BaseClass
{
	public static function UpdateNextRun()
	{
		$R=Eleanor::$Db->Query('SELECT UNIX_TIMESTAMP(`nextrun`) FROM `'.P.'tasks` WHERE `status`=1 AND `locked`=0 ORDER BY `free` ASC, `nextrun` ASC');
		list($next)=$R->fetch_row();

		if(!$next)
			$next=strtotime('+1day');
		Eleanor::$Cache->Put('nextrun',$next,0,true);
	}

	public static function MinFrom($ints,$from)
	{
		foreach($ints as &$v)
			if($v>=$from)
				return$v;
		return false;
	}

	public static function FillInt($str)
	{
		$str=preg_replace('#[^0-9,:\-*]+#','',$str);
		$str=preg_replace_callback('/([0-9]+)\-([0-9]+)(?::([0-9]+))?/',array(__class__,'FillInt2'),$str);
		return $str;
	}

	public static function FillInt2(array$abc)
	{
		$a=(int)$abc[1];
		$b=(int)$abc[2];
		$c=isset($abc[3]) ? (int)$abc[3] : 1;
		if($c<1)
			$c=1;
		if($a>=$b)
			return$a.','.$b;
		$result='';
		for(;$a<$b;$a+=$c)
			$result.=$a.',';
		return$result.$b;
	}

	public static function CalcNextRun(array$t=array(),$do=false)
	{
		$t+=array(
			'year'=>'*',
			'month'=>'*',
			'day'=>'*',
			'hour'=>'*',
			'minute'=>'*',
			'second'=>'*',
		);
		foreach($t as &$v)
		{
			$v=is_string($v) ? explode(',',self::FillInt($v)) : (array)$v;
			sort($v,SORT_NUMERIC);
		}

		if($do===false)
			$do=date_offset_get(date_create());

		#������ ��������
		$addon=array('year'=>0,'month'=>0,'day'=>0,'hour'=>0,'minute'=>0);

		list($y,$m,$d,$h,$i,$s)=explode('-',gmdate('Y-n-j-G-i-s',time()+$do));
		$i=(int)$i;
		if(!in_array('*',$t['second'],true) and false===$s=self::MinFrom($t['second'],$s))
		{
			$s=reset($t['second']);
			$addon['minute']++;
		}

		if(!in_array('*',$t['minute'],true))
		{
			$i+=$addon['minute'];
			if(false===$tmp=self::MinFrom($t['minute'],$i))
			{
				$i=reset($t['minute']);
				$addon['hour']++;
				$addon['minute']=0;
			}
			else
			{
				if($tmp>=$i)
					$addon['minute']=0;
				$i=$tmp;
			}
		}

		if(!in_array('*',$t['hour'],true))
		{
			$h+=$addon['hour'];
			if(false===$tmp=self::MinFrom($t['hour'],$h))
			{
				$h=reset($t['hour']);
				$addon['day']++;
				$addon['hour']=$addon['minute']=0;
			}
			else
			{
				if($tmp>=$h)
					$addon['hour']=0;
				$h=$tmp;
			}
		}

		if(!in_array('*',$t['day'],true))
		{
			$d+=$addon['day'];
			if(false===$tmp=self::MinFrom($t['day'],$d))
			{
				$d=reset($t['day']);
				$addon['month']++;
				$addon['day']=$addon['hour']=$addon['minute']=0;
			}
			else
			{
				if($tmp>=$d)
					$addon['day']=0;
				$d=$tmp;
			}
		}

		if(!in_array('*',$t['month'],true))
		{
			$m+=$addon['month'];
			if(false===$tmp=self::MinFrom($t['month'],$m))
			{
				$m=reset($t['month']);
				$addon['year']++;
				$addon['month']=$addon['day']=$addon['hour']=$addon['minute']=0;
			}
			else
			{
				if($tmp>=$m)
					$addon['month']=0;
				$m=$tmp;
			}
		}

		if(!in_array('*',$t['year'],true))
		{
			$y+=$addon['year'];
			if(false===$tmp=self::MinFrom($t['year'],$y))
				return false;
			if($tmp>=$y)
				$addon['year']=0;
			$y=$tmp;
		}

		$ret=gmmktime($h,$i,$s,$m,$d,$y);

		if(0!=$s=array_sum($addon))
		{
			$s=$s>0 ? '+' : '-';
			foreach($addon as $k=>&$v)
				$s.=$v.$k;
			$ret=strtotime($s,$ret);
		}
		#�������� �� ������� �� ������������
		$ret-=$do;

		return$ret;
	}
}