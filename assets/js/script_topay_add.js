$(function(){

	$('input[name=price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[name=maturity]').mask('00/00/0000');
	
});