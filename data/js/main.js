function displayimg_cs(lp) {
	var x = $("input[name='displayname" + lp + "']").length;
	if (x > 0) {
		lp++;
		return displayimg_cs(lp);
	} else {
		return lp;
	}
}

function add_images(my,imgurl,text,lp)
{
	var my,imgurl,text,lp;
	url = 'index.php?g=admin&m=attachment&a=upload_input';
	if(!arguments[1]) imgurl = "";
	if(!arguments[2]) text = "";
	if(!arguments[3]){
		lp = $('.'+my+'_row').length;
		lp += 1;
	}
	//lp = displayimg_cs(lp);
	var dom = $('#'+my+'_area');
	$.ajax({
		url: url,
		type: "POST",
		data: {lp:lp,name:my,imgurl:imgurl,text:text},
		success: function(data) {
			dom.append(data);
			$("#"+my+"_num").val(function() {
				return parseInt($(this).val()) + 1
			});
		}
	});
	return false;
}

function del_images(my,name)
{
	my.parents('.'+name+'_row').remove();
}