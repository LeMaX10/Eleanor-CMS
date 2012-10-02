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

class Categories extends BaseClass
{
		$lid='cid',#�������� ��������� �� ��������� � ������������ ������
		$imgfolder='images/categories/',
		$dump;#���� �� ���������. ���� ����� ����� ����������� ����������� �� � �����-�� ������������ �������.

	public function Init($t,$hard=false,$nc=false)
	{
			$hard=true;
		$r=$hard ? false : Eleanor::$Cache->Get($t.'_'.Language::$main);
		if($r===false)
		{
			$r=$this->GetDump($R);
				Eleanor::$Cache->Put($t.'_'.Language::$main,$r,86400,false);
		}
		return$this->dump=$r;
	}

	public function GetDump($R)
	{
		$r=$to2sort=$to1sort=$db=array();
		while($a=$R->fetch_assoc())
		{
			{
				$to1sort[$a['id']]=$cnt;
				$maxlen=max($cnt,$maxlen);
			}
			$db[$a['id']]=$a;
			$to2sort[$a['id']]=$a['pos'];
		}
		asort($to1sort,SORT_NUMERIC);

		foreach($to1sort as $k=>&$v)
			if($db[$k]['parents'])
				if(isset($to2sort[$db[$k]['parent']]))
					$to2sort[$k]=$to2sort[$db[$k]['parent']].','.$to2sort[$k];
				else
					unset($to2sort[$db[$k]['parent']]);

		foreach($to2sort as $k=>&$v)
			$v.=str_repeat(',0',$maxlen-substr_count($db[$k]['parents'],','));

		natsort($to2sort);
		foreach($to2sort as $k=>&$v)
		{
			$r[(int)$db[$k]['id']]=$db[$k];
		}

		return$r;
	}

	/*
		������� ���������� ���� ������ ��� ���������
	*/
	public function GetCategory($id,$tr=array())
	{
		if($id)
		{
				return $this->dump[$id];
		}
		else
		{
			$cnt=count($tr)-1;
			$parent=0;
			$curr=array_shift($tr);
			foreach($this->dump as &$v)
				if($v['parent']==$parent and strcasecmp($v['uri'],$curr)==0)
				{
					if($cnt--==0)
						return $v;
					$curr=array_shift($tr);
					$parent=$v['id'];
				}
		}
	}

	/*
		������� ���������� ������ ��������� � ���� option-��, ��� select-a
		<option value="ID" selected="selected">VALUE</option>
		$sel - ������, ������� ����� �������� (������, �� ����� ���� � �����).
		$no - ��� ����������� ��������� (�� ������� � �� ����). ����� ���� ��������, �� ����� ���� � ������.
	*/
	public function GetOptions($sel=array(),$no=array())
	{
		$sel=(array)$sel;
		$no=(array)$no;
		foreach($this->dump as &$v)
		{
			$p[]=$v['id'];
			if(array_intersect($no,$p))
				continue;
			$opts.=Eleanor::Option(($v['parents'] ? str_repeat('&nbsp;',substr_count($v['parents'],',')+1).'�&nbsp;' : '').$v['title'],$v['id'],in_array($v['id'],$sel),array(),2);
		}
		return$opts;

	public function GetUri($id)
	{
			return array();
		$params=array();
		$lastu=$this->dump[$id]['uri'];
		if($this->dump[$id]['parents'] and $lastu)
		{
				if(isset($this->dump[$v]))
					if($this->dump[$v]['uri'])
						$params[]=array($this->dump[$v]['uri']);
					else
					{
						$lastu='';
						break;
		}
		$params[]=array($lastu,$this->lid=>$id);
		return$params;
	}
}