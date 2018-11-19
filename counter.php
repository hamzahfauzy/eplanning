
<?
/*
http://phpdanmysql.com
*/
setcookie("counter","eperencanaan",time()+3600);
 
include "conn.php";
$tanggal;
$quey=mysql_db_query($db,"select * from counter",$koneksi);
while ($rows=mysql_fetch_array($quey))
{
	$visit=$rows[1];
}
 
if ($visit=="")
{
mysql_db_query($db,"insert into counter values('$tanggal',1)",$koneksi);
}
 
if (!isset($_COOKIE['counter']))
{
	$visit=$visit+1;
	mysql_db_query($db,"update counter set jml='$visit'",$koneksi);
}
 
?>
<html>
<table width="150" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CC99">
<tr> 
	<td bgcolor="#FF6633" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">PENGUNJUNG</font></strong></div></td>
</tr>
<tr>
	<td height="29" colspan="3" align="center" bgcolor="#333333"><br>
	<font face="verdana" size="2" color="#FF9933"><b><? echo $visit." Orang"?></b><br><br></font>	
	</td>
</tr>
 
<tr> 
	<td bgcolor="#FF6633" ><div align="center"><font face="verdana" size="2" color="#FFFFFF"><? echo $tanggal=date('D, d-M-Y');?></font></div></td>
</tr>
</br>
<tr>
<td align="center"><a href="http://phpdanmysql.com/">PhpdanMySQL.Com</a></td>
</tr>
</table>
</html>