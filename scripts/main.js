// JavaScript Document

var initialSliderHeight = 0 ;
$(document).ready(function() {

$("#googlemap").fitMaps( {w: '100%', h:'500px'} );

	setTimeout(function(){
	$(".logoWrapper").animate({"marginTop":45},1000,function(){
	
		$('#logoWrapper').mouseover(function() {
		$(".logoWrapper").animate({"marginTop":0},1000);
		});	
	});
	},3000);
	
// place nav correctly on page load
	percent = ($(window).width()/100)*36;
	if($(window).width()<1940  && ($(window).height()>=percent)){			
		if ($(window).width()<321) {			
			height = '137px';
			$(".headerImageSlideshow").css("height",height);
		} else if (($(window).width()<481) && ($(window).width()>320)) {
			height = '175px';
			$(".headerImageSlideshow").css("height",height);
		} else {
			$(".headerImageSlideshow").css("height",percent);
		}	
	}
	else if ($(window).width()<1940  && ($(window).height()<=percent)){
		percent = (($(window).height())/100)*80;
		$(".headerImageSlideshow").css("height",percent);
	} else {
		height = '730px';
		$(".headerImageSlideshow").css("height",height);
	}

//  end  //

// move nav when resizing browser
	$(window).resize(function(){
		percent = ($(window).width()/100)*36;
		if($(window).width()<1940  && ($(window).height()>=percent)){			
			if ($(window).width()<321) {			
				height = '137px';
				$(".headerImageSlideshow").css("height",height);
			} else if (($(window).width()<481) && ($(window).width()>320)) {
				height = '175px';
				$(".headerImageSlideshow").css("height",height);
			} else {
				$(".headerImageSlideshow").css("height",percent);
			}	
		}
		else if ($(window).width()<1940  && ($(window).height()<=percent)){
			percent = (($(window).height())/100)*80;
			$(".headerImageSlideshow").css("height",percent);
		} else {
			height = '730px';
			$(".headerImageSlideshow").css("height",height);
		}	
	});
//  end  //


	/* start mobile specific stuff */
	$('.mobileButton a').click(function() {
		$(".mobileMenu").slideToggle();
	});
	/* end mobile specific stuff */


//  Date picker code for room booking
	var dateChanged = false;
	$('#fromDate').blur(function() {
		setTimeout(function(){
			$("#toDate").val($('#fromDate').val());
		},300);
	});

	$('#availabilityForm').submit(function() {
		if($("#fromDate").val()=="" || $("#toDate").val()==""){
			alert("Please select dates to check availability");
			return false;
		} else {
		 $("#prevPage").attr("href",$("#prevPage").attr("data-original")+"?check_in_date="+$("#fromDate").val()+"&check_out_date="+$("#toDate").val());
		 $("#nextPage").attr("href",$("#nextPage").attr("data-original")+"?check_in_date="+$("#fromDate").val()+"&check_out_date="+$("#toDate").val());

			$(".loadingIcon").show();
			$( ".rate-check" ).animate({"opacity":0},300);
			$(".rate-check").removeClass("room-unavailable");
			$(".rate-check").removeClass("room-available");
			setTimeout(function(){
				var results = $.parseJSON(sendRequest(baseURL+"/availability.php",{from:$("#fromDate").val(),to:$("#toDate").val()}));
				for (var key in results) {
					if (results.hasOwnProperty(key)) {
						$("#rate-"+key).addClass("room-available");
						$("#rate-"+key).html(results[key].available+" room(s) available, &pound"+results[key].total+" per room for the duration of your stay.");
						$(".accomodation-link-"+key).attr("href",$(".accomodation-link-"+key).attr("data-link")+"&check_in_date="+$("#fromDate").val()+"&check_out_date="+$("#toDate").val())

						$("#proceed-"+key).show();
						$(".accomodation-link-"+key).attr("href",$(".accomodation-link-"+key).attr("data-link")+"&check_in_date="+$("#fromDate").val()+"&check_out_date="+$("#toDate").val())
						$(".booking-proceed").show();
					}
				}
				$( ".rate-check" ).each(function( index ) {
					if(!$(this).hasClass("room-available")){
						$(this).html("No rooms available " + $("#fromDate").val() + " to " + $("#toDate").val());
						$(this).addClass("room-unavailable")
						$(this).next().hide();
					}
				});
				$( ".rate-check" ).animate({"opacity":1},300);
				$(".loadingIcon").hide();
			},300);
			return false;
		}
	});
//  end  //


// room slideshow gallery //
	$(".accommodation-gallery").before('<ul id="nav" class="accommodation-gallery-nav">').cycle({
		pager:  '#nav',
		pagerAnchorBuilder: function(idx, slide) {
			return '<li><a href="#" class="slideChoose">&nbsp;&nbsp;</a></li>';
		},
	});

	$(".datePicker").datepicker({ dateFormat: "dd/mm/yy" });

	$(".lightbox").attr('rel', 'gallery').fancybox();
//  end  //



});

