var map;
var lat;
var lng;

$(".kordinat-btn").click(function(){
    var kode=$(this).data('kd');
    var lat=$(this).data('lat');
    var lng=$(this).data('lng');
    ///alert(kode);
    $('#kd_usulan_input').val(kode);
    $('#lat').val(lat);
    $('#lng').val(lng);
    $("#modal_koordinat").modal('show');
    
});

$("#modal_koordinat").on("shown.bs.modal", function () {
    lat = parseFloat($('#lat').val());
    lng = parseFloat($('#lng').val());
    if ($('#lat').val()==''){
      lat = 3.595163;
      lng = 98.671884;
      zoom = 13;
    }
    else{
      lat = parseFloat($('#lat').val());
      lng = parseFloat($('#lng').val());
      zoom = 18;
    }

    var latLng= new google.maps.LatLng(lat, lng);
    var mapOptions={
      center: latLng,
      zoom: zoom,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('peta'), mapOptions);
    
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

});