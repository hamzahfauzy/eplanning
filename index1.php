<?php
 
require_once("conn.php");
$con = connect();
//$con2 = connect2(); 
 
require 'functions.php';
 
$ip      = ip_user();
$browser = browser_user();
$os      = os_user();
$tanggal = date('Y-m-d');
$waktu=date('h:i:s a');
$id=$tanggal.$ip.' '.$waktu; 
// Check bila sebelumnya data pengunjung sudah terrekam
if (!isset($_COOKIE['VISITOR'])) {
 
    // Masa akan direkam kembali
    // Tujuan untuk menghindari merekam pengunjung yang sama dihari yang sama.
    // Cookie akan disimpan selama 24 jam
    $duration = time()+60*60*24;
 
    // simpan kedalam cookie browser
    setcookie('VISITOR',$browser,$duration);
 
    // SQL Command atau perintah SQL INSERT
 $query="insert into [counter] (id,tanggal,ip_address,os,browser) VALUES ('$id','$tanggal','$ip','$os','$browser')";
    // variabel { $db } adalah perwakilan dari koneksi database lihat config.php
    $result = @pg_query($con,$query);
}
 
 
?>

	
<!----Pengunjung ditambah oleh Ripin G -->




	<?php 
$query_v1="SELECT count(*) as vi1 from [counter] where tanggal='".date('Y-m-d')."'";// where user_id like '%-%'"; //hanya jika record user_id ada tanda -
$result_v1= @pg_query($con,$query_v1);
$rowv1 = @pg_fetch_array($result_v1);
echo ' | IP Address	:', $ip;
echo ' | Browser 		:',$browser;
echo ' | Pengunjung Hari ini:',$rowv1['vi1'];
$query_v2="SELECT count(*) as vi2 from [counter] ;// where user_id like '%-%'"; //hanya jika record user_id ada tanda -
$result_v2= @pg_query($con,$query_v2);
$rowv2 = @pg_fetch_array($result_v2);
echo ' | Total Pengunjung	:',$rowv2['vi2'];


?>

<?php
    
    
		

 
