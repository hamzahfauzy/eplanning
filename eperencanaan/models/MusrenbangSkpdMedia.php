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
class MusrenbangSkpdMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Musrenbang_Skpd_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub_Unit', 'Kd_Media', 'Jenis_Dokumen'], 'required'],
            [['Tahun', 'Jenis_Dokumen'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub_Unit', 'Kd_Media'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
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
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub_Unit' => 'Kd  Sub  Unit',
			'Kd_Media' => 'Kd  Media',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(MusrenbangSkpdAcara::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub_Unit' => 'Kd_Sub_Unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdMedia()
    {
        return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
}
