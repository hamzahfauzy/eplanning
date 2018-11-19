<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Usulan_Kelurahan_Media".
 *
 * @property integer $Kd_Media
 * @property integer $Kd_Ta_Musrenbang_Kelurahan
 * @property string $Jenis_Dokumen
 */
class TaUsulanKelurahanMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Usulan_Kelurahan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Media', 'Kd_Ta_Musrenbang_Kelurahan', 'Jenis_Dokumen'], 'required'],
            [['Kd_Media', 'Kd_Ta_Musrenbang_Kelurahan'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Media' => 'Kd  Media',
            'Kd_Ta_Musrenbang_Kelurahan' => 'Kd  Ta  Musrenbang  Kelurahan',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaUsulanKelurahanMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaUsulanKelurahanMediaQuery(get_called_class());
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTaMusrenbangKelurahan()
    {
        return $this->hasOne(TaMusrenbangKelurahan::className(), ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdMedia()
    {
        return $this->hasOne(\common\models\RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
}
