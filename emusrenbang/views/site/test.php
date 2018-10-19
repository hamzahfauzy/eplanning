<?php
use yii\helpers\Html;
?>
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
	<div class='col-md-9'>
		<div id='test'>
<div style='height:300px;border:1px solid black; float:left;' class='col-md-12' name='frame_1' id='dani'>


</div>
<div style='width:100%;height:300px;border:1px solid black; float:left;' name='frame_2'>


</div>

<div style='width:100%;height:300px;border:1px solid black; float:left;' name='frame_2'>


</div>

<div style='width:100%;height:300px;border:1px solid black; float:left;' name='frame_2'>


</div>
</div>
	</div>
</div>