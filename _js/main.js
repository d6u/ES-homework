$('#search-input').focus(function () {
	$(this).animate({'width': 680}, 400);
})
.blur(function () {
	$(this).animate({'width': 360}, 400);
});
