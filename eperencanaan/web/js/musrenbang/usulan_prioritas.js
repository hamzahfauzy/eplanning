function load_data(){
  $("#isi-wrap").html('Loading...');
	$.ajax({ 
    type: "GET",
    url:'index.php?r=ta-musrenbang-kecamatan-report/hasil-skoring',
    data:'',
    success: function(isi){
      $("#isi-wrap").html(isi);
    },
    error: function(){
      alert("Load Data Gagal");
      $("#isi-wrap").html('');
    }
  });
}

load_data();
