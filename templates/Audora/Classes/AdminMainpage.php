<?php
/*
	Copyright � Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym

	���������� ��� ������� ���������� ������ "������� ��������".
*/
class TPLAdminMainpage
{
		���� ������
	*/
	{
		$links=&$GLOBALS['Eleanor']->module['links'];

		$GLOBALS['Eleanor']->module['navigation']=array(
			array($links['list'],$lang['list'],'act'=>$act=='list',
				'submenu'=>array(
					$links['add'] ? array($links['add'],$lang['add'],'act'=>$act=='add') : false,
				),
			),
		);

		�������� �������, �������� �������� ������� ������

		$items - ������, ���������� � ���� �������� �������. ������: ID=>array() ����� ����������� �������:
			services - ������, ������ ������� �������� - ��� �������, � ������� �������� ������
			title - ������, �������� ������
			descr - ������, �������� ������
			protected - ���� ����������� ������
			path - ������� ������
			image - ���� � �������� ������. ���� � ����� �������� ����������� *, ������ �� ����� �������� �� "small"
			active - ���� ��������� (����������� ������)
			user_groups - �������������� ����� �������������, ������� �������� ������ ������
			pos - �������� ������������� ������� ������. ���� ������ $items ������������ ������ �� ����� ���� �� �������� (1) � ��������
			_aedit - ������ �� �������������� ������
			_adel - ������ �� �������� ������
			_aup - ������ �� �������� ������ �����, ���� ����� false - ������ ������ ��� � ��� ��������� � ����� �����
			_adown - ������ �� ��������� ������ ����, ���� ����� false - ������ ������ ��� � ��� ��������� � ����� ����
	*/
	public static function ShowList($items)
	{
		$ltpl=Eleanor::$Language['tpl'];
		$cnt=count($items);
		$lang=Eleanor::$Language['mp'];
		$Lst=Eleanor::LoadListTemplate('table-list',5)
			->begin(
				array($ltpl['title'],'colspan'=>2),
				$lang['services'],
				array($lang['pos'],80),
				array($ltpl['functs'],80)
			);
		if($items)
		{
			$di='images/modules/default-small.png';
			$modpref=$GLOBALS['Eleanor']->Url->file.'?section=management&amp;module=modules&amp;';
			$grspref=$GLOBALS['Eleanor']->Url->file.'?section=management&amp;module=groups&amp;';
			$serpref=$GLOBALS['Eleanor']->Url->file.'?section=management&amp;module=services&amp;';
			foreach($items as $k=>&$v)
			{
				$img=$di;
				if($v['image'])
				{
					$v['image']='images/modules/'.str_replace('*','small',$v['image']);
					if(is_file(Eleanor::$root.$v['image']))
						$img=$v['image'];
				}
				$grs=$services='';
				if($v['services'])
				{
					$v['services']=array_intersect($v['services'],array_keys(Eleanor::$services));
					foreach($v['services'] as &$sv)
						$services.='<a href="'.$serpref.'edit='.$sv.'">'.$sv.'</a>, ';
					$services=trim($services,', ');
				}

				$Lst->item(
					array('<img src="'.$img.'" alt="" title="'.$v['title'].'" id="it'.$k.'" />','style'=>'width:1px','href'=>$modpref.'edit='.$k),
					array($v['title'],'title'=>$v['descr'],'style'=>$v['protected'] ? 'font-weight:bold;' : '','href'=>$v['_aedit']),
					array($services ? $services : $ltpl['all'],'style'=>$services ? '' : 'font-style:italic;text-align:center'),
					$Lst('func',
						$v['_aup'] ? array($v['_aup'],$lang['up'],$images.'up.png') : false,
						$v['_adown'] ? array($v['_adown'],$lang['down'],$images.'down.png') : false
					),
					$Lst('func',
						$v['protected'] ? false : '<img src="'.$images.($v['active'] ? 'active.png' : 'inactive.png').'" alt="" title="'.($v['active'] ? $ltpl['active'] : $ltpl['inactive']).'" />',
						#$v['protected'] ? false : array($modpref.'swap='.$k,$v['active'] ? $ltpl['deactivate'] : $ltpl['activate'],$v['active'] ? $images.'active.png' : $images.'inactive.png'),
						array($v['_aedit'],$ltpl['edit'],$images.'edit.png'),
						array($v['_adel'],$ltpl['delete'],$images.'delete.png','addon'=>array('onclick'=>'return confirm(\''.$ltpl['are_you_sure'].'\')'))
					)
				);
			}
		}
		else
			$Lst->empty($lang['no']);
		return Eleanor::$Template->Cover((string)$Lst->end());
	}

	/*
		�������� ����������/�������������� ������, ������������ �� ������� ��������

		$id - �������� ������������� ������, ������� �� ������. ���� $id==0, ������ ������ �����������.
		$values - ������ ��������. �����:
			id - ������������� ���������� ������
			pos - �������� ������������� ����������� �������� ������
		$modules - �������� ��������� �������. ������: ID=>�������� ������
		$error - ����� ������, ���� ����� - ������ ���
		$back - URL ��� ��������
		$bypost - ���� �������� ����������� �� POST �������
	*/
	public static function AddEdit($id,$values,$modules,$error,$back)
	{
		$mops='';
		foreach($modules as $k=>&$v)
			$mops.=Eleanor::Option($v,$k,$k==$values['id']);

		if($back)
			$back=Eleanor::Control('back','hidden',$back);
		$lang=Eleanor::$Language['mp'];
		$Lst=Eleanor::LoadListTemplate('table-form')
			->form()
			->begin()
			->item($lang['module'],Eleanor::Select('id',$mops,array('tabindex'=>1)))
			->item(array($lang['pos'],'tip'=>$lang['pos_'],Eleanor::Control('pos','number',$values['pos'],array('tabindex'=>2,'min'=>1))))
			->button($back.Eleanor::Button('OK','submit',array('tabindex'=>10)).($id ? ' '.Eleanor::Button($ltpl['delete'],'button',array('tabindex'=>3,'onclick'=>'if(confirm(\''.$ltpl['are_you_sure'].'\'))window.location=\''.$GLOBALS['Eleanor']->Url->Construct(array('delete'=>$id,'noback'=>1)).'\'')) : ''))
			->end()
			->endform();
		return Eleanor::$Template->Cover((string)$Lst,$error);
	}
}