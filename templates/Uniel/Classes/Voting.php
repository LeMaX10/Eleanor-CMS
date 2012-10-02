<?php
/*
	Copyright � Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym

	������� ����������� ������, �������� ���������� �����
*/
class TplVoting
{
		����� ������
		$voting - ������ ���������� ������, �����:
			id - ������������� ������ � ��
			begin - ���� ������ ������, ���� 0000-00-00, ���� ����� ������� � ������� ����������
			end - ���� ��������� ������
			onlyusers - ���� ������ ������ ��� ������������� (�� ������)
			againdays - ���������� ����, �� ��������� ������� ����� ����� ����������
			votes - ����� ���������
		$qs - ������ �������� ������. ������: id=>array(), ����� ����������� �������:
			title - �������� �������
			variants - ������ ��������� ������, ������: id=>����� ��������
			answers - ������ ���������� ������� �� ������ ������� �������, ������: id=>����� �������
			multiple - ���� ����������� �������������� ������ �� ������
			maxans - � ������ ����������� �������������� ������, ���� ���� �������� ������������ ����� ������������ ��������� �������
		$status - ������ ������. �������� ��������� ��������:
			false (bool) - ����� ����������
			voted - ��� �������������
			refused - ����� �� �������
			confirmed - ����� �������
			guest - ���������� ������, ������ ��� ����������� ������ ��� �������������
			wait - ������� ��������
			finished - ����������� ���������
	*/
	{
		{
			if($v['multiple'] and !$status)
				$qid=uniqid();
			else
				$qid=false;

			$sum=$v['multiple'] ? max($v['answers']) : array_sum($v['answers']);
			$div=$sum==0 ? 1 : $sum;
			$r.='<div class="question"><b>'.$v['title'].'</b><ul class="voting"'.($qid ? ' id="'.$qid.'"' : '').'>';
			foreach($v['variants'] as $vk=>&$vv)
			{
				else
					$variant='<label>'.($qid ? Eleanor::Check($k.'[]',false,array('value'=>$vk)) : Eleanor::Radio($k,$vk,false)).' '.$text.'</label>';
				$r.='<li>'.$variant.($percent ? '<div style="width:'.$percent.'%;"><div><div></div></div></div>' : '').'</li>';
			}
			$r.='</ul></div>'
				.($qid ? '<script type="text/javascript">/*<![CDATA[*/new Voting.ChecksLimit("#'.$qid.'",'.$v['maxans'].')//]]></script>' : '');
		}
		switch($status)
		{
			case'guest':
			case'voted':
				$r.='<span style="font-weight:bold;">'.$l[$status].'</span>';
			break;
			case'finished':
				$r.='<span style="font-weight:bold;">'.sprintf($l['finished'],Eleanor::$Language->Date($voting['end'],'fdt')).'</span>';
			break;
			case'wait':
				$r.='<span style="font-weight:bold;">'.sprintf($l['wait'],Eleanor::$Language->Date($voting['begin'],'fdt')).'</span>';
			break;
			case'confirmed':
				$r.='<span style="color:green;font-weight:bold;">'.$l['vc'].'</span>';
			break;
			case'rejected':
				$r.='<span style="color:red;font-weight:bold;">'.$l['vr'].'</span>';
			break;
			default:
				$r.=Eleanor::Button($l['vote']);
		}
		return$r;

	/*
		����� ����� ������, ���������� � ��� �����
		�������� ���������� $votin,$qs,$status �������� � ������ Voting
		$request - �������������� ��������� AJAX �������
	*/
	{
			return$q;
		$u=uniqid('v');

		$GLOBALS['jscripts'][]='js/voting.js';
$(function(){
		form:"#'.$u.'",
		similar:".voting-'.$voting['id'].'",
		type:"'.$status.'",
		request:'.Eleanor::JsVars($request,false,true).',
		qcnt:'.count($qs).'
})//]]></script>';
	}
}