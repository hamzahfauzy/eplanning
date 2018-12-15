<?php
use yii\helpers\Html;
/*$this->registerJsFile('netizener/backend/web/undo.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('netizener/backend/web/rangy-core.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('netizener/backend/web/rangy-classapplier.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('netizener/backend/web/medium.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('netizener/backend/web/partials/inline.js', ['depends' => [\yii\web\JqueryAsset::className()]]);*/
$js="
$('#simpan').click(function(){
	
   v=$('#test').html();
   alert(v);   
   console.log(v); 
   
});

/*$( function() {
    $('[id^=\"draggable_\"]').draggable({
  		containment: '#test',
   		scroll: true
	});
 } );*/

/*$('[id^=\"draggable_\"]').focusout(function(){
    $('[id^=\"draggable_\"]').attr('contenteditable','false');
    $('[id^=\"draggable_\"]').draggable('destroy');
    //alert('test');
}); */

/*$('[id^=\"draggable_\"]').click(function(){
    $('[id^=\"draggable_\"]').draggable({
  		containment: '#result',
	});
	alert('test');
	
});*/

$('[name^=\"frame-\"]').click(function(){
	var input = $( this ).nextAll();
	var input1 = $( this ).prevAll();
	input.removeAttr('id');
	input1.removeAttr('id');
	$(this).attr('id','result');
});

$('[name^=\"frame_\"]').mouseout(function(){
	var input = $( '[id^=\"draggable_\"]' );
	
	input.removeAttr('id');
	
});

var div = document.getElementById('draggable_a');

/*div.onfocus = function() {
    window.setTimeout(function() {
        var sel, range;
        if (window.getSelection && document.createRange) {
            range = document.createRange();
            range.selectNodeContents(div);
            sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        } else if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(div);
            range.select();
        }
    }, 1);
    console.log('test');
};*/


$('[id^=\"item_\"]').click(function(){
	name=$(this).attr('name');
	$.post('index.php?r=ajax/getitemlayout&id='+name, function( data ) {
		$('#result').empty();
  		$('#result').prepend( data );
	});
});

/*$('[id^=\"draggable_\"]').dblclick(function(){
    $('[id^=\"draggable_\"]').draggable({
  		cancel: '#result',
	});
	//alert('test');
    $('[id^=\"draggable_\"]').attr('contenteditable','true');
});
*/


/*$('[id^=\"layout_\"]').click(function(){
	alert($(this).attr('name'));
});*/

";
$this->registerJs($js, 4, 'My');
?>
<style>
.drag_1{
	border: 1px solid;
    padding: 20px;
    resize: both;
    overflow: auto;
}
[name|='frame']{
	border: 1px solid;
	padding: 20px;
    resize: both;
    overflow: auto;
    height: auto;
}
.dropdown-submenu {
    position: relative;
}
#result{
	border: 1px dashed;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
#test{
	background-color:#fff;
}
</style>

<div class='row'>
	<div class='col-md-3' style='border:1px solid;'>
		<div>Panel</div>
		<ul>
		<?php
		foreach($layout as $dlayout){
		?>
			<li class="dropdown">
				<?php
				echo Html::a('<span class="title">'.$dlayout['section'].'</span>','#', ['name'=>$dlayout['_id'],
		'id'=>'layout_'.$dlayout['_id'], 'data-toggle'=>'dropdown', 'data-toggle'=>'dropdown', 'tabindex'=>'-1']);
				?>
				<ul class="dropdown-menu">
				<?php
				foreach($dlayout->items as $items){
				?>
					<li>
					<?php
						echo Html::a($items['name'],'#',['name'=>$dlayout['_id'],
		'id'=>'item_'.$dlayout['_id']])
					?>
					</li>
				<?php
				}
				?>
				</ul>
			</li>
		<?php
		}
		?>
		</ul>
	</div>
	<div class='col-md-9' id='test'>
	
<div class='col-md-12' name='frame-1'>

</div>
<div class='col-md-12' name='frame-2'>

</div>
<div class='col-md-12' name='frame-3'>

</div>


	</div>
</div>

<div id='simpan' class='btn btn-default'>simpan</div>
