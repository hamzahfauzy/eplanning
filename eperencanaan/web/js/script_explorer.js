
function get_lingkungan() {
    $(".data-kel").click(function () {
        var prov = $(this).data('prov');
        var kab = $(this).data('kab');
        var kec = $(this).data('kec');
        var urut = $(this).data('urut');
        //alert("index.php?r=laporan/getling&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut);
        $.ajax({
            url: "index.php?r=laporan/getling",
            data: "Kd_Prov=" + prov + "&Kd_Kab=" + kab + "&Kd_Kec=" + kec + "&Kd_Kel=" + urut,
            success: function (data) {
                $('#list-ling').html(data);
            },
            error: function(xhr, status, data){
           alert(xhr.responseText);
            }
        });
    });
}

/*
 $(".data-kec").click(function(){
 var prov = $(this).data('prov');
 var kab = $(this).data('kab');
 var kec = $(this).data('kec');
 //alert("index.php?r=laporan/getkel&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec);
 $.ajax({
 url: "index.php?r=laporan/getkel",
 data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec,
 success: function(data) {
 $('#list-ling').html('');
 $('#list-kel').html(data);
 get_lingkungan();
 }
 });
 });
 
 $(".detail_kecamatan").click(function(){
 var prov = $(this).data('prov');
 var kab = $(this).data('kab');
 var kec = $(this).data('kec');
 //alert("index.php?r=laporan/modal-detail-kecamatan&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec);
 $.ajax({
 type: "POST",
 url: "index.php?r=laporan/modal-detail-kecamatan",
 data: {prov:prov, kab:kab, kec:kec},
 success: function(data) {
 //alert(data);
 $('#modal_detail_kecamatan').html(data);
 $('#modal_detail_kecamatan').modal('show');
 }
 });
 });
 */
$(".detail_kecamatan").click(function () {
    //alert("hai");
    //return;
    var prov = $(this).data('prov');
    var kab = $(this).data('kab');
    var kec = $(this).data('kec');
    var urut = $(this).data('urut');
    var ling = $(this).data('ling');
    //alert(prov + ' ' + kab);return;
    //alert("index.php?r=laporan/getling&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Ling="+ling);
    //return;
    $.ajax({
        url: "index.php?r=ta-musrenbang-kelurahan-explorer/getusulan",
        data: "Kd_Prov=" + prov + "&Kd_Kab=" + kab + "&Kd_Kec=" + kec + "&Kd_Kel=" + urut + "&Kd_Ling=" + ling + "&status=0",
        success: function (data) {
            $('#list-kel').html(data);
        }
    });
    $.ajax({
        url: "index.php?r=ta-musrenbang-kelurahan-explorer/getusulan",
        data: "Kd_Prov=" + prov + "&Kd_Kab=" + kab + "&Kd_Kec=" + kec + "&Kd_Kel=" + urut + "&Kd_Ling=" + ling + "&status=1",
        success: function (data) {
            $('#list-ling').html(data);
        }
    });
    $.ajax({
        url: "index.php?r=ta-musrenbang-kelurahan-explorer/get-pj",
        data: "Kd_Prov=" + prov + "&Kd_Kab=" + kab + "&Kd_Kec=" + kec + "&Kd_Kel=" + urut + "&Kd_Ling=" + ling,
        success: function (data) {
            $('#list-pj').html(data);
        }
    });
    $(".kec-col").removeClass("active");
    $(this).addClass("active");
});

$(".detail_usulan").click(function () {
    //alert("hai");
    //return;
    var kd = $(this).data('kd');
    //alert(prov + ' ' + kab);return;
    //alert("index.php?r=laporan/getling&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Ling="+ling);
    //return;
    $.ajax({
        url: "index.php?r=ta-musrenbang-kelurahan-explorer/get-usulan-kompilasi",
        data: {Kd_Ta_Musrenbang_Kelurahan: kd},
        success: function (data) {
            $('#list-usulan').html(data);
        }
    });
    $.ajax({
        url: "index.php?r=ta-musrenbang-kelurahan-explorer/getusulan",
        data: "Kd_Prov=" + prov + "&Kd_Kab=" + kab + "&Kd_Kec=" + kec + "&Kd_Kel=" + urut + "&Kd_Ling=" + ling + "&status=1",
        success: function (data) {
            $('#list-ling').html(data);
        }
    });
    $.ajax({
        url: "index.php?r=ta-musrenbang-kelurahan-explorer/get-pj",
        data: "Kd_Prov=" + prov + "&Kd_Kab=" + kab + "&Kd_Kec=" + kec + "&Kd_Kel=" + urut + "&Kd_Ling=" + ling,
        success: function (data) {
            $('#list-pj').html(data);
        }
    });
    $(".kec-col").removeClass("active");
    $(this).addClass("active");
});