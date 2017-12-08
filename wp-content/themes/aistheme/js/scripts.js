jQuery(document).ready(function($){
	$('.topSearchHandler i').click(function(){
		$(this).closest('.topSearch').toggleClass('active');
	});

	$('.topMenu .navbarClose').on('click', function (e) {
	  e.preventDefault()
	  console.log('asdfa');
	  $('.topMenu .navbar-toggler').click();

	});

	$('.topMenu .navbar-toggler').click(function(){
		$('.topMenu .navbarSeparator').toggleClass('active');
	});

	$('.successStoriesSlider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.successStoriesSlider',
	
	});

	$('.successStoriesSlider').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.successStoriesSlider-for',
		dots: false,
		// centerMode: true,
		focusOnSelect: true,
		prevArrow: '.successStoriesPrev',
		nextArrow: '.successStoriesNext',
		responsive: [
		    {
		      breakpoint: 1200,
		      settings: {
				slidesToShow: 4,
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 3,
		      }
		    }

		  ]			
	});	
		customRadioChecklist();
}); // Ready end


function customRadioChecklist () {

	 	// Custom Radio
	    $('body').on('click', 'form input[type="radio"]', function() {
	    	
	      $('form input[type="radio"]').each(function() {
	          $(this).closest('label').removeClass('checkedRadio');
	      });

	      $(this).closest('label').addClass('checkedRadio');

	    });

	    // Custom Checkbox

	    $('body').on('click', 'form input[type="checkbox"]', function() {

	        $(this).closest('label').toggleClass('checkedBox');

	    });

};