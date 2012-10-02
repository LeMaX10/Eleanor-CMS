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

class UserManager extends BaseClass
{
	{
		if(!isset($user['name']) or $user['name']=='')
			throw new EE('EMPTY_NAME',EE::INFO);
		if(!isset($user['_password']) or $user['_password']=='')
			throw new EE('EMPTY_PASSWORD',EE::INFO);
		self::IsNameBlocked($user['name']);
		if(empty($user['email']))
			throw new EE('EMPTY_EMAIL',EE::INFO);
		if(!Strings::CheckEmail($user['email']))
			throw new EE('EMAIL_ERROR',EE::INFO);
		self::IsEmailBlocked($user['email']);
		if(Eleanor::$vars['max_name_length'] and ($l=mb_strlen($user['name']))>(int)Eleanor::$vars['max_name_length'])
			throw new EE('NAME_TOO_LONG',EE::INFO,array('max'=>(int)Eleanor::$vars['max_name_length'],'you'=>$l));
		if(Eleanor::$vars['min_pass_length'] and ($l=mb_strlen($user['_password']))<(int)Eleanor::$vars['min_pass_length'])
			throw new EE('PASS_TOO_SHORT',EE::INFO,array('min'=>(int)Eleanor::$vars['min_pass_length'],'you'=>$l));
		$escpn=Eleanor::$Db->Escape($user['name']);
		$R=Eleanor::$UsersDb->Query('SELECT `name` FROM `'.USERS_TABLE.'` WHERE `name`='.$escpn.' LIMIT 1');
		if($R->num_rows>0)
			throw new EE('NAME_EXISTS',EE::INFO);
		$R2=Eleanor::$Db->Query('SELECT `email` FROM `'.P.'users_site` WHERE `email`='.$escpn.' LIMIT 1');
		if($R2->num_rows>0)
			throw new EE('EMAIL_EXISTS',EE::INFO);

		$un=addcslashes($user['name'],"\n\r\t");
		$todb=array(
			'name'=>$un,
			'full_name'=>isset($user['full_name']) ? addcslashes($user['full_name'],"\n\r\t") : htmlspecialchars($un,ELENT,CHARSET),
			'pass_salt'=>$ps=substr(uniqid(),-5),
			'pass_hash'=>self::PassHash($ps,$user['_password']),
			'register'=>isset($user['register']) ? $user['register'] : date('Y-m-d H:i:s'),
		);

		foreach(array('last_visit','ban_date','ban_explain','language','staticip','timezone') as $v)
			if(array_key_exists($v,$user))
				$todb[$v]=$user[$v];

		$tosite=array(
			'name'=>$todb['name'],
			'full_name'=>$todb['full_name'],
			'register'=>$todb['register'],
		);
		foreach(array('last_visit','forum_id','groups_overload','login_keys','failed_logins','ip','language','email','timezone') as $v)
			if(array_key_exists($v,$user))
				$tosite[$v]=$user[$v];

		$tosite['groups']=isset($user['groups']) ? static::DoGroups($user['groups']) : ','.GROUP_USER.',';
		if(strpos($tosite['groups'],','.GROUP_WAIT.',')!==false)
			$todb['temp']=1;

		$id=Eleanor::$UsersDb->Insert(USERS_TABLE,$todb);
		$tosite['id']=$toextra['id']=$id;
		foreach($user as $k=>&$v)
			if(!array_key_exists($k,$tosite) and !array_key_exists($k,$todb) and $k[0]!='_')
				$toextra[$k]=$v;
		if(isset($toextra['avatar_location']) and !$toextra['avatar_location'])
			$toextra['avatar_type']='';
		Eleanor::$Db->Insert(P.'users_site',$tosite);
		Eleanor::$Db->Insert(P.'users_extra',$toextra);

		if(!isset($user['_ni']))
			$fid=Integration::Add($todb+$tosite+$toextra,$user);
		if($fid)
			Eleanor::$Db->Update(P.'users_site',array('forum_id'=>$fid),'`id`='.$id.' LIMIT 1');

		return$id;
	}

