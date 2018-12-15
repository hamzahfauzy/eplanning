<?php

namespace emonev\models;

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
class TaKegiatanFile extends \yii\db\ActiveRecord
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
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg'], 'integer'],
            [['upload_at'], 'safe'],
            [['Nama_File'], 'string', 'max' => 255],
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
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Nama_File' => 'Nama  File',
            'upload_at' => 'Upload At',
        ];
    }
}
