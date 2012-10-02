/*
	Copyright © Eleanor CMS
	URL: http://eleanor-cms.ru, http://eleanor-cms.com
	E-mail: support@eleanor-cms.ru
	Developing: Alexander Sunvas*
	Interface: Rumin Sergey
	=====
	*Pseudonym
*/

function VotingManager(id)
{
		qn=0,
		Question=function()
		{
				variants=th.find("table.variants"),
				max=0,
				maxans=th.find("[name$=\"[maxans]\"]"),
				rname=maxans.prop("name").replace(/\[maxans\]$/,""),//Для замены имени в динамически добавляемых вопросах
				AppDaD=function()
				{
					variants.each(function(){
						$(this).DragAndDrop({
						items:"tr:has(td)",
						move:".updown",
						replace:"<tr style=\"height:35px\"><td colspan=\"4\">&nbsp;</td></tr>"
						});
					});
				},
				ResetVariants=function(){
						th=$(this);
					beg=beg.sort();
					if(beg.length>2)
						th.find("input[type=text]:not(.variant"+beg[0]+",.variant"+beg[1]+")").closest("tr").remove();

					th.data("max",1).find(".variant"+beg[0]).val("").prop("class",function(ind,old){
						return old.replace("variant"+beg[1],"variant1");
					}).end().find(".number"+beg[0]).val(0).prop("class",function(ind,old){
						return old.replace("number"+beg[0],"number0");
					}).end().find(".number"+beg[1]).val(0).prop("class",function(ind,old){
						return old.replace("number"+beg[1],"number1");
					}).end();

				};

			if(th.data("qn")>qn)
				qn=th.data("qn");

			variants.on("click",".sb-plus",function(){
				max++;
				variants.find("."+$(this).closest("tr").find("input[type=text]").prop("class").split(/ /)[0])//Классов может быть несколько
					.closest("tr").each(function(){
					$(this).clone(false)
						.find("input[type=text]").val("").prop("class","variant"+max).prop("name",function(ind,old){
							return old.replace(/\[\d+\]$/,"["+max+"]");
						}).end()
						.find("input[type=number]").val(0).prop("class","number"+max).prop("name",function(ind,old){
							return old.replace(/\[\d+\]$/,"["+max+"]");
						}).end()
					.insertAfter(this);
				});
				var cnt;
				maxans.prop("max",function(ind,old){
					cnt=parseInt(old);
					return cnt+1;
				});
				AppDaD();
			}).on("click",".sb-minus",function(){
				var tr=variants.find("."+$(this).closest("tr").find("input[type=text]").prop("class").split(/ /)[0]).closest("tr"),
					cnt=variants.eq(0).find("tr:has(td)").size();
				if(cnt>2)
				{
					tr.remove();
					maxans.prop("max",cnt-1).val(function(ind,old){
						return old>$(this).prop("max") ? $(this).prop("max") : old;
					});
				}
				else
					tr.find("input[type=text]").val("").end().find("input[type=number]").val(0);
			}).on("change","input[type=number]",function(){
				variants.find("."+$(this).prop("class").split(/ /)[0]).val($(this).val());
			}).each(function(){
				var d=$(this).data("max");
				if(d>max)
					max=d;
			})

			maxans.prop("max",variants.eq(0).find("tr:has(td)").size());
			AppDaD();

			th.find("[name$=\"[multiple]\"]").change(function(){
				if($(this).prop("checked"))
					matr.show();
				else
					matr.hide();
			}).change().end().find(".addquestion").click(function(){
				var table=$(this).closest("table.question"),
					nname=rname.replace(/\[\d+\]$/,"["+qn+"]");
				table.clone(false).find("script").remove().end().data("qn",qn)
				.find(":input").not("[type=button],[type=submit],[type=number],:checkbox").val("").end().prop("name",function(ind,old){
				.insertAfter(table).each(Question).find(".langtabs").each(function(){
					{
						$("a",this).each(function(){
								actcl=$(this);
						if(actcl)
							actcl.click();
					}
					catch(e){}
					$(this).closest("table.question").remove();
				else
					$(this).closest("table.question").find(":input").not("[type=button],[type=submit],[type=number]").val("").end().end().find(".variants").each(ResetVariants);
		};

	//Прицепим обработчик к существующим вопросам
	gdiv.find("table.question").each(Question).end()

	//Управление основой формой
	.children("table:first").find("[name$=\"[onlyusers]\"]").change(function(){
			agtr.hide();
		else
			agtr.show();
	.find("[name$=\"[_addvoting]\"]").change(function(){
			C.prop("disabled",false).fadeTo("fast",1);
		else
			C.prop("disabled",true).fadeTo("fast",0.5);
}