	public static function Update(array$user,$ids=false)
	{
		{
			$single=(!is_array($ids) or count($ids)==1);
			if(!$single)
			{
					unset($user['email']);
				unset($user['name']);
			}
		}
		else
		{
			$ids=Eleanor::$Login->GetUserValue('id');
			$single=true;
		}
		if(!$ids or !$user)
			return;

		$in=Eleanor::$UsersDb->In($ids);
		$nin=Eleanor::$Db->In($ids,true);

		$toextra=$tosite=$todb=array();
		foreach(array('last_visit','full_name','ban_date','ban_explain','language','staticip','timezone') as $v)
			if(array_key_exists($v,$user))
				$todb[$v]=$user[$v];

		foreach(array('forum_id','full_name','email','groups_overload','login_keys','failed_logins','ip','last_visit','language','timezone') as $v)
			if(array_key_exists($v,$user))
				$tosite[$v]=$user[$v];

		if(isset($user['groups']))
		{
			$todb['temp']=strpos($tosite['groups'],','.GROUP_WAIT.',')!==false;
		}

		if($single)
		{
			if(isset($user['email']))
				if(Strings::CheckEmail($user['email'],false))
				{
					if($R->num_rows>0)
						throw new EE('EMAIL_EXISTS',EE::INFO);
				}
				else
					throw new EE('EMAIL_ERROR',EE::INFO);
			if(isset($user['name']))
			{
					throw new EE('EMPTY_NAME',EE::INFO);
				self::IsNameBlocked($user['name']);
				$R=Eleanor::$UsersDb->Query('SELECT `name` FROM `'.USERS_TABLE.'` WHERE `name`='.Eleanor::$Db->Escape($user['name']).' AND `id`'.$nin.' LIMIT 1');
				if($R->num_rows>0)
					throw new EE('NAME_EXISTS',EE::INFO);
				$tosite['name']=$todb['name']=str_replace(array("\n","\r","\t"),'',$user['name']);
				if(!isset($todb['full_name']))
				{
					Eleanor::$UsersDb->Query('SELECT `full_name`,`name` FROM `'.USERS_TABLE.'` WHERE `id`'.$in.' LIMIT 1');
					if($temp=Eleanor::$UsersDb->fetch_assoc() and $temp['full_name']==htmlspecialchars($temp['name'],ELENT,CHARSET))
						$tosite['full_name']=$todb['full_name']=htmlspecialchars($user['name'],ELENT,CHARSET);
				}
			}
		}

		if(isset($user['_password']))
		{
				throw new EE('EMPTY_PASSWORD',EE::INFO);
			Eleanor::LoadOptions('user-profile',false);
			if(Eleanor::$vars['min_pass_length'] and ($l=mb_strlen($user['_password']))<(int)Eleanor::$vars['min_pass_length'])
				throw new EE('PASS_TOO_SHORT',EE::INFO,array('min'=>(int)Eleanor::$vars['min_pass_length'],'you'=>$l));
			$todb['pass_salt']=substr(uniqid(),-5);
			$todb['pass_hash']=self::PassHash($todb['pass_salt'],$user['_password']);
		}

		foreach($user as $k=>&$v)
			if(!array_key_exists($k,$tosite) and !array_key_exists($k,$todb) and $k[0]!='_' and !in_array($k,array('id','pass_salt','pass_hash','register')))
				$toextra[$k]=$v;
		if(isset($toextra['avatar_location']) and !$toextra['avatar_location'])
			$toextra['avatar_type']='';
		if($todb)
			Eleanor::$UsersDb->Update(USERS_TABLE,$todb+array('!updated'=>'NOW()'),'`id`'.$in);
		if($tosite)
			Eleanor::$Db->Update(P.'users_site',$tosite,'`id`'.$in);
		if($toextra)
			Eleanor::$Db->Update(P.'users_extra',$toextra,'`id`'.$in);

		if(!isset($user['_ni']))
			Integration::Update($todb+$tosite+$toextra,$user,$ids);
	}

