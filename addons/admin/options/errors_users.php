<?php
return array(
	'load'=>function($co,$Obj)
	{
		$GLOBALS['head']['autocomplete']='<link rel="stylesheet" type="text/css" href="addons/autocomplete/style.css" />';

		if($co['bypost'])
			$value=$Obj->GetPostVal($co['name'],'');
		else
		{
			if($co['value'])
			{
				$R=Eleanor::$UsersDb->Query('SELECT `name` FROM `'.USERS_TABLE.'` WHERE `id`'.Eleanor::$UsersDb->In($co['value']));
				while($a=$R->fetch_assoc())
					$value.=$a['name'].', ';
				$value=rtrim($value,', ');
		}

		$u=uniqid();
		return Eleanor::Input($co['controlname'],$value,array('id'=>$u)).'<script type="text/javascript">//<![CDATA[
$(function(){
		serviceUrl:CORE.ajax_file,
		minChars:2,
		delimiter:/,\s*/,
		params:{
			direct:"'.Eleanor::$service.'",
			file:"autocomplete",
			goal:"users"
		}
	});
	},
	'save'=>function($co,$Obj)
	{
		if($value=='')
			return'';

		$value=explode(',',$value);
		foreach($value as &$v)
			$v=trim($v);

		$R=Eleanor::$UsersDb->Query('SELECT `id` FROM `'.USERS_TABLE.'` WHERE `name`'.Eleanor::$UsersDb->In($value));
		$value='';
		while($a=$R->fetch_assoc())
			$value.=','.$a['id'].',';
		return$value;
	}
);