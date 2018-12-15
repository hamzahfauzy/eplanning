$(".alertHapus").on('click',function(){
    var tanyak = confirm("Apakah Anda Ingin Menghapus Data Ini ?");
    if(!tanyak){
        return false;
    }
});

$('table.display').DataTable();