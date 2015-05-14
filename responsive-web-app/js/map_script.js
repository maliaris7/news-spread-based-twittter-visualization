var array_f = new Array;
		var MY_MAPTYPE_ID = 'custom_style';
		function initialize(data) {
		  
		var location,lat_c,long_c;
		
		var geocoder = new google.maps.Geocoder();
		  
		for(var i = 0; i < data.length; i++){
			if(data[i] != null){
				location = data[i].location;
				//call to geocode with location
				lat_c = parseFloat(data[i].lat);
				long_c = parseFloat(data[i].long);
				
				
				
				var address = location;
				  
				   geocoder.geocode( { 'address': address}, function(results, status) {

				  if (status == google.maps.GeocoderStatus.OK) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					
					var flightPlanCoordinates = [
						new google.maps.LatLng(lat_c, long_c),
						new google.maps.LatLng(latitude, longitude)
					  ];
					 
					 
						var flightPath = new google.maps.Polyline({
						path: flightPlanCoordinates,
						geodesic: true,
						strokeColor: '#F03C02',
						strokeOpacity: 1.0,
						strokeWeight: 2
					  });
					  marker = new google.maps.Marker({
						map:map,
						position: new google.maps.LatLng(lat_c, long_c),
						icon: 'https://63bf6e73e9cdd32fad466a4e99185bea3329434e-www.googledrive.com/host/0B1LnKr3Yo9hyflh3YTBLNTJIaEM5QVlPQmk5RG5WY1hwMFQ2Z1FOQVU3bEtYVXZ6NW56bnM/poor.png'
					  });
					   
					  if(latitude != lat_c){
					   marker1 = new google.maps.Marker({
						map:map,
						position: new google.maps.LatLng(latitude, longitude),
						icon: 'https://63bf6e73e9cdd32fad466a4e99185bea3329434e-www.googledrive.com/host/0B1LnKr3Yo9hyflh3YTBLNTJIaEM5QVlPQmk5RG5WY1hwMFQ2Z1FOQVU3bEtYVXZ6NW56bnM/raindrop2%20(1).png'
					  });
					  }
						flightPath.setMap(map);
					 
							} 

					}); 
				 }
		  }
		  
		  
		  
		  var featureOpts = [
			{
			  stylers: [
				{ hue: '#49708A' },
				{ visibility: 'simplified' },
				{ gamma: 0.5 },
				{ weight: 0.5 }
			  ]
			},
			{
			  elementType: 'labels',
			  stylers: [
				{ visibility: 'off' }
			  ]
			},
			{
			  featureType: 'water',
			  stylers: [
				{ color: '#CAFF42' }
			  ]
			}
		  ];
		  
		  var mapOptions = {
			zoom: 3,
			center: new google.maps.LatLng(lat_c, long_c),
			 disableDefaultUI: true,
			mapTypeId: MY_MAPTYPE_ID
		  };

		  var map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);
		   var styledMapOptions = {
			name: 'Custom Style'
		  };

			var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
			
			
			  
		  map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
		  
		 
		}
		
		$(function() {
			$("#contact_modal_form").submit(function(event) {
				var form = $(this);
				$.ajax({
					type: form.attr('method'),
					url: form.attr('action'),
					data: form.serialize(),
					dataType: 'json',
					success: function(data) {
						if(data.error == true) {
							var error = $("#example_form_error");
							error.css("color", "red");
							error.html("Not " + data.msg + ". Please enter a different name.");
						} else {
							$("#example_form_enter").hide();
							$("#example_form_error").hide();
							$("#example_form_confirmation").show();

							var success = $("#example_form_success");
							initialize(data);
							
						}
					}
				});
				event.preventDefault();
			});
		});
		$(function() {
			$("#contact_modal_form2").submit(function(event) {
				var form = $(this);
				$.ajax({
					type: form.attr('method'),
					url: form.attr('action'),
					data: form.serialize(),
					dataType: 'json',
					success: function(data) {
						if(data.error == true) {
							var error = $("#example_form_error");
							error.css("color", "red");
							error.html("Not " + data.msg + ". Please enter a different name.");
						} else {
							$("#example_form_enter").hide();
							$("#example_form_error").hide();
							$("#example_form_confirmation").show();

							var success = $("#example_form_success");
							initialize(data);
							
						}
					}
				});
				event.preventDefault();
			});
		});
		$(function() {
			$("#contact_modal_form3").submit(function(event) {
				var form = $(this);
				$.ajax({
					type: form.attr('method'),
					url: form.attr('action'),
					data: form.serialize(),
					dataType: 'json',
					success: function(data) {
						if(data.error == true) {
							var error = $("#example_form_error");
							error.css("color", "red");
							error.html("Not " + data.msg + ". Please enter a different name.");
						} else {
							$("#example_form_enter").hide();
							$("#example_form_error").hide();
							$("#example_form_confirmation").show();

							var success = $("#example_form_success");
							initialize(data);
							
						}
					}
				});
				event.preventDefault();
			});
		});
      