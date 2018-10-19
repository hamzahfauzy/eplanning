<?php

$js="
$('[id^=\"draggable_\"]').focusout(function(){
    $('[id^=\"draggable_\"]').attr('contenteditable','false');
    $('[id^=\"draggable_\"]').draggable('destroy');
    
});
$('[id^=\"draggable_\"]').click(function(){
    $('[id^=\"draggable_\"]').draggable({
  		containment: '#test',
	});
	//alert('test');
});
$('[id^=\"draggable_\"]').dblclick(function(){
    $('[id^=\"draggable_\"]').draggable({
  		cancel: '#test',
	});
	//alert('test');
    $('[id^=\"draggable_\"]').attr('contenteditable','true');
});

$('#tombol').click(function(){
   v=$('#test').html();
   alert(v);    
});

";
$this->registerJs($js, 4, 'My');
?>
<style>
	.drag_1{
		width:100px;
	}
	#sortable1, #sortable2, #sortable3, #test { 
		list-style-type: none; margin: 0; float: left; margin-right: 10px; background: #eee; padding: 5px; width: 143px;
	}
  	#sortable1 li, #sortable2 li, #sortable3 li { 
  		margin: 5px; padding: 5px; font-size: 1.2em; width: 120px; 
  	}
</style>

<div id="sortable1" class="droptrue">
  <div class="ui-state-default">Item 1</div>
  <div class="ui-state-default" id='draggable_b'>Item 2</div>
  <div class="ui-state-default" id='draggable_d'>Item 3</div>
  <div class="ui-state-default" id='draggable_e'>Item 4</div>
  <div class="ui-state-default" id='draggable_f'>Item 5</div>
</div>

<div style='width:500px;height:300px;border:1px solid black;background-color:lightgreen' id='test'>
<div class='drag_1' id='draggable_g'>satu</div>
<div class='drag_2' contenteditable='true' id='draggable_h'><span id='a'>test</span></div>

</div>

<div id='tombol' class='btn btn-default'>simpan</div>
