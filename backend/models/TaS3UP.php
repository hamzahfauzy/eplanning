<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_S3UP".
 *
 * @property integer $Tahun
 * @property string $No_Bukti
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $Tgl_Bukti
 * @property integer $No_BKU
 * @property integer $Kd_Bank
 * @property integer $Kd_Pembayaran
 * @property double $Nilai
 * @property string $D_K
 * @property string $Keterangan
 */
class TaS3UP extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_S3UP';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Bukti', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Tgl_Bukti', 'No_BKU', 'Kd_Bank', 'Nilai', 'D_K', 'Keterangan'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_BKU', 'Kd_Bank', 'Kd_Pembayaran'], 'integer'],
            [['Tgl_Bukti'], 'safe'],
            [['Nilai'], 'number'],
            [['No_Bukti'], 'string', 'max' => 50],
            [['D_K'], 'string', 'max' => 1],
            [['Keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'No_Bukti' => 'No  Bukti',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Tgl_Bukti' => 'Tgl  Bukti',
            'No_BKU' => 'No  Bku',
            'Kd_Bank' => 'Kd  Bank',
            'Kd_Pembayaran' => 'Kd  Pembayaran',
            'Nilai' => 'Nilai',
            'D_K' => 'D  K',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaS3UPQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaS3UPQuery(get_called_class());
    }
}
