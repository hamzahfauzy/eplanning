<?php

namespace referensi\controllers;

use Yii;
use common\models\RefLingkungan;
use common\models\RefKecamatan;

class DodolController extends \yii\web\Controller {

    public function actionKecamatan() {
        $Kd_Prov = 12;
        $Kd_Kab = 71;
        $Kd_Kec = 10;
        // $Kd_Kel = 1;
        // $Kd_Urut_Kel = 8;

        $model = $this->findKecamatan($Kd_Prov, $Kd_Kab, $Kd_Kec);
        /*
          $Jd_Lingkungan = RefLingkungan::find()
          ->where(['Kd_Prov' => $Kd_Prov,
          'Kd_Kab' => $Kd_Kab,
          'Kd_Kec' => $Kd_Kec,
          'Kd_Kel' => $Kd_Kel,
          'Kd_Urut_Kel' => $Kd_Urut_Kel])
          ->all();
         */

        foreach ($model->refKelurahans as $variable) {
            $no = 0;
            echo "#####";
            echo '<br>';
            foreach ($variable->lingkungans as $value) {
                $no++;
                //       $lingkungan = $this->findModel($value->Kd_Prov, $value->Kd_Kab, $value->Kd_Kec, $value->Kd_Kel, $value->Kd_Urut_Kel, $value->Kd_Lingkungan);
                echo $value->Kd_Lingkungan;
                echo '<br>';
                $value->Kd_Lingkungan = $no;
                //    $value->save(TRUE);
            }
        }

        //   echo '<pre>';
        //   print_r($model->lingkungan);
        //   echo '</pre>';
        // return $this->render('index',['model' => $model]);
    }

    public function actionLingkungan($Kd_Prov, $Kd_Kab, $Kd_Kec,$Kd_Kel,$Kd_Urut_Kel) {
  //    public function actionLingkungan() {
   //    $Kd_Prov = 12;
    //    $Kd_Kab = 71;
    //   $Kd_Kec = 6;
    //    $Kd_Kel = 1;
   //    $Kd_Urut_Kel = 3;

  //      $model = $this->findKecamatan($Kd_Prov, $Kd_Kab, $Kd_Kec);

        $model = RefLingkungan::find()
                ->where(['Kd_Prov' => $Kd_Prov,
                    'Kd_Kab' => $Kd_Kab,
                    'Kd_Kec' => $Kd_Kec,
                    'Kd_Kel' => $Kd_Kel,
                    'Kd_Urut_Kel' => $Kd_Urut_Kel])
                ->all();

        $no = 1;
        foreach ($model as $variable) {

            echo $variable->Kd_Lingkungan;
            if ($variable->Kd_Lingkungan !== $no) {
                $variable->Kd_Lingkungan = $no;
                $variable->save();
                echo '==> ';
                echo $variable->Kd_Lingkungan;
            }
            $no++;
            echo '<br>';
        }

        //   echo '<pre>';
        //   print_r($model->lingkungan);
        //   echo '</pre>';
        // return $this->render('index',['model' => $model]);
    }
    public function actionUser() {
  //    public function actionLingkungan() {
   //    $Kd_Prov = 12;
    //    $Kd_Kab = 71;
    //   $Kd_Kec = 6;
    //    $Kd_Kel = 1;
   //    $Kd_Urut_Kel = 3;

  //      $model = $this->findKecamatan($Kd_Prov, $Kd_Kab, $Kd_Kec);

        $model = \common\models\User::find()->all();

        $no = 1;
        foreach ($model as $variable) {
// if ()
            echo $variable->Kd_Lingkungan;
            if ($variable->Kd_Lingkungan !== $no) {
                $variable->Kd_Lingkungan = $no;
                $variable->save();
                echo '==> ';
                echo $variable->Kd_Lingkungan;
            }
            $no++;
            echo '<br>';
        }

        //   echo '<pre>';
        //   print_r($model->lingkungan);
        //   echo '</pre>';
        // return $this->render('index',['model' => $model]);
    }

    protected function findKecamatan($Kd_Prov, $Kd_Kab, $Kd_Kec) {
        if (($model = RefKecamatan::findOne(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel($Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut_Kel, $Kd_Lingkungan) {
        if (($model = RefLingkungan::findOne(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec' => $Kd_Kec, 'Kd_Kel' => $Kd_Kel, 'Kd_Urut_Kel' => $Kd_Urut_Kel, 'Kd_Lingkungan' => $Kd_Lingkungan])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
