<?php

namespace eperencanaan\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\RefMedia;

class UploadForm extends Model {

    /**
     * @var UploadedFile
     */
    public $absenFile;
    public $beritaFile;
    public $videoFile;
    public $imageFile;
	public $piFile;
	public $TandaTerimaFile;
    //public $nameFile;
    public $nameImage;
    public $nameAbsen;
    public $nameVideo;
    public $nameBerita;
	public $namePi;
	public $nameTandaTerima;

    public function rules() {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 50],
            [['absenFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxFiles' => 2],
			[['piFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
			[['TandaTerimaFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['beritaFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['videoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4, 3gp, mpeg', 'maxFiles' => 5],
        ];
    }

    public function attributeLabels() {
        return [

            'absenFile' => 'Berkas Absen',
            'beritaFile' => 'Berkas Berita Acara',
            'imageFile' => 'Berkas Gambar (maksimal 50 buah)',
            'videoFile' => 'Berkas Video',
			'piFile' => 'Berkas Bukti Undangan',
			'TandaTerimaFile' => 'Berkas Tanda Terima',
        ];
    }

    public function uploadFoto() {
        //if ($this->validate()) {
        if ($this->imageFile !== null) {
            $i = 0;
            foreach ($this->imageFile as $file) {
                $date = time();
                $file->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension);
                $model1 = new RefMedia();
                $model1->Jenis_Media = $file->extension;
                $model1->Type_Media = $file->extension;
                $model1->Judul_Media = preg_replace('/\s+/', '_',$file->baseName);
                $model1->Nm_Media = preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension;
                $model1->Created_At = $date;
                $this->nameImage[$i] = preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension;
                $model1->save(false);
                $i++;
            }
        }
        if ($this->absenFile !== null) {
            $i = 0;
            foreach ($this->absenFile as $file) {
                $date = time();
                $file->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension);
                $model1 = new RefMedia();
                $model1->Jenis_Media = $file->extension;
                $model1->Type_Media = $file->extension;
                $model1->Judul_Media = preg_replace('/\s+/', '_',$file->baseName);
                $model1->Nm_Media = preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension;
                $model1->Created_At = $date;
                $this->nameAbsen[$i] = preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension;
                $model1->save(false);
                $i++;
            }
        }
        if ($this->videoFile !== null) {
            $i = 0;
            foreach ($this->videoFile as $file) {
                $date = time();
                $file->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension);
                $model1 = new RefMedia();
                $model1->Jenis_Media = $file->extension;
                $model1->Type_Media = $file->extension;
                $model1->Judul_Media = preg_replace('/\s+/', '_',$file->baseName);
                $model1->Nm_Media = preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension;
                $model1->Created_At = $date;
                $this->nameVideo[$i] = preg_replace('/\s+/', '_',$file->baseName) . $date . '.' . $file->extension;
                $model1->save(false);
                $i++;
            }
        }
        if ($this->beritaFile !== null) {
            $date = time();
            $this->beritaFile->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . preg_replace('/\s+/', '_',$this->beritaFile->baseName) . $date . '.' . $this->beritaFile->extension);
            $model1 = new RefMedia();
            $model1->Jenis_Media = $this->beritaFile->extension;
            $model1->Type_Media = $this->beritaFile->extension;
            $model1->Judul_Media = preg_replace('/\s+/', '_',$this->beritaFile->baseName);
            $model1->Nm_Media = preg_replace('/\s+/', '_',$this->beritaFile->baseName) . $date . '.' . $this->beritaFile->extension;
            $model1->Created_At = $date;
            $this->nameBerita = preg_replace('/\s+/', '_',$this->beritaFile->baseName) . $date . '.' . $this->beritaFile->extension;
            $model1->save(false);
        }
		
		 if ($this->piFile !== null) {
            $date = time();
            $this->piFile->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . preg_replace('/\s+/', '_',$this->piFile->baseName) . $date . '.' . $this->piFile->extension);
            $model1 = new RefMedia();
            $model1->Jenis_Media = $this->piFile->extension;
            $model1->Type_Media = $this->piFile->extension;
            $model1->Judul_Media = preg_replace('/\s+/', '_',$this->piFile->baseName);
            $model1->Nm_Media = preg_replace('/\s+/', '_',$this->piFile->baseName) . $date . '.' . $this->piFile->extension;
            $model1->Created_At = $date;
            $this->namePi = preg_replace('/\s+/', '_',$this->piFile->baseName) . $date . '.' . $this->piFile->extension;
            $model1->save(false);
        }
		
		 if ($this->TandaTerimaFile !== null) {
            $date = time();
            $this->TandaTerimaFile->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . preg_replace('/\s+/', '_',$this->TandaTerimaFile->baseName) . $date . '.' . $this->TandaTerimaFile->extension);
            $model1 = new RefMedia();
            $model1->Jenis_Media = $this->TandaTerimaFile->extension;
            $model1->Type_Media = $this->TandaTerimaFile->extension;
            $model1->Judul_Media = preg_replace('/\s+/', '_',$this->TandaTerimaFile->baseName);
            $model1->Nm_Media = preg_replace('/\s+/', '_',$this->TandaTerimaFile->baseName) . $date . '.' . $this->TandaTerimaFile->extension;
            $model1->Created_At = $date;
            $this->nameTandaTerima = preg_replace('/\s+/', '_',$this->TandaTerimaFile->baseName) . $date . '.' . $this->TandaTerimaFile->extension;
            $model1->save(false);
        }
		
        return true;
        //} else {
        //    return false;
        //}
    }

    public function uploadAbsen() {
        if ($this->validate()) {

            $date = date("Y-m-d_h-i-s");

            $this->absenFile->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . $this->absenFile->baseName . $date . '.' . $this->absenFile->extension);
            $model2 = new RefMedia();
            $model2->Jenis_Media = $this->absenFile->extension;
            $model2->Type_Media = $this->absenFile->extension;
            $model2->Judul_Media = $this->absenFile->baseName;
            $model2->Nm_Media = $this->absenFile->baseName . $date . '.' . $this->absenFile->extension;
            $model2->Created_At = $date;
            $this->absenFile = $this->absenFile->baseName . $date . '.' . $this->absenFile->extension;
            $model2->save(false);
            //$_id = $model1->find()->where(['Nm_Media' => $this->imageFile->baseName.$date.'.'.$this->imageFile->extension])->one()->Kd_Media;

            $model5 = new TaForumLingkunganMedia();
            $model5->Kd_Ta_Forum_Lingkungan = $id;
            $model5->Kd_Media = $_id;
            $model5->save(false);

            $model6 = TaforumLingkungan::findOne($id);
            $model6->Kd_Status = 4;
            $model6->update(false);
            return true;
        } else {
            return false;
        }
    }

}

?>