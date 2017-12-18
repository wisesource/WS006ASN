<?php 

                                      
function mapCaller ($holderID, $locLat, $locLng) { ?>
	 <div class="mapWrap" id="<?= $holderID?>"></div>
                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9RytKyU86SMpDZiBeXQG-SBrEnNQutLo"></script>
                                    <script type="text/javascript">
    var templateUrl = '<?= get_bloginfo("template_url"); ?>';
    var locLat = '<?= $locLat ?>';
    var locLng = '<?= $locLng ?>';
                                       
  	// Create an array of styles.
 	 var styles = [
	  {
		"featureType": "road",
		"stylers": [
		  { },
		  { "weight": 1 }
		]
	  },{
		"featureType": "landscape",
		"stylers": [
		  { }
		]
	  },{
		"featureType": "poi",
		"stylers": [
		  { }
		]
	  },{
		"featureType": "administrative.land_parcel",
		"stylers": [
		  { }
		]
	  }
	];

	// Create a new StyledMapType object, passing it the array of styles,
  	// as well as the name to be displayed on the map type control.
  	var styledMap = new google.maps.StyledMapType(styles,
	{name: "Styled Map"});

	// Create a map object, and include the MapTypeId to add
	// to the map type control.
	var mapOptions = {
		zoom: 6,
		scrollwheel: true,
		center: new google.maps.LatLng(locLat,locLng),
	mapTypeControlOptions: {
		mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    	}
  	};
  	var map = new google.maps.Map(document.getElementById('<?= $holderID ?>'),mapOptions);

  	//Associate the styled map with the MapTypeId and set it to display.
  	map.mapTypes.set('map_style', styledMap);
 	map.setMapTypeId('map_style');


  	var image = templateUrl +'/assets/location-pin.png';
  	var amLatLng = new google.maps.LatLng(locLatAm,locLngAm);
  	var syLatLng = new google.maps.LatLng(locLatSy,locLngSy);
  	var beachMarkerAm = new google.maps.Marker({
      		position: amLatLng,
      		map: map,
  	});
  	var beachMarkerSy = new google.maps.Marker({
      		position: syLatLng,
      		map: map,
  	});

</script>
<?php }
                                    
                                        ?>