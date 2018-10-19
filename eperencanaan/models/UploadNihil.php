<?php

namespace eperencanaan\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\RefMedia;

class UploadNihil extends Model {

    /**
     * @var UploadedFile
     */
    //Made by Zulfikri
    public $nihil, $alasan, $nameFile;

    public function rules() {
        return [
            [['nihil'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
            [['alasan'], 'string'],
            [['alasan'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'nihil' => 'Berkas Surat Pernyataan Nihil',
            'alasan' => 'Keterangan/Alasan Tidak Bisa Diadakan Rembuk Warga',
        ];
    }

    public function simpan() {
        //if ($this->validate()) {
        if ($this->nihil !== null) {
            $file = $this->nihil;
            $date = time();
            $file->saveAs(realpath(dirname(dirname(__FILE__))) . '/web/data/' . $file->baseName . $date . '.' . $file->extension);
            $model1 = new RefMedia();
            $model1->Jenis_Media = $file->extension;
            $model1->Type_Media = $file->extension;
            $model1->Judul_Media = $file->baseName;
            $model1->Nm_Media = $file->baseName . $date . '.' . $file->extension;
            $model1->Created_At = $date;
            $this->nameFile = $file->baseName . $date . '.' . $file->extension;
            $model1->save(false);
            
        }

        return true;
        //} else {
        //    return false;
        //}
    }

}

?>