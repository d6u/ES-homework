(function () {
	var last_input = "";
	
	$('#search-input').focus(function () {
		var that = this;
		last_input = "";
		
		$(this).stop().animate({'width': 680}, 400);
		if ( $(this).val() == "" ) {
			$('.search').addClass('search-color');
			$('#search-message').html("Type any key word to search for your favorate restaurant!");
			$('.search-show').stop().animate({'height': 80}, 400, function () {
				$(this).css({height: 'auto'});
			});
		}
	})
	.blur(function () {
		$(this).stop().animate({'width': 360}, 400);
		if ( $(this).val() == "" ) {
			$('.search').removeClass('search-color');
			$('.search-show').stop().animate({'height': 0}, 400, function () {
				$('#search-message').empty();
				$('#search-result-restaurant-list').empty();
			});
		}
	})
	// search for on keyup
	.on('keyup', function () { 
		var input = $(this).val();
		if ( input != "" && input != last_input ) {
			// input is different, trigger update
			last_input = input;
			var url = "ajax_support/search_bar.php",
				data = {'search': input},
				that = this;
			
			$.post(url, data, function (response) {
				$('#search-result-restaurant-list').empty();
				var json = $.parseJSON(response);
				if ( json.found != false ) {
					for (var i = 0; i < json.restaurant.length; i++) {
						var id = json.restaurant[i].r_id,
							name = json.restaurant[i].r_name,
							addr = json.restaurant[i].r_address,
							li = $(document.createElement('li')).addClass('search-result-item'),
							achor = $(document.createElement('a')).attr({href: 'restaurant.php?id='+id}).addClass('clearfix'),
							name_span = $(document.createElement('span')).addClass('search-result-name').html(name),
							addr_span = $(document.createElement('span')).addClass('search-result-addr').html(addr);
						li.append(achor.append(name_span, addr_span));
						$('#search-result-restaurant-list').append(li);
					}
				} // end if
			}); // end ajax
		} // end if
	}); // end of on key up
	
	
})();
