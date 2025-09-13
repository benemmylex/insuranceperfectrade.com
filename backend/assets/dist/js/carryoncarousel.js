(function($) {
	$.fn.carryOnCarousel = function(){
	    return this.each(function() {
	        var $this = $(this);
	        var images = $this.data('images');
			
			// this is our setup
			images.forEach(function(element, index, array) {
				// setup our dom elements
				// note that the last element will be the one displayed
				var style = "background-image:url('" + element + "');background-repeat: no-repeat;z-index:0;opacity:0";
				
				var carouselImgElement = $("<div>", 
					{'class': "carryOnCarouselSlide", 
					 'style': style});
				carouselImgElement.appendTo($this);
			});
			
			// make the first "slide" active 
			$this.children().first().toggleClass('active').css('z-index',1).css('opacity',1);
			
			// this actually runs the carousel at the set interval
			setInterval(function() {
				// get our current slide and our next slide
				var $current = $('.carryOnCarouselSlide.active');
            	var $next = $current.next();
				
				// if we are at the last slide element (i.e. there is no "next" element), select the first again
				// note 0 is the falsy value
				if (!$next.length) {
                	$next = $this.children().first();
            	}
				
				// we make our next slide visible. That way when we fade out the active slide, 
				// we get a nice smooth transition to the next slide
				$next.css("opacity", 1).toggleClass('active');
            
				// fade out our current slide, reset it's z-index to 0
				// our "next" slide is then visible and we set the z-index to 1 to bring it above the other slides 
           		$current.fadeTo("slow",0, function() {
					$current.toggleClass('active').css("z-index",0);
					$next.css("z-index", 1);
            	});
				
			},5000);
			
	    });
	};
}(jQuery));