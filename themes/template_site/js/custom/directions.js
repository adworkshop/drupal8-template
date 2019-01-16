var x=document.getElementById("fromAddress");

function getLocation(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showPosition);
    }
    else{
        x.value ="Please enter your starting location";
    }
}

function showPosition(position) {
    x.value= position.coords.latitude + ", " + position.coords.longitude;
}

getLocation();

jQuery('#directions-form').submit(function(e){
    getNewDirections();
    return false;
});

var map, marker;

	var GMDirectionService = new google.maps.DirectionsService();
	var GMDirectionsRenderer = 0;

	var centerPoint = new google.maps.LatLng(jQuery('#map_canvas').attr('data-latitude'),jQuery('#map_canvas').attr('data-longitude'));

	function getNewDirections()
	{
	  marker.setMap(null);
	  var d = document.getElementById('directions-form');
	  origin  = d.from.value;
	  destination = d.to.value;

	  if(origin != '' && destination != ''){
		var DirectionRequest = {
		  destination: destination,
		  origin: origin,
		  travelMode: google.maps.DirectionsTravelMode.DRIVING,
		}

		GMDirectionService.route(DirectionRequest,showDirectionsResult);
	  }else{alert('Please enter a valid starting address and choose a valid destination.');}
	}

	function showDirectionsResult(DirectionsResult,DirectionsStatus)
	{
	  //google.maps.DirectionsRendererOptions object
	  var GDOptions = {
		  directions: DirectionsResult,
		  map: map,
		  panel: document.getElementById("directions-inner")
		}
	  if (GMDirectionsRenderer != 0) //there are already results, clear them and use the new results
	  {
		  GMDirectionsRenderer.setDirections(DirectionsResult);
			jQuery('div.directions-form-print').show();
	  }
	  else
	  {
		  GMDirectionsRenderer = new google.maps.DirectionsRenderer(GDOptions);
			jQuery('div.directions-form-print').show();
	  }
	  if (DirectionsStatus != 'OK') errorStatus(DirectionsStatus);
	}

	function errorStatus(s){
	  if (s == 'NOT FOUND'){
	    alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.");
	  }
	  else{
	    alert(s);
	    //alert("An unknown error occurred.");
      }
	}

	function initialize()
	{
		var mapOptions = {
			zoom: 13,
			mapTypeControl: true,
			center: centerPoint,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			mapTypeControlOptions: {style:google.maps.MapTypeControlStyle.HORIZONTAL_BAR}
		}

		map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);

		marker = new google.maps.Marker({
		  position: centerPoint,
		  map: map,
	  });
	}

	jQuery(document).ready(function() {
        jQuery('div.directions-form-print').hide();
      });

	google.maps.event.addDomListener(window, 'load', initialize);