<div style="position:absolute; text-align:justify;  width:900px; margin:-60px 100px 100px 10px;">
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <h3>Peta Penyebaran</h3>
	<script type="text/javascript">
      (function() {
        window.onload = function(){
			
			var json = <?php echo $maps;?>
        	// Creating a LatLng object containing the coordinate for the center of the map  
          var map = new google.maps.Map(document.getElementById("map"), {
		  center: new google.maps.LatLng(0.4028, 116.2631),
		  zoom: 5,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
          	for (var i = 0, length = json.length; i < length; i++) {
			  var data = json[i],
				  latLng = new google.maps.LatLng(data.lat, data.lng); 

			  // Creating a marker and putting it on the map
			  var marker = new google.maps.Marker({
				position: latLng,
				map: map,
				title: data.diseases
			  });
			  var infoWindow = new google.maps.InfoWindow();

				google.maps.event.addListener(marker, "click", function(e) {
				  infoWindow.setContent(data.name +"-"+ data.Diseases_Name +"-"+ data.created_at);
				  infoWindow.open(map, marker);
				});
				(function(marker, data) {
				
				  // Attaching a click event to the current marker
				  google.maps.event.addListener(marker, "click", function(e) {
					infoWindow.setContent(data.name +" / "+ data.Diseases_Name +" / "+ data.created_at);
					infoWindow.open(map, marker);
				  });
				
				})(marker, data);
			}



      	}
      })();
		</script>
	
	</script>
<div style="position:fixed; width:900px; height:400px; margin:0px 100px 100px 0px;" id="map">
</div>
</div>                  
                   