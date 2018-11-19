<?php

namespace common\models;

use Yii;
use common\models\RefBidang;
use emusrenbang\models\TaBelanjaRincSub;
use common\models\TaKegiatan;

/**
 * This is the model class for table "Ref_Urusan".
 *
 * @property integer $Kd_Urusan
 * @property string $Nm_Urusan
 *
 * @property RefBidang[] $refBidangs
 */
class RefUrusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Urusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Nm_Urusan'], 'required'],
            [['Kd_Urusan'], 'integer'],
            [['Nm_Urusan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kode Urusan',
            'Nm_Urusan' => 'Urusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBidangs()
    {
        return $this->hasMany(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getSumBelanjaRincSub()
    {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Kd_Urusan' => 'Kd_Urusan'])->sum("Total");
    }

    public function getSumKegiatan()
    {
        return $this->hasMany(TaKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan'])->sum("Pagu_Anggaran_Nt1");
    }

    

    public static function find()
    {

        return new \common\models\query\RefUrusanQuery(get_called_class());
    }
}
