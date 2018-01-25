function selectProvider(obj){
	var id = $(obj).attr('data-id');
	var name = $(obj).html();

	$('.searchresults').hide();
	$('#provider_name').val(name);
	$('#provider_name').attr('data-id',id);
	$('input[name=provider_id]').val(id);

}

$(function(){
	$('input[name=price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});

	$('.provider_add_button').on('click',function(e){
		e.preventDefault();

		var name = $('#provider_name').val();

		if( name !='' && name.length>=4){

			if(confirm('Você deseja adicionar um fornecedor com o nome: '+name+' ?')){
				$.ajax({
					url:BASE+'/ajax/add_provider',
					type:'POST',
					data:{name:name},
					dataType:'json',
					success:function(json){
						$('.searchresults').hide();
						$('input[name=provider_id]').val( json.id);
					} 
				});
			}
		}
	});

	$('#provider_name').on('keyup', function(){
		var datatype = $(this).attr('data-type');
		var q = $(this).val();

		if(datatype != '') {
			$.ajax({
				url:BASE+'/ajax/'+datatype,
				type:'GET',
				data:{q:q},
				dataType:'json',
				success:function(json) {
					if( $('.searchresults').length == 0 ) {
						$('#provider_name').after('<div class="searchresults"></div>');
					}
					$('.searchresults').css('left', $('#provider_name').offset().left+'px');
					$('.searchresults').css('top', $('#provider_name').offset().top+$('#provider_name').height()+3+'px');

					var html = '';

					for(var i in json) {
						html += '<div class="si"><a href="javascript:;" onclick="selectProvider(this)" data-id="'+json[i].id+'">'+json[i].name+'</a></div>';
					}

					$('.searchresults').html(html);
					$('.searchresults').show();
				}
			});
		}

	});

	


});