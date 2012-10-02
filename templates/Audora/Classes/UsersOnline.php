<?php
/*
	Copyright � Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym

	������� ��� ����������� ���������� � ������������� ������
*/
class TplUsersOnline
{
		���������� ����� "��� ������"
		$sess - ������ ������� ������=>users|bots|guests=>array(), ���������� ������ - ������ � ������ ������������, �����:
			user_id - ID ������������
			enter - ����� �����
			ip_guest - IP ����� � ����
			ip_user - IP ������������
			service - ������
			botname - ��� ����
			groups - ������ ����� ������������
			name - ��� ���������� (�� ���������� HTML)
			_gpref - HTML ������� ������ ������������
			_gend - HTML ��������� ������ ������������
		$scnt - ���� � sess �������� �� ��� ������ (���������� 30 ����� ������), � ���� ������� � ������� ������=>����� ������ ����� ����������� �����
			������ ��� ������� �������
		$sscnt - ���� � sess �������� �� ��� ������ (���������� 30 ����� ������), � ���� ������� � ������� ������=>(user|bot|guest)=>����� ������ �����
			����������� ����� ������ ��������������� �� �������������, ����� � ������
	*/
	{
		$t=time();
		$c='';
		foreach($sess as $k=>&$v)
		{
			$v+=array('users'=>array(),'guests'=>array(),'bots'=>array());

			foreach($v['users'] as &$vv)
				$vv='<a class="entry" href="'.$vv['_aedit'].'" data-uid="'.$vv['user_id'].'" data-s="'.$k.'" title="'.call_user_func($lang['min_left'],floor(($t-strtotime($vv['enter']))/60)).'">'.$vv['_gpref'].htmlspecialchars($vv['name'],ELENT,CHARSET).$vv['_gend'].'</a>';
			$u=isset($sscnt[$k]['user']) ? $sscnt[$k]['user'] : count($v['users']);

			foreach($v['guests'] as &$vv)
				$vv='<span class="entry" data-gip="'.$vv['ip_guest'].'" data-s="'.$k.'" title="'.call_user_func($lang['min_left'],floor(($t-strtotime($vv['enter']))/60)).'">'.$vv['ip_guest'].'</span>';
			$g=isset($sscnt[$k]['guest']) ? $sscnt[$k]['guest'] : count($v['guests']);

			foreach($v['bots'] as &$vv)
				$vv='<span class="entry" data-gip="'.$vv['ip_guest'].'" data-s="'.$k.'" title="'.call_user_func($lang['min_left'],floor(($t-strtotime($vv['enter']))/60)).'">'.htmlspecialchars($vv['botname'],ELENT,CHARSET).'</span>';
			$b=isset($sscnt[$k]['bot']) ? $sscnt[$k]['bot'] : count($v['bots']);

			$c.='<div><h2>'.$k.' ('.(isset($scnt[$k]) ? $scnt[$k] : $u+$b+$g).')</h2>'
				.($u>0 ? '<div><h4>'.call_user_func($lang['users'],$u).'</h4>'.join(', ',$v['users']).(isset($sscnt[$k]['user']) && $b<$sscnt[$k]['user'] ? ' ...' : '').'</div>' : '')
				.($g>0 ? '<div><h4>'.call_user_func($lang['guests'],$g).'</h4>'.join(', ',$v['guests']).(isset($sscnt[$k]['guest']) && $b<$sscnt[$k]['guest'] ? ' ...' : '').'</div>' : '')
				.($b>0 ? '<div><h4>'.call_user_func($lang['bots'],$b).'</h4>'.join(', ',$v['bots']).(isset($sscnt[$k]['bot']) && $b<$sscnt[$k]['bot'] ? ' ...' : '').'</div>' :'')
				.'</div>';
		}
		return$c;
	}

	/*
		����������� ���� � ��������� ����������� �� ������ ������
		$data - ������ � �������:
			type - ��� ������ user, bot, guest
			enter - ����� �����
			ip_guest - IP �����
			ip_user - IP ������������
			info - ������ � �������
				r - ������ �� ��������, ������ ������ ������������, ���� false
				c - ���������, �������������� ���������� �����������
				e - ������� ������ ������, �������������� ���������� �����������
			service - �������� �������
			browser - USER_AGENT ����������� ����������
			location - �������������� ������������
			botname - ��� ����
			groups - ������ ������������
			name - ��� ������������
			_gpref - HTML ������� ������ ������������
			_gend - HTML ��������� ������ ������������
	*/
	public static function SessionDetail($data)
	{
		$GLOBALS['title'][]=$lang['user_info'];
		$c='';
		$t=time();
		if($data)
		{
			$loc=PROTOCOL.Eleanor::$domain.Eleanor::$site_path.htmlspecialchars($data['location'],ELENT,CHARSET,false);

			if($data['name'])
				$c.='<h1>'.$data['_gpref'].htmlspecialchars($data['name'],ELENT,CHARSET).$data['_gend'].'</h1><hr />';
			$c.='<ul style="list-style-type:none">
<li><b>IP</b> <a href="http://eleanor-cms.ru/whois/'.$ip.'" target="_blank">'.$ip.'</a></li>
<li><b>'.$lang['activity'].'</b> '.call_user_func($lang['min_left'],floor(($t-strtotime($data['enter']))/60)).'</li>
<li><b>'.$lang['now_onp'].'</b> <a href="'.$loc.'" target="_blank" title="'.$lang['go'].'">'.$loc.'</a></li>
<li><b>'.$lang['browser'].'</b> '.htmlspecialchars($data['browser'],ELENT,CHARSET,false).'</li>
<li><b>'.$lang['service'].'</b> '.$data['service'].'</li>';

			foreach($data['info'] as $k=>&$v)
				if($v)
				{
					$v=htmlspecialchars($v,ELENT,CHARSET);
					$c.='<li><b>'.$lang[$k].'</b> ';
					switch($k)
					{
						case'ips':
							$ips='';
							foreach($v as $k_=>&$v_)
								$ips.=$k_.'='.$v_.', ';
							$ips=rtrim($ips,', ');
							$c.=$ips.'</li>';
						break;
						case'r':
							$c.='<a href="'.$v.'" target="_blank" title="'.$lang['go'].'">'.$v.'</a></li>';
						break;
						default:
							$c.=$v.'</li>';
					}
				}

			$c.='</ul>';
		}
		else
			$c.='<div style="text-align:center"><b>'.$lang['session_nf'].'</b></div>';
		return Eleanor::$Template->SimplePage($c);
	}