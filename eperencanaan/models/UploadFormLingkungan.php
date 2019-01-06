<?php
namespace eperencanaan\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\RefMedia;
use common\models\TaMusrenbangKelurahanMedia;
use common\models\TaMusrenbangKelurahan;
class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false,'maxSize' => 1024 * 700 * 1],
        ];
    }
	
	public function attributeLabels(){
		return [
			'imageFile' => 'Berkas',
		];
	}
    
    public function upload($id)
    {
		if ($this->validate()) {
		
			$date = date("Y-m-d_h-i-s");
            $this->imageFile->saveAs(realpath(dirname(dirname(__FILE__))).'\\web\\data\\' . $this->imageFile->baseName.$date.'.'.$this->imageFile->extension);
		
		$model1 = new RefMedia();
		$model1->Jenis_Media = $this->imageFile->extension;
		$model1->Type_Media = $this->imageFile->extension;
		$model1->Judul_Media = $this->imageFile->baseName;
		$model1->Nm_Media= $this->imageFile->baseName.$date.'.'.$this->imageFile->extension;
		$model1->Created_At = $date;
		$model1->save(false);
		$_id = $model1->find()->where(['Nm_Media' => $this->imageFile->baseName.$date.'.'.$this->imageFile->extension])->one()->Kd_Media;
		$model2 = new TaMusrenbangKelurahanMedia();
		$model2->Kd_Musrenbang_Kelurahan = $id;
		$model2->Kd_Media = $_id;
		$model2->save(false);
		$model3 = TaMusrenbangKelurahan::findOne($id);
		$model3->Kd_Status = 4;
		$model3->update(false);
        
            return true;
        } else {
            return false;
        }
    }
}
?>