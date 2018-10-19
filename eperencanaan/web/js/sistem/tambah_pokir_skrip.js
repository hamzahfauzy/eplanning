function initMap() {
	lat = parseFloat($('#lat').val());
	lng = parseFloat($('#lng').val());

	if ($('#lat').val()==''){
	  lat = 2.992121;
	  lng = 99.621045;
	  zoom = 11;
	}
	else{
	  lat = parseFloat($('#lat').val());
	  lng = parseFloat($('#lng').val());
	  zoom = 13;
	}
  var pos = {lat: lat, lng: lng};
  var map = new google.maps.Map(document.getElementById('peta'), {
    zoom: zoom ,
    center: pos
  });
 
  var tandaGerak= new google.maps.Marker({
      position:{lat: lat, lng: lng},
      draggable: true,
      title: "geser ke lokasi"
  });
  tandaGerak.setMap(map);
  
  tandaGerak.addListener('dragend', function(e) {
    var tandaLat=e.latLng.lat();
    var tandaLng=e.latLng.lng();
    //alert("latiturde= "+tandaLat+" longitude="+tandaLng);
    $("#lat").val(tandaLat);
    $("#lng").val(tandaLng);

  });

}
