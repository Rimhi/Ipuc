 var url = 'http://127.0.0.1:8000';
 window.addEventListener("load", function(){
	$('.btn-like').css('cursor','pointer');
	$('.btn-dislike').css('cursor','pointer');
	$(document).on("click", ".btn-like", function(e){
		$(this).addClass('btn-dislike').removeClass('btn-like');
		$(this).attr('src', url+'/images/heartred.png');
		$.ajax({
			url: url +'/like/'+ $(this).data('id'),
			type: 'GET',
			success: function(){
				
			}

		});
	});
	$(document).on("click", ".btn-dislike", function(e){
		$(this).addClass('btn-like').removeClass('btn-dislike');
		$(this).attr('src', url+'/images/heartgray.png');
		$.ajax({
			url: url +'/dislike/'+ $(this).data('id'),
			type: 'GET',
			success: function(){
				
			}

		});
	});
});