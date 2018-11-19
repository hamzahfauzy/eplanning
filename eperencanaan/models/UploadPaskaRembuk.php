<?php

namespace eperencanaan\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\RefMedia;

class UploadPaskaRembuk extends Model {

    /**
     * @var UploadedFile
     */

	//Made by Zulfikri
    public $videoFile;
    public $imageFile;
	public $id;
    public $nameImage;
    public $nameVideo;
	
    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 50],
            [['videoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4, 3gp, mpeg', 'maxFiles' => 5],
			[['id'], 'required']
        ];
    }

    public function attributeLabels() {
        return [
            'imageFile' => 'Berkas Gambar (maksimal 50 buah)',
            'videoFile' => 'Berkas Video',
        ];
    }

    public function upload() {
        //if ($this->validate()) {
        if ($this->imageFile !== null) {
            $i = 0;
            foreach ($this->imageFile as $file) {
                $date = time();
                $file->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . $file->baseName . $date . '.' . $file->extension);
                $model1 = new RefMedia();
                $model1->Jenis_Media = $file->extension;
                $model1->Type_Media = $file->extension;
                $model1->Judul_Media = $file->baseName;
                $model1->Nm_Media = $file->baseName . $date . '.' . $file->extension;
                $model1->Created_At = $date;
                $this->nameImage[$i] = $file->baseName . $date . '.' . $file->extension;
                $model1->save(false);
                $i++;
            }
        }
        
        if ($this->videoFile !== null) {
            $i = 0;
            foreach ($this->videoFile as $file) {
                $date = time();
                $file->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . $file->baseName . $date . '.' . $file->extension);
                $model1 = new RefMedia();
                $model1->Jenis_Media = $file->extension;
                $model1->Type_Media = $file->extension;
                $model1->Judul_Media = $file->baseName;
                $model1->Nm_Media = $file->baseName . $date . '.' . $file->extension;
                $model1->Created_At = $date;
                $this->nameVideo[$i] = $file->baseName . $date . '.' . $file->extension;
                $model1->save(false);
                $i++;
            }
        }	
        return true;
        //} else {
        //    return false;
        //}
    }

}

?>