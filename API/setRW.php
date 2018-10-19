<?php
$conn = new mysqli("localhost","root","bappeda@4321","eperencanaan");

if(isset($_GET['rw'])){
	$conn->query("update setting set status=$_GET[rw] where id=1");
}

if(isset($_GET['status'])){
	$query = $conn->query("select * from setting");
	$rs = $query->fetch_assoc();
	echo $rs['status'];
}