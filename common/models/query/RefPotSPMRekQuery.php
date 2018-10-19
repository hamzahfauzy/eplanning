<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefPotSPMRek]].
 *
 * @see \common\models\RefPotSPMRek
 */
class RefPotSPMRekQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefPotSPMRek[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefPotSPMRek|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
