<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefMedia;

/**
 * This is the model class for table "Ta_Musrenbang_Kecamatan_Media".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Media
 * @property string $Jenis_Dokumen
 *
 * @property TaMusrenbangKecamatanAcara $tahun
 * @property RefMedia $kdMedia
 */
class TaMusrenbangKecamatanMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kecamatan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Media', 'Jenis_Dokumen'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Media'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'exist', 'skipOnError' => true, 'targetClass' => TaMusrenbangKecamatanAcara::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']],
            [['Kd_Media'], 'exist', 'skipOnError' => true, 'targetClass' => RefMedia::className(), 'targetAttribute' => ['Kd_Media' => 'Kd_Media']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Media' => 'Kd  Media',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaMusrenbangKecamatanAcara::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdMedia()
    {
        return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
}
