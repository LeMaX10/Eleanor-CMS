/*
	Copyright © Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym
*/

$(function(){
	$("input[name=multiservice]").change(function(){
		{
			$("tr .multitrue").show();
			$("tr .multifalse").hide();
		}
		else
		{
			$("tr .multifalse").show();
			$("tr .multitrue").hide();
		}

	$("select[name=\"services[]\"]").change(function(){
		{
			$("select[name=\"services[]\"] option").prop("selected",true);
			$("#files li").show().find("input[type=\"text\"][name^=\"files[\"]").prop("disabled",false);
		}
		else
			$("select[name=\"services[]\"] option").each(function(){
				var inp=$("input[type=\"text\"][name=\"files["+this.value+"]\"]");
				if($(this).prop("selected"))
					inp.prop("disabled",false).closest("li").show();
				else
					inp.prop("disabled",true).closest("li").hide();
			});

	$("#addsession").click(function(){
		if(!n)
			return false;

		if($("#sections input[name^=\"sections["+n+"]\"]").size()>0)
		{
			return false;

		var newo=$("#sections li:first").clone(false),
			spn=newo.find(".name");
			old=spn.html();
		spn.html(n);

		$("input[name^=\"sections["+old+"]\"]",newo).attr("name",function(){
			return this.name.replace("sections["+old+"]","sections["+n+"]");
		});

		$(".langtabcont",newo).prop("id",function(){
			return this.id.replace(old+"-",n+"-");
		});

		$(".langtabs",newo).prop("id",function(){
			return this.id.replace("-"+old,"-"+n);
		});

		$("a",newo).each(function(){
			$(this).data("rel",($(this).data("rel")||"").replace(old+"-",n+"-"));
		});

		newo.find("input").val("").end().appendTo("#sections");
		try
		{
			$("#langs-"+n+" a").Tabs();
		}
		catch(e){}
		$("#sections .delete").show();
		AppyDragAndDrop();
		return false;

	if($("#sections li").size()==1)
		$("#sections .delete").hide();

	$("#sections").on("click",".delete",function(){
			return false;
		$(this).closest("li").remove();
		if($("#sections li").size()==1)
			$("#sections .delete").hide();
		AppyDragAndDrop();
		return false;
	.on("click",".name",function(){
			n=prompt(CORE.Lang("modules_nn"),old);
		if(!n || n==old)
			return false;

		$(this).html(n);
		$("input[name^=\"sections["+old+"]\"]").prop("name",function(){
			return this.name.replace("sections["+old+"]","sections["+n+"]");
		})
	});

	$("input[name=path]").autocomplete({
		serviceUrl:CORE.ajax_file,
		minChars:2,
		delimiter: null,
		params:{
			direct:"admin",
			file:"autocomplete",
			filter:"onlydir"
		}
	});

	$("#image").change(function(){
		if(this.value && this.value.match(/\.(png|jpe?g|gif)$/))
			$("#preview").attr("src","images/modules/"+this.value.replace("*","small")).show();
		else
			$("#preview").hide();
	}).change().autocomplete({
		serviceUrl:CORE.ajax_file,
		minChars:2,
		delimiter: null,
		params:{
			direct:"admin",
			file:"autocomplete",
			path:"images/modules/",
			filter:"module-image"
		}
	});
});