(function () {
	var last_input = "";
	
	$('#search-input').focus(function () {
		$('#category-menu').stop().slideUp(); // fold cats menu
		
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
				
				// restaurant
				if ( json.restaurant != false ) {
					// restaurant title
					var li = $(document.createElement('li')).addClass('search-result-title').html("Restaurant");
					$('#search-result-restaurant-list').append(li);
					// list item
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
				
				// dish
				if ( json.dish != false ) {
					// dish title
					var li = $(document.createElement('li')).addClass('search-result-title').html("Dish");
					$('#search-result-restaurant-list').append(li);
					// dish item
					for (var i = 0; i < json.dish.length; i++) {
						var r_id = json.dish[i].r_id,
							d_id = json.dish[i].d_id,
							d_name = json.dish[i].d_name,
							r_name = json.dish[i].r_name,
							li = $(document.createElement('li')).addClass('search-result-item'),
							achor = $(document.createElement('a')).attr({href: 'restaurant.php?id='+r_id+'&dish='+d_id}).addClass('clearfix'),
							name_span = $(document.createElement('span')).addClass('search-result-name').html(d_name),
							addr_span = $(document.createElement('span')).addClass('search-result-addr').html(r_name);
						li.append(achor.append(name_span, addr_span));
						$('#search-result-restaurant-list').append(li);
					}
				}
				
				if ( json.restaurant == false && json.dish == false ) {
					var li = $(document.createElement('li')).addClass('search-result-message').html("Sorry, we tried but found no result.");
					$('#search-result-restaurant-list').append(li);
				}
			}); // end ajax
		} else if ( input == "" && input != last_input ) {
			// clear result if input is empty
			last_input = input;
			$('#search-result-restaurant-list').empty();
		}
	}); // end of on key up
	
	// show category button
	$("#category-button").on('click', function () {
		$('#category-menu').stop().slideToggle();
	});
	
	// random pick restaurant
	$("#random-button").on('click', function () {
		var url = "ajax_support/random_restaurant.php",
			data = {'random': true};
		$.post(url, data, function (response) {
			var id = JSON.parse(response).restaurant.r_id;
			window.location = "restaurant.php?id="+id+"";
		});
	});
})();
