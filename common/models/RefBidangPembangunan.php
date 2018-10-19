<?php

namespace common\models;

use Yii;

use eperencanaan\models\TaForumLingkungan;
/**
 * This is the model class for table "Ref_Bidang_Pembangunan".
 *
 * @property integer $Kd_Pem
 * @property string $Bidang_Pembangunan
 *
 * @property TaForumLingkungan[] $taForumLingkungans
 */
class RefBidangPembangunan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Bidang_Pembangunan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Bidang_Pembangunan'], 'required'],
            [['Bidang_Pembangunan'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Pem' => 'Kd  Pem',
            'Bidang_Pembangunan' => 'Bidang  Pembangunan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaForumLingkungans()
    {
        return $this->hasMany(TaForumLingkungan::className(), ['Kd_Pem' => 'Kd_Pem']);
    }
}
