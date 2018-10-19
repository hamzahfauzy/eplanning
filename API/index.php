<?php
$conn = new mysqli("localhost","root","bappeda@4321","eperencanaan");
function getSatuan($param=false){
	global $conn;
	$satuan = $conn->query("select * from Ref_Standard_Satuan");
	$data = [];
	foreach($satuan as $rows){
		$data[] = $rows;
	}

	echo json_encode($data);
}

function getSKPD($param=false){
	global $conn;
	$satuan = $conn->query("select * from Ref_Sub_Unit where Nm_Sub_Unit NOT LIKE '%Kecamatan%'");
	$data = [];
	foreach($satuan as $rows){
		$data[] = $rows;
	}

	echo json_encode($data);
}

echo $_GET['fungsi']($_GET['param']);
//echo $_GET['fungsi'];