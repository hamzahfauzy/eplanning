<?php
/* @var $this yii\web\View */
?>
<!--<h1>dashboard/index</h1>-->
<style>
.container {
  position: relative;
  padding-left: 1.5em;
  border-radius: .5em;
  color: #888;
}
.checkbox input {
  display: none;
}
.checkbox input:checked + label {
  background: rgba(79, 187, 228, 0.87);
}
.checkbox input:checked + label:before {
  -moz-transform: translateX(1.2em);
  -webkit-transform: translateX(1.2em);
  transform: translateX(1.2em);
}
.checkbox label {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-tap-highlight-color: transparent;
  width: 2.4em;
  height: 1.2em;
  padding: .2em;
  background: #bcb8b8;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  cursor: pointer;
  border-radius: 1em;
  -webkit-transition: background .1s ease;
  transition: background .1s ease;
}
.checkbox label:before {
  content: '';
  display: block;
  width: 1.2em;
  height: 1.2em;
  background: #e7e7e7;
  box-shadow: 3px 5px 20px -3px rgba(0, 0, 0, 0.32);
  border-radius: 50%;
  -webkit-transition: -webkit-transform .1s ease;
  transition: -webkit-transform .1s ease;
  transition: transform .1s ease;
  transition: transform .1s ease, -webkit-transform .1s ease;
}

</style>

<p>
   <!-- You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>. -->
<h2 style="margin-top: 0px;">Selamat datang di Aplikasi Referensi e-Planning Kabupaten Asahan</h3>
<div class="container">
  <div class="row">
    <span>Rembuk Warga</span>
    <div class="checkbox">
      <input type="checkbox" id="rw" onclick="checkAddress(this)" />
      <label for="rw"></label>
	  <span id="label"></span>
    </div>
  </div>
</div>

<script>
function checkAddress(checkbox)
{
    if (checkbox.checked)
    {
        //alert(location.hostname);
		xhr = new XMLHttpRequest();
		xhr.open("GET","http://"+location.hostname+"/eperencanaan/API/setRW.php?rw=1");
		xhr.onload = function(){
			document.getElementById("label").innerHTML = "ON";
		}
		xhr.send(null);
    }
	else
	{
		xhr = new XMLHttpRequest();
		xhr.open("GET","http://"+location.hostname+"/eperencanaan/API/setRW.php?rw=0");
		xhr.onload = function(){
			document.getElementById("label").innerHTML = "OFF";
		}
		xhr.send(null);
	}
}

function load(){
	xhr = new XMLHttpRequest();
	xhr.open("GET","http://"+location.hostname+"/eperencanaan/API/setRW.php?status=1");
	xhr.onload = function(){
		if(xhr.responseText=="1"){
			document.getElementById("label").innerHTML = "ON";
			document.getElementById("rw").checked = true;
		}else{
			document.getElementById("label").innerHTML = "OFF";
			document.getElementById("rw").checked = false;
		}
	}
	xhr.send(null);
}
load();
</script>
</p>