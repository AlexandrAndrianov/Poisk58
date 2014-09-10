function elemAdd(el)
{
	var strErr = '';
	if($('#titlelist').val() ==='')
	{
		strErr += 'Значение для "заголовка списка" не задано.';
	}	
	
	var identif = el.id.slice(-1);
	
	if($('#text_'+identif).val() ==='')
	{
		strErr += ' Значение для "элемента списка" не задано.';
	}
	
	if($('#foto_'+identif).val() ==='')
	{
		strErr += ' Значение для "ссылка на фото" не задано.';
	}		
	
	if(strErr)
	{
		var mesErr = $('<p class="alert alert-danger">\
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">\
				&times;</button>'+strErr+'</p>');
				
		if($($('.alert.alert-danger').length).length < 1)
		{
			$('#listAdd').prepend(mesErr);
		}
		return;
	}
	
	var listElem = '<div class="col-md-7">\
								<input id="text_0" name="text" class="form-control" placeholder="элемент списка">\
							</div>\
							<div class="col-md-4">\
								<input id="foto_0"  name="foto"  class="form-control"\
									placeholder="ссылка на фото"/>\
							</div>\
							<div class="col-md-1">\
								<input onclick="elemAdd(this);" type="button"\
										id="addelem_0" class="btn btn-primary pull-right" \
												name="addelem_0" value="+"/>\
							</div>';
}