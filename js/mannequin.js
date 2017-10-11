var $leftRightBanner = $("#leftRightBanner");
var $slidingBanner = $("#slidingBanner");
var $about = $("#about");
var $sample = $("#sample");
var $dropdownButton = $(".dropdown-button");
$(document).ready(function(){
	$('.parallax').parallax();
	$('.carousel.carousel-slider').carousel({fullWidth: true});
	$('.slider').slider({full_width: true});
	$('ul.tabs').tabs();
	$('.tooltipped').tooltip({delay: 50});
    $('.materialboxed').materialbox();
    $('#libanner').click(function(){
		$banner.css("display", '');
		$about.css("display", 'none');
		$collection.css("display", 'none');
		$address.css("display", 'none');
		$dropdownButton.text('Banner Edit');
    });

    $('#liabout').click(function(){
		$banner.css("display", 'none');
		$about.css("display", '');
		$collection.css("display", 'none');
		$address.css("display", 'none');
		$dropdownButton.text('About Edit');
    });

    $('#licollection').click(function(){
		$banner.css("display", 'none');
		$about.css("display", 'none');
		$collection.css("display", '');
		$address.css("display", 'none');
		$dropdownButton.text('Collection Edit');
    });

    $('#liaddress').click(function(){
		$banner.css("display", 'none');
		$about.css("display", 'none');
		$collection.css("display", 'none');
		$address.css("display", '');
		$dropdownButton.text('Address Edit');
    });

	// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	$('.modal').modal();
	$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		constrain_width: false, // Does not change width of dropdown to that of the activator
		hover: false, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: false, // Displays dropdown below the button
		alignment: 'left' // Displays dropdown with edge aligned to the left of button
	});
	$(".button-collapse").sideNav();

	$('input[id^="checkAll"]').change(function() {
	    var checkboxes = $(this).closest('form').find(':checkbox').not(':disabled');
	    if($(this).is(':checked')) {
	        checkboxes.prop('checked', true);
	    } else {
	        checkboxes.prop('checked', false);
	    }
	});
	
	$('input:checkbox').change(function () {
	    if ($(this).is(':checked')) {
	        $('a[id^="delSelection"]').removeClass('disabled');
	        $('a[id^="delSelection"]').removeAttr('disabled');
	        $('a[id^="delSelection"]').addClass('modal-trigger');
	        $('.modal').modal();
	    } else if (($(this).not(':checked')) && ($("input:checkbox:checked").length <= 0)) {
	        $('a[id^="delSelection"]').addClass('disabled');
	        $('a[id^="delSelection"]').removeClass('modal-trigger');
	        $('a[id^="delSelection"]').attr('disabled', '');
	        $('input[id^="checkAll"]').prop('checked', false);
	        $('a[id^="delSelection').modal().unbind();
	    }
	});
	$('input:text').change(function () {
		var checkboxes = $(this).parent().parent().find(':checkbox').not(':disabled');
	    $('button[id^="btnUpdateCollection"]').removeClass('disabled');
	    $('button[id^="btnUpdateCollection"]').removeAttr('disabled');
	    checkboxes.prop('checked', true);
	});
});
