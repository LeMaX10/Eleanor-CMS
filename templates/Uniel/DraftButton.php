<?php
/*
	������� �������. ������ "��������� ��������".

	@var URL, ���� ���������� ����������� ������
*/
$url=isset($v_0) ? $v_0 : array();
if(is_array($url))
	$url=$GLOBALS['Eleanor']->Url->Construct($url);

$GLOBALS['head']['draft']='<script type="text/javascript">//<![CDATA[
CORE.drafts=[];
$(function(){
		lnk="",
		cnt,
		After=function(){
				window.location.href=lnk;
		};

	$("div.language a").click(function(){//������ ������������ ������
		{
		cnt=CORE.drafts.length;
		lnk=$(this).prop("href");
		$.each(CORE.drafts,function(i,v){
				v.Save();
			else
				cnt--;
		});
		return cnt<=0;

if(!isset(Eleanor::$vars['drafts_autosave']))
	Eleanor::LoadOptions('drafts');
array_push($GLOBALS['jscripts'],'js/eleanor_drafts.js','js/eleanor_drafts-'.Language::$main.'.js');
$u=uniqid();

echo Eleanor::Button(' ','button',array('id'=>$u,'style'=>'color:lightgray;display:none')).'<script type="text/javascript">//<![CDATA[
$(function(){
	var D'.$u.'=new CORE.DRAFT({
		url:"'.$url.'",
		interval:'.Eleanor::$vars['drafts_autosave'].',
		OnSave:function(){
		OnChange:function(){
			$("#'.$u.'").val(CORE.Lang("savedraft")).css("color","");
		}
	});
	CORE.drafts.push(D'.$u.');
	$("#'.$u.'").click(function(){
});//]]></script>';