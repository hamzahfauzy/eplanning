<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Relasi_Musrenbang_Kelurahan".
 *
 * @property integer $Kd_Ta_Musrenbang_Kelurahan_Verifikasi
 * @property integer $Kd_Ta_Musrenbang_Kelurahan
 *
 * @property TaKelurahanVerifikasiUsulanLingkungan $kdTaMusrenbangKelurahanVerifikasi
 * @property TaMusrenbangKelurahan $kdTaMusrenbangKelurahan
 */
class TaRelasiMusrenbangKelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Relasi_Musrenbang_Kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ta_Musrenbang_Kelurahan_Verifikasi', 'Kd_Ta_Musrenbang_Kelurahan'], 'required'],
            [['Kd_Ta_Musrenbang_Kelurahan_Verifikasi', 'Kd_Ta_Musrenbang_Kelurahan'], 'integer'],
            [['Kd_Ta_Musrenbang_Kelurahan_Verifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => TaKelurahanVerifikasiUsulanLingkungan::className(), 'targetAttribute' => ['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => 'Kd_Ta_Musrenbang_Kelurahan_Verifikasi']],
            [['Kd_Ta_Musrenbang_Kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => TaMusrenbangKelurahan::className(), 'targetAttribute' => ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => 'Kd  Ta  Musrenbang  Kelurahan  Verifikasi',
            'Kd_Ta_Musrenbang_Kelurahan' => 'Kd  Ta  Musrenbang  Kelurahan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTaMusrenbangKelurahanVerifikasi()
    {
        return $this->hasOne(TaKelurahanVerifikasiUsulanLingkungan::className(), ['Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => 'Kd_Ta_Musrenbang_Kelurahan_Verifikasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTaMusrenbangKelurahan()
    {
        return $this->hasOne(TaMusrenbangKelurahan::className(), ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaRelasiMusrenbangKelurahanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaRelasiMusrenbangKelurahanQuery(get_called_class());
    }
}
