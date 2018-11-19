 <?php

 $db_host = "localhost:1303";
//$db_port = "22";
$db_user = "root";
$db_passwd = "bappeda@4321";
$db_name = "eperencanaan";
$conn = mysql_connect($db_host, $db_user, $db_pass);
//$conn = new PDO('mysql:host=localhost:1303;dbname=eperencanaan', 'root', 'bappeda@4321');

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = 'SELECT * FROM counter';

mysql_select_db('helloWorld');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    echo "ID :{$row['Id']}  <br> ".
         "Title: {$row['browser']} <br> ".
         "Description: {$row['tanggal']} <br> ".
        
         "--------------------------------<br>";
} 
echo "Fetched data successfully";
mysql_close($conn);
?>
    