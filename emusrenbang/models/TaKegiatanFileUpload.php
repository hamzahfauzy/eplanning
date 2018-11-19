<?php

namespace emusrenbang\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Ta_Kegiatan_File".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 * @property string $Nama_File
 * @property string $uploat_at
 */
class TaKegiatanFileUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'Ta_Kegiatan_File';
    }

    /**
     * @inheritdoc
     */
    public $imageFile;
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, pdf, doc, docx, xls, xlsx', 'maxSize' => 1024 * 1024 * 3],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        	'imageFile' => 'Upload File',
        ];
    }
}
