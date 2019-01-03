<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan_Media".
 *
 * @property integer $Kd_Ta_Musrenbang_Kelurahan
 * @property integer $Kd_Media
 *
 * @property RefMedia $kdMedia
 * @property TaMusrenbangKelurahan $kdTaMusrenbangKelurahan
 */
class TaMusrenbangKelurahanMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Media'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Media'], 'integer'],
            [['Jenis_Dokumen'], 'string'],

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
            'Kd_Kel' => 'Kd  Kel',
            'Kd_Urut_Kel' => 'Kd  Urut  Kel',

            'Kd_Media' => 'Kd  Media',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }
    
     public function getKdMedia()

    {
        return $this->hasOne(\common\models\RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
}