function isMobile(){
	if($(window).width() <=568){
		return true;
	} else {
		return false;
	}

}

function isiPad(){
	var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
	return iOS;
}

function sendRequest(url,data){
	var returnValue = null;
	$.ajax({
		url: url,
		data: data,
		type: 'GET',
		async: false,
		cache: false,
		timeout: 30000,
		error: function(){
			return true;
		},

		success: function(data){
			returnValue = data;
		}
	});
	return returnValue;
}







/* this function will get data and return an array of 
 * 
 * */
 
function WeatherQuery(data1) {
	//alert( data1.currently.icon);

var summarytxt = data1.currently.summary;
var temptxt =  data1.currently.temperature;
var iconfilename = '';
var specialtxt = 'lorum impsum';

    switch (data1.currently.icon) { 
        case 'clear-day': 
            iconfilename = 'sun.png';
            specialtxt = 'Take a book to the beach';
            break;  
        case 'clear-night': 
            iconfilename = 'moon.png';
            specialtxt = 'Glass of wine under the stars';
            break; 
        case 'rain':
            iconfilename = 'rain.png';
            specialtxt = 'Take your brolly just in case';
            break; 
        case 'snow': 
            iconfilename = 'snow.png';
            specialtxt = 'St Mawes in white';
            break; 
        case 'sleet':
            iconfilename = 'hail.png';
            specialtxt = 'Stay in and watch a movie';
            break;        	
        case 'wind':
            iconfilename = 'wind.png';
            specialtxt = 'Careful when hiking';
            break;         	
        case 'fog':
            iconfilename = 'fog.png';
            specialtxt = 'Poor visibility at sea';
            break;       	
        case 'cloudy':
            iconfilename = 'cloud.png';
            specialtxt = 'Take your brolly just in case';
            break;           	
        case 'partly-cloudy-day':
            iconfilename = 'sun-cloud.png'; 
           specialtxt = 'Ideal for a relaxing stroll by the sea';
            break;           	
        case 'partly-cloudy-night':
            iconfilename = 'cloud-moon.png';
            specialtxt = 'Perfect for an evening walk';
        	break;
    }
    return {
        summary: summarytxt,
        temp: temptxt,
        iconfilename: iconfilename,
        special: specialtxt
    };
};




//SET THE LANG AND LONG OF THIS 
var lat  = '50.159745';
var lon = '-5.014671';
var weatherData = [];

//MAKE SURE TO USE YOUR WEATHER API KEY SUPPLIED TO YOU
var apikey = "d348c74c34e486febb0f7c2ea888a83a";
$.getJSON('https://api.forecast.io/forecast/' + apikey + '/' + lat + ',' + lon + "?callback=?", function(data1) {
            
			//UNCOMMENT BELOW IF YOU WANT TO VIEW DATA IN THE LOG (firebug)
			//console.log(data1.currently.summary);
            
			//ASSIGN WEATHER DATA BY PASSING WEATHER DATA INTO CUSTOM FUNCTION 'WeatherQuery'
            weatherData = WeatherQuery(data1);

            
            //PLACE WEATHER CONTENTS INTO DOM
            $('#w_iconimage').html(
            		'<img src="/wp-content/themes/idlerocks/images/icons/' + weatherData.iconfilename + '" title="' +  weatherData.summary + '"/>'
            		/*'<span class="fs1 ' +  weatherData.iconfilename + '" aria-hidden="true"></span>'*/
            );
            
            $('#w_summary').html(
            		weatherData.summary
            );
            
            $('#w_temp').html(
            		Math.floor(((weatherData.temp - 32) * 5) / 9) + '&#176;C'
            );
            
            $('#w_special').html(
            		weatherData.special
            		
            );
        });

$(".hero-unit").hover(function(){
    $("#w_special").fadeIn();
},
function(){
    $("#w_special").fadeOut();
});

$('#photo_wall').bind('mousewheel DOMMouseScroll', function(e) {
    var scrollTo = null;

    if (e.type == 'mousewheel') {
        scrollTo = (e.originalEvent.wheelDelta * -1);
    }
    else if (e.type == 'DOMMouseScroll') {
        scrollTo = 40 * e.originalEvent.detail;
    }

    if (scrollTo) {
        e.preventDefault();
        $(this).scrollTop(scrollTo + $(this).scrollTop());
    }
});


// makes front page image appear by forcing div dimensions
	function thirty_pc() {
    	var height = $(window).height();
    	height = parseInt(height) + 'px';
    	$(".fullheaderImage").css('height',height);
	}

	$(document).ready(function() {
    	thirty_pc();
    	$(window).bind('resize', thirty_pc);
	});
//  end  //
