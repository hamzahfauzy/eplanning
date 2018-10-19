<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$bobot = $model->getRefKecamatanKriteriaBobots()->all();
$no = 1;
?>
  <table class="table">
    <thead>
      <tr>
      	<th>#</th>
        <th>RANGE</th>
        <th>SKOR</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bobot as $value): ?>
        <tr>
          <td><?= $no; ?></td>
          <td><?= $value->Range ?></td>
          <td><?= $value->Skor ?></td>
        </tr>
      <?php
      	$no++; 
      	endforeach; 
      ?>
    </tbody>
  </table>

