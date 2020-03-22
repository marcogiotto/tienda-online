$(document).ready(function(){
	$('#ofertas img').hover(function(){
		$(this).css({
			'cursor': 'pointer',
			
		});
	})
	$('#ofertas h3').hover(function(){
		$(this).css({
			'cursor': 'pointer',
			
		});
	})
	$('picture').click(function(){
		window.location='index.php?s=productos';

	});
	$('#ofertas h3').click(function(){
		window.location='index.php?s=productos';

	})

})

$(document).ready(function(){
	$('.btn-eliminar').click(function(e){


		if(!confirm('esta seguro de eliminar ' + $(this).data('nombre') +', esta accion no se pordra revertir')){
			e.preventDefault();
		}


	})

})