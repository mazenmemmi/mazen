/**
 * Fade Menu for jQuery
 * 
 * http://www.renderrobot.com
 * 
 * Copyright (c) 2009 Alex Fish
 *
 * alex@renderrobot.com
 *
 * Dual licensed under MIT and GPL.
 *
 */

(function($){
	
	$.fn.fademenu = function(options){
		
		var 
			defaults = {
				fadeout : 400,
				fadein : 500,
				slideup : 500,
				slidedown : 500
			},
			settings = $.extend({}, defaults, options);
			
			this.each(function(){
			
					$("dd:not(dd#open)").hide();
					$("dt a").click(function(){
    					if ($.css(this, "display") !== "none" && $.css(this,
"visibility") !== "hidden") {			
							$("dd").fadeTo(settings.fadeout, 0);
							$("dd:visible").slideUp(settings.slideup);
							$(this).parent().next().slideDown(settings.slidedown);
							$(this).parent().next().fadeTo(settings.fadein, 1);
							}
						return false;
						});
		
			});
		
			return this;
	}

})(jQuery);