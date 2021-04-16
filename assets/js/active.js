jQuery(function($) {
    var path = window.location.href;
    $('li a').each(function() {
      	if (this.href === path) {
       		$(this).addClass('active');
      	}
    });
});