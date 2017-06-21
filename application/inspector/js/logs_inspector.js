$(document).ready(function () {
	function isElementIntoViewScroll(elem)
	{
	    var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();

	    var elemTop = $(elem).offset().top;
	    var elemBottom = elemTop + $(elem).height();

	    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}

	$('.label-type').each(function () {
		/*$(this).click(function () {
			
		})*/
		labelName = $(this).children().text().toLowerCase();
			//$(this).toggleClass(labelName);
			//$(this + " li").attr('title',labelName);
			//console.log($(this));
		$('.label-type').find('li').attr('title',labelName);
			//$($('.errors').find('.'+labelName).parent().parent()).toggle();		
	})

	function scrollElementAjax() {
		if (isElementIntoViewScroll(".errors tbody tr:last")) {
			$(document).unbind('scroll');
			$.ajax({
				type: "POST",
				url: document.location.href,
				data: { textFilter:  $('#textFilter').attr('value'), indexCount:$('#indexCount').attr('value'),json: "true" }
			}).done(function( msg ) {
				$(".errors tbody ").append(msg.html);
				$('#indexCount').attr('value',msg.indexCount);
				if (msg.count != 0) {
					$(document).scroll(function(e){
						scrollElementAjax();
					})
				}
			});

		};
	}
	$(document).scroll(function(e){
		scrollElementAjax();
	})

})