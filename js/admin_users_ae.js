/*
	Copyright © Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym
*/
function AddEditUser(id)
{
	$("#full-name").focus(function(){
			$(this).val($("#name").val())
	});

	//Пароли не совпадают
	$("#form").submit(function(){
			p2=$("#pass2").val();
		if(p1 && p1!=p2)
		{
			$("a:first",this).trigger("Switch");//Tabs
			$("#pass2").focus();
			return false;
		}

	//Перезагрузка параметров группы
	$("select[name^=\"_overskip\"]").change(function(){
			o=oi.find(".overload"),
			i=oi.find(".inherit");
		{
			i.show();
		}
		else
		{
			o.show();
		}
	});

	//External login
	$(".exl").next("a").click(function(){
			{
				direct:"admin",
				file:"users",
				event:"remove",
				provider:$(this).data("provider"),
				pid:$(this).data("providerid")
			},
			function()
			{
				var td=th.closest("td");
				th.closest("span").remove();
				if(td.is(":empty"))
					td.closest("tr").remove();
			}
		);
		return false;

	if(id)
	{
		var slntr=$("#slname").closest("tr").hide();
		$("#name").change(function(){
				slntr.hide();
			else
				slntr.show();

		var slptr=$("#slpass").closest("tr").hide();
		$("#pass,#pass2").change(function(){
				slptr.show();
			else
				slptr.hide();
	}
	//Avatar
	var ai=$("#avatar-input").val();
	if(ai)
	{
		$("#avatar-image").attr("src",ai);
		$("#avatar-delete").show();
		$("#avatar-no").hide();
	}
	else
		$("#avatar-image,#avatar-delete").hide();

	$("#atype").change(function(){
		if($(this).val()=="upload")
		{
			$("#avatar-view").hide();
			$("#avatar-upload").show();
		}
		else
		{
			$("#avatar-upload").hide();
			$("#avatar-view").show();
		}
	}).change();

	var g=false;
	$("#form").on("click",".getgalleries",function(){
		if(g)
		{
			$("#avatar-view").hide();
			$("#avatar-select").html(g).show();
		}
		else
			CORE.Ajax(
				{
					direct:"admin",
					file:"users",
					event:"galleries"
				},
				function(r)
				{
					$("#avatar-view").hide();
					$("#avatar-select").html(r).show();
					g=r;
				}
			);
		return false;
	});

	var galleries=[];
	$("#form")
	.on("click",".cancelavatar",function(){
		$("#avatar-view").show();
		return false;
	.on("click",".gallery",function(){
			$("#avatar-select").html(galleries[v]);
		else
			CORE.Ajax(
				{
					direct:"admin",
					file:"users",
					event:"avatars",
					gallery:v
				},
				function(r)
				{
					$("#avatar-select").html(r);
					galleries[v]=r;
				}
			);
		return false;
	.on("click",".applyavatar",function(){
		$("#avatar-image").attr("src",f).add("#avatar-delete,#avatar-view").show();
		$("#avatar-no,#avatar-select").hide();
		return false;

	$("#avatar-delete").click(function(){
		$("#avatar-input").val("");
		$("#avatar-image,#avatar-delete").hide();
		$("#avatar-no").show();
		return false;
	});
}