	public static function Delete($ids,array$data=array())
	{
			unset($ids[$k]);
		if(!$ids)
			return;

		$aroot=Eleanor::$root.Eleanor::$uploads.'/avatars/';
		$R=Eleanor::$Db->Query('SELECT `avatar_location` FROM `'.P.'users_extra` WHERE `id`'.Eleanor::$Db->In($ids).' AND `avatar_type`=\'upload\'');
		while($a=$R->fetch_assoc())
			if(is_file($a=$aroot.$a['avatar_location']))
				Files::Delete($a);

		$in=Eleanor::$Db->In($ids);
		#����������� �������� ��� ����������������.
		Eleanor::LoadOptions('comments',false);
		Eleanor::$Db->Update(P.'comments',array('author_id'=>0),'`author_id`'.$in);

		#������� ��������� �������� �������������
		Eleanor::$Db->Delete(P.'timecheck','`author_id`'.$in);#InnoDB ������ �������������
		#������� external_auth
		Eleanor::$Db->Delete(P.'users_external_auth','`id`'.$in);#InnoDB ������ �������������
		#���� ��������� ���� ��������!

		#������� �������������
		$q=Eleanor::$Db->Delete(P.'users_site','`id`'.$in);

		#������� ������
		Eleanor::$Db->Delete(P.'users_extra','`id`'.$in);#InnoDB ������ �������������

		$del=array();
		$R=Eleanor::$UsersDb->Query('SELECT `id` FROM `'.USERS_TABLE.'` WHERE `id`'.$in);
		while($a=$R->fetch_assoc())
			$del[]=$a['id'];
		Eleanor::$UsersDb->Delete(USERS_TABLE,'`id`'.$in);
		if($del)
		{
			$R2=Eleanor::$UsersDb->Query('SELECT `id` FROM `'.USERS_TABLE.'_deleted` WHERE `id`>'.(int)$lastid.' ORDER BY `id` ASC LIMIT 1');
			$upd=$R2->num_rows==0;
			$lastid=Eleanor::$UsersDb->Insert(USERS_TABLE.'_deleted',array('uid'=>$del));
			if($upd)
			{
				Eleanor::$Cache->Put('deleted-users',$lastid,true);
		}
		if(!isset($data['_ni']))
			Integration::Delete($ids);
		return$q;
	}

	/*
		������� ��������� ������������� ���� ������� ������������� � ����� ���������� �������������.
		$ids - ������ ID �������������, ������� ����� ����������������. �������� ��� ��, ���������� ������� � ����
			ID => array( field1, ... ), ��� ID - ID ������������, �  field1, ... - ����, ������ �� ���������� ������� ��� �������
		$addon - ����������� �������������� ����� ��.
	*/
	public static function Sync($ids,array$addon=array())
	{
		$tosite=$toextra=$sync=$update=array();
		foreach($ids as $k=>&$v)
			if(is_array($v))
				$sync[$k]=$v;
			else
				$sync[$v]=array();
		$in=array_keys($sync);
		$R=Eleanor::$Db->Query('SELECT `id`,`'.join('`,`',$fields).'` FROM `'.P.'users_site` WHERE `id`'.Eleanor::$Db->In($in));
		while($a=$R->fetch_assoc())
		{
			if($sync[$a['id']]==array_slice($a,1))
				unset($sync[$a['id']]);
		}
		if(!$sync)
			return;

		$R=Eleanor::$UsersDb->Query('SELECT `id`,`'.join('`,`',$fields).'` FROM `'.USERS_TABLE.'` WHERE `id`'.Eleanor::$UsersDb->In($in));
		while($a=$R->fetch_assoc())
			$sync[$a['id']]+=array_slice($a,1);

		foreach($sync as $k=>$v)
		{
				$v['groups']=static::DoGroups($v['groups']);
			elseif(isset($addon[$k]['groups']))
				$v['groups']=static::DoGroups($addon[$k]['groups']);
			elseif(isset($addon['groups']))
				$v['groups']=static::DoGroups($addon['groups']);

			foreach(array('last_visit','forum_id','groups_overload','login_keys','failed_logins','ip','email') as $f)
				if(isset($addon[$k]) and array_key_exists($f,$addon[$k]))
					$v[$k]=$addon[$k][$f];
				elseif(array_key_exists($f,$addon))
					$v[$k]=$addon[$f];

			if(in_array($k,$update))
			{
				Eleanor::$Db->Update('users_site',$v,'`id`='.$k.' LIMIT 1');
				continue;
			}
			$ts+=$v+array('groups'=>','.GROUP_USER.',');

			if(isset($addon[$k]))
				foreach($addon[$k] as $ak=>&$av)
					if(!array_key_exists($ak,$ts))
						$te[$ak]=$av;

			foreach($addon as $ak=>&$av)
				if(!array_key_exists($ak,$sync) and !array_key_exists($ak,$ts) and !array_key_exists($ak,$te))
					$te[$ak]=$av;

			$tosite[]=$ts;
			$toextra[]=$te;
		}
		Eleanor::$Db->Insert(P.'users_site',$tosite);
		Eleanor::$Db->Insert(P.'users_extra',$toextra);
	}

	public static function MatchPass($pass,$id=false)
	{
			$id=Eleanor::$Login->GetUserValue('id');
		$a=$R->fetch_assoc();
			return false;
		return$a['pass_hash']==self::PassHash($a['pass_salt'],$pass);
	}

	public static function IsNameBlocked($name)
	{
		if(!Eleanor::$vars['blocked_names'])
			return;
		foreach(explode(',',Eleanor::$vars['blocked_names']) as $v)
			if(self::MatchMask($v,$name))
				throw new EE('NAME_BLOCKED',EE::INFO);
	}

	public static function IsEmailBlocked($email)
	{
		if(!Eleanor::$vars['blocked_emails'])
			return;
		foreach(explode(',',Eleanor::$vars['blocked_emails']) as $v)
			if(self::MatchMask($v,$email))
				throw new EE('EMAIL_BLOCKED',EE::INFO);
	}

	/*
		������� ���������, ������������� �� ������ �����.
		����� ��������� ���:
		? - ���� ����� ������
		* - ����� ����������������� ��������
		=====
		� ���� � ������� fnmatch, �� "�� ������ ������ ��� ������� ���������� � Windows � ������ POSIX-������������� ��������."
	*/
	public static function MatchMask($mask,$string)
	{
		$mask=preg_quote(trim($mask),'#');
		if(!$mask)
			return false;
		$mask=str_replace(array('\?','\*'),array('.?','.*?'),$mask);
		return preg_match('#'.$mask.'#i',$string)>0;
	}

	public static function PassHash($salt,$pass,$md=false)
	{
		return md5(md5($salt).($md ? $pass : md5($pass)));
	}

	public static function GroupsOpts($sel=array(),$no=array())
	{
		$r=Eleanor::$Cache->Get('groups_'.Language::$main);
		if($r===false)
		{
			$maxlen=0;
			$r=$to2sort=$to1sort=$titles=$db=array();
			$R=Eleanor::$Db->Query('SELECT `id`,`title_l`,`parents` FROM `'.P.'groups`');
			while($a=$R->fetch_assoc())
			{
				if($a['parents'])
				{
					$cnt=substr_count($a['parents'],',');
					$to1sort[$a['id']]=$cnt;
					$maxlen=max($cnt,$maxlen);
				}
				$a['title_l']=$a['title_l'] ? Eleanor::FilterLangValues((array)unserialize($a['title_l'])) : '';
				$db[$a['id']]=$a;
				$to2sort[$a['id']]=$a['parents'];
				$titles[$a['id']]=$a['title_l'];
			}
			asort($to1sort,SORT_NUMERIC);
			asort($titles,SORT_STRING);

			$n=array();
			foreach($titles as $k=>&$v)
			{
					$n[$to2sort[$k]]=1;
				$to2sort[$k]=$n[$to2sort[$k]]++;
			unset($titles,$n);
			foreach($to1sort as $k=>&$v)
				if($db[$k]['parents'])
				{
					if(isset($to2sort[$p]))
						$to2sort[$k]=$to2sort[$p].','.$to2sort[$k];
					else
						unset($to1sort[$k],$db[$k],$to2sort[$k]);
				}

			foreach($to2sort as $k=>&$v)
				$v.=str_repeat(',0',$maxlen-substr_count($db[$k]['parents'],','));

			natsort($to2sort);
			foreach($to2sort as $k=>&$v)
			{
				$r[(int)$db[$k]['id']]=$db[$k];
			}

			Eleanor::$Cache->Put('groups_'.Language::$main,$r,86400);
		}

		$opts='';
		$sel=(array)$sel;
		$no=(array)$no;
		foreach($r as &$v)
		{
			$p[]=$v['id'];
			if(array_intersect($no,$p))
				continue;
			$opts.=Eleanor::Option(($v['parents'] ? str_repeat('&nbsp;',count($v['parents'])).'�&nbsp;' : '').$v['title_l'],$v['id'],in_array($v['id'],$sel),array(),2);
		}
		return$opts;
	}

	private static function DoGroups($g)
	{
			return','.GROUP_USER.',';
		if(is_array($g))
		{
			$mg=reset($g);
			sort($g,SORT_NUMERIC);
			if($mg!=$g[0])
				array_unshift($g,$mg);
			return','.join(',,',$g).',';
		}
		return','.(int)$g.',';
	}