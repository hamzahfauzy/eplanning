<?php
namespace eperencanaan\models;

use yii\base\Model;
use eperencanaan\models\UsulanForm;

class UsulanForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $Kd_Kec;
    public $Kd_Kel;
    public $Kd_Urut_Kel;
    public $Kd_Lingkungan;
    //public $nameFile;

    public function rules()
    {
        return [
            [['Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan'],'required'], 
        ];
    }
	
	public function attributeLabels(){
		return [
			
			'Kd_Kec' => 'Kecamatan',
			'Kd_Kel' => 'Kelurahan',
			'Kd_Urut_Kel' => 'Urutan',
			'Kd_Lingkungan' => 'Lingkungan',

		];
	}

	public function UsulanLingkungan(){

		$NASrequest = Yii::$app->request;
		
        $NASmodelUsulan = new UsulanForm(); 
        print_r($NASmodelUsulan); 
        $NASmodelUsulan1= UsulanForm::find()->all();
        foreach($NASmodelUsulan1 as $d){
            $data[$d['Kd_Kec']]=$d['Nm_Kec'];         
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['lingkungan/index']);
        } else {
            return $this->render('index', [
                        'NASmodelUsulan' => $NASmodelUsulan,

                        ]);
        }
	}
}

?>