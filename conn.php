<?php

$db_host = "localhost";
//$db_port = "22";
$db_user = "root";
$db_passwd = "bappeda@4321";
$db_name = "eperencanaan";

function connect()
{
    $host = $GLOBALS[db_host];
    //$port = $GLOBALS[db_port];
    $user = $GLOBALS[db_user];
    $passwd = $GLOBALS[db_passwd];
    $db_name = $GLOBALS[db_name];

     //  $hasil = pg_connect("host=$host port=$port dbname=$db_name user=$user password=$passwd");
	  //$hasil = new PDO('mysql:host=localhost;dbname=eperencanaan','root','bappeda@4321');
	  $hasil= mysqli_connect($host, $user, $passwd, $db_name);

	 // $hasil = new PDO('mysql:host=$host;dbname=$db_name',$user,$passwd);
	
	if(!$hasil) die ("Koneksi gagal1 : ". mysqli_error()); 
    return $hasil;
	
}

function connect2()
{

    $host = $GLOBALS[db_host];
    $port = $GLOBALS[db_port]; 
    $user = $GLOBALS[db_user];
    $passwd = $GLOBALS[db_passwd];
    $db_name2 = $GLOBALS[db_name2];

}


function disconnect($resource_id)
{
	@pg_close($resource_id);
}
